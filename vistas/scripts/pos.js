/* ---------------------------------------------------------------- */
//                      LISTAR CATEGORIAS

function listarCategorias() {

  $.ajax({
    url: 'https://wfacx.com/sistema/ajax/pos.php?action=listarCategorias',
    type : "get",
    dataType : "json",
    success: function (data) {
      // console.log('data', data);
      // console.log('aadata', data.ListaCategorias);

      const categoriaContainer = document.getElementById('category-content');
      

      data.ListaCategorias.forEach(categoria => {

        var card = document.createElement('div');
        card.classList.add('swiper-slide');
        // card.innerHTML = `

        //   <div class="rounded-pill slider-item">
        //     <img
        //       src="https://htmlcolorcodes.com/assets/images/colors/sky-blue-color-solid-background-1920x1080.png"
        //       alt="dd" height="30px" width="30px" class="rounded-circle me-2">
        //     <span class="fw-600 f-12 category">${categoria.familia}</span>
        //   </div>
    
        // `;
        card.innerHTML = `
          <div class="rounded-pill slider-item categoryclic" data-idfamilia="${categoria.idfamilia}">
              <img
                  src="https://htmlcolorcodes.com/assets/images/colors/sky-blue-color-solid-background-1920x1080.png"
                  alt="dd" height="30px" width="30px" class="rounded-circle me-2">
              <span class="fw-600 f-12 category">${categoria.familia}</span>
          </div>
        `;

        
        categoriaContainer.appendChild(card);

        // Add a click event listener to the category
        card.querySelector('.categoryclic').addEventListener('click', listarPorCategoria);

      });

    },
    error: function(error){
      console.error(error);
    }
  });
  
}

listarCategorias();

/* ---------------------------------------------------------------- */
//                   LISTAR PRODUCTOS (BUSQUEDA)

  // function listarProductos() {
  //   $.ajax({
  //     url: 'https://wfacx.com/sistema/ajax/pos.php?action=listarProducto',
  //     type : "get",
  //     dataType : "json",
  //     success: function (data) {
  //       console.log('data', data);
  //       console.log('aadata', data.ListaProductos);

        
  //       const productContainer = document.getElementById('product-container');

  //       data.ListaProductos.forEach(product => {
  //           // Create a new card element
  //           const card = document.createElement('div');
  //           card.classList.add('col-6', 'col-sm-6', 'col-md-3', 'col-lg-3', 'mb-3');
  //           card.innerHTML = `
  //               <div class="card">
  //                 <div class="text-center" style="height: 120px;">
  //                   <img src="${product.imagen}" alt="${product.nombre}" height="100%" class=" mb-2">
  //                 </div>
  //                 <div class="card-body text-center p-0">
  //                     <label class="fw-bolder fs-12">${product.nombre}</label>
  //                     <p class="fs-6 fw-600 m-0">$${product.precio}</p>
  //                 </div>
  //                 <div class="p-2 pt-0 text-center mt-2">
  //                     <button class="btn btn-blue w-100">Agregar</button>
  //                 </div>
  //               </div>
  //           `;

  //           productContainer.appendChild(card);
  //       });

  //     },
  //     error: function(error){
  //       console.error(error);
  //     }
  //   });
  // }

  // listarProductos();

