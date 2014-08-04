<?php
	function raffle_server_admin_screen(){
?>

<h2>Raffle Admin</h2>

		<p>
			<div class="raffle-gameOn">
				<label>Raffle Status</label>
				<select name="raffleStatus" id="raffleStatus">
					<option value="off">Off</option>
					<option value="on">On</option>
				</select>
			</div>
		</p>

		<div class="gameIsOn" style="display: none">

			<p>
				<div class="selectWinner">
					<button id="selectWinner">Select Winner</button>
				</div>
			</p>

			<p>
				<div class="registeredNumbers">
					<p>Registered Numbers:</p>
					<div class="numberPool"></div>
				</div>
			</p>

		</div>

		<div style="display: none">
			<?php wp_nonce_field( 'updateRaffle' ); ?>
		</div>

		<script>
			jQuery(document).ready(function($){

				$('#raffleStatus').change(function(){
					if ( $(this).val() == 'on' ){
						$.get('/api/raffle/game_on/?nonce='+$('#_wpnonce').val(), function(data){
							console.log(data);
						});
						$('.gameIsOn').show();
					} else {
						$('.gameIsOn').hide();

					}
				});

			});
		</script>

<?php }