<?php /* Template Name: Registration Form */
$theme_settings = get_option('skb_theme_settings');
$show_title = get_post_meta( get_the_id(), 'show_title', true );

get_header();

if ( have_posts() ) { 

    while ( have_posts() ) { 

        the_post();

        if ( has_post_thumbnail() ) {

            $hero_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
            $hero_image = '<img class="img-responsive" src="' . $hero_image_src[0] . '">';
            echo '<div class="hero">' . $hero_image . '</div>';
            echo '<br><br>';
        
        } 

        echo '<div class="container">';
        echo '<div class="row">';

        $sidebar_content = get_post_meta( get_the_id(), 'page_sidebar_content', true );

        if ( $sidebar_content != '' ) {

            echo '<div class="col-xs-12 col-sm-7 col-md-8" id="main-content">';
            $sidebar = true;
        
        } else {

            echo '<div class="col-xs-12" id="main-content">';
            $sidebar = false;
    
        }        
    

        if ( 'Yes' == $show_title ) { 
            the_title( '<h1>', '</h1>', TRUE ); 
        }

        if ( is_user_logged_in() ) {

            $current_user = wp_get_current_user();
            echo '<p><strong>You are already registered and logged in as ' . $current_user->user_login . '.</strong></p>';

        } else {

            echo do_shortcode( '[skb_registration_form]' );

        }

        echo '</div>';

        if ( $sidebar ) {

            echo '<div class="hidden-xs col-sm-5 col-md-4">';
            echo '<div class="well">';
            echo do_shortcode( wpautop( $sidebar_content ) );
            echo '</div>';
            echo '</div>';

        }

    }

} else {

    echo '<div class="col-xs-12"><p>' . __( 'Page not found.', 'skb-theme' ) . '</p></div>';

}

echo '</div>';
echo '</div>';

?>

<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery('.accredited').popover();
});
</script>

<?php get_footer();