var url_send;
function listarProductos(busqueda) {

  $('#loader_product').show();

  if (busqueda != '') {
    url_send = 'https://wfacx.com/sistema/ajax/pos.php?action=listarProducto&busqueda=' + busqueda;
  } else {
    url_send = 'https://wfacx.com/sistema/ajax/pos.php?action=listarProducto';
  }

  $.ajax({
    url: url_send,
    type: 'get',
    dataType: 'json',
    success: function (data) {
    
      $('#loader_product').hide();

      var productContainer = $('#product-container');
      productContainer.empty(); // Limpiar productos existentes

      if (data.ListaProductos && data.ListaProductos.length > 0) {
        data.ListaProductos.forEach(product => {

          let productImage = product.imagen;
          
          if (!productImage || productImage === 'https://wfacx.com/sistema/files/articulos/') {
              
            productImage = 'https://www.phswarnerhoward.co.uk/assets/images/no_img_avaliable.jpg';

          }

          var productCard = document.createElement('div');
          productCard.classList.add('col-6', 'col-sm-6', 'col-md-3', 'col-lg-3', 'mb-3');

          var productCardAlert = document.createElement('div');

          var productStock = parseFloat(product.stock);

          if ( productStock < 5 && productStock > 0 ) {
            productCardAlert.classList.add('card', 'card-warning', 'product-card', 'cursor-pointer');
          } else if ( productStock == 0 ) {
            productCardAlert.classList.add('card', 'card-danger', 'product-card', 'cursor-pointer');
          } else {
            productCardAlert.classList.add('card', 'product-card', 'cursor-pointer');
          }

          productCardAlert.innerHTML = `
            <div class="text-center" style="height: 120px;">
              <img src="${productImage}" alt="${product.nombre}" height="100%" class=" mb-2">
            </div>
            <div class="card-body text-center p-0">
              <label class="fw-bolder fs-12" id="p_nombre">${product.nombre}</label>
              <p class="fs-6 fw-600" >S/ <span id="p_precio">${product.precio}</span></p>
            </div>
            <input type="hidden" id="p_stock" value="${productStock}">
            <input type="hidden" id="p_idarticulo" value="${product.idarticulo}">
          `;

          productCard.append(productCardAlert);

          // var productCard = `
          //   <div class="col-6 col-sm-6 col-md-3 col-lg-3 mb-3">
          //     <div class="" style="cursor: pointer;">
          //       <div class="text-center" style="height: 120px;">
          //         <img src="${productImage}" alt="${product.nombre}" height="100%" class=" mb-2">
          //       </div>
          //       <div class="card-body text-center p-0">
          //         <label class="fw-bolder fs-12">{product.nombre}</label>
          //         <p class="fs-6 fw-600">$${product.precio}</p>
          //       </div>
          //     </div>
          //   </div>
          // `;

          productContainer.append(productCard);
        });
      } else {
        productContainer.html('<p>No hay productos disponibles para esta búsqueda.</p>');
      }
    },
    error: function (error) {
      console.error(error);

      $('#loader_product').hide();

    }
  });
}

var busqueda = '';
listarProductos(busqueda);

/* ---------------------------------------------------------------- */
//                  LISTAR PRODUCTOS CAMPO BUSQUEDA

let searchTimeout;

$('#search_product').on('input', function () {
  const searchTerm = $(this).val();

  // Cancelar la búsqueda anterior
  clearTimeout(searchTimeout);

  // Retraso 1s
  searchTimeout = setTimeout(function () {
    listarProductos(searchTerm);
  }, 1000);
});

/* ---------------------------------------------------------------- */
//                   LISTAR PRODUCTOS POR CATEGORIA

