<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConfiAqui</title>

    <!-- //!BootStrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- //!Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- //!Style Custom-->
    <link rel="stylesheet" href="CSS/Styles.css">

    <!-- //!Icons Form -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Logotipo -->
        <a class="navbar-brand" href="Index.php">
            <img src="Img/Logo.png" alt="Logo" height="40px">
        </a>

        <!-- Botón de navegación para dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del menú -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (isset($_SESSION['Rol'])) {
                $rol = $_SESSION['Rol'];

                if ($rol == "Terapeuta") { ?>
                    <!-- Opciones específicas para el rol de Terapeuta -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- ... Opciones para Terapeuta ... -->
                        <li class="nav-item"><a class="nav-link" href="agendar_cita.php">Agendar Cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="visualizar_citas.php">Ver mis citas</a></li>
                        <li class="nav-item"><a class="nav-link" href="actualizar_cita.php">Reagendar cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="borrar_citas.php">Cancelar cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="buscar_citas.php">Consultas SQL</a></li>
                    </ul>
                    
                        <form action="cerrar_sesion.php" class="d-flex">
                            <button class="btn btn-outline-success" type="submit">Cerrar sesión</button>
                        </form>
                    
                <?php } elseif ($rol == "User") { ?>
                    <!-- Opciones específicas para el rol de User -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="agendar_cita.php">Agendar Cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="visualizar_citas.php">Ver mis citas</a></li>
                        <li class="nav-item"><a class="nav-link" href="actualizar_cita.php">Reagendar cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="borrar_citas.php">Cancelar cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="buscar_citas.php">Consultas SQL</a></li>
                    </ul>
                    
                        <form action="cerrar_sesion.php" class="d-flex">
                            <button class="btn btn-outline-success" type="submit">Cerrar sesión</button>
                        </form>
                    
                <?php } elseif ($rol == "Admin") { ?>
                    <!-- Opciones específicas para el rol de Admin -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="agendar_cita.php">Agendar Cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="visualizar_citas.php">Ver mis citas</a></li>
                        <li class="nav-item"><a class="nav-link" href="actualizar_cita.php">Reagendar cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="borrar_citas.php">Cancelar cita</a></li>
                        <li class="nav-item"><a class="nav-link" href="buscar_citas.php">Consultas SQL</a></li>

                    </ul>

                    <form action="cerrar_sesion.php" class="d-flex">
                        <button class="btn btn-outline-success" type="submit">Cerrar sesión</button>
                    </form>

                <?php }
            } else { // No hay sesión iniciada 
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Nuestros_Servicios.php">¿Quiénes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Eleccion.php">Elige tu terapeuta</a>
                    </li>
                    <!-- //?Menu desplegable de las configuraciones -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sobre Nosotros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Nuestra Misión</a></li>
                            <li><a class="dropdown-item" href="#">Redes sociales</a></li>
                            <li><a class="dropdown-item" href="#">Colaboradores</a></li>
                        </ul>
                    </li>
                </ul>

                <form action="Eleccion_Sesion.php" class="d-flex">
                    <button class="btn btn-outline-success" type="submit">Registrarse</button>
                </form>


                <form action="login.php" class="d-flex">
                    <button class="btn btn-outline-success" type="submit">Iniciar Sesión</button>
                </form>



            <?php } ?>


        </div>
    </div>
</nav>