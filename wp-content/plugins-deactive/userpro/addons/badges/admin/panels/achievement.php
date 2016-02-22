<?php global $userpro, $userpro_badges; ?>

<p class="upadmin-highlight"><?php _e('You can find the achievement badges that you have created and edit the rules of achievement from this page.','userpro'); ?></p>

<table class="wp-list-table widefat fixed">

	<thead>
		<tr>
			<th scope='col' class='manage-column'><?php _e('Achievement Type','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Required','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Badge Title','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Badge','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Actions','userpro'); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th scope='col' class='manage-column'><?php _e('Achievement Type','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Required','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Badge Title','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Badge','userpro'); ?></th>
			<th scope='col' class='manage-column'><?php _e('Actions','userpro'); ?></th>
		</tr>
	</tfoot>

	<?php
	$achievement = get_option('_userpro_badges');
	if (isset($achievement)){
	?>

		<?php if (is_array($achievement) ) {
			foreach($achievement as $k => $badge) { 
			
			if ( is_array($badge) && count($badge) > 1) {
			
			?>
			
			<?php foreach($badge as $n => $arr) { ?>
			<tr>
				<td valign="top"><?php echo $k; ?></td>
				<td valign="top"><?php echo $n; ?></td>
				<td valign="top"><?php echo $arr['badge_title']; ?></td>
				<td valign="top"><img src="<?php echo $arr['badge_url']; ?>" alt="" /></td>
				<td valign="top"><a href="<?php echo admin_url(); ?>admin.php?page=userpro-badges&tab=manage&btype=<?php echo $k; ?>&bid=<?php echo $n; ?>"><?php _e('Edit','userpro'); ?></a> | <a href="#" class="userpro-badge-remove" data-btype="<?php echo $k; ?>" data-bid="<?php echo $n; ?>"><?php _e('Remove','userpro'); ?></a></td>
			</tr>
			<?php } ?>
			
			<?php } else { ?>
			
			<tr>
				<td valign="top"><?php echo $k; ?></td>
				<?php foreach($badge as $n => $arr) { ?>
				<td valign="top"><?php echo $n; ?></td>
				<td valign="top"><?php echo $arr['badge_title']; ?></td>
				<td valign="top"><img src="<?php echo $arr['badge_url']; ?>" alt="" /></td>
				<td valign="top"><a href="<?php echo admin_url(); ?>admin.php?page=userpro-badges&tab=manage&btype=<?php echo $k; ?>&bid=<?php echo $n; ?>"><?php _e('Edit','userpro'); ?></a> | <a href="#" class="userpro-badge-remove" data-btype="<?php echo $k; ?>" data-bid="<?php echo $n; ?>"><?php _e('Remove','userpro'); ?></a></td>
				<?php } ?>
			</tr>
			
			<?php } ?>
			
		<?php }

		} ?>
		
	<?php
		}
	?>

</table>