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
$fechaHoy = date("Y-m-d");
// Si el formulario ha sido enviado
if (isset($_POST['agendar_cita'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    if ($_SESSION['Rol'] == "Terapeuta") {

        $user = $_POST['paciente'];
        if ($BD->AgendarCita($user, $_SESSION['RFC'], $fecha, $hora)) {
            $_SESSION['message'] = "CITA CREADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL CREAR LA CITA";
        }
    } else if ($_SESSION['Rol'] == "User") {
        $terapeuta = $_POST['terapeuta'];

        if ($BD->AgendarCita($_SESSION['Correo'], $terapeuta, $fecha, $hora)) {
            $_SESSION['message'] = "CITA CREADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL CREAR LA CITA";
        }
    } else if ($_SESSION['Rol'] == "Admin") {
        $user = $_POST['paciente'];
        $terapeuta = $_POST['terapeuta'];
        if ($BD->AgendarCita($user, $terapeuta, $fecha, $hora)) {
            $_SESSION['message'] = "CITA CREADA CON EXITO";
        } else {
            $_SESSION['message'] = "ERROR AL CREAR LA CITA";
        }
    }
}
?>
<style>
    .wrapper {
        width: 800px;
    }

    label {
        font-size: 18px;
        color: white;
    }
</style>
<?php if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-dark" role="alert">
        <p><?php echo $_SESSION['message']; ?></p>
    </div>
<?php endif;
unset($_SESSION['message']); ?>
<?php if ($_SESSION['Rol'] == "Terapeuta") {

    $lista_pacientes = $BD->ObtenerListaPacientes();
?>

    <main class="container mb-4">
        <div class="wrapper">
            <h1 class="mt-3">Agendar Cita Del Terapeuta <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
            <form action="agendar_cita.php" method="post" class="mt-3">
                <div class="mb-3">
                    <label for="paciente" class="form-label">Paciente:</label>
                    <select name="paciente" id="paciente" class="form-select" required>
                        <?php foreach ($lista_pacientes as $paciente) { ?>
                            <option value="<?php echo $paciente['CorreoElectronico']; ?>"><?php echo $paciente['Nombre']; ?></option>
                        <?php } ?>
                    </select><br>
                    <label for="fecha">Fecha:</label><br>
                    <input type="date" name="fecha" id="fecha" class="form-control" required min="<?php echo $fechaHoy ?>"><br>
                    <label for="hora">Hora:</label><br>
                    <input type="time" name="hora" id="hora" class="form-control" required step="3600" pattern="[0-9]{2}:[0]{2}"><br>
                    <input type="submit" name="agendar_cita" value="Agendar Cita" class="btn btn-primary">
            </form>
        </div>
    </main>


<?php } else if ($_SESSION['Rol'] == "User") {
    $lista_terapeutas = $BD->ObtenerListaTerapeutas();

?>
    <main class="container mb-3">
        <div class="wrapper">
            <h1 class="mt-4">Agendar Cita del Usuario <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
            <form action="agendar_cita.php" method="post" class="mt-3">
                <div class="mb-3">
                    <label for="terapeuta" class="form-label">Terapeuta:</label>
                    <select name="terapeuta" id="terapeuta" class="form-select" required>
                        <?php foreach ($lista_terapeutas as $terapeuta) { ?>
                            <option value="<?php echo $terapeuta['RFC']; ?>"><?php echo $terapeuta['Nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required min="<?php echo $fechaHoy ?>">
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control" required step="3600" pattern="[0-9]{2}:[0]{2}">
                </div>
                <button type="submit" name="agendar_cita" class="btn btn-primary">Agendar Cita</button>
            </form>
        </div>
    </main>

<?php } else if ($_SESSION['Rol'] == "Admin") {
    $lista_terapeutas = $BD->ObtenerListaTerapeutas();
    $lista_pacientes = $BD->ObtenerListaPacientes();

?>
    <main class="container mb-3">
        <div class="wrapper">
            <h1 class="mt-4">Agendar Cita mediante Admin <?php echo $_SESSION['Nombre_Usuario']; ?></h1>
            <form action="agendar_cita.php" method="post" class="mt-3">
                <div class="mb-3">
                    <label for="paciente" class="form-label">Paciente:</label>
                    <select name="paciente" id="paciente" class="form-select">
                        <?php foreach ($lista_pacientes as $paciente) { ?>
                            <option value="<?php echo $paciente['CorreoElectronico']; ?>"><?php echo $paciente['Nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="terapeuta" class="form-label">Terapeuta:</label>
                    <select name="terapeuta" id="terapeuta" class="form-select">
                        <?php foreach ($lista_terapeutas as $terapeuta) { ?>
                            <option value="<?php echo $terapeuta['RFC']; ?>"><?php echo $terapeuta['Nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" required min="<?php echo $fechaHoy ?>">
                </div>
                <div class="mb-3">
                    <label for="hora" class="form-label">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control" required step="3600" pattern="[0-9]{2}:[0]{2}">
                </div>
                <button type="submit" name="agendar_cita" class="btn btn-primary">Agendar Cita</button>
            </form>
        </div>
    </main>
<?php } ?>