<?php
// Robinson Coello 
//-----------------
// http://php.net/manual/es/function.number-format.php	  
// http://www.php.net/manual/fr/ref.bc.php
// http://www.informaticien.be/forum_topic-2564--Generer_une_communication_structuree.html
// Transaccion 
// extructura ano factura numeroControl precede de ceros hasta completar 12 numeros 
// ejemplo: 0000 2014 77 97
//
// 2 para el digito de control 
// 3 espacios para el numero de factura 
// 2 para el ano
// 5 para la cantidad 99.999 (sin decimales)
// 12345 12 123 12
// fomateamos y queda asi 
// +++123/4512/12312+++	
//		   
//		   
// Usada en : 
// /factura_nueva.php
function generate_structured_communication($tr) {  
$transactionID = date('Y')."$tr";
$control = bcmod($transactionID, 97);
$control = ($control == "0") ? "97" : $control;
if ($control < 10) {
$control = "0" . $control;
}
$count = 10 - strlen($transactionID);
for ($i=0; $i < $count; $i++) {
$transactionID = "0" . $transactionID;
}
$com = $transactionID . $control;
return '+++'.substr($com, 0, 3) . "/" . substr($com, 3, 4) . "/" . substr($com, 7, 5).'+++';
}
