<?php

/*
Controller name: Raffle
Controller description:
*/

if ( ! class_exists ( 'JSON_API_Raffle_Controller' ) ) {

	class JSON_API_Raffle_Controller {

		const OPTION_NAME = 'currentRaffleGameID';

		const NONCE_NAME = 'updateRaffle';

		public function game_on(){
			/**
			 * @var $json_api JSON_API
			 */
			global $json_api;

			$nonce = $json_api->query->nonce;

			if ( ! wp_verify_nonce ( $nonce, self::NONCE_NAME ) ) {
				return $json_api->error();
			}

			$game_id = rand(9999,100000);

			update_option ( self::OPTION_NAME ,  $game_id );

			return $json_api->response->respond($game_id);
		}

		public function get_number(){
			/**
			 * @var $json_api JSON_API
			 */
			global $json_api;

			if ( $game_id = get_option ( self::OPTION_NAME ) ){

				$ticket_number =  rand ( 100000,999999 );
				set_transient ( '___r' . $ticket_number , $ticket_number, (60*60*30) );
				return $json_api->response->respond ( array('gameID' => $game_id, 'ticketNumber' => $ticket_number ) );
			}

		}

		public function get_winner(){

		}

	}

}
