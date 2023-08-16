<?php
date_default_timezone_set("America/Bogota");
UserData::verificaSession();
if (!session_id()) session_start();
$fechahoy = date("Y-m-d H:m:s");
//****************************** CATALOGO ************************
if(isset ($_POST['btnFiltrar'])){
  $idcatego=$_POST['cboCategorias'];
  $productos = ProductoData::getAllProductosByCategoria($idcatego);

}
?>


<h3>ESTOY EN EL CATALOGO</h3>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Lista de estudiantes</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
<div class="row">
  <div class ="col-md-6">
    <form method="post">
  <!--  -->
  <?php
                  $categorias = CategoriaData::getAllCategorias();
                  ?>
                  <label class="mb-0">Categoría :</label>
                  <div class="input-group  input-group-sm">
                  <select class="form-control" name="cboCategorias" required>
                    <option value="">-Seleccione Categoria-</option>
                    <?php
                    if ($categorias != null) {
                      foreach ($categorias as $indice => $rowc) {
                    ?>
                        <option value="<?php echo $rowc['catego_id']; ?>"><?php echo $rowc['catego_descripcion']; ?></option>
                    <?php
                      }

                    }
                    ?>
                  </select>
                  <button type="submit"  class="btn btn-primary btn-sm" name="btnFiltar">Filtrar</button>
                  </div>
                  <!--  -->
                  </form>
                  </div>
        </div>
        <div class="row">
              <?php
                   if(isset($productos)){
                     echo "entro";
                     if($productos!=null){
                       foreach($productos as $indice => $row){
                      ?>
                      <div class="col-md-3">
                        <div class="card card-primary card-outline">
                          <img src="imagenes/<?php echo  $row['pro_descripcion'];?>" 
                          <div class="card-body">
                              <?php echo  $row['pro_imagen'];?>
                              <?php echo  $row['pro_precio_v'];?>
                          </div>
                        </div>


                        




                  <?php
                    }
                     }else{
                       echo "NO HAY PRODUCTOS DE ESA CATEGORIA";
                     }
                   }
                    
                    ?>


        </div>

            
        </div>
</div>