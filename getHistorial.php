<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php $EW_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php
$conn = ew_Connect();
// Create instance of the database helper class by DbHelper() (for main database) or DbHelper("<dbname>") (for linked databases) where <dbname> is database variable name
if (!isset($_GET["id"]))
{
    $filter = "`id_avaluo`='0'";
    $filterdoc = "avaluo.id='0'";
    $filterpago = "avaluo.id='0'";
}else{
    $filter = "`id_avaluo`='".ew_AdjustSql($_GET["id"])."'";
    $filterdoc = "avaluo.id='".ew_AdjustSql($_GET["id"])."'";
    $filterpago = "avaluo.id='".ew_AdjustSql($_GET["id"])."'";
}
?>


        <div class="container-fluid">
            <div class="row">
                <div class="col col-lg-6">

                        <div class="panel panel-default">
                            <div class="panel-heading">Solicitud</div>
    <?php
    $sql = "SELECT
 avaluo.codigoavaluo,
 Concat (usuario.nombre,' ', usuario.apellido), 
  estadointerno.descripcion,
  historico.comentario,
  historico.ingreso,
  historico.salida
FROM historico
  INNER JOIN usuario ON usuario.login = historico.responsable
  INNER JOIN avaluo ON avaluo.id = historico.id_avaluo
  INNER JOIN estadointerno ON estadointerno.id = historico.proceso where " .  $filter;

    //echo $db->ExecuteHTML($sql);
    $all_mensaje_result = ew_Execute($sql) or die("error during: ".$sql);
    // echo  $sql;

    if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
        $all_mensaje_result->MoveFirst();
        $sData = "";
        echo "<table class=\"table table-hover table-dark\">";
        echo "<thead>";
        echo "<tr class=\"ewTableHeader\">";
        echo "  <th class=\"ewListOptionHeader\"><span  class=\"viewavaluosc_new2\">Codigo Avaluo</span></th>";
        echo "  <th class=\"ewListOptionHeader\"><span  class=\"viewavaluosc_new2\">Nombre Responsable</span></th>";
        echo "  <th class=\"ewListOptionHeader\"><span  class=\"viewavaluosc_new2\">Descripcion</span></th>";
        echo "  <th class=\"ewListOptionHeader\"><span  class=\"viewavaluosc_new2\">Comentario</span></th>";
        echo "  <th class=\"ewListOptionHeader\"><span  class=\"viewavaluosc_new2\">Ingreso</span></th>";
        echo "  <th class=\"ewListOptionHeader\"><span  class=\"viewavaluosc_new2\">Salida</span></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($all_mensaje_result && !$all_mensaje_result->EOF)
        {
            $id=$all_mensaje_result->fields[0];
            $nameinstitucionosolicitante=$all_mensaje_result->fields[1];
            $celularcontacto=$all_mensaje_result->fields[2];
            $email=$all_mensaje_result->fields[3];
            $address=$all_mensaje_result->fields[4];
            $nombre_contacto=$all_mensaje_result->fields[5];

            echo "<tr >";
            echo "<td >$id</td>";
            echo "<td>$nameinstitucionosolicitante</td>";
            echo "<td>$celularcontacto</td>";
            echo "<td>$email</td>";
            echo "<td>$address</td>";
            echo "<td>$nombre_contacto</td>";



            echo "</tr>";

            $all_mensaje_result->MoveNext();
        }
        echo "</tbody>";
        echo "</table>";

                                    echo " </div>";
                                        //<!-- /.panel-heading -->



                    //<!-- /.card -->
                echo "</div>";
                //<!-- /.col -->

        //<!-- /.row -->
        $all_mensaje_result->Close();
    } else {
        echo "No records found.";
    }

    ?>

                                <div class="col col-lg-5">

                                        <div class="panel panel-default">
                                            <div class="panel-heading">Adjuntos</div>
                                            <?php
                                            $sql = "SELECT documentosavaluo.id AS id,
  documentosavaluo.descripcion AS descripcion,
  documentosavaluo.imagen AS imagen,
  documentosavaluo.avaluo AS avaluo,
  documentosavaluo.path_drive AS path_drive,
  avaluo.codigoavaluo  
