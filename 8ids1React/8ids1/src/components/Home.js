import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Table from 'react-bootstrap/Table';
import Button from 'react-bootstrap/Button';
import axios from 'axios';

function Home() {
  const [especialidades, setEspecialidades] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    fnEspecialidades();
  }, []);

  const fnEspecialidades = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/especialidades');
      setEspecialidades(response.data);
    } catch (error) {
      console.error('Error fetching especialidades:', error);
    }
  };

  const fnEliminar = async (id) => {
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/especialidad/eliminar', { id });

      if (response.data === "OK") {
        fnEspecialidades();
      }
    } catch (error) {
      console.error('Error eliminando especialidad:', error);
    }
  };

  const handleLogout = async () => {
    try {
      localStorage.removeItem('user');

      // Redirige al usuario a la página de inicio de sesión
      navigate('/');
    } catch (error) {
      console.error('Error during logout:', error);
    }
  };

  return (
    <>
      <Navbar bg="dark" variant="dark">
        <Container>
          <Nav className="me-auto">
            <Nav.Link href="/home">Especialidades</Nav.Link>
          </Nav>
          <Button variant="outline-light" onClick={handleLogout}>Cerrar sesión</Button>
        </Container>
      </Navbar>
      <Container>
        <h1>Especialidades</h1>
        <Table striped bordered hover>
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {especialidades.map((item) => (
              <tr key={item.id}>
                <td>{item.id}</td>
                <td>{item.nombre}</td>
                <td>
                  <Button variant="primary" size="sm" onClick={() => navigate(`/especialidad/${item.id}`)}>Editar</Button>
                  <Button variant="danger" size="sm" onClick={() => fnEliminar(item.id)}>Eliminar</Button>
                </td>
              </tr>
            ))}
          </tbody>
        </Table>
        <Button onClick={() => navigate('/especialidad')} variant="outline-success">Agregar</Button>
      </Container>
    </>
  );
}

export default Home;
