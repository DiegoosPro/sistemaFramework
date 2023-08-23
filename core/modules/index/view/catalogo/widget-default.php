<?php
UserData::verificaSession();
if (!session_id()) session_start();
$catego=CategoriaData::getAllCategorias();

//****************************** CATALOGO ****************************//

if(isset($_POST['btnFiltar'])){ // Corrige el nombre del botón a 'btnFiltar'
  $idcatego = $_POST['cboCategorias'];
  $productos = ProductoData::getAllProductosByCategoria($idcatego);
}
?>


<h3>ESTOY EN EL CATALOGO</h3>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Lista de estudiantes</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form method="post">
                    <label class="mb-0">Categoría:</label>
                    <div class="input-group  input-group-sm">
                        <select class="form-control" name="cboCategorias" required>
                            <option value="">-Seleccione Categoria-</option>
                            <?php
                            $categorias = CategoriaData::getAllCategorias();
                            if ($categorias != null) {
                                foreach ($categorias as $rowc) {
                                    echo '<option value="' . $rowc['catego_id'] . '">' . $rowc['catego_descripcion'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm" name="btnFiltar">Filtrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php
            if(isset($productos)){
                if($productos != null){
                    foreach($productos as $row){
                        echo '<div class="col-md-3">
                                <div class="card card-primary card-outline">
                                    <img src="imagenes/' . $row['pro_imagen'] . '" alt="" height="auto" class="card-img-top">
                                    <div class="card-body">
                                        ' . $row['pro_descripcion'] . '
                                        ' . $row['pro_precio_v'] . '
                                    </div>
                                </div>
                              </div>';
                    }
                } else {
                    echo "NO HAY PRODUCTOS DE ESA CATEGORIA";
                }
            }
            ?>
        </div>
    </div>
</div>