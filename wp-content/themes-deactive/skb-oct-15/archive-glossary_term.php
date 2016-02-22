<?php 
get_header(); 
$theme_settings = get_option('skb_theme_settings');
$glossary_banner = $theme_settings['glossary_banner'];
$image_id = is_array( $glossary_banner ) ? $glossary_banner[count( $glossary_banner ) - 1] : $glossary_banner;
$glossary_intro = $theme_settings['glossary_intro'];
$glossary_sidebar = $theme_settings['glossary_sidebar'];

if ( $glossary_banner ) {

    echo '<div class="hero"><img class="img-responsive" src="' . wp_get_attachment_url( $image_id ) . '"></div>';
    echo '<br><br>';

} 

?>

<div class="container">
<div class="row">

<?php
if ( $glossary_sidebar != '' ) {

    echo '<div class="col-xs-12 col-sm-7 col-md-8" id="main-content">';
    $sidebar = true;

} else {

    echo '<div class="col-xs-12" id="main-content">';
    $sidebar = false;

}   

echo do_shortcode( wpautop( $glossary_intro ) );

echo '<div class="btn-group" role="group">';

$taxonomy = 'glossary_category';

// save the terms that have posts in an array as a transient
if ( false === ( $alphabet = get_transient( 'skb_glossary_alphabet' ) ) ) {
    // It wasn't there, so regenerate the data and save the transient
    $terms = get_terms($taxonomy);

    $alphabet = array();
    if ( $terms ) {
        foreach ( $terms as $term ){
            $alphabet[] = $term->slug;
        }
    }

    set_transient( 'skb_glossary_alphabet', $alphabet );
}


foreach ( range( 'a', 'z' ) as $i ) {

    if ( in_array( $i, $alphabet ) ) {

        echo '<a href="#' . strtoupper( $i ) . '" title="Jump to terms starting with letter ' . strtoupper( $i ) . '">' . strtoupper( $i ) . '</a> | ';

    } else {

        echo '<span style="color: gray;">' . strtoupper( $i ) . '</span> | ';

    }

}

echo '</div>';

get_template_part( 'library/templates/loop', 'glossary_term' );

echo '</div>';

if ( $sidebar ) {

    echo '<div class="hidden-xs col-sm-5 col-md-4">';
    echo '<div class="well">';
    echo do_shortcode( wpautop( $glossary_sidebar ) );
    echo '</div>';
    echo '</div>';
    
}

?>

</div>
</div>

<?php get_footer();