<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

?>

<div class="qa-migration"> <?php
	
	if ( get_query_var('paged') ) { $paged = get_query_var('paged');} 
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
	else { $paged = 1; }
	
	$posts_per_page = 20;
	
	$action = isset( $_GET['action'] ) ? $_GET['action'] : ''; 
	
	$wp_query = new WP_Query( array (
		'post_type' => 'answer',
		'post_status' => array( 'publish', 'pending' ),
		'posts_per_page' => $posts_per_page,
		'paged' => $paged,
	) );
	
	echo '<div class="qa_migration_header">';
	echo 'Total Answers: '.$wp_query->found_posts.' || ';
	echo 'Page: <span class="page_curr">'.$paged.'</span>/<span class="page_total">'.$wp_query->max_num_pages.'</span> || ';
	echo 'Post per Page: '.$posts_per_page.'</div>';
	
	
	
	echo '<center><img class="qa_loading" src="'.plugins_url( '/question-answer/assets/global/images/loading1.gif' ).'" /></center>';
	
	echo '<div id="myProgress"><div id="myBar"></div></div>';
	
	echo '<center><div paged="'.$paged.'" total_page="'.$wp_query->max_num_pages.'" ppp="'.$posts_per_page.'" class="qa_start_migration">Start Update</div></center>';
	

	?>
    
    
    
</div>

<style>


.qa-migration {

}

.qa_migration_header {
	font-size: 18px;
	font-weight: bold;
	padding:10px;
	background:#e1e1e1;
	margin:10px 0;
	margin:25px 0;
}


.qa_start_migration {
	margin:25px 0;
	text-decoration:none;
	padding:10px 35px;
	background:#e1e1e1;
	display:inline-block;
	cursor:pointer;
}

.qa_loading {
	display:none;
	padding: 50px;
}


#myProgress {
  background: #32bafa none repeat scroll 0 0;
  display: none;
  height: 30px;
  overflow: hidden;
  position: relative;
  width: 100%;
}

#myBar {
  background-color: #67caf9;
  color: #fff;
  height: 100%;
  position: absolute;
  text-align: center;
  width: 0;
}

</style>