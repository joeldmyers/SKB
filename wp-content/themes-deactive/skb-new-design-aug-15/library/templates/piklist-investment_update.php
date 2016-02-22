<tr>
	<td><?php echo $data['investment_update-date'];?></td>
	<td><?php echo $data['investment_title'];?></td>
	<td><a class="btn btn-primary" target="_blank" href="<?php echo wp_get_attachment_url( $data['investment_update-document'] ) ;?>"><span class="dashicons dashicons-download"></span> PDF</a></td>
</tr>