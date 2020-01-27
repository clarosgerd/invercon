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
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/material-dashboard.css" rel="stylesheet"/>
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<link href='assets/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='assets/fullcalendar/moment.min.js'></script>
<script src='assets/fullcalendar/fullcalendar.min.js'></script>


<?php

if (isset($_POST["id"]) && $_POST["id"]!='')
{
//echo $_SESSION["sucursal"];
//echo $_POST["id"];
function getUser($user) {
		//$rsfields[];
	$sql = "SELECT `avaluo`.id,`avaluo`.id_inspector,DATE(`avaluo`.fecha_avaluo) as fecha,DATE_FORMAT(`avaluo`.fecha_avaluo, \"%H:%i\" ) as hora ,inspector.color FROM `avaluo`,inspector where `avaluo`.id_inspector=inspector.login and inspector.login='".$user."' and inspector.id_sucursal='".$_SESSION["sucursal"]."'";
		//$sql = "SELECT id_solicitud,DATE(fecha_avaluo) as fecha,DATE_FORMAT(fecha_avaluo, \"%H:%I:%S\" ) as hora FROM `avaluo`";
		$rs =  ew_ExecuteRows($sql);
		//var_dump($rs);
		//echo $sql ;
		return $rs;
	}
$thejson=null;
$events = getUser($_POST["id"]);
if(is_array($events)){
foreach($events as $event){
	$thejson[] = array("title"=>$event["id"],"url"=>"./avaluoedit.php?id=".$event["id"],"start"=>$event["fecha"]."T".$event["hora"],"backgroundColor"=>$event["color"],"borderColor"=>$event["color"]);
}
}

}
else{
 function getEvery() {
		//$rsfields[];
	$sql = "SELECT `avaluo`.id,`avaluo`.id_inspector,DATE(`avaluo`.fecha_avaluo) as fecha,DATE_FORMAT(`avaluo`.fecha_avaluo, \"%H:%i\" ) as hora ,inspector.color FROM `avaluo`,inspector where `avaluo`.id_inspector=inspector.login and inspector.id_sucursal='".$_SESSION["sucursal"]."'";
		//$sql = "SELECT id_solicitud,DATE(fecha_avaluo) as fecha,DATE_FORMAT(fecha_avaluo, \"%H:%I:%S\" ) as hora FROM `avaluo`";
		$rs =  ew_ExecuteRows($sql);
		//var_dump($rs);
		return $rs;
	}
$thejson=null;
$events = getEvery();
if(is_array($events)){
foreach($events as $event){
	$thejson[] = array("title"=>$event["id"],"url"=>"./avaluoedit.php?id=".$event["id"],"start"=>$event["fecha"]."T".$event["hora"],"backgroundColor"=>$event["color"],"borderColor"=>$event["color"]);
}
}
}
//var_dump($thejson);
?>
<script>
	$(document).ready(function() {
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			
			defaultDate: '<?php echo date('Y-m-d');?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			 views: {
				month: { // name of view
					titleFormat: 'MMMM YYYY'
				},
				week: {
					titleFormat: " MMMM D YYYY"
				},
				day: {
					titleFormat: 'D MMM, YYYY'
				}
			},
			events: <?php echo json_encode($thejson); ?>,
			eventClick: function(event) {
				if (event.url) {
					window.open(event.url, "_parent");
					return false;
				}
			}
		});
		
	});
</script>
<div class="row">
<div class="col-md-12">
<div class="card-content table-responsive">
<div id="calendar"></div>
</div>
</div>
</div>