function listarPorCategoria(event) {
  event.preventDefault();

  $('#loader_product').show();


  // Get the idfamilia from the clicked category
  var idfamilia = event.target.getAttribute('data-idfamilia');

  // Remove the 'select' class from all category elements
  var allCategories = document.querySelectorAll('.categoryclic');
  allCategories.forEach(category => {
    category.classList.remove('select');
  });

  // Add the 'select' class to the clicked category
  event.target.classList.add('select');

  busqueda = $('#search_product').val();

  if (busqueda != '') {
    url_send = "https://wfacx.com/sistema/ajax/pos.php?action=listarProducto&idfamilia=" + idfamilia + "&busqueda=" + busqueda ;
  } else {
    url_send = "https://wfacx.com/sistema/ajax/pos.php?action=listarProducto&idfamilia=" + idfamilia;
  }

  if (idfamilia) {
    // Fetch products for the selected category
    $.ajax({
      url: url_send,
      type: 'get',
      dataType: 'json',
      success: function (data) {

        const productContainer = document.getElementById('product-container');

        // Clear any existing products in the product container
        productContainer.innerHTML = '';


        if (data.ListaProductos && data.ListaProductos.length > 0) {

          data.ListaProductos.forEach(product => {

            let productImage = product.imagen;

            if (!productImage || productImage === 'https://wfacx.com/sistema/files/articulos/') {
                
              productImage = 'https://www.phswarnerhoward.co.uk/assets/images/no_img_avaliable.jpg';

            }

            var productCard = document.createElement('div');
            productCard.classList.add('col-6', 'col-sm-6', 'col-md-3', 'col-lg-3', 'mb-3');
  
            var productCardAlert = document.createElement('div');
  
            var productStock = parseFloat(product.stock);
  
            if ( productStock < 5 && productStock > 0 ) {
              productCardAlert.classList.add('card', 'card-warning', 'product-card', 'cursor-pointer');
            } else if ( productStock == 0 ) {
              productCardAlert.classList.add('card', 'card-danger', 'product-card', 'cursor-pointer');
            } else {
              productCardAlert.classList.add('card', 'product-card', 'cursor-pointer');
            }
  
            productCardAlert.innerHTML = `
              <div class="text-center" style="height: 120px;">
                <img src="${productImage}" alt="${product.nombre}" height="100%" class=" mb-2">
              </div>
              <div class="card-body text-center p-0">
                <label class="fw-bolder fs-12" id="p_nombre">${product.nombre}</label>
                <p class="fs-6 fw-600" >S/ <span id="p_precio">${product.precio}</span></p>
              </div>
              <input type="hidden" id="p_stock" value="${productStock}">
              <input type="hidden" id="p_idarticulo" value="${product.idarticulo}">
            `;
  
            productCard.append(productCardAlert);

            productContainer.appendChild(productCard);
          });
        } else {
          
          productContainer.innerHTML = '<p>No hay productos disponibles para esta categoría.</p>';
        }

        $('#loader_product').hide();
      
      },
      error: function (error) {
        console.error(error);

        $('#loader_product').hide();

      }
    });

  } else {

    $('#product-container').html('<p>Seleccione una categoría.</p>');

    $('#loader_product').hide();

  }


}

/* ---------------------------------------------------------------- */
//                    LISTAR TODOS LOS PRODUCTOS

// Enlace "Ver Todos"
$('#ver-todos-link').on('click', function (e) {
  e.preventDefault();
  
  var allCategories = document.querySelectorAll('.categoryclic');

  allCategories.forEach(category => {
    category.classList.remove('select');
  });

  listarProductos(''); 
});

/* ---------------------------------------------------------------- */
//                    LIMPIAR FILTRO BUSQUEDA

$('#btn_deletefilter').on('click', function (e) {
  e.preventDefault();

  $('#search_product').val('');
})

/* ---------------------------------------------------------------- */
//                   AGREGAR PRODUCTO AL PEDIDO

var sub_total = 0;
var igv = 0;
var total = 0;

