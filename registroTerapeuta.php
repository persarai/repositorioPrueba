<?php include('Recursos/Nav.php'); ?>
<?php
    require_once("bd.php");
    $BD = new bd();
    $message = '';

    if (isset($_POST['Terap_Register'])){
        $id=$_POST['RFC'];
        $correo = $_POST['correo'];
        $nombre = $_POST['nombre'];
        $ApP = $_POST['apellido_paterno'];
        $ApM = $_POST['apellido_materno'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $cedula = $_POST['cedula_profesional'];
        $nacionalidad = $_POST['nacionalidad'];
        $especialidad = $_POST['especialidad'];
        $lengua = $_POST['lengua_materna'];
        $message = $BD->RegT($id,$correo,$nombre,$ApP,$ApM,$password,$cedula,$nacionalidad,$especialidad,$lengua);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>

    <!-- //!Icons Form -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- //!BootStrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- //!Style Custom-->
    <link rel="stylesheet" href="CSS/Styles.css">

    <!-- //!Custom Style Form CSS-->
    <link rel="stylesheet" href="CSS/Form.css">

    <!-- //!Icons Form -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php if(!empty($message)): ?>
        <div class="alert alert-dark" role="alert">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>

    <br><br>

    <style>
        .wrapper{
            width: 800px;
        }
    </style>

    <main class="container mb-3 wrapper">
        <center><img src="Img/Logo.png" alt="Logo"   width="150px"></center>

        <form action="registroTerapeuta.php" method="POST">
            <h1>Formulario de Registro</h1>
                
            <div class="input-box">
                <input type="text" id="nombre" name="nombre" maxlength="20" placeholder="Nombre">
                <i class='bx bxs-user' ></i>
            </div>

            <div class="input-box">
                <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno">
                <i class='bx bxs-user' ></i>
            </div>

            <div class="input-box">
                <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required>
                <i class='bx bxs-user' ></i>
            </div>

            <div class="input-box">
                <input type="email" id="correo" name="correo" placeholder="Correo Electrónico" required>
                <i class='bx bx-at'></i>
            </div>

            <div class="input-box">
                <input type="password" id="password" name="password" placeholder="Contraseña" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="input-box">
                <input type="text"  id="cedula_profesional" name="cedula_profesional" placeholder="Cédula Profesional">
                <i class='bx bxs-id-card'></i>
            </div>

            <div class="input-box">
                <input type="text" id="especialidad" name="especialidad" placeholder="Especialidad">
                <i class='bx bxs-graduation'></i>
            </div>

            <div class="input-box">
                <input type="text" id="RFC" name="RFC" required onkeypress="return ((event.charCode >= 48 && event.charCode <= 57) || (event.charCode >= 65 && event.charCode <= 90))" placeholder="RFC   |  SOLO NÚMEROS Y MAYÚSCULAS" max=15>
                <i class='bx bxs-id-card'></i>
            </div>

            <div class="select-box">
                <select id="nacionalidad" name="nacionalidad" required>
                    <option value="">Selecciona tu nacionalidad</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Chile">Chile</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Costa Rica">Costa Rica</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Honduras">Honduras</option>
                    <option value="México">México</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Panamá">Panamá</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Perú">Perú</option>
                    <option value="República Dominicana">República Dominicana</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Venezuela">Venezuela</option>
                        <!-- Agregar más opciones según sea necesario -->
                </select>
                <i class='bx bx-globe'></i>
            </div>

            <div class="select-box">
                <select id="lengua_materna" name="lengua_materna">
                    <option value="">Selecciona tu lengua materna</option>
                    <option value="idioma1">Español</option>
                    <option value="idioma2">Inglés</option>
                    <!-- Agregar más opciones según sea necesario -->
                </select>
                <i class='bx bxs-message-rounded-detail'></i>
            </div>
               
            <button type="submit" class="custom-btn" name="Terap_Register" value="NewTerap">Registrarse</button>
        </form>
    </main>
</body>
</html>
