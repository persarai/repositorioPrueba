
 <?php
 include('Recursos/Nav.php');
 // Verificar si el terapeuta ha iniciado sesión
 //session_start();
 if (!isset($_SESSION['Correo'])) {
     header("Location: login.php");
     exit();
 }
 
 require_once('bd.php');
 $BD = new bd();
 
 if (isset($_POST['nombreApellido'])) {
     $nombreApellido = $_POST["nombreApellido"];
 
     // Llamamos al método de búsqueda por nombre o apellido
     $citasEncontradas = $BD->BuscarCitasPorNombreOApellido($nombreApellido);
 
     if ($citasEncontradas !== false) {
         echo "<br>Se encontraron " . count($citasEncontradas) . " citas para la búsqueda con: " . $nombreApellido . "<br>";
 
         echo '<table class="table">';
         echo '<tr><th>Paciente</th><th>Terapeuta</th><th>Fecha</th><th>Hora</th></tr>';
         foreach ($citasEncontradas as $cita) {
             echo '<tr>';
             echo '<td>' . $cita['Paciente'] . '</td>';
             echo '<td>' . $cita['Terapeuta'] . '</td>';
             echo '<td>' . $cita['Fecha'] . '</td>';
             echo '<td>' . $cita['Hora'] . '</td>';
             echo '</tr>';
         }
         echo '</table>';
     } else {
         echo "Ocurrió un error al buscar las citas.";
     }
 }
 ?>
    <div class="container mt-4">
        <h1>Buscar Citas</h1>
        <form action="buscar_citas.php" method="post">
            <div class="form-group">
                <label for="nombreApellido">Nombre o Apellido:</label>
                <input type="text" class="form-control" id="nombreApellido" name="nombreApellido"><br>
            </div>
            <button type="submit" class="btn btn-primary">Buscar Citas</button>
            <a href="index.php" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
</body>
</html>

 