<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultorio Médico</title>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1500px;
            margin-top: 25px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            width: 100px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
        }

        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-columns {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Servicios </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/hola">Bolsa de trabajo</a></li>
                        <li><a class="dropdown-item" href="#">Soporte</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Contacto</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Acceso a la aplicación </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <li><a class="dropdown-item" href="{{ route('login') }}">Soy Doctor</a></li>
                        <li><a class="dropdown-item" href="http://localhost:3000/">Soy Paciente</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Carrusel -->
    <section id="carrusel">
        <div id="carousel-home" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carousel-home" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carousel-home" data-bs-slide-to="1"></li>
                <li data-bs-target="#carousel-home" data-bs-slide-to="2"></li>
                <li data-bs-target="#carousel-home" data-bs-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('img/logo.png') }}" alt="Niña paisaje">
                    <div class="carousel-caption">
                        <h3 style="color: white;">Bienvenidos a Saludinno</h3>
                        <p style="color: white;">Consultas a tu alcance</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/5 .jpg') }}" alt="mujer con camara">
                    <div class="carousel-caption">
                        <h3 style="color: black;">Crea Expediente por paciente con mucha facilidad</h3>
                        <p style="color: black;">Lista De Pacientes Siempre en tu mano</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/ftp.jpg') }}" alt="mujer con camara">
                    <div class="carousel-caption">
                        <h3 style="color: black;">Nunca antes ha sido tan sencillo agendar una cita</h3>
                        <p style="color: black;">Calendario para agendar citas</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/foto1(1).png') }}" alt="Amo las motocicletas">
                    <div class="carousel-caption">
                        <h3 style="color: white;">Recetas facil y rápido</h3>
                        <p style="color: white;">Tan Facil como apretar un boton</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel-home" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only" style="color: black;">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carousel-home" role="button" data-bs-slide="next">
                <span class="sr-only" style="color: black;">Siguiente</span>
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </section>
    <br><br>

    <!-- Sección Empresa -->
    <section id="empresa">
        <div class="conetenidoseccion">
            <div class="container">
                <h2 class="text-center">Acerca</h2>
                <p class="lead text-center">Saludinno es una empresa dedicada a consultas médicas. Contamos con la experiencia de los mejores asesores en sistemas de salud en México, enfocándonos en la atención y necesidades de nuestros pacientes.</p>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 text-center">
                            <img class="card-img-top" src="{{ asset('img/3.png') }}" alt="Objetivo">
                            <div class="card-body d-flex flex-column">
                                <br> <br> <br> <br> <br> <br>
                                <h4 class="card-title">Objetivo</h4>
                                <p class="card-text flex-grow-1">
                                    En Saludinno buscamos ofrecer el mejor servicio de consultas por médicos especialistas, médicos generales, psicólogos. El objetivo principal es digitalizar su consulta, maneje su consultorio desde cualquier dispositivo.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 text-center">
                            <img class="card-img-top" src="{{ asset('img/2.jpg') }}" alt="Misión">
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">Misión</h4>
                                <p class="card-text flex-grow-1">
                                    Diseñar la mejor herramienta para facilitar el trabajo del profesionista, haciendo fácil su manejo con servicio personalizado y atención profesional contando con un equipo de trabajo dedicado.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 text-center">
                            <img class="card-img-top" src="{{ asset('img/7.jpg') }}" alt="Visión">
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">Visión</h4>
                                <p class="card-text flex-grow-1">
                                    En Saludinno tenemos el objetivo de lograr la más amplia gama de proyectos para herramientas digitales y de alta tecnología para profesionistas como médicos especialistas, por lo que contamos con personal altamente capacitado en diferentes áreas para trabajar en equipo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="noticias">
        <div class="conetenidoseccion">
            <div class="container">
                <h3 class="text-center">Todo lo que necesitas hacer es dar click</h3>
                <p class="lead">Saludinno es un sistema sencillo de
                    usar, con la facilidad de tener siempre tu citas en la palma
                    de tu mano. Disfruta de las características especiales de nuestro
                    sistema, ahorra tiempo, dinero</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-columns">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('img/7.jpg') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">MultiPlataforma</h5>
                                    <p class="card-text">Obten datos importantes de tus
                                        pacientes con solo ingresar en tu sistema, siempre estará a tu
                                        alcance en cualquier dispositivo ya sea PC, Tablet o Celular.</p>
                                </div>
                            </div>
                            <div class="card p-3">
                                <blockquote class="blockquote mb-0 card-body">
                                    <p>No puede el médico curar bien sin tener presente al
                                        enfermo.</p>
                                    <footer class="blockquote-footer">
                                        <small class="text-muted"> Séneca <cite title="Source Title"></cite>
                                        </small>
                                    </footer>
                                </blockquote>
                            </div>
                            <div class="card bg-primary text-white text-center p-3">
                                <blockquote class="blockquote mb-0">
                                    <p>Sólo el médico y el dramaturgo gozan del raro privilegio
                                        de cobrar las desazones que nos dan.</p>
                                    <footer class="blockquote-footer">
                                        <small> (Santiago Ramón Y Cajal) <cite title="Source Title"></cite>
                                        </small>
                                    </footer>
                                </blockquote>
                            </div>
                            <div class="card bg-warning text-white text-left p-3">

                                <blockquote class="blockquote mb-0">
                                    <p>La medicina es la única profesión universal que en todas
                                        partes sigue los mismos métodos, actúa con los mismos
                                        objetivos y busca los mismos fines.</p>
                                    <footer class="blockquote-footer">
                                        <small> <cite title="Source Title">Sir William
                                                Osler</cite>
                                        </small>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p>© 2024 Saludinno. Todos los derechos reservados.</p>
                    <p>Aviso de <a href="/aviso">Privacidad</a></p>
                </div>
                <div class="col-sm-4">
                    <ul class="list-unstyled">
                        <li><a href="/">Inicio</a></li>
                        <li><a href="/">Acerca de</a></li>
                        <li><a href="/">Últimas noticias</a></li>
                    </ul>
                </div>
                <div class="col-sm-4">
                    <ul class="list-unstyled">
                        <li><a href="#">facebook</a></li>
                        <li><a href="#">twitter</a></li>
                        <li><a href="#">youtube</a></li>
                        <li><a href="#">linkedin</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>