<?php include("Recursos/Nav.php"); ?>

<!-- //*Custom CSS Services-->
<link rel="stylesheet" href="CSS/Servicios.css">


    <div class="container">
        <hr>
        
        <div class="row">
            <h1>Quiénes somos</h1>
            <p class="text-justify">
            Ofrecemos una variedad de servicios de atención psicológica y terapia en línea para ayudar a las personas a manejar una variedad de problemas emocionales y de salud mental.
            </p>
            <p>
                <hr>
            </p>  
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="card shadow">
                    
                    <div class="card-body">
                        <h5 class="card-title">Agenda una cita</h5>
                        <img src="IMG/terapias.png" class="card-img-top" alt="terapia">
                        <a href="agendar_cita.php" class="btn btn-warning"> + </a>
                    </div>
                </div> 
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Cancela cuando quieras</h5>
                        <img src="IMG/mensajeria.png" class="card-img-top" alt="terapia">
                        <a href="borrar_cita.php" class="btn btn-warning"> + </a>
                    </div>
                </div> 
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Visualiza tus citas</h5>
                        <img src="IMG/calendario.png" class="card-img-top" alt="horario">
                        <a href="visualizar_citas.php" class="btn btn-warning"> + </a>
                    </div>
                </div> 
            </div>
        </div>
    </div>  

<hr>

<?php include("Recursos/Footer.php")?>