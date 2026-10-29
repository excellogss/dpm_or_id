
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
	$data = array();
	$sqlqs = "select 'DONASI MASUK' Keterangan, SUM(Total) Total, MAX(Tgl) LastTgl 
			from MasterBank 
			where NoVoucher like '009H2%' 
			and ISNULL(Keterangan,'') LIKE '%DONASI%'			
union all
	select 'PENYALURAN DANA', SUM(Total) Total, MAX(Tgl) LastTgl 
			from MasterBank 
			where NoVoucher like '009H2%' 
			and ISNULL(Keterangan,'') LIKE '%PENYALURAN%'
union all
	select 'DANA OPERASIONAL', SUM(Total) Total, MAX(Tgl) LastTgl 
			from MasterBank 
			where NoVoucher like '009H2%' 
			and ISNULL(Keterangan,'') LIKE '%PENGELUARAN OPERASIONAL%'";
	$results = odbc_exec($connect, $sqlqs);
	$data = array();
	while($rows=odbc_fetch_array($results)) {
		$data[] = array('title'=>$rows['Keterangan'],'tags'=>str_replace(' ','+',strtolower($rows['Keterangan'])),'desc'=>"Rp ".number_format($rows['Total'], 0, ",", "."));
	}
	//echo json_encode($data);
}
?>

<!DOCTYPE html>
<html lang="id-ID">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<title>Yayasan Dana Paramita Majapahit &#8211; Makin muda, Makin Kaya, Makin Berdana. Makin tua, Makin Bijak, Makin Berbagi</title>
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Yayasan Dana Paramita Majapahit &raquo; Feed" href="https://dpm.or.id/feed/" />
<link rel="alternate" type="application/rss+xml" title="Yayasan Dana Paramita Majapahit &raquo; Umpan Komentar" href="https://dpm.or.id/comments/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/dpm.or.id\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.5.15"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
	<link rel='stylesheet' id='wp-block-library-css'  href='https://dpm.or.id/wp-includes/css/dist/block-library/style.min.css?ver=5.5.15' type='text/css' media='all' />
<link rel='stylesheet' id='onepress-fonts-css'  href='https://fonts.googleapis.com/css?family=Raleway%3A400%2C500%2C600%2C700%2C300%2C100%2C800%2C900%7COpen+Sans%3A400%2C300%2C300italic%2C400italic%2C600%2C600italic%2C700%2C700italic&#038;subset=latin%2Clatin-ext&#038;ver=2.2.5' type='text/css' media='all' />
<link rel='stylesheet' id='onepress-animate-css'  href='https://dpm.or.id/wp-content/themes/onepress/assets/css/animate.min.css?ver=2.2.5' type='text/css' media='all' />
<link rel='stylesheet' id='onepress-fa-css'  href='https://dpm.or.id/wp-content/themes/onepress/assets/css/font-awesome.min.css?ver=4.7.0' type='text/css' media='all' />
<link rel='stylesheet' id='onepress-bootstrap-css'  href='https://dpm.or.id/wp-content/themes/onepress/assets/css/bootstrap.min.css?ver=2.2.5' type='text/css' media='all' />
<link rel='stylesheet' id='onepress-style-css'  href='https://dpm.or.id/wp-content/themes/onepress/style.css?ver=5.5.15' type='text/css' media='all' />
<style id='onepress-style-inline-css' type='text/css'>
.site-logo-div img{height:55px;width:auto}#main .video-section section.hero-slideshow-wrapper{background:transparent}.hero-slideshow-wrapper:after{position:absolute;top:0px;left:0px;width:100%;height:100%;background-color:rgba(0,0,0,0.3);display:block;content:""}.body-desktop .parallax-hero .hero-slideshow-wrapper:after{display:none!important}#parallax-hero>.parallax-bg::before{background-color:rgba(0,0,0,0.3);opacity:1}.body-desktop .parallax-hero .hero-slideshow-wrapper:after{display:none!important}#footer-widgets{}.gallery-carousel .g-item{padding:0px 1px}.gallery-carousel{margin-left:-1px;margin-right:-1px}.gallery-grid .g-item,.gallery-masonry .g-item .inner{padding:1px}.gallery-grid,.gallery-masonry{margin:-1px}
</style>
<link rel='stylesheet' id='onepress-gallery-lightgallery-css'  href='https://dpm.or.id/wp-content/themes/onepress/assets/css/lightgallery.css?ver=5.5.15' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-icons-css'  href='https://dpm.or.id/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.9.1' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-animations-css'  href='https://dpm.or.id/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.0.5' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-frontend-legacy-css'  href='https://dpm.or.id/wp-content/plugins/elementor/assets/css/frontend-legacy.min.css?ver=3.0.5' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-frontend-css'  href='https://dpm.or.id/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.0.5' type='text/css' media='all' />
<link rel='stylesheet' id='elementor-post-65-css'  href='https://dpm.or.id/wp-content/uploads/elementor/css/post-65.css?ver=1707279197' type='text/css' media='all' />
<link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=5.5.15' type='text/css' media='all' />
<script type='text/javascript' src='https://dpm.or.id/wp-includes/js/jquery/jquery.js?ver=1.12.4-wp' id='jquery-core-js'></script>
<link rel="https://api.w.org/" href="https://dpm.or.id/wp-json/" /><link rel="alternate" type="application/json" href="https://dpm.or.id/wp-json/wp/v2/pages/1367" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://dpm.or.id/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="https://dpm.or.id/wp-includes/wlwmanifest.xml" /> 
<meta name="generator" content="WordPress 5.5.15" />
<link rel="canonical" href="https://dpm.or.id/" />
<link rel='shortlink' href='https://dpm.or.id/' />
<link rel="alternate" type="application/json+oembed" href="https://dpm.or.id/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fdpm.or.id%2F" />
<link rel="icon" href="https://dpm.or.id/wp-content/uploads/2020/09/favicon_hair4all.png" sizes="32x32" />
<link rel="icon" href="https://dpm.or.id/wp-content/uploads/2020/09/favicon_hair4all.png" sizes="192x192" />
<link rel="apple-touch-icon" href="https://dpm.or.id/wp-content/uploads/2020/09/favicon_hair4all.png" />
<meta name="msapplication-TileImage" content="https://dpm.or.id/wp-content/uploads/2020/09/favicon_hair4all.png" />
</head>

