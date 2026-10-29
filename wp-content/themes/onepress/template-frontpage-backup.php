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
?>
	<div id="content" class="site-content">
		<main id="main" class="site-main" role="main">
		<br>
		<div class="container">
		 <div class="section-title-area">		
			<h5 class="section-subtitle">Donasi</h5>		 
			<h2 class="section-title">Program Donasi</h2>					
		 </div>
		 <div class="row test">
		 <?php foreach($data as $rows){ ?>
		  <div class="col-sm-4">
			<a href="https://dpm.or.id/s/?donasi=<?php echo $rows['tags']; ?>" style="text-align:center;position: center; padding: 35px 70px;text-decoration: none;">
				<h3> <?php echo $rows['title']; ?> </h3>
				<h2> <?php echo $rows['desc']; ?> </h2>
			</a>
		  </div>
		 <?php } ?>
		</div> 
		</div> 
		 <div class="all-news">
			 <a class="btn btn-theme-primary-outline" href="https://dpm.or.id/s/">SEE MORE</a>
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

<?php get_footer(); ?>
