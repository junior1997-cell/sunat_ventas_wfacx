var tabla;
var modoDemo = false;
//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#imagenmuestra").hide();

	$.post("../ajax/usuario.php?op=permisos&id=",function(r){
		$("#permisos").html(r);
	});

	$.post("../ajax/usuario.php?op=seriesnuevo&id=",function(r){
 		$("#series").html(r);
 	});

 	$.post("../ajax/usuario.php?op=permisosEmpresaTodos",function(r){
 		$("#empresas").html(r);
 	});


}

//Función limpiar
function limpiar()
{
	$("#nombre").val("");
	$("#apellidos").val("");
	$("#num_documento").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#cargo").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idusuario").val("");



}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
		document.getElementById('nombre').focus();  
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();

	$.post("../ajax/usuario.php?op=permisos&id=",function(r){
		$("#permisos").html(r);
	});

	$.post("../ajax/usuario.php?op=series&id=",function(r){
 		$("#series").html(r);
 	});


	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		    //           {
            //     extend:    'copyHtml5',
            //     text:      '<i class="fa fa-files-o"></i>',
            //     titleAttr: 'Copy'
            // },
            // {
            //     extend:    'excelHtml5',
            //     text:      '<i class="fa fa-file-excel-o"></i>',
            //     titleAttr: 'Excel'
            // },
            // {
            //     extend:    'csvHtml5',
            //     text:      '<i class="fa fa-file-text-o"></i>',
            //     titleAttr: 'CSV'
            // },
            // {
            //     extend:    'pdfHtml5',
            //     text:      '<i class="fa fa-file-pdf-o"></i>',
            //     titleAttr: 'PDF'
            // }
		        ],
		"ajax":
				{
					url: '../ajax/usuario.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	if (modoDemo) {
		Swal.fire({
			icon: 'warning',
			title: 'Modo demo',
			text: 'No puedes editar o guardar en modo demo',
		});
		return;
	}
	
	// Validar el campo de contraseña
	var clave = $('#clave').val();
	if (clave == '') {
		Swal.fire({
			icon: 'warning',
			title: 'Contraseña requerida',
			text: 'Para validar tus cambios, ingresa tu contraseña actual',
		});
		return;
	}
	
	$("#btnGuardar").prop("disabled", true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
	  url: "../ajax/usuario.php?op=guardaryeditar",
	  type: "POST",
	  data: formData,
	  contentType: false,
	  processData: false,
  
	  success: function (datos) {
		Swal.fire({
		  icon: 'success',
		  title: 'Guardado',
		  text: datos,
		  showConfirmButton: false,
  		  timer: 1500
		});
		mostrarform(false);
		tabla.ajax.reload();
	  },
	  error: function (xhr, ajaxOptions, thrownError) {
		Swal.fire({
		  icon: 'error',
		  title: 'Error',
		  text: 'Se produjo un error al guardar el registro',
		});
	  }
	});
	limpiar();
}


  

function mostrar(idusuario)
{
	$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#apellidos").val(data.apellidos);
		$("#tipo_documento").append('<option value="' + data.tipo_documento + '">' + data.tipo_documento + '</option>');
		$("#tipo_documento").val(data.tipo_documento);
		//$("#tipo_documento").selectpicker('refresh');
		$("#num_documento").val(data.num_documento);
		$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#email").val(data.email);
		$("#cargo").val(data.cargo);
		$("#login").val(data.login);
		//$("#clave").val(data.clave);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		$("#idusuario").val(data.idusuario);

 	});

 	$.post("../ajax/usuario.php?op=permisos&id="+idusuario,function(r){
 		$("#permisos").html(r);
 	});

 	$.post("../ajax/usuario.php?op=series&id="+idusuario,function(r){
 		$("#series").html(r);
 	});

 	$.post("../ajax/usuario.php?op=permisosEmpresa&id="+idusuario,function(r){
 		$("#empresas").html(r);
 	});
}

//Función para desactivar registros
function desactivar(idusuario) {
	if (modoDemo) {
		Swal.fire({
			icon: 'warning',
			title: 'Modo demo',
			text: 'No puedes editar o guardar en modo demo',
		});
		return;
	}
	$("#btnGuardar").prop("disabled", true);
	swal.fire({
	  title: "¿Está seguro de desactivar el usuario?",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  confirmButtonText: "Sí, desactivar",
	  cancelButtonText: "Cancelar"
	}).then((result) => {
	  if (result.isConfirmed) {
		$.post("../ajax/usuario.php?op=desactivar", {idusuario : idusuario}, function(e) {
		  swal.fire({
			title: "Usuario desactivado",
			text: e,
			icon: "success",
			showConfirmButton: false,
			timer: 1500
		  });
		  tabla.ajax.reload();
		}); 
	  }
	});
  }
  

//Función para activar registros
function activar(idusuario) {
	swal.fire({
	  title: "¿Está seguro de activar el usuario?",
	  icon: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#3085d6",
	  cancelButtonColor: "#d33",
	  confirmButtonText: "Sí, activar",
	  cancelButtonText: "Cancelar",
	}).then((result) => {
	  if (result.isConfirmed) {
		$.post("../ajax/usuario.php?op=activar", { idusuario: idusuario }, function (e) {
		  swal.fire({
			title: "Usuario activado",
			text: e,
			icon: "success",
			showConfirmButton: false,
  			timer: 1500
		  });
		  tabla.ajax.reload();
		});
	  }
	});
  }
  

function mayus(e) {
     e.value = e.value.toUpperCase();
}

function stopRKey(evt) {
var evt = (evt) ? evt : ((event) ? event : null);
var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
}

 document.onkeypress = stopRKey;



 function NumCheck(e, field) {
	// Backspace = 8, Enter = 13, ’0' = 48, ’9' = 57, ‘.’ = 46
	key = e.keyCode ? e.keyCode : e.which
	// backspace
	if (key == 8) return true;
	if (key == 9) return true;
	if (key > 47 && key < 58) {
	  if (field.val() === "") return false; // Cambiado de true a false
	  var existePto = (/[.]/).test(field.val());
	  if (existePto === false){
		  regexp = /.[0-9]{10}$/;
	  }
	  else {
		regexp = /.[0-9]{2}$/;
	  }
	  return !(regexp.test(field.val()));
	}
  
	if (key == 46) {
	  if (field.val() === "") return false;
	  regexp = /^[0-9]+$/;
	  return regexp.test(field.val());
	}
	return false;
  }
  

init();