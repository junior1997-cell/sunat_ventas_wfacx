<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
class PosModelo
{
    //Implementamos nuestro constructor
    public function __construct()
    {

    }
    //Listar los articulos
    public function listarProducto($idempresa, $idfamilia = null, $busqueda = null)
    {

        $filtro = "";
        if (!is_null($idfamilia)) {
            $filtro = " AND a.idfamilia = '$idfamilia'";
        }

        if (!is_null($busqueda) && $busqueda != "") {
            $filtro .= " AND (a.codigo LIKE '%$busqueda%' OR a.nombre LIKE '%$busqueda%')";
        }

        $sql = "select 
        a.idarticulo, 
        f.idfamilia, 
        a.codigo_proveedor, 
        a.codigo, 
        f.descripcion as familia, 
        left(a.nombre, 50) as nombre, 
        format(a.stock,2) as stock, 
        a.precio_venta as precio, 
        a.costo_compra,
        a.imagen, 
        a.estado, 
        a.precio_final_kardex,
        a.unidad_medida,
        a.ccontable,
        a.stock as st2,
        um.nombreum,
        date_format(a.fechavencimiento, '%d/%m/%Y') as fechavencimiento,
        al.nombre as nombreal

        from 

        articulo a inner join familia f on a.idfamilia=f.idfamilia inner join almacen al on a.idalmacen=al.idalmacen inner join empresa e on al.idempresa=e.idempresa inner join umedida um on a.umedidacompra=um.idunidad and a.tipoitem='productos'
         where 
         not a.nombre='1000ncdg' and e.idempresa='$idempresa' and al.estado='1' $filtro";

        return ejecutarConsulta($sql);

    }

    //listar las categorias : 

    public function listarCategorias() {
        $sql = "select
                    f.idfamilia,
                    f.descripcion as familia,
                    f.estado
                from
                    familia f
                where
                    f.estado = '1'";  // elimina esta línea si también quieres categorías inactivas
    
        return ejecutarconsulta($sql);
    }
    





}