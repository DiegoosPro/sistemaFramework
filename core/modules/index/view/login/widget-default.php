
<script type="text/javascript" src="js/jquery-1.11.3.js"></script>
<?php

  // echo "<script type='text/javascript'>  $(document).ready(function(){ $('#myModalAviso').modal('show');  });</script>";

?>

    <div class="row">

        <div class="form-group col-sm-4">
              <p align="center">
                <img src="img/escudo.png" align="center" width="200" height="200">
            </p>
            <center>AMIE : 10H00099</center>
            <center>Calle Guallupe 325 y Victoria Castelló <center>
            <center>Teléfonos : (062)630663/ (062)630616</center>
            <center>email : uetmsv@gmail.com</center>
            <center>Ibarra - Ecuador</center>
        </div>

        <div class="form-group col-sm-4">

            <div class="col-md-12">
                <form action="./?action=processlogin" method="post" autocomplete="on">
                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-users"></i>
                                Acceso al sistema
                            </h3>
                        </div>

                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['sisgauser_error']) && $_SESSION['sisgauser_error'] != null) {
                                ?>
                                <div class="alert alert-danger">
                                    <i class="fa fa-warning"></i>
                                    &nbsp; <?php echo $_SESSION['sisgauser_error']; ?> !
                                </div>
                                <?php
                                $_SESSION['sisgauser_error'] = null;
                            }

                            ?>


                            <div class="form-group">
                                <label>Usuario:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="fa fa-user"></i>
                                          </span>
                                    </div>

                                    <input type="text" class="form-control" name="txtCedula" value=""
                                           placeholder="Usuario" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Contraseña:</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-lock"></i>
                      </span>
                                    </div>
                                    <input type="password" class="form-control" name="txtPassword" autocomplete="off"
                                           placeholder="Contraseña" required>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer">
                            <button name="btn-login" class="btn btn-primary" 
                                    type="submit"><i
                        class="fa fa-arrow-right"></i> &nbsp; Entrar
                            </button>
                            <div style="float:right; font-size: 80%; position: relative; top:-10px">
                                <a href="./?view=sisgarecuperarpass">Olvide mi contraseña?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-group col-sm-3">
        </div>

    </div>

<div id="myModalAviso" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i class="fa fa-info"></i> Aviso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <div class="alert alert-warning alert-white rounded">

                    <div class="icon">
                        <i class="fa fa-warning"></i>
                    </div>
                    <strong>ATENCIÓN...</strong> Estimad@ usuario
                </div>
                <p align="center">
                    <img src="img/escudo.png" width="140" height="100">
                </p>
                <div class="callout callout-danger">
                    El <strong>SISTEMA INTEGRADO DE GESTIÓN ACADÉMICA</strong>, estará deshabilitado temporalmente para DOCENTES Y ESTUDIANTES los días Martes 30 y Miercoles 31 de Agosto
                    por configuración del nuevo periodo, por lo tanto todas las actividades administrativas se realizarán en Secretaría. Gracias por su comprensión.
                    <br><br>
                    
                    <p align="center">
                        Atentamente, <br><br>
                        MSc. René Pilataxi A. <br>
                        Administrador
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
