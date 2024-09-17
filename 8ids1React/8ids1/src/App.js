import logo from './logo.svg';
import './App.css';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Login from './components/Login';
import Home from './components/Home';
import Especialidad from './components/Especialidad';
import Registrar from './components/Registrar';
import GenerarCita from './components/Cita';

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path='/' Component={Login}/>
        <Route path='/home' Component={Home}/>
        <Route path='/especialidad/:id?' Component={Especialidad}/>
        <Route path="/registrar" Component={Registrar}/>
        <Route path='/cita' Component={GenerarCita}/>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
