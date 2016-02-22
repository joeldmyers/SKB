<?php if ( ! wp_is_mobile() || is_ipad() || is_user_logged_in() ) { ?>
<div class="clearfix">
	<?php if ( wp_is_mobile() && ! is_ipad() ) { ?>
	<ul class="nav nav-pills nav-account">
	<?php } else { ?>
	<ul class="nav nav-pills pull-right nav-account">
	<?php } ?>
	<?php if ( is_user_logged_in() ) { ?>


	<?php } else { ?>

	<?php } ?>
	</ul>
</div>
<?php } ?>