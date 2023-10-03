<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  header("Location: ../vistas/login.php");
} else {
  require 'header.php';

  if ($_SESSION['compras'] == 1) {
    ?>


        <div class="content-start transition  ">
          <div class="container-fluid dashboard">
            <div class="content-header">
              <h1>Lista de compras <a class="btn btn-success btn-sm" href="compra.php">Agregar Compra</a></h1>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                  <div class="table-responsive">
                    <table id="tbllistado" class="table table-striped" style="width: 100% !important;">
                      <thead>
                        <th>...</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Usuario</th>
                        <th>Documento</th>
                        <th>Número</th>
                        <th style="background-color: #A7FF64;">Total</th>
                        <th>Estado</th>
                      </thead>
                      <tbody>
                      </tbody>

                    </table>
                    </div>
                  </div>
                </div>
              </div>


          </div><!-- /.row -->


              </div><!-- End Container-->
          </div><!-- End Content-->


        <?php
  } else {
    require 'noacceso.php';
  }

  require 'footer.php';

  ?>
    <script type="text/javascript" src="scripts/compra.js"></script>
    <?php


}
ob_end_flush();
?>
