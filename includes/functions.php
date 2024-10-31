<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	
	
	function qa_iq2a_action_admin_menus(){
		
		add_submenu_page( 'edit.php?post_type=question', __( 'Q2A Migration', QA_TEXTDOMAIN ), __( 'Q2A Migration', QA_TEXTDOMAIN ), 'manage_options', 'migration', 'qa_iq2a__migration' );	
		
		
		}

	add_action('qa_action_admin_menus','qa_iq2a_action_admin_menus');	
	
	
	
	function qa_iq2a__migration(){
		
		include( QA_IQ2APLUGIN_DIR. 'includes/menus/migration.php' );
		
		}
	
	
	
	
	
	
	
	
	
	
	
	function qa_iq2a_ajax_migration() {
		
		$paged 	= (int)$_POST['paged'];
		$ppp 	= (int)$_POST['ppp'];

		$wp_query = new WP_Query( array (
			'post_type' => 'answer',
			'post_status' => array( 'publish', 'pending' ),
			'posts_per_page' => $ppp,
			'paged' => $paged,
		) );
		

		if ( $wp_query->have_posts() ) : 
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			$answer_id = get_the_ID();
			
			echo $answer_id;
			
			$qa_answer_question_id_2 = get_post_meta( $answer_id, 'qa_answer_question_id_2', true );
			
			if( !empty( $qa_answer_question_id_2 ) ) {
			
				$wp_query_question = new WP_Query( array (
					'post_type' => 'question',
					'post_status' => array( 'publish', 'pending' ),
					'posts_per_page' => -1,
					'meta_query' => array(
						array(
							'key'     => 'qa_question_pre_postid',
							'value'   => $qa_answer_question_id_2,
							'compare' => '=',
						),
					),
				) );
			
				if ( $wp_query_question->have_posts() ) : while ( $wp_query_question->have_posts() ) : $wp_query_question->the_post();
				
					update_post_meta( $answer_id, 'qa_answer_question_id', get_the_ID() );
				
				endwhile;wp_reset_query();endif;
			}
			

		endwhile;
		wp_reset_query();
		endif;
				
			
		die();
	}

	add_action('wp_ajax_qa_iq2a_ajax_migration', 'qa_iq2a_ajax_migration');
	add_action('wp_ajax_nopriv_qa_iq2a_ajax_migration', 'qa_iq2a_ajax_migration');
	
	
	
	
	
	
	
	
	
	function qa_iq2a_admin_notices_main_plugin_missed(){

			
			$active_plugins = get_option('active_plugins');
			
			
			$html= '';

			if(in_array( 'question-answer/question-answer.php', (array) $active_plugins )){

				}
			else{
					$admin_url = get_admin_url();
					
					$html.= '<div class="update-nag">';
					$html.= 'Please install & activate <a href="'.$admin_url.'plugin-install.php?tab=search&s=question+answer"><b>Question Answer</b></a> plugin first. plugin link in <a href="https://wordpress.org/plugins/question-answer/">wordpress.org</a> ';
					$html.= '</div>';
				
				}	
			
			


			echo $html;
		}
	
	add_action('admin_notices', 'qa_iq2a_admin_notices_main_plugin_missed');
	
	
	
	