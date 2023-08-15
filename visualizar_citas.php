
<?php
//session_start();
include('Recursos/Nav.php');
// Verificar si el terapeuta ha iniciado sesión
if (!isset($_SESSION['Correo'])) {
    header("Location: login_terapeuta.php");
    exit();
}

require_once('bd.php');
$BD = new bd();
?>
<?php if($_SESSION['Rol'] == "Terapeuta"){
    $citasT = $BD->ObtenerCitasAgendadasT($_SESSION['RFC']);
    ?>
    <div class="container mt-5">
        <h1 class="mb-4">Visualizar Citas Del Terapeuta <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
        <table class="table">
            <tr>
                <th>Paciente</th>
                <th>Terapeuta</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
            <?php foreach ($citasT as $cita) { ?>
                <tr>
                    <td><?php echo $cita['Paciente']; ?></td>
                    <td><?php echo $cita['Terapeuta']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php } 
    else if($_SESSION['Rol'] == "User"){
        $citasUs = $BD->ObtenerCitasAgendadasUs($_SESSION['Correo']);
    ?>
    <div class="container mt-5">
        <h1 class="mb-4">Visualizar Citas Del Usuario <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
        <table class="table">
            <tr>
                <th>Terapeuta</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
            <?php foreach ($citasUs as $cita) { ?>
                <tr>
                <td><?php echo $cita['Terapeuta']; ?></td>
                    <td><?php echo $cita['Paciente']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php } 
    else if($_SESSION['Rol'] == "Admin"){
        $citasAd = $BD->ObtenerCitasAgendadasAdmin();
    ?>
    <div class="container mt-5">
        <h1 class="mb-4" >Visualizar Citas Como Administrador <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
        <table class="table">
            <tr>
                <th>Paciente</th>
                <th>Terapeuta</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
            <?php foreach ($citasAd as $cita) { ?>
                <tr>
                    <td><?php echo $cita['Paciente']; ?></td>
                    <td><?php echo $cita['Terapeuta']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>

                </tr>
            <?php } ?>
        </table>
        
    </div>
<?php } ?>
