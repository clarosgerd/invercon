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
			elm = this.GetElements("x" + infix + "_monto_pago");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->monto_pago->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_montoincial");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->montoincial->FldErrMsg()) ?>");

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
	if (ew_ValueChanged(fobj, infix, "tipoinmueble", false)) return false;
	if (ew_ValueChanged(fobj, infix, "codigoavaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_solicitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_oficialcredito", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_inspector", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadointerno", false)) return false;
	if (ew_ValueChanged(fobj, infix, "informe", false)) return false;
	if (ew_ValueChanged(fobj, infix, "monto_pago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "montoincial", false)) return false;
	if (ew_ValueChanged(fobj, infix, "comentario", false)) return false;
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
fviewavaluosupervisorgrid.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewavaluosupervisorgrid.Lists["x_tipoinmueble"].Data = "<?php echo $viewavaluosupervisor_grid->tipoinmueble->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluosupervisorgrid.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluosupervisor_grid->id_solicitud->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.AutoSuggests["x_id_solicitud"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluosupervisor_grid->id_solicitud->LookupFilterQuery(TRUE, "grid"))) ?>;
fviewavaluosupervisorgrid.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluosupervisorgrid.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluosupervisor_grid->id_oficialcredito->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluosupervisorgrid.Lists["x_id_inspector"].Data = "<?php echo $viewavaluosupervisor_grid->id_inspector->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluosupervisorgrid.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluosupervisorgrid.Lists["x_estadointerno"].Data = "<?php echo $viewavaluosupervisor_grid->estadointerno->LookupFilterQuery(FALSE, "grid") ?>";

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
<?php if ($viewavaluosupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->tipoinmueble) == "") { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluosupervisor->tipoinmueble->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisor_tipoinmueble"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosupervisor->tipoinmueble->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluosupervisor->tipoinmueble->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisor_tipoinmueble">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->tipoinmueble->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->tipoinmueble->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->tipoinmueble->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
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
<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->estadointerno) == "") { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluosupervisor->estadointerno->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_estadointerno" class="viewavaluosupervisor_estadointerno"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluosupervisor->estadointerno->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_estadointerno" class="viewavaluosupervisor_estadointerno">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->estadointerno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->estadointerno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->informe->Visible) { // informe ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->informe) == "") { ?>
		<th data-name="informe" class="<?php echo $viewavaluosupervisor->informe->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_informe" class="viewavaluosupervisor_informe"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->informe->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="informe" class="<?php echo $viewavaluosupervisor->informe->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_informe" class="viewavaluosupervisor_informe">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->informe->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->informe->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->informe->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->monto_pago->Visible) { // monto_pago ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->monto_pago) == "") { ?>
		<th data-name="monto_pago" class="<?php echo $viewavaluosupervisor->monto_pago->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_monto_pago" class="viewavaluosupervisor_monto_pago"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_pago" class="<?php echo $viewavaluosupervisor->monto_pago->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_monto_pago" class="viewavaluosupervisor_monto_pago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->monto_pago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->monto_pago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->montoincial->Visible) { // montoincial ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->montoincial) == "") { ?>
		<th data-name="montoincial" class="<?php echo $viewavaluosupervisor->montoincial->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_montoincial" class="viewavaluosupervisor_montoincial"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="montoincial" class="<?php echo $viewavaluosupervisor->montoincial->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_montoincial" class="viewavaluosupervisor_montoincial">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->montoincial->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->montoincial->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->comentario->Visible) { // comentario ?>
	<?php if ($viewavaluosupervisor->SortUrl($viewavaluosupervisor->comentario) == "") { ?>
		<th data-name="comentario" class="<?php echo $viewavaluosupervisor->comentario->HeaderCellClass() ?>"><div id="elh_viewavaluosupervisor_comentario" class="viewavaluosupervisor_comentario"><div class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->comentario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="comentario" class="<?php echo $viewavaluosupervisor->comentario->HeaderCellClass() ?>"><div><div id="elh_viewavaluosupervisor_comentario" class="viewavaluosupervisor_comentario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosupervisor->comentario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosupervisor->comentario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosupervisor->comentario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
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
	<?php if ($viewavaluosupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble"<?php echo $viewavaluosupervisor->tipoinmueble->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_tipoinmueble" class="form-group viewavaluosupervisor_tipoinmueble">
<select data-table="viewavaluosupervisor" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluosupervisor->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble"<?php echo $viewavaluosupervisor->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->tipoinmueble->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_tipoinmueble" class="form-group viewavaluosupervisor_tipoinmueble">
<span<?php echo $viewavaluosupervisor->tipoinmueble->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->tipoinmueble->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisor_tipoinmueble">
<span<?php echo $viewavaluosupervisor->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->tipoinmueble->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->CurrentValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT || $viewavaluosupervisor->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->CurrentValue) ?>">
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
<span<?php echo $viewavaluosupervisor->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->codigoavaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->codigoavaluo->CurrentValue) ?>">
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
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_solicitud" class="form-group viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>">
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
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($viewavaluosupervisor->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_oficialcredito->ReadOnly || $viewavaluosupervisor->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $viewavaluosupervisor->id_oficialcredito->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_oficialcredito->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_oficialcredito" class="form-group viewavaluosupervisor_id_oficialcredito">
<span<?php echo $viewavaluosupervisor->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_oficialcredito->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->CurrentValue) ?>">
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
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector"><?php echo (strval($viewavaluosupervisor->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluosupervisor->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluosupervisor->id_inspector->ReadOnly || $viewavaluosupervisor->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluosupervisor->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo $viewavaluosupervisor->id_inspector->CurrentValue ?>"<?php echo $viewavaluosupervisor->id_inspector->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_id_inspector" class="form-group viewavaluosupervisor_id_inspector">
<span<?php echo $viewavaluosupervisor->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_inspector->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->CurrentValue) ?>">
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
	<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno"<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_estadointerno" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->estadointerno->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno") ?>
