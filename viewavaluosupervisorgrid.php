<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewavaluosupervisor_grid)) $viewavaluosupervisor_grid = new cviewavaluosupervisor_grid();

// Page init
$viewavaluosupervisor_grid->Page_Init();

// Page main
$viewavaluosupervisor_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluosupervisor_grid->Page_Render();
?>
<?php if ($viewavaluosupervisor->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewavaluosupervisorgrid = new ew_Form("fviewavaluosupervisorgrid", "grid");
fviewavaluosupervisorgrid.FormKeyCountName = '<?php echo $viewavaluosupervisor_grid->FormKeyCountName ?>';

// Validate form
fviewavaluosupervisorgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_id_solicitud");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->id_solicitud->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewavaluosupervisor->fecha_avaluo->FldCaption(), $viewavaluosupervisor->fecha_avaluo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_CheckUSDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->fecha_avaluo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_id_sucursal");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->id_sucursal->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewavaluosupervisorgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "codigoavaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_solicitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_oficialcredito", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_inspector", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_cliente", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadointerno", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadopago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_sucursal", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewavaluosupervisorgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosupervisorgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluosupervisorgrid.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluosupervisorgrid.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluosupervisor_grid->id_solicitud->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.AutoSuggests["x_id_solicitud"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluosupervisor_grid->id_solicitud->LookupFilterQuery(TRUE, "grid"))) ?>;
fviewavaluosupervisorgrid.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluosupervisorgrid.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluosupervisor_grid->id_oficialcredito->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluosupervisorgrid.Lists["x_id_inspector"].Data = "<?php echo $viewavaluosupervisor_grid->id_inspector->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_id_cliente"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fviewavaluosupervisorgrid.Lists["x_id_cliente"].Data = "<?php echo $viewavaluosupervisor_grid->id_cliente->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_estado"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estado"};
fviewavaluosupervisorgrid.Lists["x_estado"].Data = "<?php echo $viewavaluosupervisor_grid->estado->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluosupervisorgrid.Lists["x_estadointerno"].Data = "<?php echo $viewavaluosupervisor_grid->estadointerno->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fviewavaluosupervisorgrid.Lists["x_estadopago"].Data = "<?php echo $viewavaluosupervisor_grid->estadopago->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewavaluosupervisor->CurrentAction == "gridadd") {
	if ($viewavaluosupervisor->CurrentMode == "copy") {
		$bSelectLimit = $viewavaluosupervisor_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewavaluosupervisor_grid->TotalRecs = $viewavaluosupervisor->ListRecordCount();
			$viewavaluosupervisor_grid->Recordset = $viewavaluosupervisor_grid->LoadRecordset($viewavaluosupervisor_grid->StartRec-1, $viewavaluosupervisor_grid->DisplayRecs);
		} else {
			if ($viewavaluosupervisor_grid->Recordset = $viewavaluosupervisor_grid->LoadRecordset())
				$viewavaluosupervisor_grid->TotalRecs = $viewavaluosupervisor_grid->Recordset->RecordCount();
		}
		$viewavaluosupervisor_grid->StartRec = 1;
		$viewavaluosupervisor_grid->DisplayRecs = $viewavaluosupervisor_grid->TotalRecs;
	} else {
		$viewavaluosupervisor->CurrentFilter = "0=1";
		$viewavaluosupervisor_grid->StartRec = 1;
		$viewavaluosupervisor_grid->DisplayRecs = $viewavaluosupervisor->GridAddRowCount;
	}
	$viewavaluosupervisor_grid->TotalRecs = $viewavaluosupervisor_grid->DisplayRecs;
	$viewavaluosupervisor_grid->StopRec = $viewavaluosupervisor_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewavaluosupervisor_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluosupervisor_grid->TotalRecs <= 0)
			$viewavaluosupervisor_grid->TotalRecs = $viewavaluosupervisor->ListRecordCount();
	} else {
		if (!$viewavaluosupervisor_grid->Recordset && ($viewavaluosupervisor_grid->Recordset = $viewavaluosupervisor_grid->LoadRecordset()))
			$viewavaluosupervisor_grid->TotalRecs = $viewavaluosupervisor_grid->Recordset->RecordCount();
	}
	$viewavaluosupervisor_grid->StartRec = 1;
	$viewavaluosupervisor_grid->DisplayRecs = $viewavaluosupervisor_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewavaluosupervisor_grid->Recordset = $viewavaluosupervisor_grid->LoadRecordset($viewavaluosupervisor_grid->StartRec-1, $viewavaluosupervisor_grid->DisplayRecs);

	// Set no record found message
	if ($viewavaluosupervisor->CurrentAction == "" && $viewavaluosupervisor_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluosupervisor_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluosupervisor_grid->SearchWhere == "0=101")
			$viewavaluosupervisor_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluosupervisor_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewavaluosupervisor_grid->RenderOtherOptions();
