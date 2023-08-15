<?php include('Recursos/Nav.php'); ?>
<?php
    require_once("bd.php");

    $message = '';
    $BD = new bd();

    if (isset($_POST['User_Register'])){
        $id=$_POST['correo'];
        $nom = $_POST['nombre'];
        $app = $_POST['apellido_paterno'];
        $apm = $_POST['apellido_materno'];
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $nac = $_POST['nacionalidad'];
        $idioma = $_POST['idioma_preferente'];
        $pron = $_POST['preferencia_pronombre'];
        $fechaNac = $_POST['fecha_nacimiento'];
        $message = $BD->RegUser($id,$nom,$app,$apm,$password,$nac,$idioma,$pron,$fechaNac);
        
    }
?>
<!DOCTYPE html>
<html lang="es">
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


        <form action="registroUsuario.php" method="POST">
            <h1>Formulario de Registro</h1>


            <div class="input-box">
                <input type="text" id="nombre" name="nombre" maxlength="20" placeholder="Nombre" required>
                <i class='bx bxs-user' ></i>
            </div>
            
            <div class="input-box">
                <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required>
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
                <select class="form-control" id="idioma_preferente" name="idioma_preferente">
                    <option value="">Idioma Preferente</option>
                    <option value="idioma1">Español</option>
                    <option value="idioma2">Inglés</option>
                    <!-- Agregar más opciones según sea necesario -->
                </select>
                <i class='bx bxs-message-rounded-detail'></i>
            </div>
            
            <div class="input-box">
                <input type="text" id="preferencia_pronombre" name="preferencia_pronombre" placeholder="Sobrenombre" required>
                <i class='bx bxs-user' ></i>
            </div>
            
            <div class="input-box">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
             <br>
            <button type="submit" class="custom-btn" name="User_Register" value="NewUser">Registrarse</button>
        </form>
    </main>
</body>
</html>