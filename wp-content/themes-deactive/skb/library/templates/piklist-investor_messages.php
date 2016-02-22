<tr>
	<th><button type="button" class="btn-link" id="<?php echo $data['investor_message_postid']; ?>" data-toggle="collapse" href="#collapse_<?php echo $i;?>" aria-expanded="false" aria-controls="collapse<?php echo $i;?>"><span class="dashicons dashicons-plus-alt"></span></button></th>
	<th scope="row"><?php echo $data['investor_message_date']; ?></th>
	<td><?php echo $data['investor_message_investment']; ?></td>
	<td><?php echo $data['investor_message_entity']; ?></td>
	<td><?php echo $data['investor_message_subject']; ?></td>
	<td id="<?php echo 'msg_status_' . $data['investor_message_postid'] ?>"><?php echo $data['investor_message_status']; ?></td>
</tr>
<tr class="collapse" id="collapse_<?php echo $i; ?>">
	<td colspan="6"><?php echo $data['investor_message_content']; ?></td>
</tr>