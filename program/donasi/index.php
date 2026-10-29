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
$program = $_GET['program']; 
if(empty($program)){
	header("Location: http://dpm.or.id/program");
	die();
}
function FungsiUbahchrkeChar($str){
	$str = str_split($str);
	$karakters = '';
	foreach($str as $karakter){
		if ((ord($karakter)>=65) && (ord($karakter)<=90) || ((ord($karakter)>=48) && (ord($karakter)<=57)))
		{
			// ----------------- enkripsi dan penggeseran urutan $karakter huruf -----------------
			if (ord($karakter)>=78 && (ord($karakter)<=90)) {
				$karakters .= chr((ord($karakter)-13));
			} else if ((ord($karakter)>=65) && (ord($karakter)<=77)) {
				$karakters .= chr((ord($karakter)+13));
			}
			// ----------------- enkripsi dan penggeseran urutan $karakter angka -----------------
			else if ((ord($karakter)>=48) && (ord($karakter)<=52)) {
				$karakters .= chr((ord($karakter)+5));
			}
			else if ((ord($karakter)>=53) && (ord($karakter)<=57)) {
				$karakters .= chr((ord($karakter)-5));
			}
		  
		} else{
		  $karakters .= $karakter;
		}
	}
	return $karakters;
	//return substr_replace($karakters,"/",5).substr($karakters,5,2).'/'.substr($karakters,7);
}
$getid = FungsiUbahchrkeChar($program);
$get_program = mysqli_query($conn, "SELECT * from dpm_program where id_program LIKE '%".$getid."%' AND status=1 ORDER BY createdate");
$rows = mysqli_fetch_assoc($get_program);
if(json_encode($rows) == "null"){
	header("Location: http://dpm.or.id/program");
	die();
}
//echo json_encode(mysqli_fetch_array($get_program));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Yayasan Dana Paramita Majapahit</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@next/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://dpm.or.id/donasi/assets/style.css" rel="stylesheet" type="text/css" />
    <link href="https://dpm.or.id/donasi/assets/foundation.css" rel="stylesheet" type="text/css" />
    <!--Replace with your tailwind.css once created-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js" integrity="sha256-XF29CBwU1MWLaGEnsELogU6Y6rcc5nCkhhx89nFMIDQ=" crossorigin="anonymous"></script>
    <style>
        .worksans {
            font-family: 'Work Sans', sans-serif;
        }
                
        #menu-toggle:checked + #menu {
            display: block;
        }
        
        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }
        
        .hover\:grow:hover {
            transform: scale(1.02);
        }
        
        .carousel-open:checked + .carousel-item {
            position: static;
            opacity: 100;
        }
        
        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }
        
        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
            display: block;
        }
        
        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }
        
        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
            /*Set to match the Tailwind colour you want the active one to be */
        }
		.icon-ico{
			font-size: 23px;
			padding: 20px;
			border-radius: 0px 0px 0px 0px;
			background-color: #3F51B5;
			color: #fff;
			fill: #fff;
		}
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <nav
      class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between navbar-expand-lg" style="background: #ffffff;"
    >
      <div
        class="container mx-auto flex flex-wrap items-center justify-between" style="background: #ffffff;"
      >
        <div
          class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start pl-6 bg_nav_atas"
        >
          <a
            class="text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-no-wrap uppercase text-white"
            href="http://dpm.or.id/"
            >
			<div class="w-6/12 sm:w-6/12">
				<img style="width:140px;" src='https://dpm.or.id/wp-content/uploads/2020/09/Yayasan-Majapahit-01.png'></img>
			</div>
          </a>
		  <button
            class="cursor-pointer text-xl leading-none px-3 pr-6 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
            type="button"
            onclick="toggleNavbar('example-collapse-navbar')"
          >
            <i id="icon_navbar" class="text-gray fas fa-bars"></i>
          </button>
        </div>
        <div
          class="lg:flex flex-grow items-center lg:bg-transparent lg:shadow-none hidden bg_navbar"
          id="example-collapse-navbar"
        >
          <ul class="flex flex-col lg:flex-row list-none lg:ml-auto" >
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-white border-b-2 hover:text-blue-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>BERANDA</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/tentang-kami" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>TENTANG KAMI</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/program" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>PROGRAM</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/berita" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>BERITA</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/kontak" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>KONTAK</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0 display_mob">
					<div class="relative inline-block text-left hidden">
					  <div>
						<span class="rounded-md shadow-sm">
						  <button type="button" onclick="toggleLogin('dropdown-menu')" class="dropdown inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150" id="options-menu" aria-haspopup="true" aria-expanded="true">
														<svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
							  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
							</svg>
						  </button>
						</span>
					  </div>

					  <!--
						Dropdown panel, show/hide based on dropdown state.

						Entering: "transition ease-out duration-100"
						  From: "transform opacity-0 scale-95"
						  To: "transform opacity-100 scale-100"
						Leaving: "transition ease-in duration-75"
						  From: "transform opacity-100 scale-100"
						  To: "transform opacity-0 scale-95"
					  -->
					</div>
				</li>
			</ul>
			<!--div class="relative pull-right pl-4 pr-4 md:pr-0 display_desk">
				<div class="flex flex-row cursor-pointer truncate p-2 px-4  rounded">
				<a href="">
					<div></div>
					<div class="flex flex-row-reverse ml-2 w-full">
						<div slot="icon" class="relative">
							<img src="" alt="..." class="rounded max-w-full w-10 h-auto align-middle border-none" />
						</div>
					</div>
					
				</a>    
				</div>
			</div-->
			<div class="relative pull-right pl-4 pr-4 md:pr-0">
				<a href="http://dpm.or.id/donasi" class="">
					<button class="bg-blue-500 text-white border border-blue-500 font-bold py-2 px-5 " >
					  DONASI
					</button>
				</a>
				<div class="relative inline-block text-left hidden">
				  <div>
					<span class="rounded-md shadow-sm">
					  <button type="button" onclick="toggleLogin('dropdown-menus')" class="dropdown inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150" id="options-menu" aria-haspopup="true" aria-expanded="true">
												<svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
						  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
						</svg>
					  </button>
					</span>
				  </div>

				  <!--
					Dropdown panel, show/hide based on dropdown state.

					Entering: "transition ease-out duration-100"
					  From: "transform opacity-0 scale-95"
					  To: "transform opacity-100 scale-100"
					Leaving: "transition ease-in duration-75"
					  From: "transform opacity-100 scale-100"
					  To: "transform opacity-0 scale-95"
				  -->
				  <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg dropdown-menu hidden" id="dropdown-menus">
					<div class="rounded-md bg-white shadow-xs">
					  <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
	<!--a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">Account settings</a>
	--><a href="http://megaraya.com/hair4allindonesia/list_appointment" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">List Appointment</a>
	<a href="http://megaraya.com/hair4allindonesia/list_order" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">List Order</a>
	<form method="POST" action="http://megaraya.com/hair4allindonesia/action_signout">
	  <button type="submit" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900" role="menuitem">
		Sign out
	  </button>
	</form>
