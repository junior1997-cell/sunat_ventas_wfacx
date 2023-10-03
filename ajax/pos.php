<?php
require_once "../modelos/PosModelo.php";
$posmodelo = new PosModelo();
//Primeros productos
$idarticulo = isset($_POST["idarticulo"]) ? limpiarCadena($_POST["idarticulo"]) : "";
$idfamilia = isset($_POST["idfamilia"]) ? limpiarCadena($_POST["idfamilia"]) : "";
$codigo_proveedor = isset($_POST["codigo_proveedor"]) ? limpiarCadena($_POST["codigo_proveedor"]) : "";
$codigo = isset($_POST["codigo"]) ? limpiarCadena($_POST["codigo"]) : "";
$familia = isset($_POST["familia"]) ? limpiarCadena($_POST["familia"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$stock = isset($_POST["stock"]) ? limpiarCadena($_POST["stock"]) : "";
$precio = isset($_POST["precio"]) ? limpiarCadena($_POST["precio"]) : "";
$costo_compra = isset($_POST["costo_compra"]) ? limpiarCadena($_POST["costo_compra"]) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";
$precio_final_kardex = isset($_POST["precio_final_kardex"]) ? limpiarCadena($_POST["precio_final_kardex"]) : "";
$unidad_medida = isset($_POST["unidad_medida"]) ? limpiarCadena($_POST["unidad_medida"]) : "";
$ccontable = isset($_POST["ccontable"]) ? limpiarCadena($_POST["ccontable"]) : "";
$nombreum = isset($_POST["nombreum"]) ? limpiarCadena($_POST["nombreum"]) : "";
$fechavencimiento = isset($_POST["fechavencimiento"]) ? limpiarCadena($_POST["fechavencimiento"]) : "";
$nombreal = isset($_POST["nombreal"]) ? limpiarCadena($_POST["nombreal"]) : "";

//Limpiar Familia 

$idfamilia = isset($_POST["idfamilia"]) ? limpiarcadena($_POST["idfamilia"]) : null;
$idfamilia = isset($_GET["idfamilia"]) ? limpiarcadena($_GET["idfamilia"]) : null;
$busqueda = isset($_GET["busqueda"]) ? limpiarcadena($_GET["busqueda"]) : null;




require_once "../modelos/Rutas.php";
$rutas = new Rutas();
$Rrutas = $rutas->mostrar2("1");
$Prutas = $Rrutas->fetch_object();
$rutaimagen = $Prutas->rutaarticulos; // ruta de la imagen


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = '';
}

if ($action == 'listarProducto') {
    $rspta = $posmodelo->listarProducto(1, $idfamilia, $busqueda);
    $data = array();

    // Obtiene la URL base
    $baseURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $currentDir = dirname($_SERVER['REQUEST_URI']); // Obtiene el directorio actual sin el script
    $baseURL = $baseURL . $currentDir; // Concatena el host con el directorio
    $baseURL = preg_replace('#/ajax$#', '', $baseURL); // Elimina la parte "/ajax" si existe

    while ($reg = $rspta->fetch_object()) {
        $imagenURL = $baseURL . '/files/articulos/' . $reg->imagen;

        $data[] = array(
            'idarticulo' => $reg->idarticulo,
            'idfamilia' => $reg->idfamilia,
            'codigo_proveedor' => $reg->codigo_proveedor,
            'codigo' => $reg->codigo,
            'familia' => $reg->familia,
            'nombre' => $reg->nombre,
            'stock' => $reg->stock,
            'precio' => $reg->precio,
            'costo_compra' => $reg->costo_compra,
            'imagen' => $imagenURL,
            // Utilizar la URL completa de la imagen
            'precio_final_kardex' => $reg->precio_final_kardex,
            'unidad_medida' => $reg->unidad_medida,
            'ccontable' => $reg->ccontable,
            'nombreum' => $reg->nombreum,
            'fechavencimiento' => $reg->fechavencimiento,
            'nombreal' => $reg->nombreal
        );
    }
    $results = array(
        "ListaProductos" => $data
    );

    header('Content-type: application/json');
    echo json_encode($results);
}


//Listar Categorias : 

if ($action == 'listarCategorias') {
    $rspta = $posmodelo->listarcategorias();
    $data = array();

    while ($reg = $rspta->fetch_object()) {
        $data[] = array(
            'idfamilia' => $reg->idfamilia,
            'familia' => $reg->familia,
            'estado' => $reg->estado
        );
    }
    $results = array(
        "ListaCategorias" => $data
    );

    header('Content-type: application/json');
    echo json_encode($results);
}










// switch ($_GET["op"]) {

//     case 'listar':

//         $idempresa = "1";
//         $rspta = $posmodelo->listar($idempresa);
//         //Vamos a declarar un array

//         while ($reg = $rspta->fetch_object()) {
//             $data[] = $reg;
//         }       

//         $results = array(
//             "sEcho" => 1,
//             //Información para el datatables
//             "iTotalRecords" => count($data),
//             //enviamos el total registros al datatable
//             "iTotalDisplayRecords" => count($data),
//             //enviamos el total registros a visualizar
//             "aaData" => $data
//         );
//         echo json_encode($results);

//         break;


// }

?>