<?php 
get_header(); 
$theme_settings = get_option('skb_theme_settings');
$faq_banner = $theme_settings['faq_banner'];
$image_id = is_array( $faq_banner ) ? $faq_banner[count( $faq_banner ) - 1] : $faq_banner;
$faq_intro = $theme_settings['faq_intro'];
$faq_sidebar = $theme_settings['faq_sidebar'];

if ( $faq_banner ) {

    echo '<div class="hero"><img class="img-responsive" src="' . wp_get_attachment_url( $image_id ) . '"></div>';
    echo '<br><br>';

} 

?>

<div class="container">
<div class="row">

<?php

if ( $faq_sidebar != '' ) {

    echo '<div class="col-xs-12 col-sm-7 col-md-8" id="main-content">';
    $sidebar = true;

} else {

    echo '<div class="col-xs-12" id="main-content">';
	$sidebar = false;

}   

echo do_shortcode( wpautop( $faq_intro ) );

get_template_part( 'library/templates/loop', 'faq' );

echo '</div>';

if ( $sidebar ) {

    echo '<div class="hidden-xs col-sm-5 col-md-4">';
    echo '<div class="well">';
    echo do_shortcode( wpautop( $faq_sidebar ) );
    echo '</div>';
    echo '</div>';
    
}

?>

</div>
</div>

<?php get_footer();