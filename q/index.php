<style>
.test [class*="col-"] {
  padding: 15px;
  background-color: #f1f1f1;
  border: 1px solid #D8D8D8;
  color: #333;
}
</style>
<?php
$title = "Program Donasi";
$tags = $_GET['donasi'];
if($tags != ''){
	$tags = str_replace('+',' ',$tags);
	$connect = odbc_connect('Driver={ODBC Driver 17 for SQL Server}; Server=36.92.71.153\\opc; Database=OmegaCloud;',  'RND_ROHMAN', 'rndomega');
	$sqlq = "select d.Keterangan, d.Jml, m.Tgl
	from MasterBank m, DetailBank d
	where m.NoVoucher like '009H2%' 
	and ISNULL(m.Keterangan,'') LIKE '%".$tags."%'
	and m.NoVoucher=d.NoVoucher
	order by m.CreateDate";
	$result = odbc_exec($connect, $sqlq);
	
	$sqlq1 = "select Keterangan, SUM(Total) Total, MAX(Tgl) LastTgl 
	from MasterBank 
	where NoVoucher like '009H2%' 
	and ISNULL(Keterangan,'') LIKE '".$tags."'
	GROUP BY Keterangan";
	$result1 = odbc_exec($connect, $sqlq1);
	$arr = odbc_fetch_array($result1);
	$title = $arr['Keterangan'];
	$totalDonasi = $arr['Total'];
}else{
	$connect = odbc_connect('Driver={ODBC Driver 17 for SQL Server}; Server=36.92.71.153\\opc; Database=OmegaCloud;',  'RND_ROHMAN', 'rndomega');
	$sqlqs1 = "SELECT Keterangan, MAX(CreateDate) TglAkhir
		FROM MasterBank
		WHERE NoVoucher LIKE '009H2%' 
		AND ISNULL(Keterangan,'') LIKE 'PENGELUARAN %'
		GROUP BY Keterangan
		ORDER BY TglAkhir DESC";
	$results1 = odbc_exec($connect, $sqlqs1);
	if(odbc_num_rows($results1)){
		$data = array();
		while($rows=odbc_fetch_array($results1)) {
			$sqlqs = "select SUM(Total) Total, MAX(Tgl) LastTgl 
			from MasterBank 
			where NoVoucher like '009H2%' 
			and ISNULL(Keterangan,'') LIKE '%".$rows['Keterangan']."%'";
			$results = odbc_exec($connect, $sqlqs);
			$total=odbc_fetch_array($results)['Total'];
			$data[] = array('title'=>$rows['Keterangan'],'tags'=>str_replace(' ','+',strtolower($rows['Keterangan'])),'desc'=>"Rp ".number_format($total, 0, ",", "."));
		}
	}
}
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
    <link href="https://unpkg.com/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://dpm.or.id/donasi/assets/style.css" rel="stylesheet" type="text/css" />
    <link href="https://dpm.or.id/donasi/assets/foundation.css" rel="stylesheet" type="text/css" />
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
	
	
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
	
	<style type="text/css">
	html,body{
		padding: 0;
		margin:0;
		font-family: sans-serif;
	}

	.menu-dpm{
		background-color: #3141ff;
	}

	.menu-dpm ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
	}

	.menu-dpm > ul > li {
		float: left;
	}

	
	.menu-dpm li a {
		display: inline-block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}

	.menu-dpm li a:hover{
		background-color: #2525ff;
	}

	li.dropdown {
		display: inline-block;
	}

	.dropdown:hover .isi-dropdown {
		display: block;
	}

	.isi-dropdown a:hover {
		color: #fff !important;
	}

	.isi-dropdown {
		position: absolute;
		display: none;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		z-index: 1;
		background-color: #f9f9f9;
		padding: 14px 26px;
		width:250px;
		text-decoration:none;
		
		line-height:40px; 
		    
	}

	.isi-dropdown a {
		color: #3c3c3c !important;
	}

	.isi-dropdown a:hover {
		color: #232323 !important;
		background: #f3f3f3 !important;
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
          id="example-collapse-navbar">
          <ul class="flex flex-col lg:flex-row list-none lg:ml-auto" >
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-white border-b-2 hover:text-blue-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>BERANDA</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0 dropdown">
					<a href="http://dpm.or.id/tentang-kami" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>TENTANG KAMI</b></span>
					</a>
					<ul class="isi-dropdown">
						<li><a href="https://dpm.or.id/latar-belakang/">LATAR BELAKANG</a></li>
						<li><a href="https://dpm.or.id/badan-hukum/">BADAN HUKUM</a></li>
						<li><a href="https://dpm.or.id/visi-dan-misi/">VISI DAN MISI</a></li>
						<li><a href="https://dpm.or.id/struktur-organisasi/">STRUKTUR ORGANISASI</a></li>
						<li><a href="https://dpm.or.id/ruang-lingkup-pengembangan/">RUANG LINGKUP PENGEMBANGAN</a></li>
						<li><a href="https://dpm.or.id/jejaring-kerja-yayasan/">JEJARING KERJA YAYASAN</a></li>
						<li><a href="https://dpm.or.id/mitra/">MITRA</a></li>
						<!-- <li><a href="https://dpm.or.id/donasi-4-juta-masker/">DONASI 4 JUTA MASKER</a></li>
						<li><a href="https://dpm.or.id/donasi-semeru/">DONASI KBI JATIM PEDULI ERUPSI SEMERU</a></li> -->
					</ul>
				</li>
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/program" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>PENDISTRIBUSIAN</b></span>
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
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/donasi" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>DONASI</b></span>
					</a>
				</li>
				<li class="ml-6 my-2 md:my-0">
					<a href="http://dpm.or.id/donasi-cepat" class="block py-1 md:py-3 pl-1 align-middle no-underline hover:text-blue-500 border-b-2 hover:border-yellow-500 border-none text-gray-600">
						<span class="pb-1 md:pb-0 text-sm"><b>DONASI CEPAT</b></span>
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
			 <!--<div class="relative pull-right pl-4 pr-4 md:pr-0">
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
    background-image: url('https://dpm.or.id/wp-content/uploads/2022/03/4194E49F-AD3E-4458-8163-4C82EAFB1A09-scaled.jpg');
    background-repeat: no-repeat;">
		
		<div class="container mx-auto md:mt-24 mb-4 bg-white rounded-lg">
        <div class="w-full mx-auto flex flex-wrap mt-4">
            <div class="flex w-full md:flex-row mx-6">
				<div class="w-full f flex-col md:flex-row mx-6">
					<div class="p-4 px-0 bg-gray-100 rounded-full">
						<h4 class="ml-4 font-bold uppercase"><?php echo $title; ?></h4>
						
					</div>
				</div>
				
			</div>
			<?php if($tags != ''){ ?>
				<div class="w-full f flex-col md:flex-row mx-4">
					</br>
						<h6 style="text-align:center;" class="ml-4 font-bold uppercase">Terimakasih atas donasi yang telah diberikan</h6>
						<h6 style="text-align:center;">Total Donasi Keluar
						<?php echo "Rp ".number_format($totalDonasi, 0, ",", ".").""; ?>
						</h6>
				</div>
			<?php } else { ?>
				<div class="w-full f flex-col md:flex-row mx-12 mt-6 mb-12">
					<div class="row test">
					 <?php foreach($data as $rows){ ?>
					  <div class="col-sm-4">
						<a href="https://dpm.or.id/q/?donasi=<?php echo $rows['tags']; ?>" style="text-align:center;position: center; padding: 35px 70px;text-decoration: none;">
							<h5 style="text-align:center;color:#333;" class="font-bold uppercase"><?php echo $rows['title']; ?></h5>
							<h4 style="text-align:center;color:#333;"> <?php echo $rows['desc']; ?> </h4>
						</a>
					  </div>
					 <?php } ?>
					</div> 
				</div>
			<?php } ?>
		</div>
		<?php if($tags != ''){ ?>
        <div class="w-full mx-auto flex flex-wrap mb-6">
            <div class="flex w-full md:flex-row mx-12">
				<div class="w-full f flex-col md:flex-row mx-12">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Jumlah</th>
								
							</tr>
						</thead>
						<tbody>
						<?php 
							
							$nama = '';
							$jumlah = '';
							$tgl = '';
							while($row=odbc_fetch_array($result)){
								//echo json_encode($row);
								$nama = $row['Keterangan'];
								$jumlah = $row['Jml'];
								$tgl = $row['Tgl'];
								$exp=explode(' ',$tgl);
								$tgl=$exp[0];
								echo '<tr>';
								echo '<td>'.$tgl.'</td>';
								echo '<td>'.$nama.'</td>';
								echo '<td>Rp '.number_format($jumlah, 0, ",", ".").'</td>';
							
								
								echo '</tr>';
							}
						?>
															
						</tbody>
						<tfoot>
							<tr>
								
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Jumlah</th>
								
							</tr>
						</tfoot>
					</table>
				</div>
			
            
			</div>
        </div>
		<?php } ?>
		<!-- -->
    </section>
    <!-- MAIN CONTENT-->

    
    <footer style="background-color:#222222">
        <div>
            <h6 class="text-white leading-tight text-center p-8">
                Copyright © 2020 Yayasan Dana Paramita Majapahit – Develop by Omegasoft</h6>
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
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
	

	<script type="text/javascript" >			
		$(document).ready(function() {
    var table = $('#example').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
} );
	</script>
</body>

</html>