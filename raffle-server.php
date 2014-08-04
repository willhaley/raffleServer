<?php

/*
Plugin Name: Raffle Server
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: whaley
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

require_once ( dirname ( __FILE__ ) . '/raffle-admin.php' );

if ( ! class_exists ( 'JSON_API_Raffle_Client' ) ) {

	class JSON_API_Raffle_Client {


		function __construct() {

			add_filter ( 'json_api_controllers',          array ( $this, 'json_api_controllers' ) );

			add_filter ( 'json_api_raffle_controller_path', array ( $this, 'json_api_raffle_controller_path') );

			add_action ( 'admin_menu', array ( $this, 'admin_menu' ) );
		}

		function json_api_controllers( $controllers ) {

			$controllers[] = 'raffle';

			return $controllers;

		}

		function json_api_raffle_controller_path(){

			return dirname( __FILE__ ) . '/json-api-raffle-controller.php';

		}

		function admin_menu(){
			add_options_page ( 'Raffle' , 'Raffle' , 'manage_options' , 'options_raffle' , 'raffle_server_admin_screen' );
		}

	}

}

$json_api_roster_client = new JSON_API_Raffle_Client();