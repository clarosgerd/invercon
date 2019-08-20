<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(57, "mi_viewavaluo", $Language->MenuPhrase("57", "MenuText"), "viewavaluolist.php?cmd=resetall", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}viewavaluo'), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(58, "mi_viewsolicitud", $Language->MenuPhrase("58", "MenuText"), "viewsolicitudlist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}viewsolicitud'), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(55, "mi_pago", $Language->MenuPhrase("55", "MenuText"), "pagolist.php?cmd=resetall", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}pago'), FALSE, FALSE, "fa fa-pie-chart");
$RootMenu->AddMenuItem(54, "mi_emailnotificaciones", $Language->MenuPhrase("54", "MenuText"), "emailnotificacioneslist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}emailnotificaciones'), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(48, "mi_calendario_php", $Language->MenuPhrase("48", "MenuText"), "calendario.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}calendario.php'), FALSE, TRUE, "fa fa-files-o");
$RootMenu->AddMenuItem(43, "mi_notificaciones", $Language->MenuPhrase("43", "MenuText"), "notificacioneslist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}notificaciones'), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(38, "mi_inspector", $Language->MenuPhrase("38", "MenuText"), "inspectorlist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}inspector'), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(39, "mi_oficialcredito", $Language->MenuPhrase("39", "MenuText"), "oficialcreditolist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}oficialcredito'), FALSE, FALSE, "fa fa-pie-chart");
$RootMenu->AddMenuItem(40, "mi_supervisor", $Language->MenuPhrase("40", "MenuText"), "supervisorlist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}supervisor'), FALSE, FALSE, "fa fa-pie-chart");
$RootMenu->AddMenuItem(9, "mi_asesor", $Language->MenuPhrase("9", "MenuText"), "asesorlist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}asesor'), FALSE, FALSE, "fa fa-laptop");
$RootMenu->AddMenuItem(23, "mi_cliente", $Language->MenuPhrase("23", "MenuText"), "clientelist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}cliente'), FALSE, FALSE, "fa fa-pie-chart");
$RootMenu->AddMenuItem(10, "mi_avaluo", $Language->MenuPhrase("10", "MenuText"), "avaluolist.php?cmd=resetall", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}avaluo'), FALSE, FALSE, "fa fa-pie-chart");
$RootMenu->AddMenuItem(3, "mi_solicitud", $Language->MenuPhrase("3", "MenuText"), "solicitudlist.php", -1, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}solicitud'), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(20, "mci_ADMINISTRACION", $Language->MenuPhrase("20", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa-bank");
$RootMenu->AddMenuItem(5, "mi_usuario", $Language->MenuPhrase("5", "MenuText"), "usuariolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}usuario'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(2, "mi_provincia", $Language->MenuPhrase("2", "MenuText"), "provincialist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}provincia'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(1, "mi_departamento", $Language->MenuPhrase("1", "MenuText"), "departamentolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}departamento'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(26, "mi_estadointerno", $Language->MenuPhrase("26", "MenuText"), "estadointernolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}estadointerno'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(25, "mi_estadopago", $Language->MenuPhrase("25", "MenuText"), "estadopagolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}estadopago'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(24, "mi_estado", $Language->MenuPhrase("24", "MenuText"), "estadolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}estado'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(32, "mi_tipoinmueble", $Language->MenuPhrase("32", "MenuText"), "tipoinmueblelist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}tipoinmueble'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(35, "mi_banco", $Language->MenuPhrase("35", "MenuText"), "bancolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}banco'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(36, "mi_metodopago", $Language->MenuPhrase("36", "MenuText"), "metodopagolist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}metodopago'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(31, "mi_sucursal", $Language->MenuPhrase("31", "MenuText"), "sucursallist.php", 20, "", AllowListMenu('{30AA0C25-B486-48CC-AF92-47D039BF725C}sucursal'), FALSE, FALSE, "fa fa-circle-o");
$RootMenu->AddMenuItem(46, "mi_userlevelpermissions", $Language->MenuPhrase("46", "MenuText"), "userlevelpermissionslist.php", 20, "", IsAdmin(), FALSE, FALSE, "fa fa-files-o");
$RootMenu->AddMenuItem(47, "mi_userlevels", $Language->MenuPhrase("47", "MenuText"), "userlevelslist.php", 20, "", IsAdmin(), FALSE, FALSE, "fa fa-files-o");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
