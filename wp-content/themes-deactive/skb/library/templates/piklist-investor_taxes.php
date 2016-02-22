<tr>
	<th scope="row"><?php echo $data['tax_year'] ;?></th>
	<td><?php echo get_the_title( $data['tax_investment']) ;?></td>
	<td><?php echo $data['tax_investment_entity'] ;?></td>
	<td><?php echo $data['tax_form'] ;?></td>
	<?php 
	for ( $i = 0; $i < 10; $i++ ) {

		if ( $data['tax_document'][$i] != 'undefined' ) { ?>
	
			<td><a class="btn btn-primary" target="_blank" href="<?php echo wp_get_attachment_url( $data['tax_document'][$i] ) ;?>"><span class="dashicons dashicons-download"></span> PDF</a></td>

			<?php break;
		}

	}
	?>
</tr>