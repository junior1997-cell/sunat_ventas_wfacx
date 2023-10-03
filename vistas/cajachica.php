<?php
session_start();
//Activamos el almacenamiento del Buffer
ob_start();


if (!isset($_SESSION["nombre"])) {
  header("Location: ../vistas/login.php");
} else {
  require 'header.php';

  if ($_SESSION['inventarios'] == 1) {


    ?>

            <div class="content-start transition">
              <div class="container-fluid dashboard">
                <div class="content-header">
                  <h1>Caja chica del sistema <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#agregarsaldoInicial" onclick="verificarSaldoInicial()">Aperturar caja</button>
                  <button type="button"  class="btn btn-primary" id="cerrarCajaBtn" onclick="cerrarCaja()">Cerrar caja Automatica 12pm</button>

        </h1>
                </div>

                <div class="row">


                    <!-- Ver ingresos , saldos, egros hacia caja -->

                    <div class="col-md-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                          </div>
                          <div class="col-8">
                            <p>Ingresos</p>
                            <h5 id="total_ingreso"></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-clipboard-list icon-home bg-success text-light"></i>
                          </div>
                          <div class="col-8">
                            <p>Egresos</p>
                            <h5 id="total_gasto"></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-chart-bar  icon-home bg-info text-light"></i>
                          </div>
                          <div class="col-8">
                            <p>Saldo Inicial</p>
                            <h5 id="total_saldoini"></h5>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-4 d-flex align-items-center">
                            <i class="fas fa-id-card  icon-home bg-danger text-light"></i>
                          </div>
                          <div class="col-8">
                            <p>Total en caja + ventas</p>
                            <h5 id="total-ventas"></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">

                        <div class="table-responsive">
                          <table id="tblistadototalcaja" class="table table-striped" style="width: 100% !important;">
                            <thead>
                              <tr>
                                <th scope="col">Fecha Cierre</th>
                                <th scope="col">Ingreso</th>
                                <th scope="col">Egreso</th>
                                <th scope="col">Saldo Inicial</th>
                                <th scope="col">Total en caja cerrada</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>

                              </tr>
                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                  </div>



                </div><!-- /.row -->


              </div><!-- End Container-->
            </div><!-- End Content-->


            <div class="modal fade text-left" id="agregarsaldoInicial" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Apertura tu caja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form name="formulario" id="formulario" method="POST">
                      <div class="row">
                        <div class="mb-3 col-lg-12">
                          <label for="message-text" class="col-form-label">Monto Inicial:</label>
                          <input type="text" class="form-control" name="saldo_inicial" id="saldo_inicial"  required>
                        </div>
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                      <i class="bx bx-x d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Cancelar</span>
                    </button>
                    <button id="btnGuardarSaldoInicial" type="submit" class="btn btn-primary ml-1">
                      <i class="bx bx-check d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Agregar</span>
                    </button>
                  </div>
                  </form>
                </div>
              </div>
            </div>


          <?php
  } else {
    require 'noacceso.php';
  }

  require 'footer.php';
  ?>
      <script type="text/javascript" src="scripts/cajachica.js"></script>  
    <?php
}
ob_end_flush();
?>