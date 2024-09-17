import React, { useState, useEffect } from 'react';
import { Form, Button, Container, Table, Spinner } from 'react-bootstrap';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

function GenerarCita() {
  const [fecha, setFecha] = useState('');
  const [especialidades, setEspecialidades] = useState([]);
  const [selectedEspecialidad, setSelectedEspecialidad] = useState('');
  const [observaciones, setObservaciones] = useState('');
  const [citas, setCitas] = useState([]);
  const [pacienteId, setPacienteId] = useState('');
  const [loading, setLoading] = useState(true);
  const user = JSON.parse(localStorage.getItem('user'));
  const navigate = useNavigate();

  useEffect(() => {
    async function fetchData() {
      try {
        const especialidadesResponse = await axios.get('http://127.0.0.1:8000/api/especialidades');
        setEspecialidades(especialidadesResponse.data);

        if (user && user.id) {
          const pacienteResponse = await axios.get(`http://127.0.0.1:8000/api/pacientes/usuario/${user.id}`);
          setPacienteId(pacienteResponse.data.id);

          const citasResponse = await axios.get(`http://127.0.0.1:8000/api/citas/paciente/${pacienteResponse.data.id}`);
          const citasConEspecialidad = citasResponse.data.map(cita => {
            const especialidad = especialidadesResponse.data.find(e => e.id === cita.id_especialidades);
            return {
              ...cita,
              especialidad_nombre: especialidad ? especialidad.nombre : 'Desconocida'
            };
          });

          setCitas(citasConEspecialidad);
        }

        setLoading(false);
      } catch (error) {
        console.error('Hubo un error al obtener los datos:', error);
        setLoading(false); // Asegúrate de detener la carga incluso si hay un error
      }
    }

    fetchData();
  }, [user]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    const now = new Date();
    const selectedDate = new Date(fecha);
    
    // Verificación de fecha
    if (selectedDate < now) {
      alert('No se puede generar una cita en una fecha pasada.');
      return;
    }

    setLoading(true);

    try {
      const response = await axios.post('http://127.0.0.1:8000/api/citas/save', {
        id_paciente: pacienteId,
        fecha: fecha,
        id_especialidades: selectedEspecialidad,
        observaciones: 'pendiente', 
        estado: 'pendiente',
        consultorio: 'pendiente', 
      });

      const especialidad = especialidades.find(e => e.id === response.data.id_especialidades);
      const nuevaCita = {
        ...response.data,
        especialidad_nombre: especialidad ? especialidad.nombre : 'Desconocida'
      };

      setCitas([...citas, nuevaCita]);
      setLoading(false);
    } catch (error) {
      console.error('Hubo un error al crear la cita:', error);
      setLoading(false);
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('user');
    navigate('/'); // Redirige a la página de inicio de sesión
  };

  return (
    <>
      <Navbar bg="dark" variant="dark">
        <Container>
          <Nav className="me-auto">
            <Nav.Link href='http://127.0.0.1:8000'>Inicio</Nav.Link>
            <Nav.Link href="/cita">Citas</Nav.Link>
          </Nav>
          <Button variant="outline-light" onClick={handleLogout}>Cerrar sesión</Button>
        </Container>
      </Navbar>
      <Container>
        <h2>Generar Cita</h2>
        <Form onSubmit={handleSubmit}>
          <Form.Group controlId="formFecha">
            <Form.Label>Fecha</Form.Label>
            <Form.Control
              type="datetime-local"
              value={fecha}
              onChange={(e) => setFecha(e.target.value)}
              required
            />
          </Form.Group>

          <Form.Group controlId="formEspecialidades">
            <Form.Label>Especialidades</Form.Label>
            <Form.Control
              as="select"
              value={selectedEspecialidad}
              onChange={(e) => setSelectedEspecialidad(e.target.value)}
              required
            >
              <option value="">Seleccione una especialidad</option>
              {especialidades.map((especialidad) => (
                <option key={especialidad.id} value={especialidad.id}>
                  {especialidad.nombre}
                </option>
              ))}
            </Form.Control>
          </Form.Group>

          <Button variant="primary" type="submit" disabled={loading}>
            {loading ? <Spinner animation="border" size="sm" /> : 'Generar Cita'}
          </Button>
        </Form>

        <h2>Mis Citas</h2>
        {loading ? (
          <p>Loading...</p>
        ) : (
          <Table striped bordered hover>
            <thead>
              <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Especialidad</th>
                <th>Observaciones</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              {citas.map((cita) => (
                <tr key={cita.id}>
                  <td>{cita.id}</td>
                  <td>{new Date(cita.fecha).toLocaleString()}</td>
                  <td>{cita.especialidad_nombre}</td>
                  <td>{cita.observaciones}</td>
                  <td>{cita.estado}</td>
                </tr>
              ))}
            </tbody>
          </Table>
        )}
      </Container>
    </>
  );
}

export default GenerarCita;
