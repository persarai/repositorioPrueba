<?php include('Recursos/Nav.php'); ?>
<style>
    body{
        background: #51B6B6;
    }
</style>


<main class="container text-center">
        <hr>
        <h1 class="text-center">¿Qué vamos a hacer <font color="#FCBF18">hoy</font>?</h1>


        <section class="row text-center">
            
        <!-- //*Tarjeta 1 -->
            <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12 custom-card">
                <div class="card shadow text-bg-info mb-3">
                    <div class="card-body">
                        <a href="agendar_cita.php" class="btn btn-outline-success">AGENDAR CITA</a>
                    </div>
                </div>
            </article>
            
            <!-- //*Tarjeta 2 -->
            <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow text-bg-info mb-3">
                    <div class="card-body custom-card">
                        <a href="actualizar_cita.php" class="btn btn-outline-success">REAGENDAR CITA</a>
                    </div>
                </div>
            </article>

            <!-- //*Tarjeta 3 -->
            <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow text-bg-info mb-3">
                    <div class="card-body">
                        <a href="borrar_citas.php" class="btn btn-outline-success">CANCELAR CITA</a>
                    </div>
                </div>
            </article>

            <!-- //*Tarjeta 4 -->
            <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow text-bg-info mb-3">
                    <div class="card-body">
                        <a href="visualizar_citas.php" class="btn btn-outline-success">VER CITAS</a>
                    </div>
                </div>
            </article>

             <!-- //*Tarjeta 4 -->
             <article class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card shadow text-bg-info mb-3">
                    <div class="card-body">
                        <a href="buscar_citas.php" class="btn btn-outline-success">CONSULTAS SQL</a>
                    </div>
                </div>
            </article>

        </section>        
        <hr>
    </main>


<?php include("Recursos/Footer.php")?>