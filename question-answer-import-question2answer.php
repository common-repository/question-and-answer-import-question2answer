<?php
/*
Plugin Name: Question Answer - Import Question2answer
Plugin URI: http://pickplugins.com
Description: Import for Question2answer CMS to WordPress.
Version: 1.0.0
Text Domain: question-answer
Author: pickplugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


class QuestionAnswerImportQuestion2answer{
	
	public function __construct(){
	
		$this->qa_define_constants();
		

		$this->qa_declare_shortcodes();

		

		$this->qa_loading_script();

		$this->qa_loading_functions();
		
	}
	

	
	public function qa_loading_functions() {
		
		require_once( QA_IQ2APLUGIN_DIR . 'includes/functions.php');
	}
	
	
	public function qa_declare_shortcodes() {

		require_once( QA_IQ2APLUGIN_DIR . 'includes/shortcodes/class-shortcode-migration.php');

	}

	
	public function qa_define_constants() {

		define('QA_IQ2AIQ2A_PLUGIN_URL', plugins_url('/', __FILE__)  );
		define('QA_IQ2APLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		define('QA_IQ2ATEXTDOMAIN', 'question-answer-import-question2answer' );
		define('QA_IQ2APLUGIN_NAME', __('Question and Answer - Import Question2answer',QA_IQ2ATEXTDOMAIN) );
	}
	
	public function qa_loading_script() {
	
		//add_action( 'wp_enqueue_scripts', array( $this, 'qa_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'qa_admin_scripts' ) );
	}
	
	public function qa_admin_scripts(){
		
		wp_enqueue_script('jquery');

		wp_enqueue_script('qa_iq2a_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script( 'qa_iq2a_admin_js', 'qa_iq2a_ajax', array( 'qa_iq2a_ajaxurl' => admin_url( 'admin-ajax.php')));
		
		//wp_enqueue_style('qa_iq2a_style', QA_IQ2AIQ2A_PLUGIN_URL.'assets/front/css/style.css');	
	}
	
	
	
} new QuestionAnswerImportQuestion2answer();