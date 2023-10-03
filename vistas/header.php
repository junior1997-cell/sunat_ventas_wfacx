<?php
if (strlen(session_id()) < 1) {
    session_start();
}

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SISTEMA FACX | Facturación electrónica</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="../public/css/factura.css">

    <link rel="stylesheet" href="../custom/modules/bootstrap-5.1.3/css/bootstrap.css">

    <link rel="stylesheet" href="../public/css/toastr.css">

    <link rel="stylesheet" href="../custom/css/custom.css">

    <link rel="stylesheet" href="../custom/css/style.css">
    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="../custom/modules/fontawesome6.1.1/css/all.css">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" href="../custom/modules/boxicons/css/boxicons.min.css">

    <link rel="icon" type="image/x-icon" href="../public/images/logo.ico" sizes="16x16">
    <link rel="icon" type="image/x-icon" href="../public/images/logo.ico" sizes="32x32">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />


    <link href="../public/css/simpleXML.css" rel="stylesheet">
    <link href="../public/css/html5tooltips.css" rel="stylesheet">
    <link href="../public/css/html5tooltips.animation.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/css/autobusqueda.css">

    <link rel="stylesheet" href="style.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>





</head>

<style>
    #sidebar .side-menu a.active {
        color: #51CBFF !important;
        /* Color de fondo del enlace activo */
    }
</style>


<body class="">

    <input type="hidden" name="iva" id="iva" value='<?php echo $_SESSION['iva']; ?>'>

    <div class="">

        <!--Topbar -->
        <div class="topbar transition">
            <div class="bars">
                <button type="button" class="btn transition" id="sidebar-toggle">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <div class="menu">
                <ul>

                    <li>
                        <a class="nav-link" href="pos"><strong>POS +</strong></a>
                    </li>
