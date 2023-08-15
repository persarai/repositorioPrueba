<?php
// Verificar si el terapeuta ha iniciado sesión
//session_start();
include('Recursos/Nav.php');

if (!isset($_SESSION['Correo'])) {
    header("Location: login.php");
    exit();
}
require_once('bd.php');
$BD = new bd();

$fechaHoy = date("Y-m-d");
// Si se envió el formulario para actualizar una cita
if (isset($_POST['actualizar_cita'])) {
    $cita = $_POST['id_cita'];
    $fecha = $_POST['nueva_fecha'];
    $hora = $_POST['nueva_hora'];
    if ($_SESSION['Rol'] == "Terapeuta") {
        $user = $_POST['id_user'];
        if ($BD->ActualizarCitaT($cita, $_SESSION['RFC'], $user, $fecha, $hora)) {
            $_SESSION['message'] = "CITA ACTUALIZADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL ACTUALIZAR LA CITA";
        }
    } else if ($_SESSION['Rol'] == "User") {
        $terapeuta = $_POST['id_t'];
        if ($BD->ActualizarCitaUs($cita, $terapeuta, $_SESSION['Correo'], $fecha, $hora)) {
            $_SESSION['message'] = "CITA ACTUALIZADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL ACTUALIZAR LA CITA";
        }
    } else if ($_SESSION['Rol'] == "Admin") {
        $user = $_POST['id_user'];
        $terapeuta = $_POST['id_t'];
        if ($BD->ActualizarCitaAdmin($cita, $terapeuta, $user, $fecha, $hora)) {
            $_SESSION['message'] = "CITA ACTUALIZADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL ACTUALIZAR LA CITA";
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
<?php if ($_SESSION['Rol'] == "Terapeuta") {
    $citasT = $BD->ObtenerCitasAgendadasT($_SESSION['RFC']);
?>
    
    <div class="container mt-5">
    <h1 class="mb-4">Actualizar Citas Del Terapeuta <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
        <table class="table">
            <tr>
                <th>ID Cita</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th></th>
            </tr>
            <?php foreach ($citasT as  $cita) { ?>
                <tr>
                    <td><?php echo $cita['idcitas']; ?></td>
                    <td><?php echo $cita['Paciente']; ?></td>
                    <td><?php echo $cita['Fecha']; ?></td>
                    <td><?php echo $cita['Hora']; ?></td>
                    <td>
                        <form action="actualizar_cita.php" method="post">
                            <input type="hidden" name="id_cita" value="<?php echo $cita['idcitas']; ?>">
                            <input type="hidden" name="id_user" value="<?php echo $cita['IDUsuario']; ?>">
                            <input type="date" name="nueva_fecha" required min="<?php echo $fechaHoy ?>">
                            <input type="time" name="nueva_hora" required step="3600" pattern="[0-9]{2}:[0]{2}">
                            <input type="submit" name="actualizar_cita" value="Actualizar Cita" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } else if ($_SESSION['Rol'] == "User") {
    $citasUs = $BD->ObtenerCitasAgendadasUs($_SESSION['Correo']);
?>
    <div>
        <h1 class="mb-4">Visualizar Citas Del Usuario <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
        <div class="container mt-5">
            <table class="table">
                <tr>
                    <th>ID Cita</th>
                    <th>ID Terapeuta</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th></th>
                </tr>
                <?php foreach ($citasUs as $cita) { ?>
                    <tr>
                        <td><?php echo $cita['idcitas']; ?></td>
                        <td><?php echo $cita['Terapeuta']; ?></td>
                        <td><?php echo $cita['Fecha']; ?></td>
                        <td><?php echo $cita['Hora']; ?></td>
                        <td>
                            <form action="actualizar_cita.php" method="post">
                                <input type="hidden" name="id_cita" value="<?php echo $cita['idcitas']; ?>">
                                <input type="hidden" name="id_t" value="<?php echo $cita['IDTerapeuta']; ?>">
                                <input type="date" name="nueva_fecha" required min="<?php echo $fechaHoy ?>">
                                <input type="time" name="nueva_hora" required step="3600" pattern="[0-9]{2}:[0]{2}">
                                <input type="submit" name="actualizar_cita" value="Actualizar Cita">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
<?php } else if ($_SESSION['Rol'] == "Admin") {
    $citasAd = $BD->ObtenerCitasAgendadasAdmin();
?>
    <div>
        <h1 class="mb-4">Visualizar Citas Como Administrador <?php echo $_SESSION['Nombre_Usuario']; ?></h1>

        <div class="container mt-5">
            <table class="table">

                <tr>
                    <th>ID Cita</th>
                    <th>Terapeuta</th>
                    <th>Paciente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
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
                            <form action="actualizar_cita.php" method="post">
                                <input type="hidden" name="id_cita" value="<?php echo $cita['idcitas']; ?>">
                                <input type="hidden" name="id_t" value="<?php echo $cita['IDTerapeuta']; ?>">
                                <input type="hidden" name="id_user" value="<?php echo $cita['IDUsuario']; ?>">
                                <input type="date" name="nueva_fecha" required min="<?php echo $fechaHoy ?>">
                                <input type="time" name="nueva_hora" required step="3600" pattern="[0-9]{2}:[0]{2}">
                                <input type="submit" name="actualizar_cita" value="Actualizar Cita">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

<?php }
include('Recursos/Footer.php')
?>