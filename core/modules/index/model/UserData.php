<?php
date_default_timezone_set("America/Bogota");
class UserData
{


    public static function getLogin($usuario, $contra)
    {
        try {
            $sql = "SELECT * FROM usuarios u, perfiles p 
                       WHERE p.per_id=u.per_id
                       AND u.user_usuario=:pusuario";
            $conexion = Database::getCon();
            $stmt = $conexion->prepare($sql);
            $stmt->bindparam(":pusuario", $usuario);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($contra == $userRow['user_contra']) {
                    if ($userRow['user_activo'] == 1) {
                        if (!isset($_SESSION)) {
                            session_destroy();
                            session_start();
                        }

                        $_SESSION['user_id'] = $userRow['user_id'];
                        $_SESSION['user_nombre'] = $userRow['user_nombre']; 
                        $_SESSION['user_perfil'] = $userRow['per_nombre']; 
                        $_SESSION['user_error'] = null;
                        $_SESSION['last_time'] = time();

                        //******************* AUXILIARES ************************************

                        $_SESSION['mensaje'] = null;

                        return true;
                    } else {
                        $_SESSION['user_error'] = "Estimado usuario, usted NO tiene autorización para utilizar el sistema, consulte al Administrador";
                        return false;
                    }
                } else {
                    $_SESSION['user_error'] = "Usuario y/o Contraseña incorrectas..!!!";
                    return false;
                }
            } else {
                $_SESSION['user_error'] = "Usuario y/o Contraseña incorrectas, intente de nuevo..!!!";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function verificaSession()
    {
        if (!session_id()) session_start();
        if (isset($_SESSION['user_id']) && $_SESSION['user_nombre'] != null) {
            if ((time() - $_SESSION['last_time']) < 300)
                $_SESSION['last_time'] = time();
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
