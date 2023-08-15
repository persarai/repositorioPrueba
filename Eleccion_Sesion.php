<?php include('Recursos/Nav.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- //!BootStrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- //!Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- //!Style Custom-->
    <link rel="stylesheet" href="CSS/Styles.css">

    <!-- //!Style Custom Register-->
    <link rel="stylesheet" href="CSS/Registro.css">
</head>
<body>
    <br><br><br>
    <main class="container">
        <h1 class="center">¿Cómo deseas registrarte?</h1>

        <section class="row">
            <article class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="chart">
                    <!-- //*Primera Imagen -->
                    <br>
                    <center><img src="Img/User.png" alt="img_1" class="img-fluid" width="280px" height="280px"></center>
                    <br><br>
                    <center><a href="registroUsuario.php" class="btn btn-outline-success">Usuario</a></center>
                    <br>
                </div>
            </article>

            <!-- //*Segunda Imagen -->
            <article class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="chart">
                    <center><img src="Img/Profesional.png" alt="img_3" class="img-fluid" width="300px" height="300px"></center>
                    <br>
                    <center><a href="registroTerapeuta.php" class="btn btn-outline-success">Terapeuta</a></center>
                    <br><br>
                </div>
            </article>
        </section>
    </main>
    <br><br><br>
    <?php include("Recursos/Footer.php") ?>