$(document).on('click', '.product-card', function (e) {
  e.preventDefault();
  // console.log('clic');

  sub_total = parseFloat($('#sub_total').text());
  // console.log('subt',  sub_total);

  var productImage = $(this).find('img').attr('src');
  var productName = $(this).find('#p_nombre').text();
  var productPrice = $(this).find('#p_precio').text();
  // console.log('productPrice', productPrice);
  var productStock = $(this).find('#p_stock').val();
  var productId = $(this).find('#p_idarticulo').val();

  // console.log('stock', productStock);

  if ( productStock == 0 ) {

    swal.fire({
      title: "Error",
      text: 'Este producto no se puede agregar porque no tiene stock.',
      icon: "error",
      timer: 2000,
      showConfirmButton: false
    });

    return;
  }

  // Verificar si el producto ya existe en la lista de pedidos
  var existingItem = $('.items-order .card[data-product-code="' + productId + '"]');


  if (existingItem.length > 0) {
    // aumentar la cantidad en 1
    var inputBox = existingItem.closest('.card').find('.input-box');
    var currentQuantity = parseInt(inputBox.val());

    // console.log( 'Final stock', productStock - (currentQuantity));

    var finalStock = productStock - (currentQuantity);

    if ( finalStock == 0  ) {
      swal.fire({
        title: "Error",
        text: 'Este producto no se puede agregar porque se alcanzó el limite de stock.',
        icon: "error",
        timer: 2000,
        showConfirmButton: false
      });
  
      return;
    }

    if (!isNaN(currentQuantity)) {
      inputBox.val(currentQuantity + 1);
    }

  } else {
    // Producto no existe, crear uno nuevo
    var newItem = `
      <div class="card mb-3 p-2" data-product-price data-product-code="${productId}" style="background: #F2F7FB !important; border-radius: .8rem !important; box-shadow: none;">
        <div class="d-flex align-items-center">
          <img src="${productImage}" alt="${productName}" height="40px" width="40px" class="d-none d-xl-inline me-2">
          <div class="w-100">
            <div class="d-flex justify-content-between align-items-center">
              <label class="fw-700 fs-7" id="ped_name">${productName}</label>
              <div class="quantity rounded-pill d-flex justify-content-center align-items-center">
                <button class="btn btn-sm btn-warning rounded-circle minus" id="ped_disminuir" aria-label="Decrease">&minus;</button>
                <input type="number" class="input-box" id="ped_cantidad" value="1" min="1" max="${productStock}">
                <button class="btn btn-sm btn-warning rounded-circle plus" id="ped_aumentar" aria-label="Increase">&plus;</button>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-baseline">
              <span>S/ <span id="ped_precio">${productPrice}</span></span>
              <a href="#" class="text-danger text-decoration-none remove-item" style="font-size: 12px;">Eliminar</a>
            </div>
          </div>
        </div>
      </div>
    `;

    $('.items-order').append(newItem);
  }

  // sub_total += parseFloat(productPrice);

  // igv = sub_total * 0.18;

  // total = sub_total + igv;

  // $('#sub_total').text(sub_total.toFixed(2));
  // $('#igv').text(igv.toFixed(2));
  // $('#total').text(total.toFixed(2));

  updateTotals();

});

/* ---------------------------------------------------------------- */
//                  INICIALIZAR BOTONES CANTIDAD

// initializeQuantityButtons();

// function initializeQuantityButtons() {
  $(document).on('click', '.quantity .minus', function () {
    var inputBox = $(this).siblings('.input-box');
    decreaseValue(inputBox);
    updateTotals();
  });

  $(document).on('click', '.quantity .plus', function () {
    var inputBox = $(this).siblings('.input-box');
    increaseValue(inputBox);
    updateTotals();
  });

  $(document).on('input', '.quantity .input-box', function () {
    handleQuantityChange($(this));
  });
// }

/* ---------------------------------------------------------------- */
//                   FUNCION DISMINUIR CANTIDAD

function decreaseValue(inputBox) {
  var value = parseInt(inputBox.val());
  value = isNaN(value) ? 1 : Math.max(value - 1, 1);
  inputBox.val(value);
  handleQuantityChange(inputBox);
}

/* ---------------------------------------------------------------- */
//                   FUNCION AUMENTAR CANTIDAD

function increaseValue(inputBox) {
  var value = parseInt(inputBox.val());
  value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.attr('max')));
  inputBox.val(value);
  handleQuantityChange(inputBox);
}

/* ---------------------------------------------------------------- */
//                FUNCION CAMBIO DE CANTIDAD AL INPUT

function handleQuantityChange(inputBox) {
  var value = parseInt(inputBox.val());
  value = isNaN(value) ? 1 : value;

  // Realiza cualquier lógica adicional aquí, si es necesario.
  // console.log("Quantity changed:", value);

  
  // Obtén el stock máximo permitido desde el atributo "max" del input
  var maxStock = parseInt(inputBox.attr('max'));

  if (value > maxStock) {
    // Muestra una alerta con SweetAlert
    swal.fire({
      title: "Error",
      text: "El valor de stock máximo permitido es de " + maxStock + ".",
      icon: "error",
      timer: 2000,
      showConfirmButton: false
    });

    // Establece la cantidad máxima permitida como el valor actual del input
    inputBox.val(maxStock);

    updateTotals();

  }


}

/* ---------------------------------------------------------------- */
//                  EVENTO ELIMINAR ITEM DE PEDIDO

