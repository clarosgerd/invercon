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
    $filter = "`id`='0'";
}else{
    $filter = "`id`='".ew_AdjustSql($_GET["id"])."'";
}
?>
<div class="panel panel-default">
    <div class="panel-heading">Solicitud</div>
    <?php
    $sql = "SELECT id AS id,
  name AS nameinstitucionosolicitante,
  lastname AS CELULARCONTACTO,
  email AS email,
  address AS address,
  nombre_contacto AS nombre_contacto,
  email_contacto AS email_contacto,
  phone AS TELEFONOFIJO,
  cell AS CELULAR ,
  id_sucursal AS id_sucursal,
  tipoinmueble AS tipoinmueble,
  tipovehiculo AS tipovehiculo,
  tipomaquinaria AS tipomaquinaria
  FROM solicitud
  WHERE " .  $filter;

    //echo $db->ExecuteHTML($sql);
    $all_mensaje_result = ew_Execute($sql) or die("error during: ".$sql);
   // echo  $sql;

    if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
    $all_mensaje_result->MoveFirst();
    $sData = "";
    echo "<table class=\"table table-hover table-dark\">";
  echo "<thead>";
    echo "<tr>";
    echo "  <th scope=\"col\">ID</th>";
    echo "  <th scope=\"col\">Nombre Solicitante</th>";
    echo "  <th scope=\"col\">Celular</th>";
    echo "  <th scope=\"col\">Email</th>";
        echo "  <th scope=\"col\">Direccion</th>";
        echo "  <th scope=\"col\">Nombre Contacto</th>";
        echo "  <th scope=\"col\">Email Contacto</th>";
        echo "  <th scope=\"col\">Telefono FIjo</th>";
        echo "  <th scope=\"col\">Celular</th>";
        echo "  <th scope=\"col\">Sucursal</th>";

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
        $email_contacto=$all_mensaje_result->fields[6];
        $telefonofijo=$all_mensaje_result->fields[7];
        $celular=$all_mensaje_result->fields[8];
        $id_sucursal=$all_mensaje_result->fields[9];
        $tipoinmueble=$all_mensaje_result->fields[10];
        $tipovehiculo=$all_mensaje_result->fields[11];
        $tipomaquinaria=$all_mensaje_result->fields[12];
        echo "<tr>";
     echo "<th scope=\"row\">$id</th>";
      echo "<td>$nameinstitucionosolicitante</td>";
      echo "<td>$celularcontacto</td>";
     echo "<td>$email</td>";
        echo "<td>$address</td>";
        echo "<td>$nombre_contacto</td>";
        echo "<td>$email_contacto</td>";
        echo "<td>$celular</td>";
        echo "<td>$id_sucursal</td>";


    echo "</tr>";

        $all_mensaje_result->MoveNext();
    }
        echo "</tbody>";
        echo "</table>";
        $all_mensaje_result->Close();
    } else {
        echo "No records found.";
    }
    ?>
</div>
