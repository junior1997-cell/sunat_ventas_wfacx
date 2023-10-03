<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
  $swsession = 0;
  header("Location: ../vistas/login.php");
} else {
  $swsession = 1;
  // require 'header.php';

  if ($_SESSION['ventas'] == 1) {
    ?>





    <?php
  } else {
    require 'noacceso.php';
  }
  require 'footer.php';
  ?>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="../public/css/bootstrap.css"> -->
  <link rel="stylesheet" href="../custom/modules/fontawesome6.1.1/css/all.css">
  <link rel="stylesheet" href="../custom/css/pos_style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

  <div class="container-fluid mb-3 p-1 pe-3 ps-3 bg-white sticky-top" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <div class="d-flex justify-content-between align-items-center">
      <div class="logo">
        <strong>POS</strong> WFACX
      </div>

      <div class="d-flex gap-3">

        <!-- <div class="d-none d-md-inline">
          <div class="input-group">
            <input type="text" id="form1" class="form-control" placeholder="Buscar Categorías o Item..."
              style="max-width: 600px;" />
            <button type="button" class="btn btn-warning rounded">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div> -->

        <button class="btn btn-warning"><i class="fa-solid fa-boxes-stacked"></i></button>

        <button class="btn btn-warning"><i class="fa-regular fa-bell"></i></button>

        <button class="btn btn-blue"><i class="fa-solid fa-plus"></i> <span class="d-none d-md-inline ms-2">Agregar
            Nuevo Item</span></button>
      </div>

      <div class="d-flex flex-column">
        <span class="fs-5 fw-bolder">Order #246</span>
        <span class="text-end color-gray-600 fs-14">Opened 7:45 am</span>
      </div>

    </div>
  </div>

  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-8 position-relative">

        <div id="loader_product">
          <svg class="lp" viewBox="0 0 128 128" width="50" height="50px" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <linearGradient id="grad1" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="#000"></stop>
                <stop offset="100%" stop-color="#fff"></stop>
              </linearGradient>
              <mask id="mask1">
                <rect x="0" y="0" width="128" height="128" fill="url(#grad1)"></rect>
              </mask>
            </defs>
            <g fill="none" stroke-linecap="round" stroke-width="16">
              <circle class="lp__ring" r="56" cx="64" cy="64" stroke="#ddd"></circle>
              <g stroke="#00548d">
                <polyline class="lp__fall-line" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay1" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay2" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay3" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay4" points="64,8 64,120"></polyline>
                <circle class="lp__drops" r="56" cx="64" cy="64" transform="rotate(90,64,64)"></circle>
                <circle class="lp__worm" r="56" cx="64" cy="64" transform="rotate(-90,64,64)"></circle>
              </g>
              <g stroke="#0092d8" mask="url(#mask1)">
                <polyline class="lp__fall-line" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay1" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay2" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay3" points="64,8 64,120"></polyline>
                <polyline class="lp__fall-line lp__fall-line--delay4" points="64,8 64,120"></polyline>
                <circle class="lp__drops" r="56" cx="64" cy="64" transform="rotate(90,64,64)"></circle>
                <circle class="lp__worm" r="56" cx="64" cy="64" transform="rotate(-90,64,64)"></circle>
              </g>
            </g>
          </svg>
        </div>

        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-12 col-md-9 row pe-0">
                <div class="col-12 col-md-6 pe-0 d-flex align-items-center">
                  <!-- <span class="fw-bold ">Buscar Producto: </span> -->
                  <div class="input-group" style="border: 1px solid #ccc; border-radius: 0.25rem;">
                    <input class="form-control border-0" type="text" id="search_product"
                      placeholder="Filtro por código o nombre">
                    <button class="btn btn-outline-secondary border-0 color-gray-500" type="button" disabled>
                      <i class=" fas fa-search"></i>
                    </button>
                    <button class="btn btn-outline-secondary delete border-0 color-gray-500" type="button"
                      id="btn_deletefilter">
                      <i class="fa-solid fa-xmark"></i>
                    </button>
                  </div>
                </div>
                <!-- <div class="col-12 col-md-8">
                </div> -->
              </div>

              <div class="col-12 col-md-3 text-start text-md-end pe-0">
                <!-- <div class="col-12 col-md-3 d-flex align-items-center text-start text-md-end pe-0"> -->
                <a href="#" class="fw-500 text-dark text-decoration-none fs-14" id="ver-todos-link"
                  style="top: 9px; position: relative;">Ver Todos</a>
              </div>
            </div>
          </div>

          <div class="card-body">

            <div class="w-100" style="position: relative;">

              <div class="swiper ms-3-5 me-3-5">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" id="category-content">
                  <!-- Slides -->

                </div>


              </div>
              <!-- If we need navigation buttons -->
              <div class="swiper-button-prev"></div>
              <div class="swiper-button-next"></div>

            </div>
          </div>
        </div>

        <div class="cards-products contenedor">
          <!-- <div id="loader_product">
            <svg class="lp" viewBox="0 0 128 128" width="50px" height="50px" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <linearGradient id="grad1" x1="0" y1="0" x2="0" y2="1">
                  <stop offset="0%" stop-color="#000" />
                  <stop offset="100%" stop-color="#fff" />
                </linearGradient>
                <mask id="mask1">
                  <rect x="0" y="0" width="128" height="128" fill="url(#grad1)" />
                </mask>
              </defs>
              <g fill="none" stroke-linecap="round" stroke-width="16">
                <circle class="lp__ring" r="56" cx="64" cy="64" stroke="#ddd" />
                <g stroke="#00548d">
                  <polyline class="lp__fall-line" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay1" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay2" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay3" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay4" points="64,8 64,120" />
                  <circle class="lp__drops" r="56" cx="64" cy="64" transform="rotate(90,64,64)" />
                  <circle class="lp__worm" r="56" cx="64" cy="64" transform="rotate(-90,64,64)" />
                </g>
                <g stroke="#0092d8" mask="url(#mask1)">
                  <polyline class="lp__fall-line" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay1" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay2" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay3" points="64,8 64,120" />
                  <polyline class="lp__fall-line lp__fall-line--delay4" points="64,8 64,120" />
                  <circle class="lp__drops" r="56" cx="64" cy="64" transform="rotate(90,64,64)" />
                  <circle class="lp__worm" r="56" cx="64" cy="64" transform="rotate(-90,64,64)" />
                </g>
              </g>
            </svg>
          </div> -->

          <div class="row pe-1" id="product-container">
            <!--  Product cards will be dynamically added here -->
          </div>
        </div>


      </div>


      <!-- <div class="col-4 d-none d-lg-inline sticky-bottom pedido-container"> -->
      <div class="col-lg-4 pedido-container" style="position: sticky;">
        <div class="card pedido-card contenedor" style="overflow: scroll; overflow-y: visible; overflow-x: hidden;">
          <div class="card-header d-flex justify-content-between align-items-baseline">
            <span class="fw-bold">Nuevo Pedido</span>
            <span id="currentDateTime" class="color-gray-400 fs-14"></span>
            <!-- Hora Actual -->
            <script>
              window.onload = function () {
                var current = new Date();
                var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
                var formattedDate = current.toLocaleDateString('es-ES', options);

                document.getElementById("currentDateTime").textContent = formattedDate;
              }

            </script>


          </div>

          <!-- <div class="card-body pb-0"> -->
          <div class="p-3 pb-0">

            <fieldset>
              <legend>
                <button class="btn btn-blue btn-sm w-100 fw-500" id="btn_datos" data-bs-toggle="tooltip"
                  data-bs-placement="bottom" data-bs-title="Completa los datos de tu pedido">Datos</button>
              </legend>
            </fieldset>

            <div id="container_datos" class="row">

              <div class="col-sm-6 mb-2">
                <select name="d_serie" id="d_serie" class="form-control">
                  <option selected value="" disabled>Seleccionar Serie</option>
                </select>
              </div>

              <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" disabled id="d_numero" placeholder="Número">
              </div>

              <div class="col-sm-6 mb-2">
                <select name="d_tipodoc" id="d_tipodoc" class="form-control">
                  <option selected value="">Seleccionar Tipo documento</option>
                </select>
              </div>

              <div class="col-sm-6 mb-2">
                <input type="number" class="form-control" name="d_nrodoc" id="d_nrodoc" placeholder="Nro Documento">
              </div>

              <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="d_nomyape" id="d_nomyape" placeholder="Nombres y Apellidos">
              </div>

              <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="d_direccion" id="d_direccion" placeholder="Dirección">
              </div>

              <input type="hidden" name="d_vendedor" id="d_vendedor">

              <input type="hidden" name="d_impuesto" id="d_impuesto">

              <!-- <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" disabled value="correlativo / número">
              </div> -->

              <div class="card-footer p-0"></div>


            </div>
          </div>
          <div class="col-12 pe-2 ps-3 contenedor"
            style="height: calc(100vh - 375px); overflow: scroll; overflow-x: hidden; overflow-y: visible; min-height: 147px;">

            <div class="items-order">
              <!-- <div class="card mb-3 p-2"
                    style="background: #F2F7FB !important; border-radius: .8rem !important; box-shadow: none;">
                    <div class="d-flex align-items-center">

                      <img
                        src="https://htmlcolorcodes.com/assets/images/colors/sky-blue-color-solid-background-1920x1080.png"
                        alt="dd" height="40px" width="40px" class="d-none d-xl-inline me-2">

                      <div class="w-100">

                        <div class="d-flex justify-content-between align-items-center">

                          <label class="fw-700 fs-7">Chicken Whooper</label>

                          <div class="quantity rounded-pill d-flex justify-content-center align-items-center">
                            <button class="btn btn-sm btn-warning rounded-circle minus"
                              aria-label="Decrease">&minus;</button>
                            <input type="number" class="input-box" value="1" min="1" max="10">
                            <button class="btn btn-sm btn-warning rounded-circle plus"
                              aria-label="Increase">&plus;</button>
                          </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-baseline">
                          <span>$14.00</span>
                          <a href="" class="text-danger text-decoration-none" style="font-size: 12px;">Eliminar</a>
                        </div>

                      </div>

                    </div>
                  </div> -->
            </div>
          </div>


          <div class="card-footer">

            <div class="row">

              <div class="col-12">

                <div class="d-flex justify-content-between align-items-center">
                  <small class="fw-500 text-black">Sub Total</small>
                  <span class="fw-bold fs-6">S/ <span id="sub_total">0.00</span></span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <small class="fw-500 text-black">I.G.V 18%</small>
                  <span class="fw-bold fs-6">S/ <span id="igv">0.00</span></span>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span class="fw-500 fs-6 text-blue">Total</span>
                  <span class="fw-bold text-success fs-6">S/ <span id="total">0.00</span></span>
                </div>
              </div>

              <!-- <div class="col-12 mb-3">
                <select name="d_tipopago" id="d_tipopago" class="form-control">
                  <option value="">Contado</option>
                  <option value="">Crédito</option>
                  <option value="">Transferencia</option>
                  <option value="">Yape</option>
                  <option value="">Plin</option>
                  <option value="">Izipay</option>
                </select>
              </div> -->

              <!-- <div class="col-4 mb-3">
                <div class="card">
                  <img src="https://htmlcolorcodes.com/assets/images/colors/sky-blue-color-solid-background-1920x1080.png"
                    class="card-img-top rounded-4" alt="...">
                  <div class="card-body text-center p-0">
                    <small class="fw-medium">Efectivo</small>
                  </div>
                </div>
              </div>

              <div class="col-4 mb-3">
                <div class="card">
                  <img src="https://htmlcolorcodes.com/assets/images/colors/sky-blue-color-solid-background-1920x1080.png"
                    class="card-img-top rounded-4" alt="...">
                  <div class="card-body text-center p-0">
                    <small class="fw-medium">Debit Card</small>
                  </div>
                </div>
              </div>

              <div class="col-4 mb-3">
                <div class="card">
                  <img src="https://htmlcolorcodes.com/assets/images/colors/sky-blue-color-solid-background-1920x1080.png"
                    class="card-img-top rounded-4" alt="...">
                  <div class="card-body text-center p-0">
                    <small class="fw-medium">E-Wallet</small>
                  </div>
                </div>
              </div> -->

              <div class="col-12">
                <button type="button" class="btn btn-blue w-100 fw-500" id="btn_metodopago">Hacer
                  Pedido</button>

              </div>

            </div>
          </div>


        </div>
      </div>

    </div>
  </div>
  </div>


  <!-- RADIO BUTTON -->

  <!-- Modal -->
  <div class="modal fade" id="modal_metodopago" tabindex="-1" aria-labelledby="modal_metodopago" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Método de Pago</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-7">
              <div class="mb-3 row fw-600 fs-6">
                <label for="p_pedido" class="col-sm-4 col-form-label d-flex justify-content-between">Total Pedido
                  <span>S/.</span></label>
                <div class="col-sm-4">
                  <input type="text" readonly class="form-control-plaintext not-spin text-end fw-600 fs-6" id="p_pedido"
                    value="0.00">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="p_contado" class="col-sm-4 col-form-label">Contado</label>
                <div class="input-group-no-width col-sm-5">
                  <!-- <input type="number" class="form-control" id="p_contado"> -->
                  <input type="text" class="form-control calculator-input" id="p_contado" value="0">
                  <button type="button" class="btn btn-blue calculator-button"><i
                      class="fa-solid fa-calculator"></i></button>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="p_credito" class="col-sm-4 col-form-label">Crédito</label>
                <div class="input-group-no-width col-sm-5">
                  <input type="text" class="form-control calculator-input" id="p_credito" value="0">
                  <button type="button" class="btn btn-blue calculator-button"><i
                      class="fa-solid fa-calculator"></i></button>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="p_transferencia" class="col-sm-4 col-form-label">Transferencia</label>
                <div class="input-group-no-width col-sm-5">
                  <input type="text" class="form-control calculator-input" id="p_transferencia" value="0">
                  <button type="button" class="btn btn-blue calculator-button"><i
                      class="fa-solid fa-calculator"></i></button>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="p_yape" class="col-sm-4 col-form-label">Yape</label>
                <div class="input-group-no-width col-sm-5">
                  <input type="text" class="form-control calculator-input" id="p_yape" value="0">
                  <button type="button" class="btn btn-blue calculator-button"><i
                      class="fa-solid fa-calculator"></i></button>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="p_plin" class="col-sm-4 col-form-label">Plin</label>
                <div class="input-group-no-width col-sm-5">
                  <input type="text" class="form-control calculator-input" id="p_plin" value="0">
                  <button type="button" class="btn btn-blue calculator-button"><i
                      class="fa-solid fa-calculator"></i></button>
                </div>
              </div>
              <div class="mb-3 row">
                <label for="p_izipay" class="col-sm-4 col-form-label">Izipay</label>
                <div class="input-group-no-width col-sm-5">
                  <input type="text" class="form-control calculator-input" id="p_izipay" value="0">
                  <button type="button" class="btn btn-blue calculator-button"><i
                      class="fa-solid fa-calculator"></i></button>
                </div>
              </div>
            </div>

            <div class="col-lg-5">
              <div class="teclado">

                <h6>TECLADO</h6>

                <div class="row">
                  <button type="button" class="design">1</button>
                  <button type="button" class="design">2</button>
                  <button type="button" class="design">3</button>
                  <button type="button" class="design not" id="backspace"><i class="fa-solid fa-delete-left"></i></button>
                </div>
                <div class="row">
                  <button type="button" class="design">4</button>
                  <button type="button" class="design">5</button>
                  <button type="button" class="design">6</button>
                </div>
                <div class="row">
                  <button type="button" class="design">7</button>
                  <button type="button" class="design">8</button>
                  <button type="button" class="design">9</button>
                </div>
                <div class="row">
                  <button type="button" class="design">0</button>
                  <button type="button" class="design">00</button>
                  <button type="button" class="design">.</button>
                </div>
                <div class="row">
                  <button type="button" class="design not two" id="allClear">BORRAR TODO</button>
                </div>

              </div>
            </div>

            <div class="col-lg-7">
              <div class="mb-0 row fw-600 fs-6">
                <label for="p_tpagado" class="col-sm-4 col-form-label d-flex justify-content-between">Total Pagado
                  <span>S/.</span></label>
                <div class="col-sm-4">
                  <input type="text" readonly class="form-control-plaintext not-spin text-end fw-600 fs-6" id="p_tpagado"
                    value="0.00">
                </div>
              </div>
              <div class="row fw-600 fs-17">
                <label for="p_vuelto" id="text_vuelto"
                  class="col-sm-4 col-form-label d-flex justify-content-between">Vuelto
                  <span>S/.</span></label>
                <div class=" col-sm-4">
                  <input type="text" readonly class="form-control-plaintext not-spin text-end fw-600 fs-17" id="p_vuelto"
                    value="0.00">
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-blue">Realizar Pago</button>
        </div>
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="scripts/pos.js"></script>


  <script>

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    const swiper = new Swiper('.swiper', {
      // Optional parameters
      direction: 'horizontal',
      autoplay: true,
      slidesPerView: 'auto',
      spaceBetween: 10,
      // allowTouchMove: false,
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

    });

  </script>
  <?php
}
ob_end_flush();
?>