$(document).on('click', '.remove-item', function (e) {
  e.preventDefault();
  $(this).closest('.card').remove();

  // var productPrecio = parseFloat( $(this).closest('.card').find('#ped_precio').text() );

  // var productCantidad = parseFloat( $(this).closest('.card').find('#ped_cantidad').val() );

  // console.log('pord', productPrecio);
  // console.log('pord', productCantidad);

  // var preciodescontar = productPrecio * productCantidad;

  // sub_total = parseFloat($('#sub_total').text());
  
  // sub_total = sub_total - preciodescontar;

  // igv = sub_total * 0.18;

  // total = sub_total + igv;

  // $('#sub_total').text(sub_total.toFixed(2));
  // $('#igv').text(igv.toFixed(2));
  // $('#total').text(total.toFixed(2));

  updateTotals();

});

/* ---------------------------------------------------------------- */
//                    CALCULAR TOTALES PEDIDO

function updateTotals() {
  sub_total = 0;


  $('.items-order .card').each(function () {
    var productPrice = parseFloat($(this).find('#ped_precio').text());
    var quantity = parseInt($(this).find('.input-box').val());

    if (!isNaN(productPrice) && !isNaN(quantity)) {
      sub_total += productPrice * quantity;
    }
  });

  igv = sub_total * 0.18;
  total = sub_total + igv;

  $('#sub_total').text( formatNumber(sub_total));
  $('#igv').text( formatNumber(igv));
  $('#total').text( formatNumber(total));
}

/* ---------------------------------------------------------------- */
//                    EVENTO MOSTRAR DATOS

$('#container_datos').hide();

$('#btn_datos').on('click', function () {
    
  $('#container_datos').slideToggle();

});

/* ---------------------------------------------------------------- */
//                    FUNCIÓN FORMATO NUMEROS

function formatNumber(number) {
  var parts = number.toFixed(2).split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}

/* ---------------------------------------------------------------- */
//                   FUNCIONES INPUT METODO PAGO

let currentInput = null;

// Al hacer clic en un botón de la calculadora, se enfoca en el input correspondiente.
$(".calculator-button").click(function () {
  // Encuentra el input relacionado al botón clickeado.
  const inputId = $(this).siblings(".calculator-input").attr("id");
  currentInput = $("#" + inputId);

  // Coloca el foco en el input.
  currentInput.focus();
});

$(".calculator-input").click(function () {
  currentInput = $(this);
});

/* ---------------------------------------------------------------- */
//                       FUNCIONES TECLADO

$(".design").click(function () {
  // console.log('this', $(this).text());

  // console.log('cuurr', currentInput.val());
  if (currentInput) {
    const buttonText = $(this).text();
    const inputValue = currentInput.val();

    if (inputValue == 0) {
      currentInput.val(buttonText);

    } else if (buttonText === "." && inputValue.includes(".")) {
      // Evitar agregar más de un punto decimal.
      currentInput.val(inputValue);

    } else {
      // currentInput.val(inputValue + buttonText);
      // Controlar la cantidad de decimales permitidos.
      const decimalIndex = inputValue.indexOf(".");
      if (decimalIndex !== -1 && inputValue.length - decimalIndex > 2) {
        // Si ya hay dos decimales, no permitir más.
        currentInput.val(inputValue);
      } else {
        currentInput.val(inputValue + buttonText);
      }
    }

    calcularPago();
  }

});

//Backspace
$('#backspace').click(function () {

  if (currentInput) {
    var value = currentInput.val();
    if (!(parseInt(parseFloat(value)) == 0 && value.length == 1)) {
      currentInput.val(value.slice(0, value.length - 1));
    }
    if (value.length == 1 || value.length == 0) {
      currentInput.val("0");
    }
    calcularPago();
  }

});

// All Clear
$("#allClear").click(function () {
  // $("#expression").val("0");
  // $("#result").val("0");
  if (currentInput) {
    currentInput.val("0");

    calcularPago();
  }
});

/* ---------------------------------------------------------------- */
//                    MOSTRAR MODAL METODO DE PAGO

