<?php
class MarcaData  {

    public static function getAllMarcas()
    {
      try {
        $sql = "SELECT * FROM tab_marcas 
                    ORDER BY marca_descripcion";
        $conexion = conectaBaseDatos();
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $lista;
        } else
          return null;
      } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      }
    }
    // RETORNA UN REGISTRO
    public static function getNombreMarcaById($marca_id)
    {
      try {
        $sql = "SELECT marca_descripcion FROM tab_marcas
              WHERE marca_id=:pmarca_id";
        $conexion = conectaBaseDatos();
        $stmt = $conexion->prepare($sql);
        $stmt->bindparam(":pmarca_id", $marca_id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          $registro = $stmt->fetch(PDO::FETCH_ASSOC);
          return $registro ['marca_descripcion'];
        } else {
          return null;
        }
      } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
      }


}


?>

