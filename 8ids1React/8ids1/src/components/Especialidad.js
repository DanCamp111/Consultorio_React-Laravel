import React, { useEffect, useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import Button from 'react-bootstrap/Button';
import axios from 'axios';
import { Form } from 'react-bootstrap';

function Especialidad() {
  const [nombre, setNombre] = useState('');
  const navigate = useNavigate();
  const [error, setError] = useState('');
  const { id } = useParams();

  useEffect(() => {
    if (id) {
      fnEspecialidad();
    }
  }, [id]); 

  const fnEspecialidad = async () => {
    try {
      const response = await axios.get(`http://127.0.0.1:8000/api/especialidad/${id}`);
      setNombre(response.data.nombre);
    } catch (error) {
      console.error('Error fetching especialidad:', error);
      setError('Error fetching especialidad');
    }
  };

  const fnGuardar = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/especialidad/guardar', {
        id: id || 0,
        nombre: nombre
      });

      if (response.data === "OK") {
        navigate('/home');
      } else {
        setError(response.data.error);
      }
    } catch (error) {
      console.error('Error saving especialidad:', error);
      setError('Error saving especialidad');
    }
  };

  return (
    <>
      <Navbar bg="dark" variant="dark">
        <Container>
          <Navbar.Brand href="#home">Barra de navegacion</Navbar.Brand>
          <Nav className="me-auto">
            <Nav.Link href="/home">Especialidades</Nav.Link>
            <Nav.Link href="#features">Doctores</Nav.Link>
            <Nav.Link href="#pricing">Consultorios</Nav.Link>
          </Nav>
        </Container>
      </Navbar>
      <Container>
        <h1>{id ? 'Editar' : 'Agregar'} Especialidad</h1>
        {error && <p style={{ color: 'red' }}>{error}</p>}
        <Form onSubmit={fnGuardar}>
          <Form.Group className="mb-3" controlId="formNombre">
            <Form.Label>Nombre</Form.Label>
            <Form.Control
              type="text"
              value={nombre}
              onChange={(e) => setNombre(e.target.value)}
              placeholder="Ingrese el nombre de la especialidad"
            />
          </Form.Group>
          <Button variant="outline-primary" type="submit">
            Guardar
          </Button>
        </Form>
      </Container>
    </>
  );
}

export default Especialidad;
