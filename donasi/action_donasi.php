<?php
$servername = "36.92.71.157";
$database = "dpm";
$username = "omegasoft";
$password = "0M3g450ft";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$fname 		= $_POST['fname'];
$femail 	= $_POST['femail'];
$fphone 	= $_POST['fphone'];
$falamat 	= $_POST['falamat'];
$prop 		= $_POST['prop'];
$kot 		= $_POST['kot'];
$kec 		= $_POST['kec'];
$kel 		= $_POST['kel'];
$kodepos 	= $_POST['kodepos'];
$fjumlah 	= $_POST['fjumlah'];
$pilihbank 	= $_POST['pilihbank'];
$fnpwp 		= $_POST['fnpwp'];
$fnote 		= $_POST['fnote'];
if($fname!='' && $femail!='' && $fphone!='' && $falamat!='' && $prop!='' && $kot!='' && $kec!='' &&
$kel!='' && $kodepos!='' && $fjumlah!='' && $pilihbank!='' && $fnpwp!='' && $fnote!=''){
	$program = mysqli_query($conn, "INSERT INTO dpm_donasi (nama,email,phone,alamat,prop,kot,kec,kel,kodepos,jumlah,bank,npwp,note) VALUES 
	('".$fname."','".$femail."','".$fphone."','".$falamat."','".$prop."','".$kot."','".$kec."',
	'".$kel."','".$kodepos."','".$fjumlah."','".$pilihbank."','".$fnpwp."','".$fnote."')");
	if($program){
		echo 200;
	}else{
		echo 400;
	}
}

?>