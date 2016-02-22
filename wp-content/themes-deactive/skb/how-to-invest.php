<?php /* Template Name: How To Invest */
get_header();
$theme_image_dir = get_template_directory_uri() . '/library/images/';
if ( wp_is_mobile() && ! is_ipad() ) {
?>

<div class="how-to-invest-slider flexslider">
  <ul class="slides">
    <li>
      <img src="<?php echo $theme_image_dir; ?>SKB-HOW-IT-WORKS-Mobile-1.jpg" />
    </li>
    <li>
      <img src="<?php echo $theme_image_dir; ?>SKB-HOW-IT-WORKS-Mobile-2.jpg" />
    </li>
    <li>
      <img src="<?php echo $theme_image_dir; ?>SKB-HOW-IT-WORKS-Mobile-3.jpg" />
    </li>
  </ul>
</div>

<?php } else { ?>

<div class="how-to-invest-slider flexslider">
  <ul class="slides">
    <li>
      <img src="<?php echo $theme_image_dir; ?>SKB-HOW-IT-WORKS-1.jpg" />
    </li>
    <li>
      <img src="<?php echo $theme_image_dir; ?>SKB-HOW-IT-WORKS-2.jpg" />
    </li>
    <li>
      <img src="<?php echo $theme_image_dir; ?>SKB-HOW-IT-WORKS-3.jpg" />
    </li>
  </ul>
</div>

<?php } 

$theme_settings = get_option('skb_theme_settings');
$slider_speed = 1000 * (int) $theme_settings['slider_speed'];
?>

<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery('.how-to-invest-slider').flexslider({
    animation: "slide",
    keyboard: false,
    controlNav: false,
    slideshowSpeed: <?php echo $slider_speed; ?>,
	  animationSpeed: 500,
  });
});
</script>

<div class="container">
    <?php get_template_part( 'library/templates/content' , 'page' ); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery('#accredited').popover();
});
</script>

<?php get_footer();