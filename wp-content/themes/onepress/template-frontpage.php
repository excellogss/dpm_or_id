<style>
.test [class*="col-"] {
  padding: 15px;
  background-color: #f1f1f1;
  border: 1px solid #D8D8D8;
  color: #333;
}
</style>
<?php
/**
 *Template Name: Frontpage
 *
 * @package OnePress
 */

get_header(); ?>
<?php
$connect = odbc_connect('Driver={ODBC Driver 17 for SQL Server}; Server=36.92.71.153\\opc; Database=OmegaCloud;',  'RND_ROHMAN', 'rndomega');
/*
$sqlqs1 = "SELECT TOP 3 Keterangan, MAX(CreateDate) TglAkhir
		FROM MasterBank
		WHERE NoVoucher LIKE '009H2%' 
		AND ISNULL(Keterangan,'') LIKE 'DONASI %'
		GROUP BY Keterangan
		ORDER BY TglAkhir DESC";
$results1 = odbc_exec($connect, $sqlqs1);

if(odbc_num_rows($results1)){
	$data = array();
	while($rows=odbc_fetch_array($results1)){
		$sqlqs = "select SUM(Total) Total, MAX(Tgl) LastTgl 
		from MasterBank 
		where NoVoucher like '009H2%' 
		and ISNULL(Keterangan,'') LIKE '%".$rows['Keterangan']."%'";
		$results = odbc_exec($connect, $sqlqs);
		$total=odbc_fetch_array($results)['Total'];
		$data[] = array('title'=>$rows['Keterangan'],'tags'=>str_replace(' ','+',strtolower($rows['Keterangan'])),'desc'=>"Rp ".number_format($total, 0, ",", "."));
	}
}
*/

$data = array();
$sqlqs = "select SUM(Total) Total
		  from MasterBank 
		  where NoVoucher like '009H2%' 
		  and ISNULL(Keterangan,'') LIKE 'DONASI%'";
$results = odbc_exec($connect, $sqlqs);
$total=odbc_fetch_array($results)['Total'];
$data[] = array('title'=>"TOTAL DONASI MASUK",'tags'=>"DONASI",'desc'=>"Rp ".number_format($total, 0, ",", "."));

$data2 = array();
$sql2 = "SELECT SUM(Total) Total
		  FROM MasterBank 
		  WHERE NoVoucher LIKE '009H2%' 
		  AND ISNULL(Keterangan,'') LIKE 'PENYALURAN %'";
$results2 = odbc_exec($connect, $sql2);
while($rows2=odbc_fetch_array($results2)){
	$total2=$rows2['Total'];
	$data2[] = array('title'=>"PENYALURAN",'tags'=>"PENYALURAN",'desc'=>"Rp ".number_format($total2, 0, ",", "."));
}

$data3 = array();
$sql3 = "SELECT Keterangan, SUM(Total) Total
		  FROM MasterBank 
		  WHERE NoVoucher LIKE '009H2%' 
		  AND ISNULL(Keterangan,'') LIKE 'PENYALURAN %'
		  GROUP BY Keterangan";
$results3 = odbc_exec($connect, $sql3);
while($rows3=odbc_fetch_array($results3)){
	$total3=$rows3['Total'];
	$keterangan3=$rows3['Keterangan'];
	$data3[] = array('title'=>$keterangan3,'tags'=>"PENYALURAN",'desc'=>"Rp ".number_format($total3, 0, ",", "."));
}

$data4 = array();
$sql4 = "SELECT SUM(Total) Total
		  FROM MasterBank 
		  WHERE NoVoucher LIKE '009H2%' 
		  AND ISNULL(Keterangan,'') LIKE 'PENGELUARAN %'";
$results4 = odbc_exec($connect, $sql4);
while($rows4=odbc_fetch_array($results4)){
	$total4=$rows4['Total'];
	$data4[] = array('title'=>"PENGELUARAN",'tags'=>"PENGELUARAN",'desc'=>"Rp ".number_format($total4, 0, ",", "."));
}


?>
	<div id="content" class="site-content">
		<main id="main" class="site-main" role="main">
		<br>
		<div class="container">
		 <div class="section-title-area">		
			<h5 class="section-subtitle">Donasi</h5>		 
			<h2> <?php echo date("d/m/Y H:i", strtotime('+7 hours')); ?> </h2>	
			<h2 class="section-title">TOTAL DONASI MASUK</h2>		
			<!-- <div class="test"> -->
			 <?php foreach($data as $rows){ ?>
			  <div class="test">
				<a style="text-align:center;position: center; padding: 0px 0px;text-decoration: none;">
					<h1><b> <?php echo $rows['desc']; ?> </h1>
				</a>
			  </div>
			 <?php } ?>
			<!-- </div> -->
		 </div>
		 
		
		<div class="section-title-area">		 
			<h2 class="section-title">TOTAL PENYALURAN DANA</h2>	
			
			<!-- <div class="row test"> -->
			 <?php foreach($data2 as $rows2){ ?>
			  <div class="test">
				<a style="text-align:center;position: center; padding: 0px 0px;text-decoration: none;">
					<h1><b> <?php echo $rows2['desc']; ?> </b></h1>
				</a>
			  </div>
			 <?php } ?>
			 
			 <!--table id="example" class="table table-striped table-bordered" style="width:100%">
			 <thead>
				<tr>
					<th>Keterangan</th>
					<th>Jumlah</th>
				</tr>
			 </thead>
			 <tbody>
			 <?php foreach($data3 as $rows3){ 
				echo '<tr>';
				echo '<td>'.$rows3['title'].'</td>';
				echo '<td>'.$rows3['desc'].'</td>';
				//echo '<td>Rp '.number_format($rows3['desc'], 0, ",", ".").'</td>';
				echo '</tr>';
			 } ?>
			 </tbody>
			 </table-->
			 
			<!-- </div>
			
			<div class="all-news">
				<a class="btn btn-theme-primary-outline" href="https://dpm.or.id/q/">SEE MORE</a>
			</div>
			-->
			
		</div>
		
		
		<div class="section-title-area">
			<h2 class="section-title">TOTAL DANA OPERASIONAL</h2>		
			<!-- <div class="test"> -->
			 <?php foreach($data4 as $rows4){ ?>
			  <div class="test">
				<a style="text-align:center;position: center; padding: 0px 0px;text-decoration: none;">
					<h1><b> <?php echo $rows4['desc']; ?> </b></h1>
				</a>
			  </div>
			 <?php } ?>
			<!-- </div> -->
		 </div>
		
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
		
		 
            <?php

            do_action( 'onepress_frontpage_before_section_parts' );

			if ( ! has_action( 'onepress_frontpage_section_parts' ) ) {

				$sections = apply_filters( 'onepress_frontpage_sections_order', array(
                    'features', 'about', 'services', 'videolightbox', 'gallery', 'counter', 'team',  'news', 'contact'
                ) );

				foreach ( $sections as $section ){
					/**
                     * Load section if active
                     *
					 * @since 2.1.1
					 */
				    if ( Onepress_Config::is_section_active( $section ) ) {
					    onepress_load_section( $section );
                    }

				}

			} else {
				do_action( 'onepress_frontpage_section_parts' );
			}

            do_action( 'onepress_frontpage_after_section_parts' );

			?>
		</main><!-- #main -->
	</div><!-- #content -->

<?php the_content(); ?>
<?php get_footer(); ?>
