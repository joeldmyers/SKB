<?php /* Template Name: Home */
get_header();
$theme_settings = get_option('skb_theme_settings');

if ( wp_is_mobile() && ! is_ipad() ) {

	get_mobile_banner();
	$investments_per_page = 4;


} else { 

	$investments_per_page = 8;
	get_slides( array(
		'posts_per_page' => -1,
		)
	);


	?>

	<div class="container hidden-xs">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2" style="text-align: center;">
				<?php echo do_shortcode( wpautop( $theme_settings['intro_spot'] ) ); ?>			
			</div>
		</div>
	</div>

	<?php

}

?>

<div class="container" id="skb-deals">
	<div class="investments">
		<div class="row">
			<div class="col-xs-12">
	    		<h2 style="text-align: center; margin-top: 0;"><?php echo $theme_settings['closed_deals_title']; ?></h2>
	    	</div>
		</div>
	    <div class="row">
			<?php 
			get_investments( array(
				'posts_per_page' => $investments_per_page,
				'meta_key'     => 'investment_featured',
				'meta_value'   => 'Yes',
				'meta_compare' => '=',				
				'tax_query' => array(
						array(
							'taxonomy' => 'investment_category',
							'field'    => 'slug',
							'terms'    => 'closed',
						),
					),
				)
			);
			?>
	    </div>
	</div>
</div>

<?php 
get_testimonials( array(
	'posts_per_page' => -1,
	)
);
?>

<?php
$about_image = $theme_settings['about_image'];
$last_image = count( $about_image ) - 1;
$about_image_src = wp_get_attachment_url( $about_image[$last_image] );
$about_image = '<img src="' . $about_image_src . '" class="img-responsive" >';
?>

<div class="about">
	<div class="image" style="background-image: url( '<?php echo $about_image_src; ?>' );">
		<span style="background-color: rgba(0,0,0,0.6); display: block; text-align: center; color: white; font-weight: 700; padding: 5px 0;">SKB Headquarters, Portland OR</span>
	</div>
	<div class="caption">
		<?php echo $theme_settings['about_caption']; ?>
	</div>	
</div>

<?php /* Turned off for now
<div class="partners">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
	    		<h2 style="text-align: center;"><?php echo $theme_settings['partners_title']; ?></h2>
	    		<p style="text-align: center;"><?php echo $theme_settings['partners_caption']; ?></p>
	    	</div>
		</div>
	    <div class="row">
			<?php 
			get_partners( array(
				'posts_per_page' => 3,
				)
			);
			?>
	    </div>
	</div>
</div>
*/ ?>

<div class="find-out-more">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php echo $theme_settings['find_out_more']; ?>
			</div>
		</div>
	</div>
</div>

<div class="privacy-notice">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php echo $theme_settings['privacy_notice']; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer();