<?php $connected_sites = get_option('woonet_child_sites'); ?>
<div class='woonet-pages'>
	<h1>  Network Sites </h1>
	<p> A list of sites connected to the network. </p>
	<div class="error notice" style='display: none;'></div>
    <div class="notice-success notice" style='display: none;'></div>

	<a class='add-to-network-btn' href='<?php echo admin_url('admin.php?page=woonet-connect-child') ?>'> Add </a>
		
	<?php if ( !empty( $connected_sites ) ): ?>

	<table class='woonet-sites-table'> 
		<tr> 
			<th> Site </th>
			<th> Status </th>
			<th> Date Added </th>
			<th> Action </th>
		</tr>
		<?php foreach( $connected_sites as $key => $connected_site ): ?>
			<tr> 
				<td> 
					<a target='_blank' href='<?php echo $connected_site['site_url']; ?>'> 
						<?php echo str_replace( array( 'http://', 
						'https://'), '', $connected_site['site_url'] ); ?> 
					</a> 
				</td>
				<td> Active </td>
				<td> <?php echo date("Y/m/d", $connected_site['date_added']); ?> </td>
				<td> 
					<form action='<?php echo admin_url('admin.php?page=woonet-connected-sites') ?>' method='POST'> 
						<?php wp_nonce_field( 'woonet_delete_site' ); ?>
						<input type="hidden" value='<?php echo $key; ?>' name="__key">
						<button type='submit' class='button-primary' onclick='return confirm("Do you really want to delete the site?");'> Remove </button>
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php else: ?>
		<p class='woonet-sites-empty'> Follow the <a href='<?php echo admin_url('admin.php?page=woonet-setup-wizard'); ?>'> Setup Wizard </a> to add a new site. </p>
	<?php endif; ?>
</div>