$('#btn_metodopago').click( function () {

  if ($('.items-order .card').length === 0) {
    swal.fire({
      title: "Error",
      text: 'Debe agregar al menos un producto al pedido antes de continuar.',
      icon: "error",
      timer: 2000,
      showConfirmButton: false
    });
    return;
  }
  
  var totalpedido = $('#total').text().replace(',', '');

  $('#p_pedido').val(totalpedido);
  $('#p_contado').val( parseFloat(totalpedido).toFixed(2) );

  
  $('#modal_metodopago').modal('show');

  setTimeout(function () {
    $('#p_contado').focus();
  }, 500);

  currentInput = $('#p_contado');
  calcularPago();
})

/* ---------------------------------------------------------------- */
//                     CERRAR MODAL METODO DE PAGO

$('#modal_metodopago').on('hidden.bs.modal', function () {

  limpiarMetodoPago();
});

/* ---------------------------------------------------------------- */
//                      FUNCION CALCULAR PAGO

function calcularPago() {

  var p_pedido = parseFloat($('#p_pedido').val());

  var p_contado = parseFloat( $('#p_contado').val() );
  var p_credito = parseFloat( $('#p_credito').val() || 0 );
  var p_transferencia = parseFloat( $('#p_transferencia').val() || 0 );
  var p_yape = parseFloat( $('#p_yape').val() || 0 );
  var p_plin = parseFloat( $('#p_plin').val() || 0 );
  var p_izipay = parseFloat( $('#p_izipay').val() || 0 );

  var totalpagado = p_contado + p_credito + p_transferencia + p_yape + p_plin + p_izipay;

  $('#p_tpagado').val( formatNumber(totalpagado) );
  
  var totalvuelto = 0;

  totalvuelto = totalpagado - p_pedido

  if ( totalpagado > p_pedido) {

    $('#text_vuelto').html('Vuelto <span>S/.</span>');
    $('#text_vuelto').css('color', 'green');
    $('#p_vuelto').css('color', 'green');

  } else if ( totalpagado == p_pedido ) {

    $('#text_vuelto').html('Completo <span>S/.</span>');
    $('#text_vuelto').css('color', 'blue');
    $('#p_vuelto').css('color', 'blue');

  } else {

    totalvuelto = p_pedido - totalpagado

    $('#text_vuelto').html('Falta <span>S/.</span>');
    $('#text_vuelto').css('color', 'red');
    $('#p_vuelto').css('color', 'red');
  }

  // console.log('vuelto1', totalvuelto);
  $('#p_vuelto').val( formatNumber(totalvuelto) );


}

/* ---------------------------------------------------------------- */
//                   EVENTO INPUT CALCULAR PAGO

$('.calculator-input').on('input', calcularPago);

// Escucha el evento input en los inputs con la clase "calculator-input"
// $(".calculator-input").on("input", function (e) {
//   e.preventDefault();


//   console.log('hre');
//   // Obtén el valor actual del input
//   let inputValue = $(this).val();
//   console.log('inputValue',inputValue);

//   // Formatea el valor para que tenga dos decimales
//   if (inputValue != "") {
//     // Convierte el valor a un número con dos decimales
//     const floatValue = parseFloat(inputValue);
//    console.log(floatValue);
//     if (!isNaN(floatValue)) {
//       inputValue = floatValue.toFixed(2);
//     } else {
//       // Si el valor no es un número válido, establece el valor en 0.00
//       inputValue = "0.00";
//     }
//   }

//   // Establece el valor formateado en el input
//   $(this).val(inputValue);

//   // Llama a la función calcularPago
//   calcularPago();
// });
/* ---------------------------------------------------------------- */
//                  LIMPIAR MODAL METODO DE PAGO

function limpiarMetodoPago() {
  
  $('#p_pedido').val(0);

  $('#p_contado').val(0);
  $('#p_credito').val(0);
  $('#p_transferencia').val(0);
  $('#p_yape').val(0);
  $('#p_plin').val(0);
  $('#p_izipay').val(0);

  $('#p_tpagado').val(0);

  $('#text_vuelto').html('Vuelto <span>S/.</span>');
  $('#p_vuelto').val(0);

}

