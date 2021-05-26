<?php include("modulos/id.php"); ?>
<?php include("header.php"); ?>
<?php include("sidebar.php");

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tipos de Indentificaciones</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">trabajadores</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- /.col-md-6 -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Identificaciones</h3>

              <div class="card-tools">
                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
              <table class="table table-head-fixed text-nowrap">
                <caption>Tipos de indentificaciones</caption>
                <thead>
                  <tr>
                    <th>id</th>
                    <th>tipo</th>
                    <th>codigo</th>
                    <th>Editar</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach ($registroIdentificion as $Identificacion) { ?>
                    <tr>
                      <td> <?php echo $Identificacion['id']; ?></td>
                      <td><?php echo $Identificacion['tipo']; ?></td>

                      <td> <span class="badge badge-danger"><?php echo $Identificacion['codigo']; ?></span></td>

                      <td>


                        <form action="" method="post">
                          <input type="hidden" name="txtID" id="txtID" value="<?php echo $Identificacion['id']; ?>">


                          <input class="btn-outline-info btn-sm" heref="#formSelected" type="submit" value="Seleccionar" name="accion">








                        </form>

                      </td>


                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>



        </div>


        <!-- /.col-md-6 -->
        <div class="col-md-6">
          <form action="" method="post" enctype="multipart/form-data">

            <div class="form-row">

              <input class="form-control" type="hidden" name="txtID" placeholder="" id="txtID" value="<?php echo $txtID; ?>" require="">



              <div class="form-group col-md-12">
                <label for="">Tipo de Identificacion:</label>

                <input class="form-control" type="text" required name="txtTipo" placeholder="" id="txtTipo" value="<?php echo utf8_encode($txtTipo); ?>">


              </div>


              <div class="form-group col-md-12">
                <label for="">Codigo:</label>

                <input class="form-control" type="number" required name="txtCodigo" placeholder="" id="txtCodigo" value="<?php echo $txtCodigo; ?>">


              </div>

              <div class="row align-items-start">


                <div class="col"> <button value="btnCancelar" type="submit" <?php echo $accionCancelar ?> class="btn btn-outline-info btn-sm" name="accion">Cancelar</button></div>
                <div class="col"> <button value="btnModificar" type="submit" <?php echo $accionModificar ?> class="btn btn-outline-primary btn-sm" name="accion">Editar</button></div>
                <div class="col"> <button value="btnEliminar" type="submit" <?php echo $accionEliminar ?> class="btn btn-outline-danger btn-sm" name="accion">Eliminar</button></div>
                <div class="col"><button value="btnAgregar" type="submit" <?php echo $accionAgregar ?> class="btn btn-outline-success btn-sm" name="accion">Agregar</button></div>


              </div>

              <div class="form-group col-md-12">

                <br>
                <br>



                <!--Mensaje de error -->
                <?php if (!empty($errores)) : ?>
                  <div>
                    <ul>
                      <?php echo $errores; ?>
                    </ul>
                  </div>
                <?php endif; ?>



              </div>





            </div>

          </form>

        </div>


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include("footer.php"); ?>