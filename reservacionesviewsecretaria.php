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
 <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="plugins/fullcalendar-bootstrap/main.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<?php

 function getEvery() {
		//$rsfields[];
	$sql = "SELECT `avaluo`.id,`avaluo`.id_inspector,DATE(`avaluo`.fecha_avaluo) as fecha,DATE_FORMAT(`avaluo`.fecha_avaluo, \"%H:%i\" ) as hora ,inspector.color FROM `avaluo`,inspector  where `avaluo`.id_inspector=inspector.login and inspector.id_sucursal='".$_SESSION["sucursal"]."'";
		//$sql = "SELECT id_solicitud,DATE(fecha_avaluo) as fecha,DATE_FORMAT(fecha_avaluo, \"%H:%I:%S\" ) as hora FROM `avaluo`";
		$rs =  ew_ExecuteRows($sql);
		//var_dump($rs);
		return $rs;
	}

function getUser() {
		//$rsfields[];
	$sql = "SELECT CONCAT (inspector.nombre,' ',inspector.apellido) as nombre,inspector.color FROM inspector  where inspector.id_sucursal='".$_SESSION["sucursal"]."'";
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

//var_dump($thejson);
?>
 <!-- Main content -->
	<section class="content">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-md-3">
			<div class="sticky-top mb-3">
			  <div class="card">
				
				<div class="card-body">
				  <!-- the events -->
				  <div id="external-events">
					
		<?php
				$user = getUser();
if(is_array($user)){
foreach($user as $users){
echo "<div class=external-event style=background-color:".$users["color"].">".$users["nombre"]."</div>";
}
}else {
	echo "<div class=external-event bg-success>Lunch</div>";
}?>
			 
					
				  </div>
				</div>
				<!-- /.card-body -->
			  </div>
			  <!-- /.card -->
			 
			</div>
		  </div>
			
		
		  <!-- /.col -->
		  <div class="col-md-9">
			<div class="card card-primary">
			  <div class="card-body p-0">
				<!-- THE CALENDAR -->
				<div id="calendar" style="width:65%;height:60%"></div>
			  </div>
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		  </div>
		 </div>
		<!-- /.row -->
	  </div><!-- /.container-fluid -->
	</section>
  
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/fullcalendar/main.min.js"></script>
<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="plugins/fullcalendar-interaction/main.min.js"></script>
<script src="plugins/fullcalendar-bootstrap/main.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {

	/* initialize the external events
	 -----------------------------------------------------------------*/
	function ini_events(ele) {
	  ele.each(function () {

		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
		  title: $.trim($(this).text()) // use the element's text as the event title
		}

		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject)

		// make the event draggable using jQuery UI
		$(this).draggable({
		  zIndex        : 1070,
		  revert        : true, // will cause the event to go back to its
		  revertDuration: 0  //  original position after the drag
		})

	  })
	}

	ini_events($('#external-events div.external-event'))

	/* initialize the calendar
	 -----------------------------------------------------------------*/
	//Date for the calendar events (dummy data)
	var date = new Date()
	var d    = date.getDate(),
		m    = date.getMonth(),
		y    = date.getFullYear()

	var Calendar = FullCalendar.Calendar;
	var Draggable = FullCalendarInteraction.Draggable;

	var containerEl = document.getElementById('external-events');
	var checkbox = document.getElementById('drop-remove');
	var calendarEl = document.getElementById('calendar');

	// initialize the external events
	// -----------------------------------------------------------------

	new Draggable(containerEl, {
	  itemSelector: '.external-event',
	  eventData: function(eventEl) {
		console.log(eventEl);
		return {
		  title: eventEl.innerText,
		  backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
		  borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
		  textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
		};
	  }
	});

	var calendar = new Calendar(calendarEl, {
	   height: 300,
		aspectRatio: 1,
		contentHeight: 300,
	  plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
	  header    : {
		left  : 'prev,next today',
		center: 'title',
		right : 'dayGridMonth,timeGridWeek,timeGridDay'
	  },
	  //Random default events
	  events: <?php echo json_encode($thejson); ?>,
	  editable  : false,
	  droppable : false, // this allows things to be dropped onto the calendar !!!
	  drop      : function(info) {
		// is the "remove after drop" checkbox checked?
		if (checkbox.checked) {
		  // if so, remove the element from the "Draggable Events" list
		  info.draggedEl.parentNode.removeChild(info.draggedEl);
		}
	  }    
	});

	calendar.render();

	/* ADDING EVENTS */
	var currColor = '#3c8dbc' //Red by default
	//Color chooser button
	var colorChooser = $('#color-chooser-btn')
	$('#color-chooser > li > a').click(function (e) {
	  e.preventDefault()
	  //Save color
	  currColor = $(this).css('color')
	  //Add color effect to button
	  $('#add-new-event').css({
		'background-color': currColor,
		'border-color'    : currColor
	  })
	})
	$('#add-new-event').click(function (e) {
	  e.preventDefault()
	  //Get value and make sure it is not null
	  var val = $('#new-event').val()
	  if (val.length == 0) {
		return
	  }

	  //Create events
	  var event = $('<div />')
	  event.css({
		'background-color': currColor,
		'border-color'    : currColor,
		'color'           : '#fff'
	  }).addClass('external-event')
	  event.html(val)
	  $('#external-events').prepend(event)

	  //Add draggable funtionality
	  ini_events(event)

	  //Remove event from text input
	  $('#new-event').val('')
	})
  })
</script>


