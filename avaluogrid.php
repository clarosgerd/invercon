<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($avaluo_grid)) $avaluo_grid = new cavaluo_grid();

// Page init
$avaluo_grid->Page_Init();

// Page main
$avaluo_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$avaluo_grid->Page_Render();
?>
<?php if ($avaluo->Export == "") { ?>
<script type="text/javascript">

// Form object
var favaluogrid = new ew_Form("favaluogrid", "grid");
favaluogrid.FormKeyCountName = '<?php echo $avaluo_grid->FormKeyCountName ?>';

// Validate form
favaluogrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($avaluo->id_solicitud->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $avaluo->fecha_avaluo->FldCaption(), $avaluo->fecha_avaluo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_CheckUSDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($avaluo->fecha_avaluo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_montoincial");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($avaluo->montoincial->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
favaluogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "codigoavaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_solicitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_oficialcredito", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_inspector", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_cliente", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadointerno", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadopago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "montoincial", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_metodopago", false)) return false;
	return true;
}

// Form_CustomValidate event
favaluogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
favaluogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
favaluogrid.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
favaluogrid.Lists["x_id_solicitud"].Data = "<?php echo $avaluo_grid->id_solicitud->LookupFilterQuery(FALSE, "grid") ?>";
favaluogrid.AutoSuggests["x_id_solicitud"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $avaluo_grid->id_solicitud->LookupFilterQuery(TRUE, "grid"))) ?>;
favaluogrid.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
favaluogrid.Lists["x_id_oficialcredito"].Data = "<?php echo $avaluo_grid->id_oficialcredito->LookupFilterQuery(FALSE, "grid") ?>";
favaluogrid.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
favaluogrid.Lists["x_id_inspector"].Data = "<?php echo $avaluo_grid->id_inspector->LookupFilterQuery(FALSE, "grid") ?>";
favaluogrid.Lists["x_id_cliente"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
favaluogrid.Lists["x_id_cliente"].Data = "<?php echo $avaluo_grid->id_cliente->LookupFilterQuery(FALSE, "grid") ?>";
favaluogrid.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
favaluogrid.Lists["x_estadointerno"].Data = "<?php echo $avaluo_grid->estadointerno->LookupFilterQuery(FALSE, "grid") ?>";
favaluogrid.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
favaluogrid.Lists["x_estadopago"].Data = "<?php echo $avaluo_grid->estadopago->LookupFilterQuery(FALSE, "grid") ?>";
favaluogrid.Lists["x_id_metodopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_short_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"metodopago"};
favaluogrid.Lists["x_id_metodopago"].Data = "<?php echo $avaluo_grid->id_metodopago->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($avaluo->CurrentAction == "gridadd") {
	if ($avaluo->CurrentMode == "copy") {
		$bSelectLimit = $avaluo_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$avaluo_grid->TotalRecs = $avaluo->ListRecordCount();
			$avaluo_grid->Recordset = $avaluo_grid->LoadRecordset($avaluo_grid->StartRec-1, $avaluo_grid->DisplayRecs);
		} else {
			if ($avaluo_grid->Recordset = $avaluo_grid->LoadRecordset())
				$avaluo_grid->TotalRecs = $avaluo_grid->Recordset->RecordCount();
		}
		$avaluo_grid->StartRec = 1;
		$avaluo_grid->DisplayRecs = $avaluo_grid->TotalRecs;
	} else {
		$avaluo->CurrentFilter = "0=1";
		$avaluo_grid->StartRec = 1;
		$avaluo_grid->DisplayRecs = $avaluo->GridAddRowCount;
	}
	$avaluo_grid->TotalRecs = $avaluo_grid->DisplayRecs;
	$avaluo_grid->StopRec = $avaluo_grid->DisplayRecs;
} else {
	$bSelectLimit = $avaluo_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($avaluo_grid->TotalRecs <= 0)
			$avaluo_grid->TotalRecs = $avaluo->ListRecordCount();
	} else {
		if (!$avaluo_grid->Recordset && ($avaluo_grid->Recordset = $avaluo_grid->LoadRecordset()))
			$avaluo_grid->TotalRecs = $avaluo_grid->Recordset->RecordCount();
	}
	$avaluo_grid->StartRec = 1;
	$avaluo_grid->DisplayRecs = $avaluo_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$avaluo_grid->Recordset = $avaluo_grid->LoadRecordset($avaluo_grid->StartRec-1, $avaluo_grid->DisplayRecs);

	// Set no record found message
	if ($avaluo->CurrentAction == "" && $avaluo_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$avaluo_grid->setWarningMessage(ew_DeniedMsg());
		if ($avaluo_grid->SearchWhere == "0=101")
			$avaluo_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$avaluo_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$avaluo_grid->RenderOtherOptions();
?>
<?php $avaluo_grid->ShowPageHeader(); ?>
<?php
$avaluo_grid->ShowMessage();
?>
<?php if ($avaluo_grid->TotalRecs > 0 || $avaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($avaluo_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> avaluo">
<div id="favaluogrid" class="ewForm ewListForm form-inline">
<div id="gmp_avaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_avaluogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$avaluo_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$avaluo_grid->RenderListOptions();

// Render list options (header, left)
$avaluo_grid->ListOptions->Render("header", "left");
?>
<?php if ($avaluo->codigoavaluo->Visible) { // codigoavaluo ?>
	<?php if ($avaluo->SortUrl($avaluo->codigoavaluo) == "") { ?>
		<th data-name="codigoavaluo" class="<?php echo $avaluo->codigoavaluo->HeaderCellClass() ?>"><div id="elh_avaluo_codigoavaluo" class="avaluo_codigoavaluo"><div class="ewTableHeaderCaption"><?php echo $avaluo->codigoavaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigoavaluo" class="<?php echo $avaluo->codigoavaluo->HeaderCellClass() ?>"><div><div id="elh_avaluo_codigoavaluo" class="avaluo_codigoavaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->codigoavaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->codigoavaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->codigoavaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($avaluo->SortUrl($avaluo->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $avaluo->id_solicitud->HeaderCellClass() ?>"><div id="elh_avaluo_id_solicitud" class="avaluo_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $avaluo->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $avaluo->id_solicitud->HeaderCellClass() ?>"><div><div id="elh_avaluo_id_solicitud" class="avaluo_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($avaluo->SortUrl($avaluo->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $avaluo->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_avaluo_id_oficialcredito" class="avaluo_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $avaluo->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $avaluo->id_oficialcredito->HeaderCellClass() ?>"><div><div id="elh_avaluo_id_oficialcredito" class="avaluo_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->id_inspector->Visible) { // id_inspector ?>
	<?php if ($avaluo->SortUrl($avaluo->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $avaluo->id_inspector->HeaderCellClass() ?>"><div id="elh_avaluo_id_inspector" class="avaluo_id_inspector"><div class="ewTableHeaderCaption"><?php echo $avaluo->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $avaluo->id_inspector->HeaderCellClass() ?>"><div><div id="elh_avaluo_id_inspector" class="avaluo_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->id_cliente->Visible) { // id_cliente ?>
	<?php if ($avaluo->SortUrl($avaluo->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $avaluo->id_cliente->HeaderCellClass() ?>"><div id="elh_avaluo_id_cliente" class="avaluo_id_cliente"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $avaluo->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $avaluo->id_cliente->HeaderCellClass() ?>"><div><div id="elh_avaluo_id_cliente" class="avaluo_id_cliente">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $avaluo->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->estadointerno->Visible) { // estadointerno ?>
	<?php if ($avaluo->SortUrl($avaluo->estadointerno) == "") { ?>
		<th data-name="estadointerno" class="<?php echo $avaluo->estadointerno->HeaderCellClass() ?>"><div id="elh_avaluo_estadointerno" class="avaluo_estadointerno"><div class="ewTableHeaderCaption"><?php echo $avaluo->estadointerno->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadointerno" class="<?php echo $avaluo->estadointerno->HeaderCellClass() ?>"><div><div id="elh_avaluo_estadointerno" class="avaluo_estadointerno">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->estadointerno->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->estadointerno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->estadointerno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->estadopago->Visible) { // estadopago ?>
	<?php if ($avaluo->SortUrl($avaluo->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $avaluo->estadopago->HeaderCellClass() ?>"><div id="elh_avaluo_estadopago" class="avaluo_estadopago"><div class="ewTableHeaderCaption"><?php echo $avaluo->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $avaluo->estadopago->HeaderCellClass() ?>"><div><div id="elh_avaluo_estadopago" class="avaluo_estadopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($avaluo->SortUrl($avaluo->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $avaluo->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_avaluo_fecha_avaluo" class="avaluo_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $avaluo->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $avaluo->fecha_avaluo->HeaderCellClass() ?>"><div><div id="elh_avaluo_fecha_avaluo" class="avaluo_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->montoincial->Visible) { // montoincial ?>
	<?php if ($avaluo->SortUrl($avaluo->montoincial) == "") { ?>
		<th data-name="montoincial" class="<?php echo $avaluo->montoincial->HeaderCellClass() ?>"><div id="elh_avaluo_montoincial" class="avaluo_montoincial"><div class="ewTableHeaderCaption"><?php echo $avaluo->montoincial->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="montoincial" class="<?php echo $avaluo->montoincial->HeaderCellClass() ?>"><div><div id="elh_avaluo_montoincial" class="avaluo_montoincial">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->montoincial->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->montoincial->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->montoincial->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($avaluo->id_metodopago->Visible) { // id_metodopago ?>
	<?php if ($avaluo->SortUrl($avaluo->id_metodopago) == "") { ?>
		<th data-name="id_metodopago" class="<?php echo $avaluo->id_metodopago->HeaderCellClass() ?>"><div id="elh_avaluo_id_metodopago" class="avaluo_id_metodopago"><div class="ewTableHeaderCaption"><?php echo $avaluo->id_metodopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_metodopago" class="<?php echo $avaluo->id_metodopago->HeaderCellClass() ?>"><div><div id="elh_avaluo_id_metodopago" class="avaluo_id_metodopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $avaluo->id_metodopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($avaluo->id_metodopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($avaluo->id_metodopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$avaluo_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$avaluo_grid->StartRec = 1;
$avaluo_grid->StopRec = $avaluo_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($avaluo_grid->FormKeyCountName) && ($avaluo->CurrentAction == "gridadd" || $avaluo->CurrentAction == "gridedit" || $avaluo->CurrentAction == "F")) {
		$avaluo_grid->KeyCount = $objForm->GetValue($avaluo_grid->FormKeyCountName);
		$avaluo_grid->StopRec = $avaluo_grid->StartRec + $avaluo_grid->KeyCount - 1;
	}
}
$avaluo_grid->RecCnt = $avaluo_grid->StartRec - 1;
if ($avaluo_grid->Recordset && !$avaluo_grid->Recordset->EOF) {
	$avaluo_grid->Recordset->MoveFirst();
	$bSelectLimit = $avaluo_grid->UseSelectLimit;
	if (!$bSelectLimit && $avaluo_grid->StartRec > 1)
		$avaluo_grid->Recordset->Move($avaluo_grid->StartRec - 1);
} elseif (!$avaluo->AllowAddDeleteRow && $avaluo_grid->StopRec == 0) {
	$avaluo_grid->StopRec = $avaluo->GridAddRowCount;
}

// Initialize aggregate
$avaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$avaluo->ResetAttrs();
$avaluo_grid->RenderRow();
if ($avaluo->CurrentAction == "gridadd")
	$avaluo_grid->RowIndex = 0;
if ($avaluo->CurrentAction == "gridedit")
	$avaluo_grid->RowIndex = 0;
while ($avaluo_grid->RecCnt < $avaluo_grid->StopRec) {
	$avaluo_grid->RecCnt++;
	if (intval($avaluo_grid->RecCnt) >= intval($avaluo_grid->StartRec)) {
		$avaluo_grid->RowCnt++;
		if ($avaluo->CurrentAction == "gridadd" || $avaluo->CurrentAction == "gridedit" || $avaluo->CurrentAction == "F") {
			$avaluo_grid->RowIndex++;
			$objForm->Index = $avaluo_grid->RowIndex;
			if ($objForm->HasValue($avaluo_grid->FormActionName))
				$avaluo_grid->RowAction = strval($objForm->GetValue($avaluo_grid->FormActionName));
			elseif ($avaluo->CurrentAction == "gridadd")
				$avaluo_grid->RowAction = "insert";
			else
				$avaluo_grid->RowAction = "";
		}

		// Set up key count
		$avaluo_grid->KeyCount = $avaluo_grid->RowIndex;

		// Init row class and style
		$avaluo->ResetAttrs();
		$avaluo->CssClass = "";
		if ($avaluo->CurrentAction == "gridadd") {
			if ($avaluo->CurrentMode == "copy") {
				$avaluo_grid->LoadRowValues($avaluo_grid->Recordset); // Load row values
				$avaluo_grid->SetRecordKey($avaluo_grid->RowOldKey, $avaluo_grid->Recordset); // Set old record key
			} else {
				$avaluo_grid->LoadRowValues(); // Load default values
				$avaluo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$avaluo_grid->LoadRowValues($avaluo_grid->Recordset); // Load row values
		}
		$avaluo->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($avaluo->CurrentAction == "gridadd") // Grid add
			$avaluo->RowType = EW_ROWTYPE_ADD; // Render add
		if ($avaluo->CurrentAction == "gridadd" && $avaluo->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$avaluo_grid->RestoreCurrentRowFormValues($avaluo_grid->RowIndex); // Restore form values
		if ($avaluo->CurrentAction == "gridedit") { // Grid edit
			if ($avaluo->EventCancelled) {
				$avaluo_grid->RestoreCurrentRowFormValues($avaluo_grid->RowIndex); // Restore form values
			}
			if ($avaluo_grid->RowAction == "insert")
				$avaluo->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$avaluo->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($avaluo->CurrentAction == "gridedit" && ($avaluo->RowType == EW_ROWTYPE_EDIT || $avaluo->RowType == EW_ROWTYPE_ADD) && $avaluo->EventCancelled) // Update failed
			$avaluo_grid->RestoreCurrentRowFormValues($avaluo_grid->RowIndex); // Restore form values
		if ($avaluo->RowType == EW_ROWTYPE_EDIT) // Edit row
			$avaluo_grid->EditRowCnt++;
		if ($avaluo->CurrentAction == "F") // Confirm row
			$avaluo_grid->RestoreCurrentRowFormValues($avaluo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$avaluo->RowAttrs = array_merge($avaluo->RowAttrs, array('data-rowindex'=>$avaluo_grid->RowCnt, 'id'=>'r' . $avaluo_grid->RowCnt . '_avaluo', 'data-rowtype'=>$avaluo->RowType));

		// Render row
		$avaluo_grid->RenderRow();

		// Render list options
		$avaluo_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($avaluo_grid->RowAction <> "delete" && $avaluo_grid->RowAction <> "insertdelete" && !($avaluo_grid->RowAction == "insert" && $avaluo->CurrentAction == "F" && $avaluo_grid->EmptyRow())) {
?>
	<tr<?php echo $avaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$avaluo_grid->ListOptions->Render("body", "left", $avaluo_grid->RowCnt);
?>
	<?php if ($avaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo"<?php echo $avaluo->codigoavaluo->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_codigoavaluo" class="form-group avaluo_codigoavaluo">
<input type="text" data-table="avaluo" data-field="x_codigoavaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $avaluo->codigoavaluo->EditValue ?>"<?php echo $avaluo->codigoavaluo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_codigoavaluo" class="form-group avaluo_codigoavaluo">
<input type="text" data-table="avaluo" data-field="x_codigoavaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $avaluo->codigoavaluo->EditValue ?>"<?php echo $avaluo->codigoavaluo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_codigoavaluo" class="avaluo_codigoavaluo">
<span<?php echo $avaluo->codigoavaluo->ViewAttributes() ?>>
<?php echo $avaluo->codigoavaluo->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="avaluo" data-field="x_id" name="x<?php echo $avaluo_grid->RowIndex ?>_id" id="x<?php echo $avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($avaluo->id->CurrentValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id" name="o<?php echo $avaluo_grid->RowIndex ?>_id" id="o<?php echo $avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($avaluo->id->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT || $avaluo->CurrentMode == "edit") { ?>
<input type="hidden" data-table="avaluo" data-field="x_id" name="x<?php echo $avaluo_grid->RowIndex ?>_id" id="x<?php echo $avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($avaluo->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($avaluo->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $avaluo->id_solicitud->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($avaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<?php
$wrkonchange = trim(" " . @$avaluo->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$avaluo->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" style="white-space: nowrap; z-index: <?php echo (9000 - $avaluo_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="sv_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo $avaluo->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>"<?php echo $avaluo->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
favaluogrid.CreateAutoSuggest({"id":"x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_solicitud->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_solicitud->ReadOnly || $avaluo->id_solicitud->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($avaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<?php
$wrkonchange = trim(" " . @$avaluo->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$avaluo->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" style="white-space: nowrap; z-index: <?php echo (9000 - $avaluo_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="sv_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo $avaluo->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>"<?php echo $avaluo->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
favaluogrid.CreateAutoSuggest({"id":"x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_solicitud->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_solicitud->ReadOnly || $avaluo->id_solicitud->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_solicitud" class="avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<?php echo $avaluo->id_solicitud->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $avaluo->id_oficialcredito->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_oficialcredito" class="form-group avaluo_id_oficialcredito">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($avaluo->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $avaluo->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_oficialcredito->ReadOnly || $avaluo->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $avaluo->id_oficialcredito->CurrentValue ?>"<?php echo $avaluo->id_oficialcredito->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_oficialcredito" class="form-group avaluo_id_oficialcredito">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($avaluo->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $avaluo->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_oficialcredito->ReadOnly || $avaluo->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $avaluo->id_oficialcredito->CurrentValue ?>"<?php echo $avaluo->id_oficialcredito->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_oficialcredito" class="avaluo_id_oficialcredito">
<span<?php echo $avaluo->id_oficialcredito->ViewAttributes() ?>>
<?php echo $avaluo->id_oficialcredito->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $avaluo->id_inspector->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_inspector" class="form-group avaluo_id_inspector">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $avaluo_grid->RowIndex ?>_id_inspector"><?php echo (strval($avaluo->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $avaluo->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_inspector->ReadOnly || $avaluo->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo $avaluo->id_inspector->CurrentValue ?>"<?php echo $avaluo->id_inspector->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_inspector" class="form-group avaluo_id_inspector">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $avaluo_grid->RowIndex ?>_id_inspector"><?php echo (strval($avaluo->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $avaluo->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_inspector->ReadOnly || $avaluo->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo $avaluo->id_inspector->CurrentValue ?>"<?php echo $avaluo->id_inspector->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_inspector" class="avaluo_id_inspector">
<span<?php echo $avaluo->id_inspector->ViewAttributes() ?>>
<?php echo $avaluo->id_inspector->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $avaluo->id_cliente->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_cliente" class="form-group avaluo_id_cliente">
<select data-table="avaluo" data-field="x_id_cliente" data-value-separator="<?php echo $avaluo->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" name="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente"<?php echo $avaluo->id_cliente->EditAttributes() ?>>
<?php echo $avaluo->id_cliente->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_id_cliente") ?>
</select>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_cliente" class="form-group avaluo_id_cliente">
<select data-table="avaluo" data-field="x_id_cliente" data-value-separator="<?php echo $avaluo->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" name="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente"<?php echo $avaluo->id_cliente->EditAttributes() ?>>
<?php echo $avaluo->id_cliente->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_id_cliente") ?>
</select>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_cliente" class="avaluo_id_cliente">
<span<?php echo $avaluo->id_cliente->ViewAttributes() ?>>
<?php echo $avaluo->id_cliente->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno"<?php echo $avaluo->estadointerno->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_estadointerno" class="form-group avaluo_estadointerno">
<select data-table="avaluo" data-field="x_estadointerno" data-value-separator="<?php echo $avaluo->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" name="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno"<?php echo $avaluo->estadointerno->EditAttributes() ?>>
<?php echo $avaluo->estadointerno->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_estadointerno" class="form-group avaluo_estadointerno">
<select data-table="avaluo" data-field="x_estadointerno" data-value-separator="<?php echo $avaluo->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" name="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno"<?php echo $avaluo->estadointerno->EditAttributes() ?>>
<?php echo $avaluo->estadointerno->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_estadointerno" class="avaluo_estadointerno">
<span<?php echo $avaluo->estadointerno->ViewAttributes() ?>>
<?php echo $avaluo->estadointerno->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $avaluo->estadopago->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_estadopago" class="form-group avaluo_estadopago">
<select data-table="avaluo" data-field="x_estadopago" data-value-separator="<?php echo $avaluo->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" name="x<?php echo $avaluo_grid->RowIndex ?>_estadopago"<?php echo $avaluo->estadopago->EditAttributes() ?>>
<?php echo $avaluo->estadopago->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="o<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="o<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_estadopago" class="form-group avaluo_estadopago">
<select data-table="avaluo" data-field="x_estadopago" data-value-separator="<?php echo $avaluo->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" name="x<?php echo $avaluo_grid->RowIndex ?>_estadopago"<?php echo $avaluo->estadopago->EditAttributes() ?>>
<?php echo $avaluo->estadopago->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_estadopago" class="avaluo_estadopago">
<span<?php echo $avaluo->estadopago->ViewAttributes() ?>>
<?php echo $avaluo->estadopago->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="o<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="o<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $avaluo->fecha_avaluo->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_fecha_avaluo" class="form-group avaluo_fecha_avaluo">
<input type="text" data-table="avaluo" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $avaluo->fecha_avaluo->EditValue ?>"<?php echo $avaluo->fecha_avaluo->EditAttributes() ?>>
<?php if (!$avaluo->fecha_avaluo->ReadOnly && !$avaluo->fecha_avaluo->Disabled && !isset($avaluo->fecha_avaluo->EditAttrs["readonly"]) && !isset($avaluo->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("favaluogrid", "x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_fecha_avaluo" class="form-group avaluo_fecha_avaluo">
<input type="text" data-table="avaluo" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $avaluo->fecha_avaluo->EditValue ?>"<?php echo $avaluo->fecha_avaluo->EditAttributes() ?>>
<?php if (!$avaluo->fecha_avaluo->ReadOnly && !$avaluo->fecha_avaluo->Disabled && !isset($avaluo->fecha_avaluo->EditAttrs["readonly"]) && !isset($avaluo->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("favaluogrid", "x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_fecha_avaluo" class="avaluo_fecha_avaluo">
<span<?php echo $avaluo->fecha_avaluo->ViewAttributes() ?>>
<?php echo $avaluo->fecha_avaluo->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->montoincial->Visible) { // montoincial ?>
		<td data-name="montoincial"<?php echo $avaluo->montoincial->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_montoincial" class="form-group avaluo_montoincial">
<input type="text" data-table="avaluo" data-field="x_montoincial" name="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->montoincial->getPlaceHolder()) ?>" value="<?php echo $avaluo->montoincial->EditValue ?>"<?php echo $avaluo->montoincial->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="o<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="o<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_montoincial" class="form-group avaluo_montoincial">
<input type="text" data-table="avaluo" data-field="x_montoincial" name="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->montoincial->getPlaceHolder()) ?>" value="<?php echo $avaluo->montoincial->EditValue ?>"<?php echo $avaluo->montoincial->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_montoincial" class="avaluo_montoincial">
<span<?php echo $avaluo->montoincial->ViewAttributes() ?>>
<?php echo $avaluo->montoincial->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="o<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="o<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($avaluo->id_metodopago->Visible) { // id_metodopago ?>
		<td data-name="id_metodopago"<?php echo $avaluo->id_metodopago->CellAttributes() ?>>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_metodopago" class="form-group avaluo_id_metodopago">
<select data-table="avaluo" data-field="x_id_metodopago" data-value-separator="<?php echo $avaluo->id_metodopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" name="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago"<?php echo $avaluo->id_metodopago->EditAttributes() ?>>
<?php echo $avaluo->id_metodopago->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago") ?>
</select>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->OldValue) ?>">
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_metodopago" class="form-group avaluo_id_metodopago">
<select data-table="avaluo" data-field="x_id_metodopago" data-value-separator="<?php echo $avaluo->id_metodopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" name="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago"<?php echo $avaluo->id_metodopago->EditAttributes() ?>>
<?php echo $avaluo->id_metodopago->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago") ?>
</select>
</span>
<?php } ?>
<?php if ($avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $avaluo_grid->RowCnt ?>_avaluo_id_metodopago" class="avaluo_id_metodopago">
<span<?php echo $avaluo->id_metodopago->ViewAttributes() ?>>
<?php echo $avaluo->id_metodopago->ListViewValue() ?></span>
</span>
<?php if ($avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="favaluogrid$x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->FormValue) ?>">
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="favaluogrid$o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$avaluo_grid->ListOptions->Render("body", "right", $avaluo_grid->RowCnt);
?>
	</tr>
<?php if ($avaluo->RowType == EW_ROWTYPE_ADD || $avaluo->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
favaluogrid.UpdateOpts(<?php echo $avaluo_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($avaluo->CurrentAction <> "gridadd" || $avaluo->CurrentMode == "copy")
		if (!$avaluo_grid->Recordset->EOF) $avaluo_grid->Recordset->MoveNext();
}
?>
<?php
	if ($avaluo->CurrentMode == "add" || $avaluo->CurrentMode == "copy" || $avaluo->CurrentMode == "edit") {
		$avaluo_grid->RowIndex = '$rowindex$';
		$avaluo_grid->LoadRowValues();

		// Set row properties
		$avaluo->ResetAttrs();
		$avaluo->RowAttrs = array_merge($avaluo->RowAttrs, array('data-rowindex'=>$avaluo_grid->RowIndex, 'id'=>'r0_avaluo', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($avaluo->RowAttrs["class"], "ewTemplate");
		$avaluo->RowType = EW_ROWTYPE_ADD;

		// Render row
		$avaluo_grid->RenderRow();

		// Render list options
		$avaluo_grid->RenderListOptions();
		$avaluo_grid->StartRowCnt = 0;
?>
	<tr<?php echo $avaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$avaluo_grid->ListOptions->Render("body", "left", $avaluo_grid->RowIndex);
?>
	<?php if ($avaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_codigoavaluo" class="form-group avaluo_codigoavaluo">
<input type="text" data-table="avaluo" data-field="x_codigoavaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $avaluo->codigoavaluo->EditValue ?>"<?php echo $avaluo->codigoavaluo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_codigoavaluo" class="form-group avaluo_codigoavaluo">
<span<?php echo $avaluo->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->codigoavaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_codigoavaluo" name="o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $avaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($avaluo->codigoavaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<?php if ($avaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el$rowindex$_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<?php
$wrkonchange = trim(" " . @$avaluo->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$avaluo->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" style="white-space: nowrap; z-index: <?php echo (9000 - $avaluo_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="sv_x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo $avaluo->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>"<?php echo $avaluo->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
favaluogrid.CreateAutoSuggest({"id":"x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_solicitud->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_solicitud->ReadOnly || $avaluo->id_solicitud->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_avaluo_id_solicitud" class="form-group avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" name="o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" id="o<?php echo $avaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_id_oficialcredito" class="form-group avaluo_id_oficialcredito">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito"><?php echo (strval($avaluo->id_oficialcredito->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $avaluo->id_oficialcredito->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_oficialcredito->ReadOnly || $avaluo->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $avaluo->id_oficialcredito->CurrentValue ?>"<?php echo $avaluo->id_oficialcredito->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_id_oficialcredito" class="form-group avaluo_id_oficialcredito">
<span<?php echo $avaluo->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_oficialcredito->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_id_oficialcredito" name="o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $avaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($avaluo->id_oficialcredito->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_id_inspector" class="form-group avaluo_id_inspector">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $avaluo_grid->RowIndex ?>_id_inspector"><?php echo (strval($avaluo->id_inspector->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $avaluo->id_inspector->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($avaluo->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $avaluo_grid->RowIndex ?>_id_inspector',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($avaluo->id_inspector->ReadOnly || $avaluo->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $avaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo $avaluo->id_inspector->CurrentValue ?>"<?php echo $avaluo->id_inspector->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_id_inspector" class="form-group avaluo_id_inspector">
<span<?php echo $avaluo->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_inspector->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_id_inspector" name="o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" id="o<?php echo $avaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($avaluo->id_inspector->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_id_cliente" class="form-group avaluo_id_cliente">
<select data-table="avaluo" data-field="x_id_cliente" data-value-separator="<?php echo $avaluo->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" name="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente"<?php echo $avaluo->id_cliente->EditAttributes() ?>>
<?php echo $avaluo->id_cliente->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_id_cliente") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_id_cliente" class="form-group avaluo_id_cliente">
<span<?php echo $avaluo->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_cliente->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_id_cliente" name="o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" id="o<?php echo $avaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($avaluo->id_cliente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_estadointerno" class="form-group avaluo_estadointerno">
<select data-table="avaluo" data-field="x_estadointerno" data-value-separator="<?php echo $avaluo->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" name="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno"<?php echo $avaluo->estadointerno->EditAttributes() ?>>
<?php echo $avaluo->estadointerno->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_estadointerno" class="form-group avaluo_estadointerno">
<span<?php echo $avaluo->estadointerno->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->estadointerno->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="x<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_estadointerno" name="o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" id="o<?php echo $avaluo_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($avaluo->estadointerno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_estadopago" class="form-group avaluo_estadopago">
<select data-table="avaluo" data-field="x_estadopago" data-value-separator="<?php echo $avaluo->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" name="x<?php echo $avaluo_grid->RowIndex ?>_estadopago"<?php echo $avaluo->estadopago->EditAttributes() ?>>
<?php echo $avaluo->estadopago->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_estadopago" class="form-group avaluo_estadopago">
<span<?php echo $avaluo->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->estadopago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_estadopago" name="o<?php echo $avaluo_grid->RowIndex ?>_estadopago" id="o<?php echo $avaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($avaluo->estadopago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_fecha_avaluo" class="form-group avaluo_fecha_avaluo">
<input type="text" data-table="avaluo" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $avaluo->fecha_avaluo->EditValue ?>"<?php echo $avaluo->fecha_avaluo->EditAttributes() ?>>
<?php if (!$avaluo->fecha_avaluo->ReadOnly && !$avaluo->fecha_avaluo->Disabled && !isset($avaluo->fecha_avaluo->EditAttrs["readonly"]) && !isset($avaluo->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("favaluogrid", "x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_fecha_avaluo" class="form-group avaluo_fecha_avaluo">
<span<?php echo $avaluo->fecha_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->fecha_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_fecha_avaluo" name="o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $avaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($avaluo->fecha_avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->montoincial->Visible) { // montoincial ?>
		<td data-name="montoincial">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_montoincial" class="form-group avaluo_montoincial">
<input type="text" data-table="avaluo" data-field="x_montoincial" name="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->montoincial->getPlaceHolder()) ?>" value="<?php echo $avaluo->montoincial->EditValue ?>"<?php echo $avaluo->montoincial->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_montoincial" class="form-group avaluo_montoincial">
<span<?php echo $avaluo->montoincial->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->montoincial->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="x<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_montoincial" name="o<?php echo $avaluo_grid->RowIndex ?>_montoincial" id="o<?php echo $avaluo_grid->RowIndex ?>_montoincial" value="<?php echo ew_HtmlEncode($avaluo->montoincial->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($avaluo->id_metodopago->Visible) { // id_metodopago ?>
		<td data-name="id_metodopago">
<?php if ($avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_avaluo_id_metodopago" class="form-group avaluo_id_metodopago">
<select data-table="avaluo" data-field="x_id_metodopago" data-value-separator="<?php echo $avaluo->id_metodopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" name="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago"<?php echo $avaluo->id_metodopago->EditAttributes() ?>>
<?php echo $avaluo->id_metodopago->SelectOptionListHtml("x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_avaluo_id_metodopago" class="form-group avaluo_id_metodopago">
<span<?php echo $avaluo->id_metodopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_metodopago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="avaluo" data-field="x_id_metodopago" name="o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" id="o<?php echo $avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($avaluo->id_metodopago->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$avaluo_grid->ListOptions->Render("body", "right", $avaluo_grid->RowIndex);
?>
<script type="text/javascript">
favaluogrid.UpdateOpts(<?php echo $avaluo_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($avaluo->CurrentMode == "add" || $avaluo->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $avaluo_grid->FormKeyCountName ?>" id="<?php echo $avaluo_grid->FormKeyCountName ?>" value="<?php echo $avaluo_grid->KeyCount ?>">
<?php echo $avaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($avaluo->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $avaluo_grid->FormKeyCountName ?>" id="<?php echo $avaluo_grid->FormKeyCountName ?>" value="<?php echo $avaluo_grid->KeyCount ?>">
<?php echo $avaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($avaluo->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="favaluogrid">
</div>
<?php

// Close recordset
if ($avaluo_grid->Recordset)
	$avaluo_grid->Recordset->Close();
?>
<?php if ($avaluo_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($avaluo_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($avaluo_grid->TotalRecs == 0 && $avaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($avaluo_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($avaluo->Export == "") { ?>
<script type="text/javascript">
favaluogrid.Init();
</script>
<?php } ?>
<?php
$avaluo_grid->Page_Terminate();
?>
