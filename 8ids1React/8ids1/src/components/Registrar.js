import React, { useState } from 'react';
import { Form, Button, Container, Col } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './CSS/Login.css';
import logo from './img/AdminLTELogo.png'
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

function Registrar() {
  const [formData, setFormData] = useState({
    nombre: '',
    ap_paterno: '',
    ap_materno: '',
    email: '',
    telefono: '',
    password: ''
  });
  const navigate = useNavigate();
  const [error, setError] = useState('');

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/pacientes/guardar', formData);
      if (response.data === "OK") {
        navigate('/');
      }
    } catch (error) {
      console.error('Error registering user:', error);
    }
  };

  return (
    <div>
      <Container className="d-flex justify-content-center align-items-center min-vh-70">
        <Col>
          <div className="card text-center box">
            <div className="card-body">
              <Form onSubmit={handleSubmit}>
                <div className="form-group InputBox">
                  <input
                    type="text"
                    name="nombre"
                    value={formData.nombre}
                    required
                    onChange={handleChange}
                  />
                  <label><i className="fas fa-user"></i> Nombre</label>
                </div>
                <div className="form-group InputBox">
                  <input
                    type="text"
                    name="ap_paterno"
                    value={formData.ap_paterno}
                    required
                    onChange={handleChange}
                  />
                  <label><i className="fas fa-user"></i> Apellido Paterno</label>
                </div>
                <div className="form-group InputBox">
                  <input
                    type="text"
                    name="ap_materno"
                    value={formData.ap_materno}
                    required
                    onChange={handleChange}
                  />
                  <label><i className="fas fa-user"></i> Apellido Materno</label>
                </div>
                <div className="form-group InputBox">
                  <input
                    type="email"
                    name="email"
                    value={formData.email}
                    required
                    onChange={handleChange}
                  />
                  <label><i className="fas fa-envelope"></i> Correo Electrónico</label>
                </div>
                <div className="form-group InputBox">
                  <input
                    type="text"
                    name="telefono"
                    value={formData.telefono}
                    required
                    onChange={handleChange}
                  />
                  <label><i className="fas fa-phone"></i> Teléfono</label>
                </div>
                <div className="form-group InputBox">
                  <input
                    type="password"
                    name="password"
                    value={formData.password}
                    required
                    onChange={handleChange}
                  />
                  <label><i className="fas fa-lock"></i> Contraseña</label>
                </div>
                {error && <p className='text-danger'>{error}</p>}
                <div className="form-group">
                  <Button className="btn btn-primary btn-block" type="submit">Registrar</Button>
                </div>
                <div className="form-group">
                  <a href="/">Iniciar Sesión</a>
                </div>
              </Form>
            </div>
          </div>
        </Col>
      </Container>
      <script src="https://kit.fontawesome.com/f3cd46a135.js" crossorigin="anonymous"></script>
    </div>
  );
}

export default Registrar;