<!-- 
                    <li>
                        <button type="button" class="btn btn-primary"><strong>Comprar Sistema Online</strong></button>
                    </li> -->

                    <li>
                        <a class="nav-link" data-bs-toggle="modal" data-bs-target="#modalTcambio" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="true"> <i
                                class="fa fa-bell size-icon-1"></i><span class="badge bg-danger notif">1</span></a>
                    </li>
                    <li class="nav-item dropdown dropdown-list-toggle">

                        <div class="dropdown-menu dropdown-list">

                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" alt="">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../vistas/usuario"><i class="fa fa-user size-icon-1"></i>
                                <span>Mi perfil</span></a>
                            <a class="dropdown-item" href="../vistas/empresa"><i class="fa fa-cog size-icon-1"></i>
                                <span>Ajustes</span></a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item" href="../ajax/usuario?op=salir"><i
                                    class="fa fa-sign-out-alt  size-icon-1"></i> <span>Salir</span></a>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- transition overlay-scrollbars animate__animated  animate__slideInLeft -->
        <div class="sidebar">
            <div class="sidebar-content">
                <div id="sidebar">

                    <!-- Logo -->
                    <input type="hidden" name="iva" id="iva" value='<?php echo $_SESSION[' iva']; ?>'>
                    <div class="logo">
                        <!-- <h2 class="mb-0"><img src="../custom/images/logo.png"> FACX</h2> -->
                        <h2 class="mb-0">FACX</h2>
                    </div>

                    <ul class="side-menu">

                        <?php
                        if ($_SESSION['escritorio'] == 1) {
                            echo '<li>
                            <a href="escritorio">
                                <i class="bx bxs-dashboard icon"></i>Dashboard
                            </a>
                            </li>';
                        }
                        ?>


                        <!-- Divider-->


                        <?php
                        if ($_SESSION['almacen'] == 1) {

                            echo '<li class="divider" data-text="PROVISIÓN Y MANTENIMIENTO">PROVISIÓN Y MANTENIMIENTO</li>
                                  <li>
                                    <a href="almacen">
                                        <i class="bx bxs-arch icon"></i>Almacen
                                    </a>
                                  </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['almacen'] == 1) {

                            echo '<li>
                                            <a href="familia">
                                            <i class="bx bxs-category-alt icon"></i>Categorías</a>
                                          </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['almacen'] == 1) {
                            echo '<li>
                                              <a href="umedida">
                                              <i class="bx bx-underline icon"></i>Unidad de medida</a>
                                            </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['compras'] == 1) {
                            echo ' <li>
                            <a href="#">
                                <i class="bx bx-cart-download icon"></i>
                                Compras
                                <i class="bx bx-chevron-right icon-right"></i>
                            </a>
                            <ul class="side-dropdown">
                                <li><a href="proveedor">Registrar proveedor</a></li>
                                <li><a href="compra">Ingresar compra</a></li>
                                <li><a href="compralistas">Ver lista de compras</a></li>
                            </ul>
                        </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['almacen'] == 1) {
                            echo ' <li>
                              <a href="#">
                                  <i class="bx bx-folder-plus icon"></i>
                                  Artículos
                                  <i class="bx bx-chevron-right icon-right"></i>
                              </a>
                              <ul class="side-dropdown">
                                  <li><a href="articulo">Agregar producto</a></li>
                                  <li><a href="servicios">Agregar servicio</a></li>
                              </ul>
                          </li>
                          ';
                        }
                        ?>


                        <?php
                        if ($_SESSION['almacen'] == 1) {
                       echo '<li>
                            <a href="pos"><i class="bx bx-analyse icon"></i>Stock artículos</a>
                        </li>';
                        }
                        ?>

                        <!-- Divider-->


                        <?php
                        if ($_SESSION['ventas'] == 1) {
                            echo ' <li class="divider" data-text="Gestión de ventas">Gestión de ventas</li>
                        <li>
                              <a href="#">
                                  <i class="bx bx-money icon"></i>
                                  Realizar venta
                                  <i class="bx bx-chevron-right icon-right"></i>
                              </a>
                              <ul class="side-dropdown">
                                  <li><a href="guiaremision">Guia de Remisión</a></li>
                                  <li><a href="boleta">Boleta</a></li>
                                  <li><a href="factura">Factura</a></li>
                                  <li><a href="notapedido">Nota de venta</a></li>
                                  <li><a href="cotizacion">Cotización</a></li>
                                  <li><a href="notac">Nota de crédito</a></li>
                                  <li><a href="notad">Nota de débito</a></li>
                                  <li hidden><a href="doccobranza">Doc. de cobranza</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="pos"><i class="bx bx-cart icon"></i>POS</a>
                          </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['almacen'] == 1) {
                            echo ' <li hidden>
                                <a href="#">
                                    <i class="bx bx-train icon"></i>
                                    Orden y transporte
                                    <i class="bx bx-chevron-right icon-right"></i>
                                </a>
                                <ul class="side-dropdown">
                                    <li><a href="ordenservicio">Orden de servicio</a></li>
                                    <li><a href="guiaremision">Guía Remisión</a></li>
                                </ul>
                            </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['ventas'] == 1) {
                            echo ' <li>
                                  <a href="#">
                                      <i class="bx bx-file-blank icon"></i>
                                      Comprobantes
                                      <i class="bx bx-chevron-right icon-right"></i>
                                  </a>
                                  <ul class="side-dropdown">
                                      <li><a href="consultacomprobantes">Consultar comprobante</a></li>
                                      <li><a href="documentosrelacionados">Factura y boleta anulados</a></li>
                                      <li><a href="validafactura">Validar Facturas</a></li>
                                      <li><a href="validaboleta">Validar Boletas</a></li>
                                      <li hidden><a href="cambioestado">Cambiar estado</a></li>

                                  </ul>
                              </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['ventas'] == 1) {
                            echo ' <li>
                                    <a href="#">
                                        <i class="bx bx-error-alt icon"></i>
                                        Anular comprobantes
                                        <i class="bx bx-chevron-right icon-right"></i>
                                    </a>
                                    <ul class="side-dropdown">
                                        <li><a href="cbaja">Baja facturas</a></li>
                                        <li><a href="resumend">Baja de boletas</a></li>
                                        <li><a href="bajanc">Baja Nota de crédito</a></li>
                                    </ul>
                                </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['ventas'] == 1) {
                            echo ' <li>
                                      <a href="creditospendiente">
                                        <i class="bx bx-error-alt icon"></i>
                                        Créditos pendientes
                                      </a>
                                    </li>';
                        }
                        ?>

                        <!-- Divider-->


                        <?php
                        if ($_SESSION['inventarios'] == 1) {
                            echo '<li class="divider" data-text="Gestión e inventario">Gestión e inventario</li>
                        <li>
                                  <a href="#">
                                      <i class="bx bx-dollar-circle icon"></i>
                                      Caja
                                      <i class="bx bx-chevron-right icon-right"></i>
                                  </a>
                                  <ul class="side-dropdown">
                                      <li><a href="cajachica">Caja Chica</a></li>
                                      <li><a href="insumos">Gastos/Ingresos</a></li>
                                      <li><a href="ventadiaria">Ingreso Diario</a></li>
                                      <li><a href="utilidadsemana">Utilidad Semanal</a></li>
                                  </ul>
                              </li>
                         
                        <li>
                              <a href="#">
                                  <i class="bx bx-shield-quarter icon"></i>
                                  Administración
                                  <i class="bx bx-chevron-right icon-right"></i>
                              </a>
                              <ul class="side-dropdown">
                                  <li><a href="usuario">Registro Usuarios</a></li>
                                  <li><a href="vendedorsitio">Registro Vendedor</a></li>
                                  <li><a href="cliente">Registro Clientes</a></li>
                                  <li><a href="registroinventario">Registro de inventario</a></li>
                              </ul>
                          </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['kardex'] == 1) {
                            echo ' <li>
                                <a href="#">
                                    <i class="bx bx-trending-up icon"></i>
                                    Movimiento
                                    <i class="bx bx-chevron-right icon-right"></i>
                                </a>
                                <ul class="side-dropdown">
                                    <li><a href="kardexArticulo">Kardex por artículo</a></li>
                                </ul>
                            </li>';
                        }
                        ?>


                        <?php
                        if ($_SESSION['boletapago'] == 1) {
                            echo ' <li>
                                  <a href="#">
                                      <i class="bx bx-task icon"></i>
                                      Planilla personal
                                      <i class="bx bx-chevron-right icon-right"></i>
                                  </a>
                                  <ul class="side-dropdown">
                                      <li><a href="empleadoboleta">Empleados</a></li>
                                      <li><a href="tipoSeguro">Tipo de seguro</a></li>
                                      <li><a href="boletapago">Boleta de pago</a></li>
                                  </ul>
                              </li>';
                        }
                        ?>






                        <?php
                        if ($_SESSION['inventarios'] == 1) {
                            echo '<li class="divider" data-text="Reportes generales">Reportes generales</li> 
                        <li>
                              <a href="#">
                                  <i class="bx bx-pie-chart-alt-2 icon"></i>
                                  Reporte General
                                  <i class="bx bx-chevron-right icon-right"></i>
                              </a>
                              <ul class="side-dropdown">

                                  <li hidden><a href="ventadiaria">Ventas diarias</a></li>
                                  <li><a href="regventas">Ventas agrupados</a></li>
                                  <li><a href="ventasxdia">Ventas día/mes</a></li>
                                  <li><a href="ventasxcliente">Ventas por cliente</a></li>
                                  <li><a href="ventasvendedor">Ventas por vendedor</a></li>
                                  <li hidden><a href="insumos">Gastos / Ingresos</a></li>
                                  <li><a href="inventario_valorizado">Inventario valorizado</a></li>
                                  <li><a href="ple">Generar PLE</a></li>
                                  <li><a href="regcompras">Reporte de Compras</a></li>
                                  <li><a href="repmargenganancia">Margen de ganancia</a></li>
                                  <li hidden><a href="utilidadsemana">Utilidad de semana</a></li>
                                  <li hidden><a href="itemliquidacion">Liquidación</a></li>
                                  <li><a href="enviocorreo">Correos enviados</a></li>
                              </ul>
                          </li>';
                        }
                        ?>



                        <!-- Divider-->


                        <?php
                        if ($_SESSION['acceso'] == 1) {
                            echo '<li class="divider" data-text="Configuración del sistema">Configuración del sistema</li> 
                        <li>
                              <a href="#">
                                  <i class="bx bx-layer icon"></i>
                                  Config. Sunat
                                  <i class="bx bx-chevron-right icon-right"></i>
                              </a>
                              <ul class="side-dropdown">

                                  <li><a href="catalogo5">Tipos de tributos</a></li>
                                  <li><a href="catalogo6">Documentos de identidad</a></li>
                                  <li><a href="tipoafectacionigv">Tipo de afectación IGV</a></li>
                                  <li><a href="configNum">Config. Numeración</a></li>
                                  <li><a href="cargarcertificado">Cargar certificado</a></li>
                                  <li><a href="notificaciones">Notificaciones</a></li>

                              </ul>
                          </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['acceso'] == 1) {
                            echo '<li>
                                    <a href="correo">
                                    <i class="bx bx-mail-send icon"></i>Configurar correo</a>
                                  </li>';
                        }
                        ?>

                        <?php
                        if ($_SESSION['acceso'] == 1) {
                            echo '<li hidden>
                                    <a href="limpiarbd">
                                    <i class="bx bx-coin-stack icon"></i>Base de datos</a>
                                  </li>';
                        }
                        ?>
                        <li hidden><a href="rutas"><i class="fa fa-sitemap"></i>Configurar rutas</a></li>
                        <?php
                        if ($_SESSION['acceso'] == 1) {
                            echo '<li>
                                    <a href="empresa">
                                    <i class="bx bx-home-alt icon"></i>Conf. Empresa</a>
                                  </li>';
                        }
                        ?>

                    </ul>

                    <div class="ads">
                        <div class="wrapper">
                            <div class="help-icon"><i class="fa fa-circle-question fa-3x"></i></div>
                            <p>Necesitas ayuda con <strong>FACX</strong>?</p>
                            <a href="https://wa.link/e6ml7b" target="_blank" class="btn-upgrade">Contactar</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- End Sidebar-->