FROM documentosavaluo
INNER JOIN avaluo ON avaluo.id = documentosavaluo.avaluo
where " .  $filterdoc;

                                            //echo $db->ExecuteHTML($sql);
                                            $all_mensaje_result = ew_Execute($sql) or die("error during: ".$sql);
                                            // echo  $sql;

                                            if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
                                                $all_mensaje_result->MoveFirst();
                                                $sData = "";
                                                echo "<table class=\"table ewTable\">";
                                                echo "<thead>";
                                                echo "<tr class=\"ewTableHeader\">";
                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">id</th>";
                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">descripcion</th>";
                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">imagen</th>";
                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">avaluo</th>";
                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">path_drive</th>";
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while ($all_mensaje_result && !$all_mensaje_result->EOF)
                                                {
                                                    $id=$all_mensaje_result->fields[0];
                                                    $descripcion=$all_mensaje_result->fields[1];
                                                    $imagen=$all_mensaje_result->fields[2];
                                                    $avaluo=$all_mensaje_result->fields[3];
                                                    $path_drive=$all_mensaje_result->fields[4];
                                                    echo "<tr>";
                                                    echo "<th scope=\"row\">$id</th>";
                                                    echo "<td>$descripcion</td>";
                                                    echo "<td><a target=\"_blank\" href=\"viewdocumentosavaluoframe_imagen_bv.php?id=$id\">DOCUMENTO</a></td>";
                                                    echo "<td>$avaluo</td>";
                                                    echo "<td>$path_drive</td>";
                                                    echo "</tr>";
                                                    $all_mensaje_result->MoveNext();
                                                }
                                                echo "</tbody>";
                                                echo "</table>";

                                                echo " </div>";
                                                //<!-- /.panel-heading -->




                                                //<!-- /.card -->
                                                echo "</div>";
                                                //<!-- /.col -->

                                                //<!-- /.row -->
                                                $all_mensaje_result->Close();
                                            } else {
                                                echo "No records found.";
                                            }

                                            ?>



                                                <div class="col col-lg-2">

                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">Historial de Pagos</div>
                                                            <?php
                                                            $sql = "SELECT pago_avaluo.pago_id AS pago_id,
  pago_avaluo.avaluo_id AS avaluo_id,
  pago_avaluo.q AS q,
  pago_avaluo.monto AS monto,
  pago_avaluo.documentopago AS documentopago,
  banco.name,
  metodopago.name AS metodopago, 
  avaluo.codigoavaluo
FROM pago_avaluo
  left JOIN banco ON banco.id = pago_avaluo.id_banco
  INNER JOIN metodopago ON metodopago.id = pago_avaluo.id_metodopago
  INNER JOIN avaluo ON avaluo.id = pago_avaluo.avaluo_id
where " .  $filterpago;

                                                            //echo $db->ExecuteHTML($sql);
                                                            $all_mensaje_result = ew_Execute($sql) or die("error during: ".$sql);
                                                            // echo  $sql;
                                                            if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
                                                                $all_mensaje_result->MoveFirst();
                                                                $sData = "";
                                                                echo "<table class=\"table ewTable\">";
                                                                echo "<thead>";
                                                                echo "<tr class=\"ewTableHeader\">";
                                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">id</th>";
                                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">codigoavaluo</th>";
                                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">monto</th>";
                                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">metodopago</th>";
                                                                echo "  <th scope=\"col\" class=\"ewListOptionHeader\">banco</th>";
                                                                echo "</tr>";
                                                                echo "</thead>";
                                                                echo "<tbody>";
                                                                while ($all_mensaje_result && !$all_mensaje_result->EOF)
                                                                {
                                                                    $id=$all_mensaje_result->fields[0];
                                                                    $codigoavaluo=$all_mensaje_result->fields[1];
                                                                    $monto=$all_mensaje_result->fields[2];
                                                                    $metodopago=$all_mensaje_result->fields[3];
                                                                    $banco=$all_mensaje_result->fields[4];
                                                                    echo "<tr>";
                                                                    echo "<th scope=\"row\">$id</th>";
                                                                    echo "<td>$codigoavaluo</td>";
                                                                    echo "<td>$monto</td>";
                                                                    echo "<td> $metodopago</td>";
                                                                    echo "<td>$banco</td>";
                                                                    echo "</tr>";
                                                                    $all_mensaje_result->MoveNext();
                                                                }
                                                                echo "</tbody>";
                                                                echo "</table>";

                                                                echo " </div>";
                                                                //<!-- /.panel-heading -->

                                                                //<!-- /.card -->
                                                                echo "</div>";
                                                                //<!-- /.col -->


                                                                $all_mensaje_result->Close();
                                                            } else {
                                                                echo "No records found.";
                                                            }

                                                            ?>
                                                            </div>
                                                        <!-- /.row -->

                        </div>
                           <!--/. container-fluid -->

    <!-- /.content -->