</select>
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
	<?php if ($viewavaluosupervisor->informe->Visible) { // informe ?>
		<td data-name="informe"<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>>
<?php if ($viewavaluosupervisor_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_viewavaluosupervisor_informe" class="form-group viewavaluosupervisor_informe">
<div id="fd_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe">
<span title="<?php echo $viewavaluosupervisor->informe->FldTitle() ? $viewavaluosupervisor->informe->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosupervisor->informe->ReadOnly || $viewavaluosupervisor->informe->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosupervisor" data-field="x_informe" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe"<?php echo $viewavaluosupervisor->informe->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fn_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="0">
<input type="hidden" name="fs_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fs_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="0">
<input type="hidden" name="fx_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fx_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fm_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_informe" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->informe->OldValue) ?>">
<?php } elseif ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_informe" class="viewavaluosupervisor_informe">
<span<?php echo $viewavaluosupervisor->informe->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewavaluosupervisor->informe, $viewavaluosupervisor->informe->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_informe" class="form-group viewavaluosupervisor_informe">
<div id="fd_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe">
<span title="<?php echo $viewavaluosupervisor->informe->FldTitle() ? $viewavaluosupervisor->informe->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosupervisor->informe->ReadOnly || $viewavaluosupervisor->informe->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosupervisor" data-field="x_informe" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe"<?php echo $viewavaluosupervisor->informe->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fn_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fs_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="0">
<input type="hidden" name="fx_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fx_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fm_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->monto_pago->Visible) { // monto_pago ?>
		<td data-name="monto_pago"<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_monto_pago" class="form-group viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_monto_pago" class="form-group viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_monto_pago" class="viewavaluosupervisor_monto_pago">
<span<?php echo $viewavaluosupervisor->monto_pago->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->monto_pago->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->montoincial->Visible) { // montoincial ?>
		<td data-name="montoincial"<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_montoincial" class="form-group viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_montoincial" class="form-group viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_montoincial" class="viewavaluosupervisor_montoincial">
<span<?php echo $viewavaluosupervisor->montoincial->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->montoincial->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->comentario->Visible) { // comentario ?>
		<td data-name="comentario"<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_comentario" class="form-group viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_comentario" class="form-group viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewavaluosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosupervisor_grid->RowCnt ?>_viewavaluosupervisor_comentario" class="viewavaluosupervisor_comentario">
<span<?php echo $viewavaluosupervisor->comentario->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->comentario->ListViewValue() ?></span>
</span>
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="fviewavaluosupervisorgrid$x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->FormValue) ?>">
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="fviewavaluosupervisorgrid$o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->OldValue) ?>">
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
	<?php if ($viewavaluosupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_tipoinmueble" class="form-group viewavaluosupervisor_tipoinmueble">
<select data-table="viewavaluosupervisor" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluosupervisor->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble"<?php echo $viewavaluosupervisor->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->tipoinmueble->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_tipoinmueble" class="form-group viewavaluosupervisor_tipoinmueble">
<span<?php echo $viewavaluosupervisor->tipoinmueble->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->tipoinmueble->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->OldValue) ?>">
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
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($viewavaluosupervisor->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_oficialcredito->ViewValue); ?></span>
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
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_id_inspector"><?php echo (strval($viewavaluosupervisor->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluosupervisor->id_inspector->ViewValue); ?></span>
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
	<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_estadointerno" class="form-group viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_estadointerno") ?>
</select>
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
	<?php if ($viewavaluosupervisor->informe->Visible) { // informe ?>
		<td data-name="informe">
<span id="el$rowindex$_viewavaluosupervisor_informe" class="form-group viewavaluosupervisor_informe">
<div id="fd_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe">
<span title="<?php echo $viewavaluosupervisor->informe->FldTitle() ? $viewavaluosupervisor->informe->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosupervisor->informe->ReadOnly || $viewavaluosupervisor->informe->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosupervisor" data-field="x_informe" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe"<?php echo $viewavaluosupervisor->informe->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fn_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fa_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="0">
<input type="hidden" name="fs_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fs_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="0">
<input type="hidden" name="fx_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fx_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id= "fm_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo $viewavaluosupervisor->informe->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_informe" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_informe" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->informe->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->monto_pago->Visible) { // monto_pago ?>
		<td data-name="monto_pago">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_monto_pago" class="form-group viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_monto_pago" class="form-group viewavaluosupervisor_monto_pago">
<span<?php echo $viewavaluosupervisor->monto_pago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->monto_pago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_monto_pago" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->montoincial->Visible) { // montoincial ?>
		<td data-name="montoincial">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_montoincial" class="form-group viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_montoincial" class="form-group viewavaluosupervisor_montoincial">
<span<?php echo $viewavaluosupervisor->montoincial->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->montoincial->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_montoincial" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluosupervisor->comentario->Visible) { // comentario ?>
		<td data-name="comentario">
<?php if ($viewavaluosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluosupervisor_comentario" class="form-group viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluosupervisor_comentario" class="form-group viewavaluosupervisor_comentario">
<span<?php echo $viewavaluosupervisor->comentario->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->comentario->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_comentario" name="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" id="o<?php echo $viewavaluosupervisor_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluosupervisor_grid->ListOptions->Render("body", "right", $viewavaluosupervisor_grid->RowCnt);
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