<body class="home page-template page-template-template-frontpage page-template-template-frontpage-php page page-id-1367 wp-custom-logo elementor-default elementor-kit-65 elementor-page elementor-page-1367">
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content">Lompat ke konten</a>
	<div id="header-section" class="h-on-top no-transparent">		<header id="masthead" class="site-header header-contained is-sticky no-scroll no-t h-on-top" role="banner">
			<div class="container">
				<div class="site-branding">
				<div class="site-brand-inner has-logo-img no-desc"><div class="site-logo-div"><a href="https://dpm.or.id/" class="custom-logo-link  no-t-logo" rel="home" itemprop="url"><img width="2563" height="2041" src="https://dpm.or.id/wp-content/uploads/2020/09/Yayasan-Majapahit-01.png" class="custom-logo" alt="Yayasan Dana Paramita Majapahit" loading="lazy" itemprop="logo" srcset="https://dpm.or.id/wp-content/uploads/2020/09/Yayasan-Majapahit-01.png 2x" /></a></div></div>				</div>
				<div class="header-right-wrapper">
					<a href="#0" id="nav-toggle">Menu<span></span></a>
					<nav id="site-navigation" class="main-navigation" role="navigation">
						<ul class="onepress-menu">
							<li id="menu-item-1438" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-1367 current_page_item menu-item-1438"><a href="https://dpm.or.id/" aria-current="page">Beranda</a></li>
<li id="menu-item-1450" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-1450"><a href="https://dpm.or.id/tentang-kami/">TENTANG KAMI</a>
<ul class="sub-menu">
	<li id="menu-item-1576" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1576"><a href="https://dpm.or.id/latar-belakang/">LATAR BELAKANG</a></li>
	<li id="menu-item-1579" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1579"><a href="https://dpm.or.id/badan-hukum/">BADAN HUKUM</a></li>
	<li id="menu-item-1582" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1582"><a href="https://dpm.or.id/visi-dan-misi/">VISI DAN MISI</a></li>
	<li id="menu-item-1585" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1585"><a href="https://dpm.or.id/struktur-organisasi/">STRUKTUR ORGANISASI</a></li>
	<li id="menu-item-1588" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1588"><a href="https://dpm.or.id/ruang-lingkup-pengembangan/">RUANG LINGKUP PENGEMBANGAN</a></li>
	<li id="menu-item-1591" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1591"><a href="https://dpm.or.id/jejaring-kerja-yayasan/">JEJARING KERJA YAYASAN</a></li>
	<li id="menu-item-1594" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1594"><a href="https://dpm.or.id/mitra/">MITRA</a></li>
	<li id="menu-item-2333" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2333"><a href="https://dpm.or.id/laporan-audit/">LAPORAN AUDIT</a></li>