?>
<?php $viewavaluosupervisor_grid->ShowPageHeader(); ?>
<?php
$viewavaluosupervisor_grid->ShowMessage();
?>
<?php if ($viewavaluosupervisor_grid->TotalRecs > 0 || $viewavaluosupervisor->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluosupervisor_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluosupervisor">
<div id="fviewavaluosupervisorgrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewavaluosupervisor" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewavaluosupervisorgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluosupervisor_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluosupervisor_grid->RenderListOptions();

// Render list options (header, left)
$viewavaluosupervisor_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluosupervisor->id->Visible) { // id ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->id) == "") { ?>
		<th data-name="id" class="<?php echo $viewavaluosupervisor->id->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_id" class="viewavaluosupervisor_id"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosupervisor->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $viewavaluosupervisor->id->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_id" class="viewavaluosupervisor_id">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->codigoavaluo->Visible) { // codigoavaluo ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->codigoavaluo) == "") { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluosupervisor->codigoavaluo->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_codigoavaluo" class="viewavaluosupervisor_codigoavaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->codigoavaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluosupervisor->codigoavaluo->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_codigoavaluo" class="viewavaluosupervisor_codigoavaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->codigoavaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->codigoavaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->codigoavaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluosupervisor->id_solicitud->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisor_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluosupervisor->id_solicitud->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisor_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluosupervisor->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisor_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluosupervisor->id_oficialcredito->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisor_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluosupervisor->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_id_inspector" class="viewavaluosupervisor_id_inspector"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluosupervisor->id_inspector->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_id_inspector" class="viewavaluosupervisor_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_cliente->Visible) { // id_cliente ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluosupervisor->id_cliente->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_id_cliente" class="viewavaluosupervisor_id_cliente"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosupervisor->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluosupervisor->id_cliente->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_id_cliente" class="viewavaluosupervisor_id_cliente">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->estado->Visible) { // estado ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $viewavaluosupervisor->estado->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_estado" class="viewavaluosupervisor_estado"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $viewavaluosupervisor->estado->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_estado" class="viewavaluosupervisor_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->estadointerno) == "") { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluosupervisor->estadointerno->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_estadointerno" class="viewavaluosupervisor_estadointerno"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluosupervisor->estadointerno->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_estadointerno" class="viewavaluosupervisor_estadointerno">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->estadointerno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->estadointerno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluosupervisor->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_estadopago" class="viewavaluosupervisor_estadopago"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluosupervisor->estadopago->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_estadopago" class="viewavaluosupervisor_estadopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluosupervisor->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_fecha_avaluo" class="viewavaluosupervisor_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluosupervisor->fecha_avaluo->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_fecha_avaluo" class="viewavaluosupervisor_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_sucursal->Visible) { // id_sucursal ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->id_sucursal) == "") { ?>
		<th data-name="id_sucursal" class="<?php echo $viewavaluosupervisor->id_sucursal->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisor_id_sucursal"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_sucursal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sucursal" class="<?php echo $viewavaluosupervisor->id_sucursal->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisor_id_sucursal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->id_sucursal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->id_sucursal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->id_sucursal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluosupervisor_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewavaluosupervisor_grid->StartRec = 1;
$viewavaluosupervisor_grid->StopRec = $viewavaluosupervisor_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewavaluosupervisor_grid->FormKeyCountName) && ($viewavaluosupervisor->CurrentAction == "gridadd" || $viewavaluosupervisor->CurrentAction == "gridedit" || $viewavaluosupervisor->CurrentAction == "F")) {
		$viewavaluosupervisor_grid->KeyCount = $objForm->GetValue($viewavaluosupervisor_grid->FormKeyCountName);
		$viewavaluosupervisor_grid->StopRec = $viewavaluosupervisor_grid->StartRec + $viewavaluosupervisor_grid->KeyCount - 1;
	}
}
$viewavaluosupervisor_grid->RecCnt = $viewavaluosupervisor_grid->StartRec - 1;
if ($viewavaluosupervisor_grid->Recordset && !$viewavaluosupervisor_grid->Recordset->EOF) {
	$viewavaluosupervisor_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluosupervisor_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluosupervisor_grid->StartRec > 1)
		$viewavaluosupervisor_grid->Recordset->Move($viewavaluosupervisor_grid->StartRec - 1);
} elseif (!$viewavaluosupervisor->AllowAddDeleteRow && $viewavaluosupervisor_grid->StopRec == 0) {
	$viewavaluosupervisor_grid->StopRec = $viewavaluosupervisor->GridAddRowCount;
}

