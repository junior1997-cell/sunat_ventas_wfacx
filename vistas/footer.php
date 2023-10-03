<?php
require_once "../modelos/Factura.php";
$factura = new Factura();

$datos = $factura->datosemp($_SESSION['idempresa']);
$datose = $datos->fetch_object();

?>



<script src="../custom/modules/jquery/jquery.min.js"></script>

<script src="../public/js/jquery.PrintArea.js"></script>
<script src="../public/js/toastr.js"></script>
<script src="../public/js/simpleXML.js"></script>


<!-- DATATABLES -->
<script src="../public/datatables/jquery.dataTables.min.js"></script>
<script src="../public/datatables/dataTables.buttons.min.js"></script>
<script src="../public/datatables/buttons.html5.min.js"></script>
<script src="../public/datatables/buttons.colVis.min.js"></script>
<script src="../public/datatables/jszip.min.js"></script>
<script src="../public/datatables/pdfmake.min.js"></script>
<script src="../public/datatables/vfs_fonts.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- General JS Scripts -->
<script src="../custom/js/atrana.js"></script>

<!-- JS Libraies -->

<script src="../custom/modules/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>
<script src="../custom/modules/popper/popper.min.js"></script>

<!-- Template JS File -->
<script src="../custom/js/script.js"></script>
<script src="../custom/js/custom.js"></script>


</body>

</html>