</ul>
</li>
<li id="menu-item-2362" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2362"><a href="https://dpm.or.id/faq/">FAQ</a></li>
<li id="menu-item-1456" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1456"><a href="https://dpm.or.id/program/">Pendistribusian</a></li>
<li id="menu-item-1459" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1459"><a href="https://dpm.or.id/berita/">BERITA</a></li>
<li id="menu-item-1465" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1465"><a href="https://dpm.or.id/kontak/">Kontak</a></li>
<li id="menu-item-1509" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1509"><a href="https://dpm.or.id/donasi/">Donasi</a></li>
<li id="menu-item-1719" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1719"><a href="https://dpm.or.id/donasi-cepat/">DONASI CEPAT</a></li>
						</ul>
					</nav>
					<!-- #site-navigation -->
				</div>
			</div>
		</header><!-- #masthead -->
</div>	

<div class="page-header">
				<div class="container">
					<h1 class="entry-title">DONASI</h1>				</div>
			</div>

<div id="content" class="site-content">
		<main id="main" class="site-main" role="main">
		<br>
		<div class="container">
		 <!--<div class="section-title-area">		
			<h5 class="section-subtitle">Donasi</h5>		 
			<h2><?php
date_default_timezone_set('Asia/Jakarta'); // Menentukan zona waktu
echo date('d/m/Y H:i');
?>
</h2>	
		 </div> -->

		 <?php $count=1; foreach($data as $rows){ ?>
			<div class="section-title-area">
				<?php if($count==1){ ?>
					<h5 class="section-subtitle">Donasi</h5>		 
					<h2><?php
						date_default_timezone_set('Asia/Jakarta'); // Menentukan zona waktu
						echo date('d/m/Y H:i');
					?>
					</h2>
				<?php } ?>
				
				<h2 class="section-title">Total <?php echo $rows['title']; ?></h2>	
				  <div class="test">
					<a style="text-align:center;position: center; padding: 0px 0px;text-decoration: none;">
						<h1><b> <?php echo $rows['desc']; ?> </b></h1>
					</a>
				  </div>
			</div>
		 <?php $count++; } ?>
		
		<div class="section-title-area">
			<h2 class="section-title">Telah Diliput Oleh</h2>	
			<br>
			  <div class="test">
				<a style="text-align:center;position: center; padding: 0px 0px;text-decoration: none;" href="https://mediaindonesia.com/nusantara/681088/warga-desa-megale-bojonegoro-dapat-bantuan-akses-air-bersih">
					<img src="https://dpm.or.id/wp-content/uploads/2024/07/Logo_Media_Indonesia-tanpa-bg.png" alt="HTML tutorial" style="">
				</a>
			  </div>
		 </div>
		
		
		</div> 
		
		 
            		<div class="section-parallax"> <div class="parallax-bg"><img src="https://dpm.or.id/wp-content/uploads/2016/02/blog1.jpg" alt=""></div></div>	    	section>
				</main><!-- #main -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
						<div class="footer-connect">
			<div class="container">
				<div class="row">
												<div class="col-md-4 offset-md-2 col-sm-6 offset-md-0">
										<div class="footer-subscribe">
			<h5 class="follow-heading">Gabung Surat Kabar kami</h5>			<form novalidate="" target="_blank" class="" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post"
				  action="">
				<input type="text" placeholder="Masukkan alamat email Anda" id="mce-EMAIL" class="subs_input" name="EMAIL" value="">
				<input type="submit" class="subs-button" value="Langganan" name="subscribe">
			</form>
		</div>
									</div>
													<div class="col-md-4 col-sm-6">
										<div class="footer-social">
			<h5 class="follow-heading">Tetap Update</h5><div class="footer-social-icons"><a target="_blank" href="https://www.instagram.com/yayasandpm" title="Instagram"><i class="fa fa fa-instagram"></i></a><a target="_blank" href="https://www.facebook.com/danaparamitamajapahit" title="Facebook"><i class="fa fa fa-facebook"></i></a><a target="_blank" href="https://www.youtube.com/channel/UCGAEmxE4sddICDgq6G1YtoA" title="Youtube"><i class="fa fa fa-youtube-play"></i></a><a target="_blank" href="https://www.tiktok.com/@yayasandpm?_t=8jfrQdTN13B&_r=1" title="TikTok"><i class="fa fa fa-tumblr"></i></a></div>		</div>
									</div>
										</div>
			</div>
		</div>
	
		<div class="site-info">
			<div class="container">
									<div class="btt">
						<a class="back-to-top" href="#page" title="Kembali ke Atas"><i class="fa fa-angle-double-up wow flash" data-wow-duration="2s"></i></a>
					</div>
												Copyright © 2022 Yayasan Dana Paramita Majapahit
				<span class="sep"> – </span>Develop
				<a href="https://omegasoft.co.id/">by Omegasoft</a>
			</div>
		</div>
		<!-- .site-info -->

	</footer><!-- #colophon -->
	</div><!-- #page -->