// Initialize aggregate
$viewavaluosupervisor->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluosupervisor->ResetAttrs();
$viewavaluosupervisor_grid->RenderRow();
if ($viewavaluosupervisor->CurrentAction == "gridadd")
	$viewavaluosupervisor_grid->RowIndex = 0;
if ($viewavaluosupervisor->CurrentAction == "gridedit")
	$viewavaluosupervisor_grid->RowIndex = 0;
while ($viewavaluosupervisor_grid->RecCnt < $viewavaluosupervisor_grid->StopRec) {
	$viewavaluosupervisor_grid->RecCnt++;
	if (intval($viewavaluosupervisor_grid->RecCnt) >= intval($viewavaluosupervisor_grid->StartRec)) {
		$viewavaluosupervisor_grid->RowCnt++;
		if ($viewavaluosupervisor->CurrentAction == "gridadd" || $viewavaluosupervisor->CurrentAction == "gridedit" || $viewavaluosupervisor->CurrentAction == "F") {
			$viewavaluosupervisor_grid->RowIndex++;
			$objForm->Index = $viewavaluosupervisor_grid->RowIndex;
			if ($objForm->HasValue($viewavaluosupervisor_grid->FormActionName))
				$viewavaluosupervisor_grid->RowAction = strval($objForm->GetValue($viewavaluosupervisor_grid->FormActionName));
			elseif ($viewavaluosupervisor->CurrentAction == "gridadd")
				$viewavaluosupervisor_grid->RowAction = "insert";
			else
				$viewavaluosupervisor_grid->RowAction = "";
		}

		// Set up key count
		$viewavaluosupervisor_grid->KeyCount = $viewavaluosupervisor_grid->RowIndex;

		// Init row class and style
		$viewavaluosupervisor->ResetAttrs();
		$viewavaluosupervisor->CssClass = "";
		if ($viewavaluosupervisor->CurrentAction == "gridadd") {
			if ($viewavaluosupervisor->CurrentMode == "copy") {
				$viewavaluosupervisor_grid->LoadRowValues($viewavaluosupervisor_grid->Recordset); // Load row values
				$viewavaluosupervisor_grid->SetRecordKey($viewavaluosupervisor_grid->RowOldKey, $viewavaluosupervisor_grid->Recordset); // Set old record key
			} else {
				$viewavaluosupervisor_grid->LoadRowValues(); // Load default values
				$viewavaluosupervisor_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewavaluosupervisor_grid->LoadRowValues($viewavaluosupervisor_grid->Recordset); // Load row values
		}
		$viewavaluosupervisor->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewavaluosupervisor->CurrentAction == "gridadd") // Grid add
			$viewavaluosupervisor->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewavaluosupervisor->CurrentAction == "gridadd" && $viewavaluosupervisor->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewavaluosupervisor_grid->RestoreCurrentRowFormValues($viewavaluosupervisor_grid->RowIndex); // Restore form values
		if ($viewavaluosupervisor->CurrentAction == "gridedit") { // Grid edit
			if ($viewavaluosupervisor->EventCancelled) {
				$viewavaluosupervisor_grid->RestoreCurrentRowFormValues($viewavaluosupervisor_grid->RowIndex); // Restore form values
			}
			if ($viewavaluosupervisor_grid->RowAction == "insert")
				$viewavaluosupervisor->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewavaluosupervisor->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewavaluosupervisor->CurrentAction == "gridedit" && ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT || $viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) && $viewavaluosupervisor->EventCancelled) // Update failed
			$viewavaluosupervisor_grid->RestoreCurrentRowFormValues($viewavaluosupervisor_grid->RowIndex); // Restore form values
		if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewavaluosupervisor_grid->EditRowCnt++;
		if ($viewavaluosupervisor->CurrentAction == "F") // Confirm row
			$viewavaluosupervisor_grid->RestoreCurrentRowFormValues($viewavaluosupervisor_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewavaluosupervisor->RowAttrs = array_merge($viewavaluosupervisor->RowAttrs, array('data-rowindex'=>$viewavaluosupervisor_grid->RowCnt, 'id'=>'r' . $viewavaluosupervisor_grid->RowCnt . '_viewavaluosupervisor', 'data-rowtype'=>$viewavaluosupervisor->RowType));

		// Render row
		$viewavaluosupervisor_grid->RenderRow();

		// Render list options
		$viewavaluosupervisor_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewavaluosupervisor_grid->RowAction <> "delete" && $viewavaluosupervisor_grid->RowAction <> "insertdelete" && !($viewavaluosupervisor_grid->RowAction == "insert" && $viewavaluosupervisor->CurrentAction == "F" && $viewavaluosupervisor_grid->EmptyRow())) {
?>
	<tr<?php echo $viewavaluosupervisor->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluosupervisor_grid->ListOptions->Render("body", "left", $viewavaluosupervisor_grid->RowCnt);
?>
	<?php if ($viewavaluosupervisor->id->Visible) { // id ?>
		<td data-name="id"<?php echo $viewavaluosupervisor->id->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id" class="form-group viewavaluosupervisor_id">
<span<?php echo $viewavaluosupervisor->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id" class="viewavaluosupervisor_id">
<span<?php echo $viewavaluosupervisor->id->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo"<?php echo $viewavaluosupervisor->codigoavaluo->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_codigoavaluo" class="form-group viewavaluosupervisor_codigoavaluo">
<input type="text" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->codigoavaluo->EditValue ?>"<?php echo $viewavaluosupervisor->codigoavaluo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_codigoavaluo" class="form-group viewavaluosupervisor_codigoavaluo">
<input type="text" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->codigoavaluo->EditValue ?>"<?php echo $viewavaluosupervisor->codigoavaluo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_codigoavaluo" class="viewavaluosupervisor_codigoavaluo">
<span<?php echo $viewavaluosupervisor->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->codigoavaluo->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $viewavaluosupervisor->id_solicitud->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewavaluosupervisor->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<?php
$wrkonchange = trim(" " . @$viewavaluosupervisor->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluosupervisor->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluosupervisor_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="sv_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo $viewavaluosupervisor->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluosupervisorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_solicitud->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_solicitud->ReadOnly || $viewavaluosupervisor->id_solicitud->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($viewavaluosupervisor->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<?php
$wrkonchange = trim(" " . @$viewavaluosupervisor->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluosupervisor->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluosupervisor_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="sv_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo $viewavaluosupervisor->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluosupervisorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_solicitud->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_solicitud->ReadOnly || $viewavaluosupervisor->id_solicitud->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_solicitud->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluosupervisor->id_oficialcredito->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_oficialcredito" class="form-group viewavaluosupervisor_id_oficialcredito">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($viewavaluosupervisor->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_oficialcredito->ReadOnly || $viewavaluosupervisor->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $viewavaluosupervisor->id_oficialcredito->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_oficialcredito->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_oficialcredito" class="form-group viewavaluosupervisor_id_oficialcredito">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($viewavaluosupervisor->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_oficialcredito->ReadOnly || $viewavaluosupervisor->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $viewavaluosupervisor->id_oficialcredito->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_oficialcredito->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisor_id_oficialcredito">
<span<?php echo $viewavaluosupervisor->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_oficialcredito->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluosupervisor->id_inspector->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_inspector" class="form-group viewavaluosupervisor_id_inspector">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector"><?php echo (strval($viewavaluosupervisor->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_inspector->ReadOnly || $viewavaluosupervisor->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo $viewavaluosupervisor->id_inspector->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_inspector->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_inspector" class="form-group viewavaluosupervisor_id_inspector">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector"><?php echo (strval($viewavaluosupervisor->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_inspector->ReadOnly || $viewavaluosupervisor->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo $viewavaluosupervisor->id_inspector->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_inspector->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_inspector" class="viewavaluosupervisor_id_inspector">
<span<?php echo $viewavaluosupervisor->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_inspector->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $viewavaluosupervisor->id_cliente->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_cliente" class="form-group viewavaluosupervisor_id_cliente">
<select data-table="viewavaluosupervisor" data-field="x_id_cliente" data-value-separator="<?php echo $viewavaluosupervisor->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente"<?php echo $viewavaluosupervisor->id_cliente->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->id_cliente->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_cliente" class="form-group viewavaluosupervisor_id_cliente">
<select data-table="viewavaluosupervisor" data-field="x_id_cliente" data-value-separator="<?php echo $viewavaluosupervisor->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente"<?php echo $viewavaluosupervisor->id_cliente->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->id_cliente->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_cliente" class="viewavaluosupervisor_id_cliente">
<span<?php echo $viewavaluosupervisor->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_cliente->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $viewavaluosupervisor->estado->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estado" class="form-group viewavaluosupervisor_estado">
<select data-table="viewavaluosupervisor" data-field="x_estado" data-value-separator="<?php echo $viewavaluosupervisor->estado->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado"<?php echo $viewavaluosupervisor->estado->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estado->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estado" class="form-group viewavaluosupervisor_estado">
<select data-table="viewavaluosupervisor" data-field="x_estado" data-value-separator="<?php echo $viewavaluosupervisor->estado->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado"<?php echo $viewavaluosupervisor->estado->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estado->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estado" class="viewavaluosupervisor_estado">
<span<?php echo $viewavaluosupervisor->estado->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->estado->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno"<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno"><?php echo (strval($viewavaluosupervisor->estadointerno->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->estadointerno->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->estadointerno->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->estadointerno->ReadOnly || $viewavaluosupervisor->estadointerno->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo $viewavaluosupervisor->estadointerno->CurrentValue ?>"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno"><?php echo (strval($viewavaluosupervisor->estadointerno->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->estadointerno->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->estadointerno->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->estadointerno->ReadOnly || $viewavaluosupervisor->estadointerno->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo $viewavaluosupervisor->estadointerno->CurrentValue ?>"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadointerno" class="viewavaluosupervisor_estadointerno">
<span<?php echo $viewavaluosupervisor->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluosupervisor->estadopago->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadopago" class="form-group viewavaluosupervisor_estadopago">
<select data-table="viewavaluosupervisor" data-field="x_estadopago" data-value-separator="<?php echo $viewavaluosupervisor->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago"<?php echo $viewavaluosupervisor->estadopago->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadopago->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadopago" class="form-group viewavaluosupervisor_estadopago">
<select data-table="viewavaluosupervisor" data-field="x_estadopago" data-value-separator="<?php echo $viewavaluosupervisor->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago"<?php echo $viewavaluosupervisor->estadopago->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadopago->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadopago" class="viewavaluosupervisor_estadopago">
<span<?php echo $viewavaluosupervisor->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->estadopago->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluosupervisor->fecha_avaluo->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_fecha_avaluo" class="form-group viewavaluosupervisor_fecha_avaluo">
<input type="text" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->fecha_avaluo->EditValue ?>"<?php echo $viewavaluosupervisor->fecha_avaluo->EditAttributes() ?>>
<?php if (!$viewavaluosupervisor->fecha_avaluo->ReadOnly && !$viewavaluosupervisor->fecha_avaluo->Disabled && !isset($viewavaluosupervisor->fecha_avaluo->EditAttrs["readonly"]) && !isset($viewavaluosupervisor->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fviewavaluosupervisorgrid", "x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_fecha_avaluo" class="form-group viewavaluosupervisor_fecha_avaluo">
<input type="text" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->fecha_avaluo->EditValue ?>"<?php echo $viewavaluosupervisor->fecha_avaluo->EditAttributes() ?>>
<?php if (!$viewavaluosupervisor->fecha_avaluo->ReadOnly && !$viewavaluosupervisor->fecha_avaluo->Disabled && !isset($viewavaluosupervisor->fecha_avaluo->EditAttrs["readonly"]) && !isset($viewavaluosupervisor->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fviewavaluosupervisorgrid", "x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_fecha_avaluo" class="viewavaluosupervisor_fecha_avaluo">
<span<?php echo $viewavaluosupervisor->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->fecha_avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_sucursal->Visible) { // id_sucursal ?>
		<td data-name="id_sucursal"<?php echo $viewavaluosupervisor->id_sucursal->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_sucursal" class="form-group viewavaluosupervisor_id_sucursal">
<input type="text" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->id_sucursal->EditValue ?>"<?php echo $viewavaluosupervisor->id_sucursal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_sucursal" class="form-group viewavaluosupervisor_id_sucursal">
<input type="text" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->id_sucursal->EditValue ?>"<?php echo $viewavaluosupervisor->id_sucursal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisor_id_sucursal">
<span<?php echo $viewavaluosupervisor->id_sucursal->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_sucursal->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluosupervisor_grid->ListOptions->Render("body", "right", $viewavaluosupervisor_grid->RowCnt);
?>
	</tr>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD || $viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewavaluosupervisorgrid.UpdateOpts(<?php echo $viewavaluosupervisor_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewavaluosupervisor->CurrentAction <> "gridadd" || $viewavaluosupervisor->CurrentMode == "copy")
		if (!$viewavaluosupervisor_grid->Recordset->EOF) $viewavaluosupervisor_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewavaluosupervisor->CurrentMode == "add" || $viewavaluosupervisor->CurrentMode == "copy" || $viewavaluosupervisor->CurrentMode == "edit") {
		$viewavaluosupervisor_grid->RowIndex = '$rowindex$';
		$viewavaluosupervisor_grid->LoadRowValues();

		// Set row properties
		$viewavaluosupervisor->ResetAttrs();
		$viewavaluosupervisor->RowAttrs = array_merge($viewavaluosupervisor->RowAttrs, array('data-rowindex'=>$viewavaluosupervisor_grid->RowIndex, 'id'=>'r0_viewavaluosupervisor', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewavaluosupervisor->RowAttrs["class"], "ewTemplate");
		$viewavaluosupervisor->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewavaluosupervisor_grid->RenderRow();

		// Render list options
		$viewavaluosupervisor_grid->RenderListOptions();
		$viewavaluosupervisor_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewavaluosupervisor->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluosupervisor_grid->ListOptions->Render("body", "left", $viewavaluosupervisor_grid->RowIndex);
?>
	<?php if ($viewavaluosupervisor->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id" class="form-group viewavaluosupervisor_id">
<span<?php echo $viewavaluosupervisor->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_codigoavaluo" class="form-group viewavaluosupervisor_codigoavaluo">
<input type="text" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->codigoavaluo->EditValue ?>"<?php echo $viewavaluosupervisor->codigoavaluo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_codigoavaluo" class="form-group viewavaluosupervisor_codigoavaluo">
<span<?php echo $viewavaluosupervisor->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->codigoavaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<?php if ($viewavaluosupervisor->id_solicitud->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<?php
$wrkonchange = trim(" " . @$viewavaluosupervisor->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluosupervisor->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluosupervisor_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="sv_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo $viewavaluosupervisor->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluosupervisorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_solicitud->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_solicitud->ReadOnly || $viewavaluosupervisor->id_solicitud->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_oficialcredito" class="form-group viewavaluosupervisor_id_oficialcredito">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($viewavaluosupervisor->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_oficialcredito->ReadOnly || $viewavaluosupervisor->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $viewavaluosupervisor->id_oficialcredito->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_oficialcredito->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_oficialcredito" class="form-group viewavaluosupervisor_id_oficialcredito">
<span<?php echo $viewavaluosupervisor->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_oficialcredito->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_inspector" class="form-group viewavaluosupervisor_id_inspector">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector"><?php echo (strval($viewavaluosupervisor->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_inspector->ReadOnly || $viewavaluosupervisor->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo $viewavaluosupervisor->id_inspector->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_inspector->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_inspector" class="form-group viewavaluosupervisor_id_inspector">
<span<?php echo $viewavaluosupervisor->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_inspector->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_cliente" class="form-group viewavaluosupervisor_id_cliente">
<select data-table="viewavaluosupervisor" data-field="x_id_cliente" data-value-separator="<?php echo $viewavaluosupervisor->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente"<?php echo $viewavaluosupervisor->id_cliente->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->id_cliente->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_cliente" class="form-group viewavaluosupervisor_id_cliente">
<span<?php echo $viewavaluosupervisor->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_cliente->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_cliente" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_cliente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_estado" class="form-group viewavaluosupervisor_estado">
<select data-table="viewavaluosupervisor" data-field="x_estado" data-value-separator="<?php echo $viewavaluosupervisor->estado->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado"<?php echo $viewavaluosupervisor->estado->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estado->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_estado" class="form-group viewavaluosupervisor_estado">
<span<?php echo $viewavaluosupervisor->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estado" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno"><?php echo (strval($viewavaluosupervisor->estadointerno->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->estadointerno->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->estadointerno->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->estadointerno->ReadOnly || $viewavaluosupervisor->estadointerno->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo $viewavaluosupervisor->estadointerno->CurrentValue ?>"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<span<?php echo $viewavaluosupervisor->estadointerno->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->estadointerno->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_estadopago" class="form-group viewavaluosupervisor_estadopago">
<select data-table="viewavaluosupervisor" data-field="x_estadopago" data-value-separator="<?php echo $viewavaluosupervisor->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago"<?php echo $viewavaluosupervisor->estadopago->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadopago->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_estadopago" class="form-group viewavaluosupervisor_estadopago">
<span<?php echo $viewavaluosupervisor->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->estadopago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadopago" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadopago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_fecha_avaluo" class="form-group viewavaluosupervisor_fecha_avaluo">
<input type="text" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->fecha_avaluo->EditValue ?>"<?php echo $viewavaluosupervisor->fecha_avaluo->EditAttributes() ?>>
<?php if (!$viewavaluosupervisor->fecha_avaluo->ReadOnly && !$viewavaluosupervisor->fecha_avaluo->Disabled && !isset($viewavaluosupervisor->fecha_avaluo->EditAttrs["readonly"]) && !isset($viewavaluosupervisor->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fviewavaluosupervisorgrid", "x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_fecha_avaluo" class="form-group viewavaluosupervisor_fecha_avaluo">
<span<?php echo $viewavaluosupervisor->fecha_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->fecha_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->fecha_avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->id_sucursal->Visible) { // id_sucursal ?>
		<td data-name="id_sucursal">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_sucursal" class="form-group viewavaluosupervisor_id_sucursal">
<input type="text" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->id_sucursal->EditValue ?>"<?php echo $viewavaluosupervisor->id_sucursal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_id_sucursal" class="form-group viewavaluosupervisor_id_sucursal">
<span<?php echo $viewavaluosupervisor->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_sucursal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluosupervisor_grid->ListOptions->Render("body", "right", $viewavaluosupervisor_grid->RowIndex);
?>
<script type="text/javascript">
fviewavaluosupervisorgrid.UpdateOpts(<?php echo $viewavaluosupervisor_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewavaluosupervisor->CurrentMode == "add" || $viewavaluosupervisor->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewavaluosupervisor_grid->FormKeyCountName ?>" id="<?php echo $viewavaluosupervisor_grid->FormKeyCountName ?>" value="<?php echo $viewavaluosupervisor_grid->KeyCount ?>">
<?php echo $viewavaluosupervisor_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewavaluosupervisor->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewavaluosupervisor_grid->FormKeyCountName ?>" id="<?php echo $viewavaluosupervisor_grid->FormKeyCountName ?>" value="<?php echo $viewavaluosupervisor_grid->KeyCount ?>">
<?php echo $viewavaluosupervisor_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewavaluosupervisor->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewavaluosupervisorgrid">
</div>
<?php

// Close recordset
if ($viewavaluosupervisor_grid->Recordset)
	$viewavaluosupervisor_grid->Recordset->Close();
?>
<?php if ($viewavaluosupervisor_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewavaluosupervisor_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewavaluosupervisor_grid->TotalRecs == 0 && $viewavaluosupervisor->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluosupervisor_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewavaluosupervisor->Export == "") { ?>
<script type="text/javascript">
fviewavaluosupervisorgrid.Init();
</script>
<?php } ?>
<?php
$viewavaluosupervisor_grid->Page_Terminate();
?>
