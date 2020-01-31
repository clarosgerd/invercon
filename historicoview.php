<?php
//echo "hola";
//echo $_GET['id'];
//echo $_GET['type'];
//$_GET['case']case=of
/*
if (isset($_GET['id']) || isset($_GET['type']) || isset($_GET['case'])) { /// all

if ($_GET['case']=="sec") ////if of
{
if ($_GET['type']=="validar")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";



			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();

		$core_php->setSuccessMessage($sData);
		//ew_SendEmail()

		//$core_php->s
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
//email
if ($_GET['type']=="email")
{

	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();
		$assunto = "Actualizacion de Documentos";
		$texto = $sData;


		$email_envio = ew_ExecuteScalar("SELECT  max(login) as login FROM usuario WHERE id_rol=3 and id_sucursal = '" . ew_AdjustSql($_SESSION["sucursal"]) . "'");

		if (isset($email_envio))
		{
		$Email = new cEmail;
		$Email->Sender="tester@communitysoft.org";
		$Email->AddRecipient($email_envio);
		$Email->AddCc($email_contacto);
		$Email->Subject = $assunto;
		$Email->Content = $sData;
		$Email->Recipient = $email_envio;
		$bEmailSent = $Email->Send();

		$sql_new="INSERT INTO `emailnotificaciones` (`enviadopor`, `recibidopor`, `cc`, `bcc`, `mensaje`, `leido`, `estado`, `fechaenvio`, `fecharecibido`) VALUES ('".$_SESSION["usr"]."', '".$email_envio."', NULL, NULL, '".$texto."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
		$MyResult = ew_Execute($sql_new);
			$core_php->setSuccessMessage("Correo enviado");
		}
		else{
			$core_php->setFailureMessage("Correo no enviado");
		}
	//	var_dump($bEmailSent);
		//$core_php->s

		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
////

if ($_GET['type']=="notify")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();

		$assunto = "Actualizacion de Documentos";
		$texto = $sData;
		$email_envio = ew_ExecuteScalar("SELECT  max(login) as login FROM usuario WHERE id_rol=3 and id_sucursal = '" . ew_AdjustSql($_SESSION["sucursal"]) . "'");

		if (isset($email_envio)) {
			$sql_new = "INSERT INTO `notificaciones` (`mensaje`, `creadopor`, `recibidopor`, `leido`, `estado`, `fecha`, `fechaleido`) VALUES ('mensaje', '" . $_SESSION["usr"] . "', '" . $email_envio . "', '0', '0', NOW(), NOW())";
			$MyResult = ew_Execute($sql_new);
			$core_php->setSuccessMessage("Notificacion enviada");
			header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
			exit;
		}else{

			$core_php->setFailureMessage("Notificacion no enviada");
			header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
			exit;
		}
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
if ($_GET['type']=="notifylearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE notificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Notificacion Leida");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}
if ($_GET['type']=="emaillearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Correo Leido");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}

if ($_GET['type']=="smslearn")
{
//	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
//	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("SMS enviado");
	header('Location:viewsolicitudedit.php?showdetail=&id='.$_GET['id']);
	exit;

}
}/////else of
else{
if ($_GET['type']=="validar")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";



			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();
		$core_php->setSuccessMessage($sData);
		//ew_SendEmail()

		//$core_php->s
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
//email
if ($_GET['type']=="email")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();
		$assunto = "Documentos Faltantes";
		$texto = $sData;

		$Email = new cEmail;
		$Email->Sender="tester@communitysoft.org";
		$Email->AddRecipient($email);
		$Email->AddCc($email_contacto);

		$Email->Subject = $assunto;
		$Email->Content = $sData;
		
		//$Email->Sender ="tester@communitysoft.org";
		$Email->Recipient = $email;
		
		$bEmailSent = $Email->Send();

		

		$sql_new="INSERT INTO `emailnotificaciones` (`enviadopor`, `recibidopor`, `cc`, `bcc`, `mensaje`, `leido`, `estado`, `fechaenvio`, `fecharecibido`) VALUES ('".$_SESSION["usr"]."', '".$email."', NULL, NULL, '".$texto."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
		$MyResult = ew_Execute($sql_new);
		
	//	var_dump($bEmailSent);
		//$core_php->s
		$core_php->setSuccessMessage("Correo enviado");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
////


if ($_GET['type']=="notify")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();

		$assunto = "Documentos Faltantes";
		$texto = $sData;

		$MyResult = ew_Execute($sql_new);
		$core_php->setSuccessMessage("Notificacion enviada");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}




////
if ($_GET['type']=="notifylearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE notificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Notificacion Leida");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}
if ($_GET['type']=="emaillearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Correo Leido");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}

if ($_GET['type']=="smslearn")
{
//	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
//	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("SMS enviado");
	header('Location:solicitudedit.php?showdetail=&id='.$_GET['id']);
	exit;

}
}

}else{

	header('Location:viewsolicitudlist.php');
	exit;
}
*/
if (isset($_GET['id']) || isset($_GET['type']) || isset($_GET['case'])) { /// all
if ($_GET['case']=="sec")
{


switch ($_GET['type']) {


	case "emailof":
		$core_php->setSuccessMessage("email enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;
	case "pagado":
		$core_php->setSuccessMessage("SMS enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;

	case "email":
	
			$Sql="SELECT solicitud.email FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
	$TheQuery=$Sql." WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
	$email = ew_ExecuteScalar($TheQuery);
	

		if (isset($email))
		{
		$Email = new cEmail;
		$Email->Sender="tester@communitysoft.org";
		$Email->AddRecipient($email);
		$Email->AddCc($email_contacto);
		$Email->Subject = $assunto;
		$Email->Content = $sData;
		$Email->Recipient = $email_envio;
		$bEmailSent = $Email->Send();
		$core_php->setSuccessMessage("Correo enviado");
		}
		else{
			$core_php->setFailureMessage("Correo no enviado");
		}

	$core_php->setSuccessMessage("Email enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;
	case "whataspp":
	$core_php->setSuccessMessage("WhatsApp enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;
	case "whatasppapi":
	$Sql="SELECT solicitud.cell FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
	$TheQuery=$Sql." WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
	$celular = ew_ExecuteScalar($TheQuery);
	
// https://eu84.chat-api.com/instance89383/ and token fa83g4xkqmnl36lf
	$apiURL = 'https://eu84.chat-api.com/instance89383/';
	$token = 'fa83g4xkqmnl36lf';

	$message = "Su avaluo fue terminado pase por la oficina para cancelar el costo ";
	$phone = $celular;
	$data = json_encode(
	array(
		'chatId'=>$phone.'@c.us',
		'body'=>$message
	)
	);
	$url = $apiURL.'message?token='.$token;
	$options = stream_context_create(
	array('http' =>
		array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $data
		)
		)
		);
	$response = file_get_contents($url,false,$options);
	$core_php->setSuccessMessage("WHATAPP enviado");
	header('Location:viewavaluosclist.php');
	exit;
		break;
	case "sms":
	   $Sql="SELECT solicitud.cell FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
		$TheQuery=$Sql." WHERE avaluo.id = '" . ew_AdjustSql($_GET['id']) . "'";
		$celular = ew_ExecuteScalar($TheQuery);
		$sms_msg= ew_Execute("insert into sms_data (celular,mensaje) values ('".$celular."','Su avaluo fue terminado pase por la oficina para cancelar el saldo')");
		$core_php->setSuccessMessage("SMS enviado");
	    header('Location:viewavaluosclist.php');
	    exit;
		break;
}
}
//echo $response; exit;
}

?>
