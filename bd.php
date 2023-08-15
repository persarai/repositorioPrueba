<?php

    class bd 
    {
        private $pdo;

        public function __construct() {
            $host = "localhost";
            $user = "root";
            $password = "";
            $dbname = "confiaqui";
            
            try {
                $this->pdo = new PDO("mysql:host=".$host.";dbname=".$dbname,$user,$password);
                $this->pdo->exec("SET CHARACTER SET utf8");
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE,
                                         PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "ERROR EN LA CONEXIÓN.". $e->getMessage();
            }
        }

        public function VerificarCorreo($correo){
            $queryVerifUs="SELECT count(CorreoElectronico) from registrousuario where CorreoElectronico  = :correo";
            $stmnt=$this->pdo->prepare($queryVerifUs);
            $stmnt->bindParam(":correo",$correo);
            if($stmnt->execute()){
                $res = $stmnt->fetch();
                if( $res[0] == 0){
                    $queryVerifCorreo="SELECT count(Correo) from registroterapeuta where Correo  = :correo";
                    $verifCorreo=$this->pdo->prepare($queryVerifCorreo);
                    $verifCorreo->bindParam(':correo',$correo);
                    if($verifCorreo->execute()){
                        $result = $verifCorreo->fetch();
                        return $result[0];
                    }
                    else {
                        return -1;
                        
                    }
                }
                else{
                    return $res[0];
                }
            }
            else{
                return -1;
            }
        }
        public function ObtenerRol($correo){
            $CorreoExiste = $this->VerificarCorreo($correo);
            if ($CorreoExiste == 1){
                $queryVerifCorreo="SELECT count(Correo) from registroterapeuta where Correo  = :correo";
                $verifCorreo=$this->pdo->prepare($queryVerifCorreo);
                $verifCorreo->bindParam(':correo',$correo);
                if($verifCorreo->execute()){
                    $result = $verifCorreo->fetch();
                    if($result[0] == 0){
                        $queryVerifUs="SELECT RolUsuario from registrousuario where CorreoElectronico  = :correo";
                        $stmnt=$this->pdo->prepare($queryVerifUs);
                        $stmnt->bindParam(":correo",$correo);
                        if($stmnt->execute()){
                            $res = $stmnt->fetch();
                            return $res[0];
                        }
                        else{
                            return "";
                        }
                    }
                    else{
                        return "Terapeuta";
                    }
                }
                else {
                    return "";
                }
            }
            else{
                return "";
            }
        }
        public function ObtenerNombre($correo){
            $rol = $this->ObtenerRol($correo);
            if(!empty($rol)){
                if($rol == "Terapeuta"){
                    $queryGetNomT="SELECT concat_ws(' ',Nombre,Apellido_Paterno,Apellido_Materno) as Nombre from registroterapeuta where Correo  = :correo";
                    $GetNomT=$this->pdo->prepare($queryGetNomT);
                    $GetNomT->bindParam(':correo',$correo);
                    if($GetNomT->execute()){
                        $result = $GetNomT->fetch();
                        return $result[0];
                    }
                    else{
                        return "";
                    }
                }
                else{
                    $queryGetNomUs="SELECT concat_ws(' ',Nombre,Apellido_Paterno,Apellido_Materno) as Nombre from registrousuario where CorreoElectronico  = :correo";
                    $GetNomUs=$this->pdo->prepare($queryGetNomUs);
                    $GetNomUs->bindParam(':correo',$correo);
                    if($GetNomUs->execute()){
                        $result = $GetNomUs->fetch();
                        return $result[0];
                    }
                    else{
                        return "";
                    }
                }
            }
            else{
                return "";
            }
        }

        public function VerificarLogin($correo,$password){
            $rol = $this->ObtenerRol($correo);
            $logged = false;
            if(!empty($rol)){
                if($rol == "Terapeuta"){
                    $queryGetPass="SELECT Password from registroterapeuta where Correo  = :correo";
                    $GetPass=$this->pdo->prepare($queryGetPass);
                    $GetPass->bindParam(':correo',$correo);
                    if($GetPass->execute()){
                        $result = $GetPass->fetch();
                        $logged = password_verify($password,$result[0]);
                        return $logged;
                    }
                    else{
                        return $logged;
                        
                    }
                }
                else{
                    $queryGetPass="SELECT Password from registrousuario where CorreoElectronico  = :correo";
                    $GetPass=$this->pdo->prepare($queryGetPass);
                    $GetPass->bindParam(':correo',$correo);
                    if($GetPass->execute()){
                        $result = $GetPass->fetch();
                        $logged = password_verify($password,$result[0]);
                        return $logged;
                    }
                    else{
                        return $logged;
                    }
                }
            }
            else{
                return $logged;
            }
            
        }
        public function VerificarRFC($rfc){
            $queryVerif="SELECT count(RFC) from registroterapeuta where RFC  = :id";
            $stmt=$this->pdo->prepare($queryVerif);
            $stmt->bindParam(":id",$id);
            if($stmt->execute()){
                $result = $stmt ->fetch();
                return $result[0];
            }
            else{
                return -1;
            }
        }

        public function RegT($id, $correo, $nom, $app, $apm, $pword, $ced, $nac, $esp, $lenMat)
        {
            $message = '';
            $result = $this->VerificarRFC($id);
            if ($result == 0) {
                $res = $this->VerificarCorreo($correo);
                if ($res == 0) {
                    $sql = 'INSERT INTO registroterapeuta (RFC,Correo,Nombre,Apellido_Paterno,Apellido_Materno,Password,CedulaProfesional,Nacionalidad,Especialidad,LenguaMaterna) VALUES (:RFC,:correo,:nom,:apellido_paterno,:apellido_materno,:pword,:cedula,:nac,:espec,:lenguamat)';
                    $stmnt = $this->pdo->prepare($sql);
                    $stmnt->bindParam(":RFC", $id);
                    $stmnt->bindParam(':correo', $correo);
                    $stmnt->bindParam(':nom', $nom);
                    $stmnt->bindParam(':apellido_paterno', $app); // Corrección aquí
                    $stmnt->bindParam(':apellido_materno', $apm); // Corrección aquí
                    $stmnt->bindParam(':pword', $pword);
                    $stmnt->bindParam(':cedula', $ced);
                    $stmnt->bindParam(':nac', $nac);
                    $stmnt->bindParam(':espec', $esp); // Corrección aquí
                    $stmnt->bindParam(':lenguamat', $lenMat);
        
                    if ($stmnt->execute()) {
                        $message = "SE REGISTRO CORRECTAMENTE";
                    } else {
                        $message = "HUBO UN ERROR EN EL REGISTRO";
                    }
                } else if ($res == -1) { // Cambio de $result a $res
                    $message = "HUBO UN ERROR AL VERIFICAR SU CORREO";
                } else {
                    $message = "EL CORREO YA HA SIDO REGISTRADO POR OTRO TERAPEUTA O USUARIO.";
                }
        
            } else if ($result == -1) {
                $message = "HUBO UN ERROR AL VERIFICAR SU RFC";
            } else {
                $message = "EL RFC INSERTADO YA HA SIDO REGISTRADO";
            }
            return $message;
        }
        public function RegUser($correo,$nom,$app,$apm,$pword,$nac,$idioma,$pron,$fechaNac){
            $message = '';
            $result = $this->VerificarCorreo($correo);
            if($result == 0 ){
                $sql = 'INSERT INTO registrousuario (CorreoElectronico,Nombre,Apellido_Paterno,Apellido_Materno,Password,Nacionalidad,IdiomaPreferente,PreferenciaPronombre,FechaNacimiento) VALUES (:correo,:nom,:appat,:apmat,:pword,:nac,:idioma,:pron,:fechaNac)';
                $stmnt = $this->pdo->prepare($sql);
                $stmnt->bindParam(":correo",$correo);
                $stmnt->bindParam(':nom',$nom);
                $stmnt->bindParam(':appat',$app);
                $stmnt->bindParam(':apmat',$apm);
                $stmnt->bindParam(':pword',$pword);
                $stmnt->bindParam(':nac',$nac);
                $stmnt->bindParam(':idioma',$idioma);
                $stmnt->bindParam(':pron',$pron);
                $stmnt->bindParam(':fechaNac',$fechaNac);
                if($stmnt->execute()){
                    $message = "SE REGISTRO CORRECTAMENTE";
                }
                else{
                    $message = "HUBO UN ERROR EN EL REGISTRO";
                }
            }
            else if($result == -1){
                $message = "HUBO UN ERROR AL VERIFICAR SU CORREO";
            }
            else{
                $message = "EL CORREO INSERTADO YA HA SIDO REGISTRADO POR OTRO TERAPEUTA O USUARIO";
            }
            return $message;
        }

    public function ObtenerRFC($correo) {
        try {
            $stmt = $this->pdo->prepare("SELECT RFC FROM registroterapeuta WHERE Correo = :correo");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();

            if ($stmt->rowCount() === 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                return $row['RFC'];
            } else {
                // Caso cuando el terapeuta no se encuentra en la base de datos
                return null;
            }
        } catch (PDOException $e) {
            echo "ERROR EN LA CONEXIÓN.". $e->getMessage();
            return null;
        }
    }

    public function ObtenerListaPacientes() {
        try {
            $stmt = $this->pdo->prepare("SELECT CorreoElectronico,concat_ws(' ',Nombre,Apellido_Paterno,Apellido_Materno) as Nombre FROM registrousuario WHERE RolUsuario = 'User'");
            $stmt->execute();
            $lista_pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $lista_pacientes;
        } catch (PDOException $e) {
            // Errores de conexión o consulta
            return array();
        }
    }

    public function ObtenerListaTerapeutas() {
        try {
            $stmt = $this->pdo->prepare("SELECT RFC,concat_ws(' ',Nombre,Apellido_Paterno,Apellido_Materno) as Nombre FROM registroterapeuta");
            $stmt->execute();
            $lista_Terapeutas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $lista_Terapeutas;
        } catch (PDOException $e) {
            // Errores de conexión o consulta
            return array();
        }
    }

    public function ObtenerCitasAgendadasT($terapeuta_rfc) {
        try {
            $stmt = $this->pdo->prepare("SELECT agc.idcitas,agc.IDUsuario,CONCAT_WS(' ', u.nombre, u.Apellido_Paterno, u.Apellido_Materno) AS Paciente, rt.nombre as Terapeuta, agc.Fecha,agc.Hora FROM agendacitas AS agc 
            INNER JOIN registrousuario AS u ON agc.IDUsuario = u.CorreoElectronico
            INNER JOIN registroterapeuta AS rt ON agc.IDTerapeuta = rt.RFC WHERE IDTerapeuta = :terapeuta_rfc");
            $stmt->bindParam(':terapeuta_rfc', $terapeuta_rfc);
            $stmt->execute();
            $citas_agendadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $citas_agendadas;
        } catch (PDOException $e) {
            echo "ERROR EN LA CONEXIÓN.". $e->getMessage();
            return array();
        }
    }

    public function ObtenerCitasAgendadasUs($correo) {
        try {
            $stmt = $this->pdo->prepare("SELECT agc.idcitas,agc.IDTerapeuta,CONCAT_WS(' ', rt.nombre, rt.Apellido_Paterno, rt.Apellido_Materno) AS Terapeuta, u.nombre as Paciente, agc.Fecha,agc.Hora FROM agendacitas AS agc 
            INNER JOIN registrousuario AS u ON agc.IDUsuario = u.CorreoElectronico
            INNER JOIN registroterapeuta AS rt ON agc.IDTerapeuta = rt.RFC WHERE IDUsuario = :correo");
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            $citas_agendadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $citas_agendadas;
        } catch (PDOException $e) {
            echo "ERROR EN LA CONEXIÓN.". $e->getMessage();
            return array();
        }
    }

    public function ObtenerCitasAgendadasAdmin() {
        try {
            $stmt = $this->pdo->prepare("SELECT agc.idcitas,agc.IDUsuario,CONCAT_WS(' ', u.nombre, u.Apellido_Paterno, u.Apellido_Materno) AS Paciente,agc.IDTerapeuta,CONCAT_WS(' ', rt.nombre, rt.Apellido_Paterno, rt.Apellido_Materno) as Terapeuta, agc.Fecha,agc.Hora
            FROM agendacitas AS agc 
            INNER JOIN registrousuario AS u ON agc.IDUsuario = u.CorreoElectronico
            INNER JOIN registroterapeuta AS rt ON agc.IDTerapeuta = rt.RFC");
            $stmt->execute();
            $citas_agendadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $citas_agendadas;
        } catch (PDOException $e) {
            echo "ERROR EN LA CONEXIÓN.". $e->getMessage();
            return array();
        }
    }
    
    public function BorrarCitaT($id_cita, $terapeuta_rfc) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM agendacitas WHERE idcitas = :id_cita AND IDTerapeuta = :terapeuta_rfc");
            $stmt->bindParam(':id_cita', $id_cita);
            $stmt->bindParam(':terapeuta_rfc', $terapeuta_rfc);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            return false;
        }
    }

    public function BorrarCitaUs($id_cita, $correo) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM agendacitas WHERE idcitas = :id_cita AND IDUsuario = :correo");
            $stmt->bindParam(':id_cita', $id_cita);
            $stmt->bindParam(':correo', $correo);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            return false;
        }
    }
    public function BorrarCitaAdmin($id_cita,$terapeuta_rfc,$correo) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM agendacitas WHERE idcitas = :id_cita AND IDUsuario = :correo AND IDTerapeuta = :terapeuta_rfc");
            $stmt->bindParam(':id_cita', $id_cita);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':terapeuta_rfc', $terapeuta_rfc);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            return false;
        }
    }

    public function ActualizarCitaT($id_cita, $terapeuta_rfc,$correo, $nueva_fecha, $nueva_hora) {
        try {
            if($this->VerificarCita($correo,$terapeuta_rfc,$nueva_fecha,$nueva_hora)){
                $stmt = $this->pdo->prepare("UPDATE agendacitas SET Fecha = :nueva_fecha, Hora = :nueva_hora WHERE idcitas = :id_cita AND IDTerapeuta = :terapeuta_rfc");
                $stmt->bindParam(':id_cita', $id_cita);
                $stmt->bindParam(':terapeuta_rfc', $terapeuta_rfc);
                $stmt->bindParam(':nueva_fecha', $nueva_fecha);
                $stmt->bindParam(':nueva_hora', $nueva_hora);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            return false;
        }
    }
    public function ActualizarCitaUs($id_cita,$RFC, $correo, $nueva_fecha, $nueva_hora) {
        try {
            if($this->VerificarCita($correo,$RFC,$nueva_fecha,$nueva_hora)){
                $stmt = $this->pdo->prepare("UPDATE agendacitas SET Fecha = :nueva_fecha, Hora = :nueva_hora WHERE idcitas = :id_cita AND IDUsuario = :correo");
                $stmt->bindParam(':id_cita', $id_cita);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':nueva_fecha', $nueva_fecha);
                $stmt->bindParam(':nueva_hora', $nueva_hora);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            return false;
        }
    }
    public function ActualizarCitaAdmin($id_cita, $terapeuta_rfc,$correo,$nueva_fecha, $nueva_hora) {
        try {
            if($this->VerificarCita($correo,$terapeuta_rfc,$nueva_fecha,$nueva_hora)){
                $stmt = $this->pdo->prepare("UPDATE agendacitas SET Fecha = :nueva_fecha, Hora = :nueva_hora WHERE idcitas = :id_cita AND IDTerapeuta = :terapeuta_rfc AND IDUsuario = :correo");
                $stmt->bindParam(':id_cita', $id_cita);
                $stmt->bindParam(':terapeuta_rfc', $terapeuta_rfc);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':nueva_fecha', $nueva_fecha);
                $stmt->bindParam(':nueva_hora', $nueva_hora);
                $stmt->execute();
            }
            return true;
        } catch (PDOException $e) {
            // Manejar errores de conexión o consulta
            return false;
        }
    }


    public function VerificarCita($correo,$RFC,$fecha,$hora){
        $queryVerifUsuario="SELECT count(Fecha) from agendacitas where IDUsuario = :correo and Fecha = :fecha and Hora = :hora ";
        $verifUs=$this->pdo->prepare($queryVerifUsuario);
        $verifUs->bindParam(":correo",$correo);
        $verifUs->bindParam(":fecha",$fecha);
        $verifUs->bindParam(":hora",$hora);
        if($verifUs->execute()){
            $result = $verifUs ->fetch();
            if($result[0] == 0 ){
                $queryVerifTerapeuta = "SELECT count(Fecha) from agendacitas where IDTerapeuta = :RFC and Fecha = :fecha and Hora = :hora ";
                    $verifT = $this->pdo->prepare($queryVerifTerapeuta);
                    $verifT->bindParam(':RFC', $RFC);
                    $verifT->bindParam(":fecha", $fecha);
                    $verifT->bindParam(":hora", $hora);
                if($verifT->execute())
                {
                    $res = $verifT->fetch();
                    if($res[0] == 0){
                        
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                    }
                }
                else{
                    return false;
                }
            }
            else{
                return false;
           }
        }

        public function AgendarCita($correo, $RFC, $fecha, $hora){
            $queryVerifUsuario = "SELECT count(Fecha) from agendacitas where IDUsuario = :correo and Fecha = :fecha and Hora = :hora ";
            $verifUs = $this->pdo->prepare($queryVerifUsuario);
            $verifUs->bindParam(":correo", $correo);
            $verifUs->bindParam(":fecha", $fecha);
            $verifUs->bindParam(":hora", $hora);
            if ($verifUs->execute()) {
                $result = $verifUs->fetch();
                if ($result[0] == 0) {
                    $queryVerifTerapeuta = "SELECT count(Fecha) from agendacitas where IDTerapeuta = :RFC and Fecha = :fecha and Hora = :hora ";
                    $verifT = $this->pdo->prepare($queryVerifTerapeuta);
                    $verifT->bindParam(':RFC', $RFC);
                    $verifT->bindParam(":fecha", $fecha);
                    $verifT->bindParam(":hora", $hora);
                    if ($verifT->execute()) {
                        $res = $verifT->fetch();
                        if ($res[0] == 0) {
                            $stmt = $this->pdo->prepare("INSERT INTO agendacitas (IDTerapeuta, IDUsuario, Fecha, Hora) VALUES (:terapeuta, :paciente, :fecha, :hora)");
                            $stmt->bindParam(':terapeuta', $RFC);
                            $stmt->bindParam(':paciente', $correo);
                            $stmt->bindParam(':fecha', $fecha);
                            $stmt->bindParam(':hora', $hora);
                            if ($stmt->execute()) {
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }
        public function BuscarCitasPorNombreOApellido($nombreApellido) {
            
            $correo = $_SESSION['Correo'];
            $rol = $_SESSION['Rol'];
            if ($rol == "User"){
                $query = "SELECT CONCAT_WS(' ', u.nombre, u.Apellido_Paterno, u.Apellido_Materno) AS Paciente,CONCAT_WS(' ', rt.nombre, rt.Apellido_Paterno, rt.Apellido_Materno) AS Terapeuta, a.Fecha, a.Hora
                FROM registrousuario AS u
                INNER JOIN agendacitas AS a ON a.IDUsuario = u.CorreoElectronico
                INNER JOIN registroterapeuta AS rt ON a.IDTerapeuta = rt.RFC
                WHERE (rt.nombre LIKE :search OR rt.Apellido_Paterno LIKE :search OR rt.Apellido_Materno LIKE :search)
                    AND u.CorreoElectronico = :correo;";  // Agregamos la condición para el correo del terapeuta
            }
            else if ($rol == "Terapeuta") {
                $query = "SELECT CONCAT_WS(' ', u.nombre, u.Apellido_Paterno, u.Apellido_Materno) AS Paciente, CONCAT_WS(' ', rt.nombre, rt.Apellido_Paterno, rt.Apellido_Materno) AS Terapeuta, a.Fecha, a.Hora
                FROM registrousuario AS u
                INNER JOIN agendacitas AS a ON a.IDUsuario = u.CorreoElectronico
                INNER JOIN registroterapeuta AS rt ON a.IDTerapeuta = rt.RFC
                WHERE (u.nombre LIKE :search OR u.Apellido_Paterno LIKE :search OR u.Apellido_Materno LIKE :search)
                AND rt.Correo = :correo;";  // Agregamos la condición para el correo del terapeuta
            }
            else if ($rol == "Admin"){
                $query = "SELECT CONCAT_WS(' ', u.nombre, u.Apellido_Paterno, u.Apellido_Materno) AS Paciente, CONCAT_WS(' ', rt.nombre, rt.Apellido_Paterno, rt.Apellido_Materno) AS Terapeuta, a.Fecha, a.Hora
                FROM registrousuario AS u
                INNER JOIN agendacitas AS a ON a.IDUsuario = u.CorreoElectronico
                INNER JOIN registroterapeuta AS rt ON a.IDTerapeuta = rt.RFC
                WHERE (u.nombre LIKE :search OR u.Apellido_Paterno LIKE :search OR u.Apellido_Materno LIKE :search) OR 
                (rt.nombre LIKE :search OR rt.Apellido_Paterno LIKE :search OR rt.Apellido_Materno LIKE :search)";  // Agregamos la condición para el correo del terapeuta
            }
                      
            $statement = $this->pdo->prepare($query);
            $searchPattern = "%". $nombreApellido . "%"; // Agregamos el símbolo '%' para buscar coincidencias que comiencen con el texto proporcionado
            $statement->bindParam(":search", $searchPattern);
            if($rol == "Terapeuta" || $rol == "User"){
                $statement->bindParam(":correo", $correo);
            }
            if ($statement->execute()) {
                $results = $statement->fetchAll(PDO::FETCH_ASSOC);
                return $results;
            } else {
                return false;
            }
        }
    }

?>