<?php
$prop = $_POST['prop'];
if($prop){
	$data = array("namatable"=>'jwstflkab',"provinsi"=>$prop);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://danaparamitaabi.or.id/modul/lokasi.php");
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	$request = curl_exec($curl);
	$return = ($request === FALSE) ? curl_error($curl) : $request;
	curl_close($curl);
	echo $return;
}else{
	echo 404;
}
?>