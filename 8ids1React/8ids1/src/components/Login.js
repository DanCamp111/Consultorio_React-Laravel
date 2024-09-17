import React, { useState } from 'react';
import { Form, Button, Container, Col } from 'react-bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './CSS/Login.css';
import logo from './img/AdminLTELogo.png'
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

function Login() {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();
  const [error, setError] = useState('');

  const loginValidate = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://127.0.0.1:8000/api/login', {
        email: username,
        password: password
      });

      if (response.data.acceso === "OK") {
        localStorage.setItem('user', JSON.stringify({
          id: response.data.idUsuario,
          rol: response.data.rol
        }));
        if (response.data.rol === 'doctor') {
          navigate('/home');
        } else if (response.data.rol === 'paciente') {
          navigate('/cita');
        } else {
          setError('Rol desconocido');
        }
      } else {
        setError(response.data.error);
      }
    } catch (error) {
      setError('Ocurrió un error en el servidor');
      console.log('Ocurrió un error: ', error);
    }
  }

  return (
    <div>
      <Container className="d-flex justify-content-center align-items-center min-vh-70">
        <Col>
          <div className="card text-center box">
            <div className="card-header">
              <img src={logo} alt="Logo" />
            </div>
            <div className="card-body">
              <Form onSubmit={loginValidate}>
                <div className="form-group InputBox">
                  <input
                    type="email"
                    name="email"
                    value={username}
                    required
                    onChange={(e) => setUsername(e.target.value)}
                  />
                  <label><i className="fas fa-envelope"></i> Correo electrónico</label>
                </div>
                {error && <p className='text-danger'>{error}</p>}
                <div className="form-group InputBox">
                  <input
                    type="password"
                    name="password"
                    value={password}
                    required
                    onChange={(e) => setPassword(e.target.value)}
                  />
                  <label><i className="fas fa-lock"></i> Contraseña</label>
                </div>
                <div className="form-group">
                  <Button className="btn btn-primary btn-block" type="submit">Ingresar</Button>
                </div>
                <div className="form-group">
                  <a href="/registrar">Registrar una nueva membresía</a>
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

export default Login;
