<?php /* This is the template used when a posts page is selected under reading settings */
get_header();

$posts_page = get_queried_object();
$posts_page_id = get_queried_object_id();

if ( has_post_thumbnail( $posts_page_id ) ) {

    $hero_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $posts_page_id ), 'full' );
    $hero_image = '<img class="img-responsive" src="' . $hero_image_src[0] . '">';
    echo '<div class="hero">' . $hero_image . '</div>';
    echo '<br><br>';
    
} 

echo '<div class="container">';
echo '<div class="row">';

$sidebar_content = get_post_meta( $posts_page_id, 'page_sidebar_content', true );

if ( $sidebar_content != '' ) {

    echo '<div class="col-xs-12 col-sm-7 col-md-8">';
    $sidebar = true;

} else {

    echo '<div class="col-xs-12">';
    $sidebar = false;

}        

echo '<h1>' . get_the_title( $posts_page_id ) . '</h1>';

echo apply_filters( 'the_content', $posts_page->post_content );

get_template_part( 'library/templates/loop', 'single' );

echo '</div>';

if ( $sidebar ) {

    echo '<div class="col-xs-12 col-sm-5 col-md-4">';
    echo '<div class="well">';
    echo do_shortcode( wpautop( $sidebar_content ) );
    echo '</div>';
    echo '</div>';

}

echo '</div>';
echo '</div>';

get_footer();