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
    $filterdoc = "`avaluo`='0'";
}else{
    $filter = "`id_avaluo`='".ew_AdjustSql($_GET["id"])."'";
    $filterdoc = "`avaluo`='".ew_AdjustSql($_GET["id"])."'";
}

// select the image
$query = "select * from images WHERE id = ?";
$stmt = $con->prepare( $query );

// bind the id of the image you want to select
$stmt->bindParam(1, $_GET['id']);
$stmt->execute();

// to verify if a record is found
$num = $stmt->rowCount();

if( $num ){
    // if found
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // specify header with content type,
    // you can do header("Content-type: image/jpg"); for jpg,
    // header("Content-type: image/gif"); for gif, etc.
    header("Content-type: image/png");

    //display the image data
    print $row['data'];
    exit;
}else{
    //if no image found with the given id,
    //load/query your default image here
}
?>