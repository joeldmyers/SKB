<tr>
	<td><?php echo $data['transaction_date'] ;?></td>
	<td><?php echo get_the_title( $data['transaction_investment'] );?></td>
	<td><?php echo $data['transaction_investment_entity'] ;?></td>
	<?php 
	for ( $i = 0; $i < 10; $i++ ) {

		if ( $data['transaction_document'][$i] != 'undefined' ) { ?>
	
			<td><a class="btn btn-primary" target="_blank" href="<?php echo wp_get_attachment_url( $data['transaction_document'][$i] ) ;?>"><span class="dashicons dashicons-download"></span> PDF</a></td>

			<?php break;
		}

	}
	?>
</tr>