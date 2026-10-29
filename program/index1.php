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
//echo "Koneksi berhasil";
// mysqli_close($conn);
//$detail = mysqli_query($conn, "SELECT * from detailtracking");
$program = mysqli_query($conn, "SELECT * from dpm_program where status=1 ORDER BY createdate");
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
    
    <div class="container mx-auto px-8 py-8 pb-4 pt-24">

        <div class="w-full mx-auto flex flex-wrap">
				<h1 class="w-full text-2xl md:text-3xl font-bold leading-tight text-left text-gray-800 display_desk">Program</h1><br><br>
		</div>


    </div>
    <div class="mx-auto flex flex-wrap pt-4" style="background: #E6E6E6;">
        <div class="container mx-auto px-8 py-8">
            <section class="" style="background: #E6E6E6;">
				<div class="container mx-auto">
					<div class="flex flex-wrap md:w-60" id="product_conditioner">
						<?php while ($row = mysqli_fetch_array($program)) { ?>
							<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/2 p-6 flex flex-col cardCss" style=" border-style: solid; border-width: 1px; border-color:black;" align="center">
								<div class="pt-3 flex items-center text-center">
								<p class="text-1xl font-bold"><?php echo $row["judul"]; ?></p>
								</div>
								<p class="pt-1 text-left text-gray-900 mb-6">
								MULAI        : <?php echo $row["mulai"]; ?><br>
								AKHIR        : <?php echo $row["akhir"]; ?><br>
								Total Donasi : <?php echo "Rp. ".number_format($row["total_donasi"],0,',','.'); ?>
								</p>
								<a href="https://dpm.or.id/program/donasi?program=<?php echo FungsiUbahchrkeChar($row["id_program"]); ?>" class="bg-blue-700 text-white border border-blue-700 font-bold py-2 px-5">
								  DONASI
								</a>
							</div> 
						<?php } ?>
					</div>
            </section>
        </div>
    </div>
    <!-- MAIN CONTENT-->

    
    <footer style="background-color:#222222">
        <div>
            <h1 class="text-white leading-tight text-center p-8">
                Copyright © 2020 Yayasan Dana Paramita Majapahit – Develop by Omegasoft</h1>
        </div>
    </footer>
    <script src="htts://dpm.or.id/assets/jquery.event.move.js"></script>
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