<script type='text/javascript' src='https://dpm.or.id/wp-content/themes/onepress/assets/js/plugins.js?ver=2.2.5' id='onepress-js-plugins-js'></script>
<script type='text/javascript' src='https://dpm.or.id/wp-content/themes/onepress/assets/js/bootstrap.min.js?ver=2.2.5' id='onepress-js-bootstrap-js'></script>
<script type='text/javascript' id='onepress-theme-js-extra'>
/* <![CDATA[ */
var onepress_js_settings = {"onepress_disable_animation":"","onepress_disable_sticky_header":"","onepress_vertical_align_menu":"","hero_animation":"flipInX","hero_speed":"5000","hero_fade":"750","hero_duration":"5000","hero_disable_preload":"","is_home":"","gallery_enable":"","is_rtl":""};
/* ]]> */
</script>
<script type='text/javascript' src='https://dpm.or.id/wp-content/themes/onepress/assets/js/theme.js?ver=2.2.5' id='onepress-theme-js'></script>
<script type='text/javascript' id='jquery.bully-js-extra'>
/* <![CDATA[ */
var Onepress_Bully = {"enable_label":"1","disable_mobile":"","sections":{"hero":{"id":"hero","_id":"hero","inverse":1,"enable":true,"title":"Home"},"beritaterkini":{"id":"beritaterkini","_id":"news","inverse":false,"enable":true,"title":"Berita Terkini"}}};
/* ]]> */
</script>
<script type='text/javascript' src='https://dpm.or.id/wp-content/themes/onepress/assets/js/jquery.bully.js?ver=5.5.15' id='jquery.bully-js'></script>
<script type='text/javascript' src='https://dpm.or.id/wp-includes/js/wp-embed.min.js?ver=5.5.15' id='wp-embed-js'></script>
<script type="text/javascript">
window.addEventListener("load", function(event) {
jQuery(".cfx_form_main,.wpcf7-form,.wpforms-form,.gform_wrapper form").each(function(){
var form=jQuery(this); 
var screen_width=""; var screen_height="";
 if(screen_width == ""){
 if(screen){
   screen_width=screen.width;  
 }else{
     screen_width=jQuery(window).width();
 }    }  
  if(screen_height == ""){
 if(screen){
   screen_height=screen.height;  
 }else{
     screen_height=jQuery(window).height();
 }    }
form.append('<input type="hidden" name="vx_width" value="'+screen_width+'">');
form.append('<input type="hidden" name="vx_height" value="'+screen_height+'">');
form.append('<input type="hidden" name="vx_url" value="'+window.location.href+'">');  
}); 

});
</script> 

<a href="https://wa.me/628113525900" class="tp-whatsapp fa fa-whatsapp"></a>
<style>
  a.tp-whatsapp {
	padding: 20px;
    background-color: #23A455;
    border-radius: 100%;
    color: white;
    font-size: 30px;
    position: fixed;
    right: 10px;
    bottom: 10px;
    z-index: 9999;
	text-decoration: none;
}
	a.tp-whatsapp:hover {
    color: grey;
}
  a.tp-whatsapp img {
    max-width: 150px;
}
</style>


</body>
</html>
