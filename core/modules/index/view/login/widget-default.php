<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Acceder al Sistema</b></a>
    </div>
    <div class="card-body">

      <form action="../../index3.html" method="post">
        <div class="input-group mb-3">
            <label for="">Usuario:</label>
          <input type="text" class="form-control" name="txtUsuario" placeholder="usuario">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <label for=""> Contraseña:</label>
          <input type="password" class="form-control" name="txtContra" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btnIngresar" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">Olvide mi contraseña</a>
      </p>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->