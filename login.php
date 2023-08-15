<?php
    require_once('bd.php');
    $BD = new bd();
    session_start();
    $message = '';
    if(isset($_POST['Login_User'])){
        $correo = $_POST['CorreoElectronico'];
        $password = $_POST['Password'];
        $log = $BD->VerificarLogin($correo,$password);
        if($log){
            $_SESSION['Correo'] = $correo;
            $_SESSION['Nombre_Usuario'] = $BD->ObtenerNombre($correo);
            $_SESSION['Rol'] = $BD->ObtenerRol($correo);
            if($_SESSION['Rol'] == "Terapeuta"){
                $_SESSION['RFC'] = $BD->ObtenerRFC($correo);
                header("Location: Servicios_Terapeutas.php");
                
            }
            else if($_SESSION['Rol'] == "User"){
                header("Location: Servicios_Pacientes.php");
                
            }
            else if($_SESSION['Rol'] == "Admin"){
                header("Location: Administrador.php");
                
            }
        }
        else{
            $message = 'CORREO Y/O CONTRASEÑA INCORRECTOS';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

    <br> <br>
    
    <main class="container mb-3 wrapper">
        <center><img src="Img/Logo.png" alt="Logo" width="150px"></center>

        <form action="login.php" method="post">
            <h1>Iniciar Sesión</h1>
                    
            <div class="input-box ">
                <input type="email" name="CorreoElectronico" id="CorreoElectronico" placeholder="Correo Electronico" required>
                <i class='bx bxs-user'></i>
            </div>
                    
            <div class="input-box">
                <input type="password" name="Password" id="Password" placeholder="Contraseña" required>    
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Recordar Contraseña</label>
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" name="Login_User" value="LoginUser" class="custom-btn">Iniciar Sesión</button>

            <div class="register-link">
                <p>
                    ¿No tienes una cuenta?
                    <a href="Eleccion_Sesion.php">Registrarse</a>
                </p>
            </div>
        </form>
    </main>

    <br><br>
</body>
</html>
    