<?php
UserData::verificaSession();
if (!session_id()) session_start();
$marcas = MarcaData::getAllMarcas();

if(isset($_POST['btnFiltrar'])){
  $marca_id = $_POST['cboMarcas'];
  $productos = ProductoData::getAllProductosByMarca($marca_id);
}
?>

<div class="container">
    <h3 class="section-title">Explora nuestro Catálogo por Marca</h3>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-address-card-o"></i>&nbsp;&nbsp;Lista de Productos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <label class="mb-0">Marcas:</label>
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="cboMarcas" required>
                                <option value="">-Seleccione Marca-</option>
                                <?php
                                if ($marcas != null) {
                                    foreach ($marcas as $marca) {
                                        echo '<option value="' . $marca['marca_id'] . '">' . $marca['marca_descripcion'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm" name="btnFiltrar">Filtrar</button>
                            <a href="reportes/vistamarcas.php" class="btn btn-success btn-sm"><i class="fas fa-print mr-2" ></i>Lista de precios</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row product-list">
                <?php
                if (isset($productos)) {
                    if ($productos != null) {
                        foreach ($productos as $row) {
                            echo '<div class="col-md-3">
                                    <div class="card card-product">
                                        <img src="imagenes/' . $row['pro_imagen'] . '" alt="' . $row['pro_descripcion'] . '" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title"><strong>Producto:</strong></h5>
                                            <p>' . $row['pro_descripcion'] . '</p>
                                            <h5 class="card-title"><strong>Precio:</strong></h5>
                                            <p>' . $row['pro_precio_v'] . ' $</p>
                                        </div>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo '<p class="no-products">NO HAY PRODUCTOS DE ESA MARCA</p>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
