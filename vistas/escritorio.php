<?php

//Activamos el almacenamiento en el buffer

session_start();

ob_start();



if (!isset($_SESSION["nombre"])) {

  header("Location: ../vistas/login.php");

} else {

  require 'header.php';



  if ($_SESSION['escritorio'] == 1) {





    require_once "../modelos/Consultas.php";
    $consulta = new Consultas();
    
    $rsptac = $consulta->totalcomprahoy($_SESSION['idempresa']);
    $regc = $rsptac->fetch_object();
    $totalc = $regc->total_compra;



    $rsptav = $consulta->totalventahoycotizacion($_SESSION['idempresa']);
    $regv = $rsptav->fetch_object();
    $totalvcotihoy = $regv->total_venta_coti_hoy;



    $rsptav = $consulta->totalventahoyFactura($_SESSION['idempresa']);
    $regv = $rsptav->fetch_object();
    $totalvfacturahoy = $regv->total_venta_factura_hoy;



    $rsptav = $consulta->totalventahoyBoleta($_SESSION['idempresa']);
    $regv = $rsptav->fetch_object();
    $totalvboletahoy = $regv->total_venta_boleta_hoy;



    $rsptav = $consulta->totalventahoyNotapedido($_SESSION['idempresa']);
    $regv = $rsptav->fetch_object();
    $totalvnpedidohoy = $regv->total_venta_npedido_hoy;



    $totalventas = 0;
    $totalventas = $totalvfacturahoy + $totalvboletahoy + $totalvnpedidohoy;






    $rsptav = $consulta->totalventahoyFacturaServicio($_SESSION['idempresa']);
    $regv = $rsptav->fetch_object();
    $totalvfacturaServiciohoy = $regv->total_venta_factura_hoy;



    $rsptav = $consulta->totalventahoyBoletaServicio($_SESSION['idempresa']);
    $regv = $rsptav->fetch_object();
    $totalvboletaServiciohoy = $regv->total_venta_boleta_hoy;


    //dash card

    //total categoria
    $rsptav = $consulta->totalcategoriaActiva();
    $regv = $rsptav->fetch_object();
    $totalcategoriaActiva = $regv->total;

    $rsptav = $consulta->totaUsuarioRegistrados();
    $regv = $rsptav->fetch_object();
    $totaUsuarioRegistrados = $regv->total;

    $rsptav = $consulta->totaArticulosRegistrados();
    $regv = $rsptav->fetch_object();
    $totaArticulosRegistrados = $regv->total;

    $rsptav = $consulta->totaClientesRegistrados();
    $regv = $rsptav->fetch_object();
    $totaClientesRegistrados = $regv->total;



    //Productos mas vendidos
    $rsptav = $consulta->productosmasvendidos();
    $regv = $rsptav->fetch_object();
    $productosmasvendidos= $regv->total;






    //Tipo de cambio
    date_default_timezone_set('America/Lima');
    $hoy = date('Y/m/d');
    $hoy2 = date('Y-m-d');

    $rsptatc = $consulta->mostrartipocambio($hoy);
    $regtc = $rsptatc->fetch_object();

    if (!isset($regtc)) {
      $idtipocambio = "";
      $fechatc = "";
      $tccompra = "";
      $tcventa = "";
      $dfecha = "";

    } else {
      $idtipocambio = $regtc->idtipocambio;
      $fechatc = $regtc->fecha;
      $tccompra = $regtc->compra;
      $tcventa = $regtc->venta;


      // if ($fechatc==$hoy2) {
      //      $dfecha="readonly";
      //    }else{
      //      $dfecha="";
      //  }


      if ($fechatc == '') {
        $dfecha = "";
      }
    }
    //Tipor de cambio

    //Caja

    date_default_timezone_set('America/Lima');

    $hoy = date('Y/m/d');

    $hoy2 = date('Y-m-d');



    $rsptatc = $consulta->mostrarcaja($hoy, $_SESSION['idempresa']);

    $regtc = $rsptatc->fetch_object();



    if (!isset($regtc)) {

      $idcaja = "";

      $idcajai = "";

      $idcajas = "";

      $fecha = "";

      $montoi = "0";

      $montof = "0";

      $dfecha = "";

      $estado = "";

      $cajaestado = "";

      $mensajecaja = "ABRIR CAJA";

      $hb = "";

      $color = "";

      $btn = "";

    } else {

      $idcaja = $regtc->idcaja;

      $idcajai = $regtc->idcaja;

      $idcajas = $regtc->idcaja;

      $fecha = $regtc->fecha;

      $montoi = $regtc->montoi;

      $montof = $regtc->montof;

      $estado = $regtc->estado;



      if ($fecha == $hoy2) {

        $dfecha = "readonly";

      } else {

        $dfecha = "";



      }



      if ($estado == '') {

        $mensajecaja = 'ABRIR CAJA';

      }



      if ($estado == '1') {

        $mensajecaja = 'CERRAR CAJA';

        $hb = "";

        $cajaestado = 'ABIERTA';

        $color = 'green';

        $btn = "";

      } else {

        $mensajecaja = 'ABRIR CAJA';

        $hb = "readonly";

        $cajaestado = 'CERRADA';

        $color = 'red';

        $btn = "disabled";

      }











    }

    //Tipor de caja





    //Datos para mostrar el gráfico de barras de las compras

    $compras10 = $consulta->comprasultimos_10dias($_SESSION['idempresa']);

    $fechasc = '';

    $totalesc = '';

    $mes = '';

    while ($regfechac = $compras10->fetch_object()) {

      $fechasc = $fechasc . '"' . $regfechac->fecha . '",';

      $totalesc = $totalesc . $regfechac->total . ',';

      $mes = $mes . $regfechac->mes . ',';

    }

    //Quitamos la última coma

    $fechasc = substr($fechasc, 0, -1);

    $totalesc = substr($totalesc, 0, -1);

    $mes = substr($mes, 0, -1);



    //Datos para mostrar el gráfico de barras de las ventas

    $ventas12 = $consulta->ventasultimos_12meses($_SESSION['idempresa']);

    $fechasv = '';

    $totalesv = '';

    while ($regfechav = $ventas12->fetch_object()) {

      $fechasv = $fechasv . '"' . $regfechav->fecha . '",';

      $totalesv = $totalesv . $regfechav->total . ',';

    }

    //Quitamos la última coma

    $fechasv = $fechasv;

    $totalesv = $totalesv;





    $consultaSTs = $consulta->consultaestados();

    $estado = '';

    $totalestado = '';

    $stEmitido = 0;

    $stFirmado = 0;

    $stAceptado = 0;

    $stAnulado = 0;

    $stNota = 0;

    $stFisico = 0;

    while ($regestados = $consultaSTs->fetch_object()) {

      $estadoD = $regestados->estado;

      $totalestadoD = $regestados->totalestados;

      switch ($estadoD) {

        case '1':

          $stEmitido = $totalestadoD;

          break;

        case '5':

          $stAceptado = $totalestadoD;
          ;

          break;

        case '5':

          $stAceptado = $totalestadoD;
          ;

          break;

        case '3':

          $stAnulado = $totalestadoD;
          ;

          break;

        case '4':

          $stFirmado = $totalestadoD;
          ;

          break;

        case '6':

          $stFisico = $totalestadoD;
          ;

          break;



        default:

          # code...

          break;

      }

    }





    $consultaSTsCoti = $consulta->consultaestadoscotizaciones();

    $estadoC = '';

    $totalestadoDCoti = '';

    $stEmitidoCoti = 0;

    $stAceptadoCoti = 0;

    while ($regestadosCoti = $consultaSTsCoti->fetch_object()) {

      $estadoDCoti = $regestadosCoti->estado;

      $totalestadoDCoti = $regestadosCoti->totalestados;

      switch ($estadoDCoti) {

        case '1':

          $stEmitidoCoti = $totalestadoDCoti;

          break;

        case '5':

          $stAceptadoCoti = $totalestadoDCoti;
          ;

          break;

        default:

          break;

      }

    }







    $consultaSTsOs = $consulta->consultaestadosdocumentoC();

    $estadoC = '';

    $totalestadoDcobranza = '';

    $stEmitidoDcobranza = 0;

    $stAceptadoddcobranza = 0;

    while ($regestadosDcobranza = $consultaSTsOs->fetch_object()) {

      $estadoDCoti = $regestadosDcobranza->estado;

      $totalestadoDcobranza = $regestadosDcobranza->totalestados;

      switch ($estadoDCoti) {

        case '1':

          $stEmitidoDcobranza = $totalestadoDcobranza;

          break;

        case '5':

          $stAceptadoddcobranza = $totalestadoDcobranza;
          ;

          break;

        default:

          break;

      }

    }


                    
    $lunes = '0.00';
    $martes = '0.00';
    $miercoles = '0.00';
    $jueves = '0.00';
    $viernes = '0.00';
    $sabado = '0.00';
    $domingo = '0.00';

    $consultadiase = $consulta->ventasdiasemana();

    while ($regdiase = $consultadiase->fetch_object()) {
      $nrodia = $regdiase->dia;

      switch ($nrodia) {
        case '1':
          $domingo = $regdiase->VentasDia;
          break;
        case '2':
          $lunes = $regdiase->VentasDia;
          break;
        case '3':
          $martes = $regdiase->VentasDia;
          break;
        case '4':
          $miercoles = $regdiase->VentasDia;
          break;
        case '5':
          $jueves = $regdiase->VentasDia;
          break;
        case '6':
          $viernes = $regdiase->VentasDia;
          break;
        case '7':
          $sabado = $regdiase->VentasDia;
          break;
      }
    }
















    require_once "../modelos/Factura.php";

    $factura = new Factura();

    $datos = $factura->datosemp($_SESSION['idempresa']);

    $datose = $datos->fetch_object();



    ?>



                                        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> -->

                                        <!--Contenido-->



                                          <!-- Modal ABRIR / CERRAR CAJA -->

                                         <div class="modal fade" id="modalcaja">



                                            <div class="modal-dialog" style="width: 60% !important;">

                                              <div class="modal-content">



                                                  <div class="modal-header">CAJA</div>



                                              <form name="formulariocaja" id="formulariocaja" method="POST">

                                                  <div  id="montoscajamodal" name="montoscajamodal">

                                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                     Fecha del día: <input type="date" name="fechacaja" id="fechacaja" value="<?php echo $fecha; ?>" class=""  <?php echo $dfecha; ?>     >

                                                     <input type="hidden" name="idcaja" id="idcaja" value="<?php echo $idcaja; ?>" >

                                                     <input type="hidden" name="estado" id="estado" value="<?php echo $mensajecaja; ?>" >

                                                  </div>



                                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                     Monto inicial del día:  <input type="text" name="montoi" id="montoi" placeholder="Monto inicial" value=" <?php echo $montoi; ?> " class=""  <?php echo $hb; ?> onkeypress="return NumCheck(event, this)">

                                                  </div>

                                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                      Monto final del día: <input type="text" name="montof" id="montof" placeholder="Monto final" value=" <?php echo $montof; ?> " class=""  <?php echo $hb; ?>  onkeypress="return NumCheck(event, this)">

                                                  </div>





                                          <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">

                                            <button class="btn btn-primary" type="submit" id="btngrabar" name="btngrabar">

                                                <i class="fa fa-save"></i> <?php echo $mensajecaja; ?>

                                                  </button>

                                          </div>

 
                                          <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">

                                           <a href="#ingresocaja" data-toggle="modal"> <button class="btn btn-primary" type="submit" id="btningreso" name="btningreso" <?php echo $btn; ?>>

                                                <i class="fa fa-save"></i> INGRESO

                                                  </button></a>

                                          </div>



                                          <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">

                                             <a href="#salidacaja" data-toggle="modal">  <button class="btn btn-danger" type="submit" id="btnsalida" name="btnsalida" <?php echo $btn; ?> >

                                                <i class="fa fa-save"></i> SALIDA

                                                  </button></a>

                                          </div>











                                          <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">

                                             <a href="#cajaconsulta" data-toggle="modal">  <button class="btn btn-primary">

                                                <i class="fa fa-eye"></i> CONSULTA

                                                  </button></a>

                                          </div>



                                          <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">

                                            CAJA: <label style="font-size: 18px; color:<?php echo $color; ?>;"> <?php echo $cajaestado; ?> </label>

                                          </div>



                                          </div>



                                          <div class="form-group col-lg-12 col-md-6 col-sm-6 col-xs-12">



                                          </div>



                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                          FECHA DE CAJAS ANTERIORES.

                                            <table id="tbllistadocaja"  class="table table-striped table-bordered table-condensed table-hover" style="font-size: 14px;">

                                                                  <thead >

                                                                    <th>Id</th>

                                                                    <th>Fecha</th>



                                                                    <th>Inicial </th>

                                                                    <th>Final</th>

                                                                  </thead>

                                                                  <tbody >



                                                                  </tbody>

                                                  </table>

                                                </div>







                                                </form>



                                                  <div class="modal-footer">

                                                  <button type="button" class="btn btn-danger btn-ver" data-dismiss="modal" ><i class="fa fa-close"> </i>   Cerrar</button>

                                                </div>

                                             </div>

                                           </div>

                                          </div>





















                                           <!-- Modal ABRIR / CERRAR CAJA -->

                                         <div class="modal fade" id="modalfechas">

                                            <div class="modal-dialog" style="width: 40% !important;">

                                              <div class="modal-content">

                                                  <div class="modal-header">Fechas anteriores</div>

                                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

           <table id="tbllistadocaja"  >

                          <thead >

                            <th>Fecha</th>

                            <th>Inicial </th>

                            <th>Final</th>

                          </thead>

                          <tbody >



                          </tbody>

          </table>

        </div> -->

                                                  <div class="modal-footer">

                                                  <button type="button" class="btn btn-danger btn-ver" data-dismiss="modal" >Cerrar</button>



                                                </div>

                                             </div>

                                           </div>

                                          </div>







                                            <!-- Modal REPORTE ---------------------------------------------->

                                         <div class="modal fade" id="cajaconsulta">

                                            <div class="modal-dialog" style="width: 80% !important;">

                                              <div class="modal-content">

                                                  <div class="modal-header">ingresos y salidas</div>

                                                <form name="formulariois" id="formulariois" action="../reportes/.php" method="POST" target="_blank">

                                        <input type="hidden" name="idempresa" id="idempresa" value="<?php echo $_SESSION['idempresa']; ?>">

                                            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">

                                            <label> Año: </label>

                                            <select class="" name="ano" id="ano" onchange="listarValidar()">



                                              <option value="2017">2017</option>

                                              <option value="2018">2018</option>

                                              <option value="2019">2019</option>

                                              <option value="2020">2020</option>

                                              <option value="2021">2021</option>

                                              <option value="2022">2022</option>

                                              <option value="2023">2023</option>

                                              <option value="2024">2024</option>

                                              <option value="2025">2025</option>

                                              <option value="2026">2026</option>

                                              <option value="2027">2027</option>

                                              <option value="2028">2028</option>

                                              <option value="2029">2029</option>

                                            </select>

                                            <input type="hidden" name="ano_1" id="ano_1">

                                          </div>







                                         <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">

                                            <label> Mes: </label>

                                            <select class="" name="mes" id="mes" onchange="listarValidar()">

                                              <option value="0">todos</option>

                                              <option value="1">Enero</option>

                                              <option value="2">Febrero</option>

                                              <option value="3">Marzo</option>

                                              <option value="4">Abril</option>

                                              <option value="5">Mayo</option>

                                              <option value="6">Junio</option>

                                              <option value="7">Julio</option>

                                              <option value="8">Agosto</option>

                                              <option value="9">Septiembre</option>

                                              <option value="10">Octubre</option>

                                              <option value="11">Noviembre</option>

                                              <option value="12">Diciembre</option>

                                            </select>

                                            <input type="hidden" name="mes_1" id="mes_1">

                                          </div>





                                          <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">

                                            <label> Día: </label>

                                            <select class="" name="dia" id="dia" onchange="listarValidar()">

                                              <option value="01">01</option>

                                              <option value="02">02</option>

                                              <option value="03">03</option>

                                              <option value="04">04</option>

                                              <option value="05">05</option>

                                              <option value="06">06</option>

                                              <option value="07">07</option>

                                              <option value="08">08</option>

                                              <option value="09">09</option>

                                              <option value="10">10</option>

                                              <option value="11">11</option>

                                              <option value="12">12</option>

                                              <option value="13">13</option>

                                              <option value="14">14</option>

                                              <option value="15">15</option>

                                              <option value="16">16</option>

                                              <option value="17">17</option>

                                              <option value="18">18</option>

                                              <option value="19">19</option>

                                              <option value="20">20</option>

                                              <option value="21">21</option>

                                              <option value="22">22</option>

                                              <option value="23">23</option>

                                              <option value="24">24</option>

                                              <option value="25">25</option>

                                              <option value="26">26</option>

                                              <option value="27">27</option>

                                              <option value="28">28</option>

                                              <option value="29">29</option>

                                              <option value="30">30</option>

                                              <option value="31">31</option>



                                            </select>

                                            <input type="hidden" name="mes_1" id="mes_1">

                                          </div>



                                        <!-- <div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12">

        <button class="btn btn-primary" type="submit" id="btnconsulta"  data-toggle="tooltip" title="Consultar" onclick="return enviar();" ><i class="fa fa-print" ></i> Reporte

        </button>

</div> -->



                                        <div class="form-group col-lg-12 col-md-4 col-sm-6 col-xs-12">

                                        </div>





                                          <!-- centro -->



                                                <table id="tbllistadocajavalidar" class="table table-striped table-bordered table-condensed table-hover" style="font-size: 12px;">

                                                            <thead>

                                                                    <th>FECHA</th>

                                                                    <th>MONTO</th>

                                                                    <th>CONCEPTO</th>

                                                                    <th>TIPO</th>

                                                                  </thead>

                                                                  <tbody>

                                                                  </tbody>

                                                                </table>







                                              </form>

                                                  <div class="modal-footer">

                                                  <button type="button" class="btn btn-danger btn-ver" data-dismiss="modal" >Cerrar</button>



                                                </div>

                                             </div>

                                           </div>

                                          </div>







                                          <!-- Modal ABRIR / INGRESO CAJA -->

                                         <div class="modal fade" id="ingresocaja">

                                            <div class="modal-dialog" style="width: 40% !important;">

                                              <div class="modal-content">

                                                  <div class="modal-header" style="font-size: 18px; color: green;"  >Ingreso</div>

                                              <form name="formularioicaja" id="formularioicaja" method="POST">

                                                <div name="idcajaingreso" id="idcajaingreso">

                                                  <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">

                                                     <input type="hidden" name="idcajai" id="idcajai" value="<?php echo $idcajai; ?>" >

                                                  </div>

                                                  <div class="form-group col-lg-12 col-md-4 col-sm-6 col-xs-12">

                                                     Concepto:  <textarea name="concepto" id="concepto" placeholder="Monto inicial" class=""  rows="5" cols="100" autofocus onkeyup="mayus(this)"></textarea>

                                                  </div>

                                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                      Monto: <input type="text" name="monto" id="monto" placeholder="Monto" class=""  onkeypress="return NumCheck(event, this)" >

                                                  </div>

                                                </div>



                                          <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                            <button class="btn btn-primary" type="submit" id="btngrabar" name="btngrabar">

                                                <i class="fa fa-save"></i> GRABAR

                                                  </button>

                                          </div>

                                                </form>

                                                  <div class="modal-footer">

                                                  <button type="button" class="btn btn-danger btn-ver" data-dismiss="modal" >Cerrar</button>

                                                </div>

                                             </div>

                                           </div>

                                          </div>





                                           <!-- Modal ABRIR / SALIDA CAJA -->

                                         <div class="modal fade" id="salidacaja">

                                            <div class="modal-dialog" style="width: 40% !important;">

                                              <div class="modal-content">

                                                  <div class="modal-header" style="font-size: 18px; color: red;"  >SALIDA</div>

                                              <form name="formularioscaja" id="formularioscaja" method="POST">

                                                <div name="idcajasalida" id="idcajasalida">

                                                  <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">

                                                     <input type="hidden" name="idcajas" id="idcajas" value="<?php echo $idcajas; ?>" >

                                                  </div>

                                                  <div class="form-group col-lg-12 col-md-4 col-sm-6 col-xs-12">

                                                     Concepto:  <textarea name="concepto" id="concepto" placeholder="Monto inicial" class=""  rows="5" cols="100" autofocus onkeyup="mayus(this)"></textarea>

                                                  </div>

                                                  <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                      Monto: <input type="text" name="monto" id="monto" placeholder="Monto" class=""  onkeypress="return NumCheck(event, this)" >

                                                  </div>

                                                </div>



                                          <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">

                                            <button class="btn btn-primary" type="submit" id="btngrabar" name="btngrabar">

                                                <i class="fa fa-save"></i> GRABAR

                                                  </button>

                                          </div>

                                                </form>

                                                  <div class="modal-footer">

                                                  <button type="button" class="btn btn-danger btn-ver" data-dismiss="modal" >Cerrar</button>

                                                </div>

                                             </div>

                                           </div>

                                          </div>



                                         <!-- Modal tipo de cambio -->
                                         <div class="modal fade" id="modalTcambio" tabindex="-1" aria-labelledby="modalTcambio" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTcambio">Tipo de cambio desde SUNAT</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="formulariotcambio" id="formulariotcambio" method="POST">
                                                            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12" hidden>
                                                                Fecha: <input type="date" name="fechatc" id="fechatc" value="<?php echo $fechatc; ?>" class=""
                                                                    <?php echo $dfecha; ?> onchange="consultartcambio();" readonly="true">
                                                                <input type="hidden" name="idtcambio" id="idtcambio" value="<?php echo $idtipocambio; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-lg-6">
                                                                    <label for="recipient-name" class="col-form-label">Compra:</label>
                                                                    <input type="text" class="form-control" name="compra" id="compra" value=" <?php echo $tccompra; ?> ">
                                                                </div>
                                                                <div class="mb-3 col-lg-6">
                                                                    <label for="message-text" class="col-form-label">Venta:</label>
                                                                    <input type="text" class="form-control" name="venta" id="venta"
                                                                        value=" <?php echo $tcventa; ?> ">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button hidden class="btn btn-success" type="button" id="btnguarconsultar" name="btnguarconsultar"
                                                            onclick="consultartcambio();">
                                                            <i class="fa fa-find"></i>TC sunat
                                                        </button>
                                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button> -->
                                                        <button type="submit" id="btnguardartcambio" name="btnguardartcambio" value="btnguardartcambio"
                                                            class="btn btn-primary">Guardar</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <!--Content Start-->
                                        <div class="content-start transition  ">
                                         <div class="container-fluid dashboard">
                                          <div class="content-header">
                                            <h1>Dashboard</h1>
                                          </div>

                                            <!-- Main content -->
             

                                                <div class="row">


                                                  <div class="col-md-6 col-lg-3">
                                                    <div class="card">
                                                      <div class="card-body">
                                                        <div class="row">
                                                          <div class="col-4 d-flex align-items-center">
                                                            <i class="fas fa-inbox icon-home bg-primary text-light"></i>
                                                          </div>
                                                          <div class="col-8">
                                                            <p>Boleta</p>
                                                            <h5>S/<?php echo number_format($totalvboletahoy, 2); ?></h5>
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
                                                            <p>Factura</p>
                                                            <h5>S/<?php echo number_format($totalvfacturahoy, 2); ?></h5>
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
                                                            <p>Nota de venta</p>
                                                            <h5>S/<?php echo number_format($totalvnpedidohoy, 2); ?></h5>
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
                                                            <p>Total Ventas HOY</p>
                                                            <h5>S/<?php echo number_format($totalventas, 2); ?></h5>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>      
                    
              
                                          <div class="col-md-6 col-lg-3">
                                                        <div class="card" style="max-height: 120px;">
                                                            <div style="background: #111c43; padding: 10px;" class="card-body">
                                                                <div class="row">
                                                    
                                                                    <div class="col-8">
                                                                        <p class="letracard">Categorias activas</p>
                                                                        <h5 class="preciocard"><?php echo number_format($totalcategoriaActiva); ?></h5>
                                                                    </div>
                                                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                                            
                                                                        <i class="fa-brands fa-slack icon-home text-light"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                      <div class="col-md-6 col-lg-3">
                                                        <div class="card" style="max-height: 120px;">
                                                            <div style="background: #28a745; padding: 10px;" class="card-body">
                                                                <div class="row">
                                                    
                                                                    <div class="col-8">
                                                                        <p class="letracard">Artículos</p>
                                                                        <h5 class="preciocard"><?php echo number_format($totaArticulosRegistrados); ?></h5>
                                                                    </div>
                                                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                                                        <i class="fa-solid fa-barcode icon-home text-light"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                          
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="card" style="max-height: 120px;">
                                                            <div style="background: #17a2b8; padding: 10px;" class="card-body">
                                                                <div class="row">
                                                    
                                                                    <div class="col-8">
                                                                        <p class="letracard">Usuarios</p>
                                                                        <h5 class="preciocard"><?php echo number_format($totaUsuarioRegistrados); ?></h5>
                                                                    </div>
                                                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                                                        <i class="fa-solid fa-users icon-home text-light"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                          
                                                    <div class="col-md-6 col-lg-3">
                                                        <div class="card" style="max-height: 120px;">
                                                            <div style="background: #dc3545; padding: 10px;" class="card-body">
                                                                <div class="row">
                                              
                                                                    <div class="col-8">
                                                                        <p class="letracard">Clientes</p>
                                                                        <h5 class="preciocard"><?php echo number_format($totaClientesRegistrados); ?></h5>
                                                                    </div>
                                                                    <div class="col-4 d-flex align-items-center justify-content-center">
                                                                        <i class="fa-solid fa-people-group icon-home text-light"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  

                                                    <div class="col-md-6">
                                                    <div class="card" style="height:100%">
                                                             <div class="card-header">
                                                                <h4>Top productos más vendidos</h4>
                                                              </div>

                                                      <div class="card-body" style="overflow-y: auto;">

                                                      <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-left">Código</th>
                <th class="text-left">Nombre</th>
                <th class="text-center">Imagen</th>
                <th class="text-center">Estado</th>
                <th class="text-right">Uni. Vendidas</th>
                <th class="text-right">Total Ventas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rsptav = $consulta->productosmasvendidos();
            while ($regv = $rsptav->fetch_object()) {
                echo "<tr>";
                echo "<td class='text-left'>{$regv->codigo}</td>";
                echo "<td class='text-left'>{$regv->nombre}</td>";
                $imagenPath = (empty($regv->imagen) || $regv->imagen == null) ? 'simagen.png' : $regv->imagen;
                echo "<td class='text-center'><img src='../files/articulos/{$imagenPath}' alt='Imagen del producto' class='img-thumbnail' style='max-width: 40px;'></td>";
                $estadoClase = ($regv->estado == 1) ? 'estado-activo' : 'estado-inhabilitado';
                $estadoTexto = ($regv->estado == 1) ? 'Activo' : 'Inhabilitado';
                echo "<td class='text-center'><span class='{$estadoClase}'>{$estadoTexto}</span></td>";
                echo "<td class='text-right'>" . intval($regv->total_unidades_vendidas) . "</td>";
                echo "<td class='text-right'>{$regv->total_ventas}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

                                                    
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="col-md-6">
                                                  <div class="card">
                                                    <!-- <div class="card-header">
              <h4>Ventas de los últimos 3 meses</h4>
            </div> -->
                                                    <div class="card-body">
                                                      <!-- <canvas id="ventas" width="400" height="300"></canvas> -->
                                                      <figure class="highcharts-figure">
                                                      <div id="ventasfacturaboletasemanalxdia"></div>
                                                      </figure>
                                                    </div>
                                                  </div>
                                                </div>



                                                  <div class="col-md-6">
                                                    <div class="card">
                                                      <!-- <div class="card-header">
                <h4>Ventas de los últimos 3 meses</h4>
              </div> -->
                                                      <div class="card-body">
                                                        <!-- <canvas id="ventas" width="400" height="300"></canvas> -->
                                                        <figure class="highcharts-figure">
                                                        <div id="ventas"></div>
                                                        </figure>
                                                      </div>
                                                    </div>
                                                  </div>

                                                
                                          
                    
                                                  

                                                <div class="col-md-6">
                                                  <div class="card">
                                                    <!-- <div class="card-header">
              <h4>Compras del ultimo mes</h4>
            </div> -->
                                                    <div class="card-body">
                                                      <!-- <canvas id="compras" width="400" height="300"></canvas> -->
                                                      <figure class="highcharts-figure">
                                                      <div id="compras"></div>
                                                      </figure>
                                                    </div>
                                                  </div>
                                                </div>

                                               

                                                <div class="col-md-6">
                                                  <div class="card">
                                                    <!-- <div class="card-header">
              <h4>Ventas de los últimos 3 meses</h4>
            </div> -->
                                                    <div class="card-body">
                                                      <!-- <canvas id="ventas" width="400" height="300"></canvas> -->
                                                      <figure class="highcharts-figure">
                                                      <div id="EstadoComprobantes"></div>
                                                      </figure>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div hidden class="col-md-6 col-lg-3">
                                                  <div class="card">
                                                    <div class="card-header">
                                                      <h4>Consulta rápida de stock</h4>
                                                    </div>
                                                    <div class="card-body pb-4">
                                                      <div class="recent-message d-flex px-4 py-3">
                                                     <input type="input" name="codigoart" id="codigoart" class="form-control" placeholder="Código de artículo" onfocus="focusTest(this);" >
                                                      </div>
                                                      <div class="recent-message d-flex px-4 py-3">
                                                        <div class="name ms-4">
                                                          <h5 class="mb-1">Nombre :</h5>
                                                          <h6 id="lnombre" nombre="lnombre" class="text-muted mb-0"></h6>
                                                        </div>
                                                      </div>
                                                      <div class="recent-message d-flex px-4 py-3">
                                                        <div class="name ms-4">
                                                          <h5 class="mb-1">Stock :</h5>
                                                          <h6 id="lstock" nombre="lstock" class="text-muted mb-0"></h6>
                                                        </div>
                                                      </div>
                                                      <div class="recent-message d-flex px-4 py-3">
                                                        <div class="name ms-4">
                                                          <h5 class="mb-1">Precio s/:</h5>
                                                          <h6 id="lprecio" nombre="lprecio" class="text-muted mb-0"></h6>
                                                        </div>
                                                      </div>
                                                      <div class="px-4">
                                                        <button type="submit" class='btn btn-block btn-xl btn-primary font-bold mt-3' name="btn-submit" id="btn-submit">
                                                          Realizar consulta</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div hidden class="col-md-6 col-lg-3">
                                                  <div class="card">
                                                    <div class="card-header">
                                                      <h4>Consulta rápida de comprobantes</h4>
                                                    </div>
                                                    <div class="card-body">
                                                      <form method="post" id="frmConsultaComp"  name="frmConsultaComp" action="../reportes/exComprobante.php" method="POST" target="_blank" >

                                                      <div class="form-group has-feedback" hidden>
                                                        <label>EMPRESA</label><br>
                                                        <select name="empresaConsulta" id="empresaConsulta" class="form-control"  onchange="empresa()" >
                                                            <option value="ticthrsi_facx" selected="true">ticthrsi_facx</option>
                                                        </select>
                                                        <span class="fa fa-bd form-control-feedback"></span>
                                                      </div>

                                                      <input type="hidden" name="idempresa" id="idempresa" value="1">

                                                       <div class="form-group has-feedback">
                                                        <label>CONSULTE SU COMPROBANTE</label><br>
                                                        <select  class="form-control"  name="tipodoc" id="tipodoc" title="seleccione" >
                                                          <option value="01">FACTURA</option>
                                                          <option value="03">BOLETA</option>
                                                          <option value="07">NOTA DE CRÉDITO</option>
                                                          <option value="08">NOTA DE DÉBITO</option>
                                                        </select>
                                                      </div>

                                                      <div class="form-group has-feedback mt-4">
                                                        <label>DOC. CLIENTE</label><br>
                                                        <input type="input" name="nruc" id="nruc" class="form-control" placeholder="Ej: 20603504969" maxlength="11" onfocus="focusTest(this);" onkeypress="return enter(event, this)">
                                                        <span class="fa fa-user form-control-feedback"></span>
                                                      </div>

                                                        <div class="form-group has-feedback">
                                                        <label>FOLIO (SERIE-CORRELATIVO)</label><br>
                                                        <input type="input" name="serienumero" id="serienumero" class="form-control" placeholder="Ej: FXXX-000000000" onfocus="focusTest(this);">
                                                        <span class="fa fa-file form-control-feedback"></span>
                                                      </div>

                                                      <div class="row">
                                                        <div class="col-xs-8">

                                                        </div><!-- /.col -->
                                                        <div class="col-xs-12 text-center">
                                                          <!-- <button type="submit" class="btn btn-danger btn-ver" name="boton" name="boton" value="btnpdf" >  <span  class="fa fa-download "> PDF</span> </button> -->
                                                          <button type="submit" class="btn btn-primary btn-ver" name="boton" name="boton" value="btnxml"  >XML</button>
                                                          <button type="submit" class="btn btn-success btn-ver" name="boton" name="boton" value="btnrpta"  >RPTA</button>
                                                        </div><!-- /.col -->

                                                        </div>
                                                    </form>
                                                    </div>
                                                  </div>
                                                </div>

                                                <!-- <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Ventas de la semana boleta - factura</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="panel-body table-responsive" id="listadoregistros">

                      <table id="tbllistado" class="table table-striped table-hover table-bordered table-condensed"  style="text-align: center; font-family: courier new; overflow: auto;">

                        <thead align="center">

                          <th style="color:brown; text-align: center; background: #081a51; color: white;">LUNES </th>

                          <th style="color:brown; text-align: center; background: #081a51; color: white;">MARTES</th>

                          <th style="color:brown; text-align: center; background: #081a51; color: white;">MIERCOLES</th>

                          <th style="color:brown; text-align: center; background: #081a51; color: white;">JUEVES</th>

                          <th style="color:brown; text-align: center; background: #081a51; color: white;">VIERNES</th>

                          <th style="color:brown; text-align: center; background: #081a51; color: white;">SABADO</th>

                        </thead>



                        <tbody align="" >

                        <td style="color:brown; font-size: 18px; text-align: center;"><a href=""></a></td>



                        <td style="color:red; font-size: 18px; text-align: center;"><a href="" data-toggle="tooltip" title=""></a></td>
                   
                        <td style="color:green; font-size: 18px; text-align: center;"><a href="" data-toggle="tooltip" title=""></a></td>



                        <td style="color:green; font-size: 18px; text-align: center;"><a href="" data-toggle="tooltip" title=""></a></td>





                        <td style="color:orange; font-size: 18px; text-align: center;"><a href="" data-toggle="tooltip" title=""></a></td>



                        <td style="color:orange; font-size: 18px; text-align: center;"><a href="" data-toggle="tooltip" title=""></a></td>

                        </tbody>





                      </table>

                  </div>


                  <div class="panel-body table-responsive mt-5" id="listadoregistros">


                    <div class="card-header">
                      <h4>Estado de comprobantes</h4>
                    </div>

                      <table id="tbllistado" class="table table-striped table-hover table-bordered table-condensed" style="text-align: center; font-family: courier new; overflow: auto;">

                          <thead align="center">

                            <th style="color:brown; text-align: center; background: #081a51; color: white;">EMITIDOS </th>

                            <th style="color:brown; text-align: center; background: #081a51; color: white;">FIRMADOS</th>

                            <th style="color:brown; text-align: center; background: #081a51; color: white;">SUNAT</th>

                            <th style="color:brown; text-align: center; background: #081a51; color: white;">ANULADOS</th>

                            <th style="color:brown; text-align: center; background: #081a51; color: white;">FISICOS</th>

                          </thead>

                          <tbody align="" >

                          <td style="color:brown; font-size: 18px; text-align: center;"><a href="validarcomprobantes.php?estadoC=1" data-toggle="tooltip" title="Ir a emitidos"></a></td>
    
                          <td style="color:red; font-size: 18px; text-align: center;"><a href="validarcomprobantes.php?estadoC=4" data-toggle="tooltip" title="Ir a firmados"></a></td>

                          <td style="color:green; font-size: 18px; text-align: center;"><a href="validarcomprobantes.php?estadoC=5" data-toggle="tooltip" title="Ir a enviados a SUNAT"></a></td>

                          <td style="color:green; font-size: 18px; text-align: center;"><a href="validarcomprobantes.php?estadoC=3" data-toggle="tooltip" title="Ir a anulados"></a></td>

                          <td style="color:orange; font-size: 18px; text-align: center;"><a href="validarcomprobantes.php?estadoC=6" data-toggle="tooltip" title="Ir a fisicos"></a></td>

                          </tbody>

                        </table>

                    </div>
              </div>
            </div>
          </div>
        </div> -->



                                                  <div class="col-md-12">

                                                      <div class="panel-body" >






                                                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" hidden>
                                                              <div class="small-box bg-aqua-active">
                                                                  <div class="inner">
                                                                    <h4>
                                                                      <strong><h1>S/ <?php echo number_format($totalventas, 2); ?></h1></strong>
                                                                    </h4>
                                                                    <p style="font-size: 14px; font-weight: bolder;">TOTAL VENTAS</p>
                                                                  </div>
                                                                </div>
                                                            </div>







                                        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>



                                        <script src="scripts/ajaxview.js"></script>

                                        <script>

                                        //============== original ===========================================================

                                          $(document).ready(function(){

                                            $("#btn-submit").click(function(e){

                                              var $this = $(this);

                                              e.preventDefault();

                                        //============== original ===========================================================



                                          var codigo=$("#codigoart").val();

                                           $.post("../ajax/articulo.php?op=articuloBusqueda&codigoa="+codigo, function(data,status)

                                        {

                                           data=JSON.parse(data);

                                           if (data != null){

                                           document.querySelector('#lnombre').innerText = data.nombre;

                                           document.querySelector('#lstock').innerText = data.stock+" "+data.unidad_medida;

                                           document.querySelector('#lprecio').innerText = data.precio_venta;

                                            }

                                            else

                                            {

                                              alert("Verifique");



                                        //============== original ===========================================================

                                                    }

                                        //============== original ===========================================================

                                                });



                                            });

                                          });

                                        </script>


                                                            </div>


                                            </div>




                                                  </div><!-- /.box -->



                                            </div><!-- End Container-->
                                        </div><!-- End Content-->



                                          <!--Fin-Contenido-->


                                          <div class="modal fade" id="ModalNnotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg" style="width: 50% !important;" >
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                   <!-- <img src="../public/images/notificacion.png"> -->
                                                   <h1 class="modal-title" id="fechaaviso">ALERTAS DEL DÍA DE HOY</h1>
                                                </div>

                                                    <form name="formularionnotificacion" id="formularionnotificacion" method="POST">
                                                          <input type="hidden" name="fechaaviso" id="fechaaviso">
                                                      <div class="table-responsive" id="">
                                                    <table id="listanotificaciones" class="table table-sm table-striped table-bordered table-condensed table-hover nowrap">
                                                                  <thead>
                                                                    <th>Notificación</th>
                                                                    <th>Documento</th>
                                                                    <th>Cliente</th>
                                                                    <th >Proxima aviso</th>
                                                                    <th >---</th>
                                                                  </thead>
                                                                  <tbody>
                                                                  </tbody>
                                                                </table>
                                                        </div>

                                             <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                              <!--   <button class="btn btn-primary" type="button" id="btnguardarnnotificacion" name="btnguardarnnotificacion" value="">
          <i class="fa fa-save"></i> OK
          </button> -->

                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                                             </div>

                                                <div class="modal-footer">
                                                </div>
                                                </form>



                                              </div>
                                            </div>
                                          </div>






                                          <div class="modal fade" id="ModalComprobantes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                                            <div class="modal-dialog modal-lg" style="width: 30% !important;" >
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                   <!-- <img src="../public/images/notificacion.png"> -->
                                                   <h1 class="modal-title" id="fechaaviso">COMPROBANTES PENDIENTES</h1>
                                                </div>

                                                    <table id="listacomprobantes" class="table table-sm table-striped table-bordered table-condensed table-hover nowrap">
                                                                  <thead>
                                                                    <th>Fecha</th>
                                                                    <th>Estado</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Comprobante</th>
                                                                  </thead>
                                                                  <tbody>
                                                                  </tbody>

                                                                </table>



                                             <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                                             </div>

                                                <div class="modal-footer">
                                                </div>
                                              </div>
                                            </div>
                                          </div>




                                        <?php

  } else {

    require 'noacceso.php';

  }



  require 'footer.php';



  ?>
                    <script src="../public/js/Chart.min.js"></script>
                    <script src="../public/js/Chart.bundle.min.js"></script>
                    <script type="text/javascript" src="scripts/caja.js"></script>

                    <script src="https://code.highcharts.com/highcharts.js"></script>
                    <script src="https://code.highcharts.com/modules/series-label.js"></script>
                    <script src="https://code.highcharts.com/modules/exporting.js"></script>
                    <script src="https://code.highcharts.com/modules/export-data.js"></script>
                    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



                    <script type="text/javascript">
                    function reloadPage () {
                    location.reload (true)
                    }

                      toastr.options = {
                                    closeButton: false,
                                    debug: false,
                                    newestOnTop: false,
                                    progressBar: false,
                                    rtl: false,
                                    positionClass: 'toast-bottom-full-width',
                                    preventDuplicates: false,
                                    onclick: null
                                };


                    showComprobantes();

                    $("#formularionnotificacion").on("submit",function(e)
                        {
                            guardaryeditarnotificacion(e);
                        });


                    var now = new Date();
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var fechahoy = now.getFullYear()+"-"+(month)+"-"+(day);
                    $("#fechaaviso").val(fechahoy);

                    function guardaryeditarnotificacion(e)
                    {
                        e.preventDefault(); //
                        var formData = new FormData($("#formularionnotificacion")[0]);


                        $.ajax({
                            //url: "../ajax/ventas.php?op=editarnotificacion",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(datos)
                            {
                                  //toastr.success(datos);
                                  //tabla.ajax.reload();
                            }

                        });
                        $("#ModalNnotificacion").modal('hide');
                        $("#ModalComprobantes").modal('hide');
                    }



                    $(document).ready(function()
                    {
                          showNotification();
                          setTimeout(function ()
                          {
                              $("#ModalNnotificacion").modal('hide');
                               //showComprobantes();
                          }, 8000);

                    });








                    function nextM(idnotificacion)
                    {

                        $.post("../ajax/ventas.php?op=avanzar", {idnotificacion : idnotificacion}, function(e){
                                toastr.success(e);
                              });

                    }


                    function showNotification() {
                       tabla=$('#listanotificaciones').dataTable(
                        {
                            "aProcessing": true,
                            "aServerSide": true,
                            dom: 'Bfrtip',
                            searching:false,
                            buttons: [],
                            "ajax":
                                    {
                                        url: '../ajax/ventas.php?op=notificaciones&fechanoti='+fechahoy,
                                        type : "get",
                                        dataType : "json",
                                        error: function(e){
                                        console.log(e.responseText);
                                        }
                                    },

                             "rowCallback":
                             function( row, data ) {
                              if (data) {
                                $("#ModalNnotificacion").modal('show');
                              }
                            },

                            "bDestroy": true,
                            "iDisplayLength": 5,//Paginación
                            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                        }).DataTable();

                    };







                    function showComprobantes()
                     {
                       tabla=$('#listacomprobantes2').dataTable(
                        {
                            "aProcessing": true,
                            "aServerSide": true,
                            "bPaginate": false,
                            "paging": false,
                            "bInfo": false,
                            dom: 'Bfrtip',
                            searching:false,
                            lengthChange: false,


                            buttons: [],
                            "ajax":
                                    {
                                        url: '../ajax/ventas.php?op=ComprobantesPendientes',
                                        type : "get",
                                        dataType : "json",
                                        error: function(e){
                                        console.log(e.responseText);
                                        }
                                    },

                             "rowCallback":
                             function( row, data ) {
                              if (data) {
                                //$("#ModalComprobantes").modal('show');
                              }
                            },

                            "fnDrawCallback":
                            function(oSettings) {
                              $('.dataTables_paginate').hide();
                            },

                            "bDestroy": true,
                            "iDisplayLength": 20,//Paginación
                            "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
                        }).DataTable();

                    }





                    function estadoNoti()
                    {
                        var estanoti = document.getElementById("estadonoti").checked;
                        if (estanoti==true) {
                            $("#selestado").val("1");
                        }else{
                            $("#selestado").val("0");
                        }
                    }


                    Highcharts.setOptions({
                        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                            return {
                                radialGradient: {
                                    cx: 0.5,
                                    cy: 0.3,
                                    r: 0.7
                                },
                                stops: [
                                    [0, color],
                                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                                ]
                            };
                        })
                    });
                    



                    // Build the chart
                    Highcharts.chart('ventasfacturaboletasemanalxdia', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Ventas x día de la semana Boleta - Factura',
                        },
                        tooltip: {
                           pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: 's/'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}: <b>s/ {point.y:.2f}</b><br/>',
                                    connectorColor: 'silver'
                                }
                            }
                        },
                        series: [{
                            data: [
                                { name: 'Lunes', y: <?php echo $lunes; ?> },
                                { name: 'Martes', y: <?php echo $martes; ?> },
                                { name: 'Miercoles', y: <?php echo $miercoles; ?> },
                                { name: 'Jueves', y: <?php echo $jueves; ?> },
                                { name: 'Viernes', y: <?php echo $viernes; ?> },
                                { name: 'Sabado', y: <?php echo $sabado; ?> },
                                { name: 'Domingo', y: <?php echo $domingo; ?> }
                            ]
                        }]
                    });





                    // Build the chart
                    Highcharts.chart('EstadoComprobantes', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Estado de comprobantes electrónicos',
                        },
                        tooltip: {
                           pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}: <b>{point.y:.2f}</b><br/>',
                                    connectorColor: 'silver'
                                }
                            }
                        },   
                        series: [{
                            data: [
                                { name: 'Emitidos', y: <?php echo ($stEmitido); ?> },
                                { name: 'Firmados', y: <?php echo ($stFirmado); ?> },
                                { name: 'Sunat Aceptados', y: <?php echo ($stAceptado); ?> },
                                { name: 'Anulados', y: <?php echo ($stAnulado); ?> },
                                { name: 'Fisicos', y:  <?php echo ($stFisico); ?> }
                            ]
                        }]
                    });


                    Highcharts.chart('compras', {
                      chart: {
                        type: 'column'
                      },
                      title: {
                        text: 'Gráfico 12 meses de compra'
                      },
                      xAxis: {
                        categories: [<?php echo $fechasc; ?>]
                      },
                      yAxis: {
                        title: {
                          text: 'Reporte de compras'
                        }
                      },
                      series: [{
                        name: 'Gráfico 12 meses de compra',
                        data: [<?php echo $totalesc; ?>],
                        colorByPoint: true,
                        colors: ['#081A51', 'green', 'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'orange'], // matriz de colores personalizados
                        borderWidth: 0
                      }, 
                      // {
                      //       type: 'spline',
                      //       name: 'Average',
                      //       data: [<?php echo $totalesc; ?>],
                      //       marker: {
                      //           lineWidth: 2,
                      //           lineColor: Highcharts.getOptions().colors[3],
                      //           fillColor: 'white'
                      //       }
                      //   }, 
                      ],
                      plotOptions: {
                        column: {
                          dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                          }
                        }
                      }
                    });


                    // var ctx = document.getElementById("compras").getContext('2d');
                    // var compras = new Chart(ctx, {

                    //     type: 'bar',

                    //     data: {

                    //         labels: [<?php echo $fechasc; ?>],
                    //         datasets: [{
                    //             label: 'Último Mes de compra S/',
                    //             data: [<?php echo $totalesc; ?>],
                    //             backgroundColor: [
                    //                 'rgba(255, 99, 132, 0.2)',
                    //                 'rgba(54, 162, 235, 0.2)',
                    //                 'rgba(255, 206, 86, 0.2)',
                    //                 'rgba(75, 192, 192, 0.2)',
                    //                 'rgba(153, 102, 255, 0.2)',
                    //                 'rgba(255, 159, 64, 0.2)',
                    //                 'rgba(255, 99, 132, 0.2)',
                    //                 'rgba(54, 162, 235, 0.2)',
                    //                 'rgba(255, 206, 86, 0.2)',
                    //                 'rgba(75, 192, 192, 0.2)'
                    //             ],
                    //             borderColor: [
                    //                 'rgba(255,99,132,1)',
                    //                 'rgba(54, 162, 235, 1)',
                    //                 'rgba(255, 206, 86, 1)',
                    //                 'rgba(75, 192, 192, 1)',
                    //                 'rgba(153, 102, 255, 1)',
                    //                 'rgba(255, 159, 64, 1)',
                    //                 'rgba(255,99,132,1)',
                    //                 'rgba(54, 162, 235, 1)',
                    //                 'rgba(255, 206, 86, 1)',
                    //                 'rgba(75, 192, 192, 1)'
                    //             ],

                    //             borderWidth: 1

                    //         }]

                    //     },

                    //     options: {
                    //         scales: {
                    //             yAxes: [{
                    //                 ticks: {
                    //                     beginAtZero:true

                    //                 }

                    //             }]

                    //         }

                    //     }

                    // });




                    Highcharts.chart('ventas', {
                      chart: {
                        type: 'column'
                      },
                      title: {
                        text: 'Gráfico 12 meses de venta'
                      },
                      xAxis: {
                        categories: [<?php echo $fechasv; ?>]
                      },
                      yAxis: {
                        title: {
                          text: 'Reporte de ventas'
                        }
                      },
                      series: [{
                        name: 'Gráfico 12 meses de venta',
                        data: [<?php echo $totalesv; ?>],
                        colorByPoint: true,
                        colors: ['#081A51', 'rgba(54, 162, 235, 0.2)', 'green', 'rgba(255, 99, 132, 0.2)', 'orange'], // matriz de colores personalizados
                        borderWidth: 0
                      }, 
                      ],
                      plotOptions: {
                        column: {
                          dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                          }
                        }
                      }
                    });

                    // {
                    //         type: 'spline',
                    //         name: 'Average',
                    //         data: [<?php echo $totalesv; ?>],
                    //         marker: {
                    //             lineWidth: 2,
                    //             lineColor: Highcharts.getOptions().colors[3],
                    //             fillColor: 'white'
                    //         }
                    //     }, 
                    // var ctx = document.getElementById("ventas").getContext('2d');

                    // var ventas = new Chart(ctx, {

                    //     type: 'bar',

                    //     data: {

                    //         labels: [<?php echo $fechasv; ?>],

                    //         datasets: [{

                    //             label: 'Último Mes de venta S/',

                    //             data: [<?php echo $totalesv; ?>],

                    //             backgroundColor: [

                    //                 'rgba(54, 162, 235, 0.2)',

                    //                 'rgba(255, 99, 132, 0.2)',

                    //                 'rgba(255, 206, 86, 0.2)',

                    //                 'rgba(75, 192, 192, 0.2)',

                    //                 'rgba(153, 102, 255, 0.2)',

                    //                 'rgba(255, 159, 64, 0.2)',

                    //                 'rgba(255, 99, 132, 0.2)',

                    //                 'rgba(54, 162, 235, 0.2)',

                    //                 'rgba(255, 206, 86, 0.2)',

                    //                 'rgba(75, 192, 192, 0.2)',

                    //                 'rgba(153, 102, 255, 0.2)',

                    //                 'rgba(255, 159, 64, 0.2)'

                    //             ],

                    //             borderColor: [

                    //                 'rgba(54, 162, 235, 1)',

                    //                 'rgba(255,99,132,1)',

                    //                 'rgba(255, 206, 86, 1)',

                    //                 'rgba(75, 192, 192, 1)',

                    //                 'rgba(153, 102, 255, 1)',

                    //                 'rgba(255, 159, 64, 1)',

                    //                 'rgba(255,99,132,1)',

                    //                 'rgba(54, 162, 235, 1)',

                    //                 'rgba(255, 206, 86, 1)',

                    //                 'rgba(75, 192, 192, 1)',

                    //                 'rgba(153, 102, 255, 1)',

                    //                 'rgba(255, 159, 64, 1)'

                    //             ],

                    //             borderWidth: 1

                    //         }]

                    //     },

                    //     options: {

                    //         scales: {

                    //             yAxes: [{

                    //                 ticks: {

                    //                     beginAtZero:true

                    //                 }

                    //             }]

                    //         }

                    //     }

                    // });





                    </script>



                    <?php

}

ob_end_flush();

?>
