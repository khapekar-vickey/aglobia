<div class='woonet-setup-wizard woonet-license-key'>
	<img src='<?php echo plugins_url( '/assets/images/lock.png' ,  dirname(dirname(__FILE__) ) ); ?>' alt='Lock'/>

	<?php if ( get_option('woonet_network_type') == 'master' ): ?>
	<h1> Enter License Key </h1>
	<p> Please go to your <a href='https://woomultistore.com/my-account/' target='_blank'> account dashboard </a> and generate a license key for this site. You will need one license key for each site. </p>
	<?php if ( !empty($_SESSION['mstore_form_submit_messages']) ): ?>
		<?php foreach( $_SESSION['mstore_form_submit_messages'] as $error ): ?>
			<div class="error notice">
		        <p><?php _e( esc_html($error), 'woonet' ); ?></p>
		    </div>
		<?php endforeach; ?>
	<?php endif; ?>
	<form  autocomplete="off" action='<?php menu_page_url( 'woonet-license-key' ) ?>' method='post'> 
		<?php wp_nonce_field( 'woonet_license_verify_submit'); ?>
		<input type='text' name='woonet_license_key' value='' placeholder="Enter your license key here">
		<button type='submit' class='button-primary'> Submit </button>
	</form>
	<?php else: ?>
		<h1 style='text-align: center;'> Child site doesn't need a license. </h1>
	<?php endif; ?>
</div>