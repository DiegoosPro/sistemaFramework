<?php
date_default_timezone_set("America/Bogota");
class UserData
{

    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public static function getLogin($cedula, $upass)
    {
        try {
            $sql = "SELECT * FROM sisga_personas p, sisga_usuarios u 
                       WHERE p.cedula=u.persona_cedula
                       AND u.usuario=:pcedula LIMIT 1";
            $conexion = Database::getCon();
            $stmt = $conexion->prepare($sql);
            $stmt->bindparam(":pcedula", $cedula);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                if (MD5($upass) == $userRow['upassword']) {
                    if ($userRow['activo'] == 1) {
                        if (!isset($_SESSION)) {
                            session_destroy();
                            session_start();
                        }


                        $_SESSION['sisgauser_cedula'] = $userRow['persona_cedula']; // ESTE ES RP ***OJO **** persona cedula
                        $_SESSION['sisgauser_error'] = null;
                        $_SESSION['sisgalast_time'] = time();

                        //******************* AUXILIARES ************************************

                        $_SESSION['mensaje'] = null;

                        return true;
                    } else {
                        $_SESSION['sisgauser_error'] = "Estimado usuario, usted NO tiene autorización para utilizar el sistema, consulte al Administrador";
                        return false;
                    }
                } else {
                    $_SESSION['sisgauser_error'] = "Usuario y/o Contraseña incorrectas..!!!";
                    return false;
                }
            } else {
                $_SESSION['sisgauser_error'] = "Usuario y/o Contraseña incorrectas, intente de nuevo..!!!";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function verificaSession()
    {
        if (!session_id()) session_start();
        if (isset($_SESSION['sisgauser_id']) && $_SESSION['sisgauser_cedula'] != null) {
            if ((time() - $_SESSION['sisgalast_time']) < 5400)
                $_SESSION['sisgalast_time'] = time();
            else
                Core::redir("./?view=logout");
        } else {
            Core::redir("./?view=logout");
        }
    }


    public static function redirect($url)
    {
        View::load("login");
    }
}