</div>					</div>
				  </div>
				</div>
			</div>
        </div>
      </div>
    </nav>
	<script>
    function toggleLogin(collapseID) {
      document.getElementById(collapseID).classList.toggle("hidden");
      document.getElementById(collapseID).classList.toggle("block");
	}
	</script>
    <!-- MAIN CONTENT max-width:1600px; height: 32rem; background-image: url('https://hair4allindonesia.com/frontend/uploads/hair-replacement-header.jpg');background-repeat: no-repeat;
    background-size: cover;background-position: center center;-->
	<section class="pt-24 w-full mx-auto bg-nordic-gray-light flex md:pt-0 md:items-center bg-cover bg-right mrsection_100 hslider" style="
	background-size: cover;
    background-position: center center;
    width: 100%;
	height: auto;
    background-image: url('https://dpm.or.id/wp-content/uploads/2020/09/Desain-Web-Yayasan-Dana-Paramita-Slider.jpg');
    background-repeat: no-repeat;">
        <!--div class="container mx-auto">
        <div class="flex flex-col w-full lg:w-1/2 justify-center items-start  px-6 tracking-wide">
            <!--h1 class="text-black text-2xl my-4">Stripy Zig Zag Jigsaw Pillow and Duvet Set</h1>
            <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="#">Products</a-->
			
			<!--div class="container mx-auto px-8 py-8 pb-4">

				<div class="w-full mx-auto flex flex-wrap">
					<h1 class="w-full text-2xl md:text-3xl font-bold leading-tight text-left text-gray-800 display_desk">Donasi Program</h1><br><br>
					<form method="post" action="donasiprogram_save.php" enctype="multipart/form-data" id="formData" name="formData" runat="server">
						<div class="col-lg-12">
							<div class="row" style="margin:10px;">
								<div class="col-lg-6">
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Name</label></div>
										<div class="col-lg-8">
											<input type="text" id="name" name="name" class="form-control" required="true">
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Email</label></div>
										<div class="col-lg-8">
											<input type="email" id="email" name="email" class="form-control" required="true">
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Phone</label></div>
										<div class="col-lg-8">
											<input type="text" id="phone" name="phone" class="form-control">
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Alamat </label></div>
										<div class="col-lg-8">
											<textarea class="form-control" name="address" rows="1"></textarea>
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Propinsi</label></div>
										<div class="col-lg-8">
											<select name="prop" id="prop" class="form-control" onchange="callkabupaten()" style="margin-bottom:5px;height: 30px;" required="true"><option value=""> Pilih Propinsi </option><option value="94">Papua</option><option value="91">Papua Barat</option><option value="82">Maluku Utara</option><option value="81">Maluku</option><option value="76">Sulawesi Barat</option><option value="75">Gorontalo</option><option value="74">Sulawesi Tenggara</option><option value="73">Sulawesi Selatan</option><option value="72">Sulawesi Tengah</option><option value="71">Sulawesi Utara</option><option value="65">Kalimantan Utara</option><option value="64">Kalimantan Timur</option><option value="63">Kalimantan Selatan</option><option value="62">Kalimantan Tengah</option><option value="61">Kalimantan Barat</option><option value="53">Nusa Tenggara Timur</option><option value="52">Nusa Tenggara Barat</option><option value="51">Bali</option><option value="36">Banten</option><option value="35">Jawa Timur</option><option value="34">Di Yogyakarta</option><option value="33">Jawa Tengah</option><option value="32">Jawa Barat</option><option value="31">Dki Jakarta</option><option value="21">Kepulauan Riau</option><option value="19">Kepulauan Bangka Belitung</option><option value="18">Lampung</option><option value="17">Bengkulu</option><option value="16">Sumatera Selatan</option><option value="15">Jambi</option><option value="14">Riau</option><option value="13">Sumatera Barat</option><option value="12">Sumatera Utara</option><option value="11">Aceh</option>
												</select>					</div>
									</div>
									<div class="row">
										<div class="col-lg-4"><label>Kabupaten</label></div>
										<div class="col-lg-8">
											<select name="kot" id="kot" class="form-control" onchange="callkecamatan()" style="margin-bottom:5px;height: 30px;" required="true">
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4"><label>Kecamatan</label></div>
										<div class="col-lg-8">
											<select name="kec" id="kec" class="form-control" onchange="callkelurahan()" style="margin-bottom:5px;height: 30px;" required="true">
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4"><label>Desa</label></div>
										<div class="col-lg-8">
											<select name="kel" id="kel" class="form-control" onchange="callkodepos()" style="margin-bottom:5px;height: 30px;" required="true">
												<option value=""></option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-4"><label>Kodepos</label></div>
										<div class="col-lg-8">
											<select name="kodepos" id="kodepos" class="form-control" style="margin-bottom:5px;height: 30px;" required="true">
												<option value=""></option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Program</label></div>
										<div class="col-lg-8">
											<input type="text" class="form-control" required="true" readonly="true" value="PENGOBATAN ROMO UP. PANDITA Dr. Alimin ">
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Kode Program</label></div>
										<div class="col-lg-8">
											<input type="text" id="progdonasi" name="progdonasi" class="form-control" required="true" readonly="true" value="PR00000036">
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Jumlah</label></div>
										<div class="col-lg-8">
											<div class="input-group">
												<span class="input-group-addon">Rp</span>
												<input type="text" id="jumlah" name="jumlah" class="form-control" required="true" onkeypress="return (event.charCode >= 48 &amp;&amp; event.charCode <= 57) || event.charCode == 8 || event.keyCode  == 8 || event.charCode == 46 || event.keyCode  == 46">
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Bank Account</label></div>
										<div class="col-lg-8">
											<select name="idbankaccount" id="idbankaccount" class="form-control" style="margin-bottom:5px;height: 30px;" required="true"><option value=""> Pilih Bank Tujuan </option><option value="4">BCA - 2886076808 / Yayasan Dana Paramita Agama Buddha Indonesia</option><option value="5">BRI - 111801000366305 / Yayasan Dana Paramita Agama Buddha Indonesia</option><option value="6">GOPAY - 081219272299 / Yayasan Dana Paramita Agama Buddha Indonesia</option>
												</select>					</div>
									</div>
									<div class="row">
										<div class="col-lg-4"><label>NPWP</label></div>
										<div class="col-lg-8">
											<input type="text" id="npwp" name="npwp" class="form-control">
										</div>
									</div>
									<div class="row" style="margin-top:5px;">
										<div class="col-lg-4"><label>Note</label></div>
										<div class="col-lg-8">
											<input type="text" id="keterangan" name="keterangan" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<button type="submit" class="btn btn-white btn-sm btn-block" style="color:#000;background-clip: padding-box;background-color: yellow;border-color: rgba(150, 160, 180, 0.3);box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.05) inset;"><i class="icon-plus-sign"></i> Konfirmasi</button>
									</div>
								</div>
							</div>
						</div>
					  </form>
				</div>


			</div>
		</div>
        </div-->
		
		<div class="container mx-auto md:mt-24 mb-4 bg-white rounded-lg">
        <div class="w-full mx-auto flex flex-wrap mt-4">
            <div class="flex w-full md:w-1/2">
				<div class="w-full f flex-col md:flex-row mx-6">
					<div class="p-4 px-0 bg-gray-100 rounded-full">
						<h1 class="ml-4 font-bold uppercase">Donasi Program</h1>
					</div>
				</div>
			</div>
		</div>
        <div class="w-full mx-auto flex flex-wrap">
            <div class="flex w-full md:w-1/2">
				<div class="w-full f flex-col md:flex-row mx-6">
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
							<h1 class="font-bold md:mt-3">Name</h1>                 
						</div>
					</div>
                    <div class="w-full flex flex-col md:flex-row mt-2">
                        <div class="flex-1 px-2 text-left">
							<div class="relative">
								<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="fname" type="text" autofocus="">
							</div>                        
						</div>
                    </div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
								<h1 class="font-bold md:mt-3">Email</h1>                 
						</div>
					</div>
                    <div class="w-full flex flex-col md:flex-row mt-2">
                        <div class="flex-1 px-2 text-left">
							<div class="relative">
								<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="femail" type="text" autofocus="">
							</div>                        
						</div>
                    </div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
								<h1 class="font-bold md:mt-3">Phone</h1>              
						</div>
					</div>
                    <div class="w-full flex flex-col md:flex-row mt-2">
                        <div class="flex-1 px-2 text-left">
							<div class="relative">
								<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="fphone" type="text" autofocus="">
							</div>                        
						</div>
                    </div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
								<h1 class="mt-6 font-bold md:mt-3">Alamat</h1>              
						</div>
					</div>
                    <div class="w-full flex flex-col md:flex-row mt-2">
                        <div class="flex-1 px-2 text-left">
							<div class="relative">
								<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="falamat" type="text" autofocus="">
							</div>                        
						</div>
                    </div>
					<div id="opsi_pengiriman2" class="">
						<div class="w-full flex flex-col md:flex-row">
							<div class="flex-1 px-2 text-left">
								<h1 class="mt-6 font-bold md:mt-3">Provinsi</h1>                
							</div>
						</div>

						<div class="w-full relative flex-col md:flex-row">
							<div class="flex-1 px-2 text-center">
								<select name="prop" id="prop" onchange="callkabupaten()" class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
									<option value=""> Pilih Propinsi </option>
									<option value="94">Papua</option>
									<option value="91">Papua Barat</option>
									<option value="82">Maluku Utara</option>
									<option value="81">Maluku</option>
									<option value="76">Sulawesi Barat</option>
									<option value="75">Gorontalo</option>
									<option value="74">Sulawesi Tenggara</option>
									<option value="73">Sulawesi Selatan</option>
									<option value="72">Sulawesi Tengah</option>
									<option value="71">Sulawesi Utara</option>
									<option value="65">Kalimantan Utara</option>
									<option value="64">Kalimantan Timur</option>
									<option value="63">Kalimantan Selatan</option>
									<option value="62">Kalimantan Tengah</option>
									<option value="61">Kalimantan Barat</option>
									<option value="53">Nusa Tenggara Timur</option>
									<option value="52">Nusa Tenggara Barat</option>
									<option value="51">Bali</option>
									<option value="36">Banten</option>
									<option value="35">Jawa Timur</option>
									<option value="34">Di Yogyakarta</option>
									<option value="33">Jawa Tengah</option>
									<option value="32">Jawa Barat</option>
									<option value="31">Dki Jakarta</option>
									<option value="21">Kepulauan Riau</option>
									<option value="19">Kepulauan Bangka Belitung</option>
									<option value="18">Lampung</option>
									<option value="17">Bengkulu</option>
									<option value="16">Sumatera Selatan</option>
									<option value="15">Jambi</option>
									<option value="14">Riau</option>
									<option value="13">Sumatera Barat</option>
									<option value="12">Sumatera Utara</option>
									<option value="11">Aceh</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700" style="right: 10px;">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col md:flex-row">
							<div class="flex-1 px-2 text-left">
								<h1 class="mt-6 font-bold md:mt-3">Kabupaten</h1>                
							</div>
						</div>
						<div class="w-full relative flex-col md:flex-row">
							<div class="flex-1 px-2 text-center">
								<select name="kot" id="kot" onchange="callkecamatan()" class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600 disabled" disabled=""><option value="0">-PILIH-</option></select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700" style="right: 10px;">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col md:flex-row">
							<div class="flex-1 px-2 text-left">
								<h1 class="mt-6 font-bold md:mt-3">Kecamatan</h1>                
							</div>
						</div>
						<div class="w-full relative flex-col md:flex-row">
							<div class="flex-1 px-2 text-center">
								<select name="kec" id="kec" onchange="callkelurahan()" class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600 disabled" disabled=""><option value="0">-PILIH-</option></select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700" style="right: 10px;">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col md:flex-row">
							<div class="flex-1 px-2 text-left">
								<h1 class="mt-6 font-bold md:mt-3">Desa</h1>                
							</div>
						</div>
						<div class="w-full relative flex-col md:flex-row">
							<div class="flex-1 px-2 text-center">
								<select name="kel" id="kel" onchange="callkodepos()" class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600 disabled" disabled=""><option value="0">-PILIH-</option></select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700" style="right: 10px;">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div class="w-full flex flex-col md:flex-row">
							<div class="flex-1 px-2 text-left">
								<h1 class="mt-6 font-bold md:mt-3">Kodepos</h1>                
							</div>
						</div>
						<div class="w-full relative flex-col md:flex-row">
							<div class="flex-1 px-2 text-center">
								<select name="kodepos" id="kodepos" class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600 disabled" disabled=""><option value="0">-PILIH-</option></select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700" style="right: 10px;">
									<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
										<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
									</svg>
								</div>
							</div>
						</div>
						<div class="flex justify-between border-b mt-6 display:none radioservice" id="radioservice"></div>
					</div>
                </div>
            </div>
			
            <div class="flex w-full md:w-1/2 text-left">
				<div class="w-full relative flex-col md:flex-row mx-2">
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
							<h1 class="mt-6 font-bold md:mt-3">Program</h1>                
						</div>
					</div>
					<div class="w-full relative flex-col md:flex-row mt-2">
						<div class="flex-1 px-2 text-center">
							<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="fprogram" type="text" value="<?php echo $rows["judul"]; ?>" autofocus="" disabled>
						</div>
					</div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
							<h1 class="mt-6 font-bold md:mt-3">Kode Program</h1>                
						</div>
					</div>
					<div class="w-full relative flex-col md:flex-row mt-2">
						<div class="flex-1 px-2 text-center">
							<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="fkodeprogram" type="text" value="<?php echo $getid; ?>" autofocus="" disabled>
						</div>
					</div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
							<h1 class="mt-6 font-bold md:mt-3">Jumlah</h1>                
						</div>
					</div>
					<div class="w-full relative flex-col md:flex-row mt-2">
						<div class="flex px-2 flex-wrap items-stretch w-full relative">
							<div class="flex -mr-px">
								<span class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">Rp</span>
							</div>	
							<input type="text" class="flex-shrink flex-grow flex-auto leading-normal w-px py-5 flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative focus:border-blue focus:shadow" id="fjumlah" placeholder="">
						</div>	
					</div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
							<h1 class="mt-6 font-bold md:mt-3">Bank Account</h1>                
						</div>
					</div>

					<div class="w-full relative flex-col md:flex-row">
						<div class="flex-1 px-2 text-center">
							<select name="pilihbank" id="pilihbank" class="block appearance-none w-full bg-white border border-gray-400 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600">
								<option value=""> Pilih Bank Tujuan </option>
								<option value="4">BCA - 2886076808 / Yayasan Dana Paramita Agama Buddha Indonesia</option>
								<option value="5">BRI - 111801000366305 / Yayasan Dana Paramita Agama Buddha Indonesia</option>
								<option value="6">GOPAY - 081219272299 / Yayasan Dana Paramita Agama Buddha Indonesia</option>
							</select>
							<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700" style="right: 10px;">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
									<path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
								</svg>
							</div>
						</div>
					</div>
					<div class="w-full flex flex-col md:flex-row mt-2">
						<div class="flex-1 px-2 text-left">
							<h1 class="mt-6 font-bold md:mt-3">NPWP</h1>                
						</div>
					</div>
					<div class="w-full relative flex-col md:flex-row mt-1">
						<div class="flex-1 px-2 text-center">
							<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="fnpwp" type="text" autofocus="">
						</div>
					</div>
					<div class="w-full flex flex-col md:flex-row">
						<div class="flex-1 px-2 text-left">
							<h1 class="mt-6 font-bold md:mt-3">Note</h1>                
						</div>
					</div>
					<div class="w-full relative flex-col md:flex-row">
						<div class="flex-1 px-2 text-center">
							<input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" id="fnote" type="text" autofocus="">
						</div>
						<div class="flex-1 px-2 mt-4 text-right" style='margin-bottom: 40px;'>
							<a onclick="" class="bg-blue-700 text-white border border-blue-700 font-bold py-2 px-12">
							  Konfirmasi
							</a>
						</div>
					</div>
				</div>
            </div>
        </div>
        </div>
		<!-- -->
    </section>
    <!-- MAIN CONTENT-->

    
    <footer style="background-color:#222222">
        <div>
            <h1 class="text-white leading-tight text-center p-8">
                Copyright © 2020 Yayasan Dana Paramita Majapahit – Develop by Omegasoft</h1>
        </div>
    </footer>
    <script src="https://dpm.or.id/donasi/assets/jquery.event.move.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
	<script language="JavaScript" type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
	var cart=0;
    $(function(){
	  cart = 0;
      //$("#jml_cart").text(cart);
	  //$("#jml_cart2").text(cart);	  
    });
    </script>
    <script>
    function toggleLogin(collapseID) {
      document.getElementById(collapseID).classList.toggle("hidden");
      document.getElementById(collapseID).classList.toggle("block");
	}
    function toggleNavbar(collapseID) {
	  document.getElementById('icon_navbar').classList.toggle("fa-bars");
	  document.getElementById('icon_navbar').classList.toggle("fa-times");
      document.getElementById(collapseID).classList.toggle("hidden");
      document.getElementById(collapseID).classList.toggle("block");
    }
	function callkabupaten(){
		var prop = $("#prop").val();
		if (prop == "") {
			return false;
		} else {
			$.ajax
			({ type: "POST",
			url: "https://danaparamitaabi.or.id/combo/kabupaten.php",
			data: "prop="+prop,
			success: function(option)
				{
					document.getElementById("kot").disabled = false;
					$("#kot").html(option); 
					$("#kec").html('null');
					$("#kel").html('null');
					$("#kodepos").html('null');
				}
			});
		}
	}
	function callkecamatan(){
		var kot = $("#kot").val();
		if (kot == "") {
			return false;
		} else {
			$.ajax
			({ type: "POST",
			url: "https://danaparamitaabi.or.id/combo/kecamatan.php",
			data: "kot="+kot,
			success: function(option)
				{ 
					document.getElementById("kec").disabled = false;
					$("#kec").html(option); 
					$("#kel").html('null');
					$("#kodepos").html('null');
				}
			});
		}
	}
	function callkelurahan(){
		var kec = $("#kec").val();
		if (kec == "") {
			return false;
		} else {
			$.ajax
			({ type: "POST",
			url: "https://danaparamitaabi.or.id/combo/kelurahan.php",
			data: "kec="+kec,
			success: function(option)
				{ 
					document.getElementById("kel").disabled = false;
					$("#kel").html(option); 
					$("#kodepos").html('null');
				}
			});
		}
	}
	function callkodepos(){
		var kel = $("#kel").val();
		if (kel == "") {
			return false;
		} else {
			$.ajax
			({ type: "POST",
			url: "https://danaparamitaabi.or.id/combo/kodepos.php",
			data: "kel="+kel,
			success: function(option)
				{ 
					document.getElementById("kodepos").disabled = false;
					$("#kodepos").html(option); 
				}
			});
		}
	}
    /*Toggle dropdown list*/
    /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

    /*var userMenuDiv = document.getElementById("userMenu");
    var userMenu = document.getElementById("userButton");

    var navMenuDiv = document.getElementById("nav-content");
    var navMenu = document.getElementById("nav-toggle");

    document.onclick = check;

    function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //User Menu
        if (!checkParent(target, userMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, userMenu)) {
                // click on the link
                if (userMenuDiv.classList.contains("invisible")) {
                    userMenuDiv.classList.remove("invisible");
                } else { userMenuDiv.classList.add("invisible"); }
            } else {
                // click both outside link and outside menu, hide menu
                userMenuDiv.classList.add("invisible");
            }
        }

        //Nav Menu
        if (!checkParent(target, navMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, navMenu)) {
                // click on the link
                if (navMenuDiv.classList.contains("hidden")) {
                    navMenuDiv.classList.remove("hidden");
                } else { navMenuDiv.classList.add("hidden"); }
            } else {
                // click both outside link and outside menu, hide menu
                navMenuDiv.classList.add("hidden");
            }
        }

    }

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) { return true; }
            t = t.parentNode;
        }
        return false;
    }*/
    </script>
</body>

</html>