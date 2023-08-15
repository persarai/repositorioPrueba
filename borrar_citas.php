<?php
//session_start();
include('Recursos/Nav.php');
// Verificar si el terapeuta ha iniciado sesión
if (!isset($_SESSION['Correo'])) {
    header("Location: login.php");
    exit();
}

require_once('bd.php');

$BD = new bd();
// Si se envió el formulario para borrar una cita
if (isset($_POST['borrar_cita'])) {
    if ($_SESSION['Rol'] == "Terapeuta") {
        if ($BD->BorrarCitaT($_POST['id_cita'], $_SESSION['RFC'])) {
            $_SESSION['message'] = "CITA BORRADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL BORRAR LA CITA";
        }
    } else if ($_SESSION['Rol'] == "User") {
        if ($BD->BorrarCitaUs($_POST['id_cita'], $_SESSION['Correo'])) {
            $_SESSION['message'] = "CITA BORRADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL BORRAR LA CITA";
        }
    } else if ($_SESSION['Rol'] == "Admin") {
        if ($BD->BorrarCitaAdmin($_POST['id_cita'], $_POST['id_T'], $_POST['id_Us'])) {
            $_SESSION['message'] = "CITA BORRADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL BORRAR LA CITA";
        }
    }

}
?>
<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-dark" role="alert">
        <p><?php echo $_SESSION['message']; ?></p>
    </div>
<?php endif;
unset($_SESSION['message']); ?>
<?php if($_SESSION['Rol'] == "Terapeuta"){
    $citasT = $BD->ObtenerCitasAgendadasT($_SESSION['RFC']);
    ?>
    <div class="container mt-5">
        <h1 class="mb-4">Visualizar Citas Del Terapeuta <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
        <table class="table">
            <tr>
                <th>ID Cita</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($citasT as $cita) { ?>
                <tr>
                    <td><?php echo $cita['idcitas']; ?></td>
                    <td><?php echo $cita['Paciente']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>
                    <td>
                        <form action="borrar_citas.php" method="post">
                            <input type="hidden" name="id_cita" value="<?php echo $cita['idcitas']; ?>">
                            <input type="submit" name="borrar_cita" value="BorrarCita" class="btn btn-outline-success">
                        </form>
                    </td>
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
                <th>ID Cita</th>
                <th>Terapeuta</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($citasUs as $cita) { ?>
                <tr>
                <td><?php echo $cita['idcitas']; ?></td>
                    <td><?php echo $cita['Terapeuta']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>
                    <td>
                        <form action="borrar_citas.php" method="post">
                            <input type="hidden" name="id_cita" value="<?php echo $cita['idcitas']; ?>" >
                            <input type="submit" name="borrar_cita" value="BorrarCita" class="btn btn-outline-success">
                        </form>
                    </td>
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
                <th>ID Cita</th>
                <th>Terapeuta</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($citasAd as $cita) { ?>
                <tr>
                    <td><?php echo $cita['idcitas']; ?></td>
                    <td><?php echo $cita['Terapeuta']; ?></td>
                    <td><?php echo $cita['Paciente']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>
                    <td>
                        <form action="borrar_citas.php" method="post">
                            <input type="hidden" name="id_T" value="<?php echo $cita['IDTerapeuta']; ?>">
                            <input type="hidden" name="id_Us" value="<?php echo $cita['IDUsuario']; ?>">
                            <input type="hidden" name="id_cita" value="<?php echo $cita['idcitas']; ?>">
                            <input type="submit" name="borrar_cita" value="BorrarCita" class="btn btn-outline-success">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>