<?php /* Template Name: Home */
get_header();
$theme_settings = get_option('skb_theme_settings');


if ( have_posts() ) { 

    while ( have_posts() ) { 

		the_post();

		if ( isset($sidebar_content) ) {

		    echo '<div class="col-xs-12 col-sm-7 col-md-8">';	    
		    $sidebar = true;
		
		} else {

		    echo '<div class="col-xs-5 top-header">';
			$sidebar = false;
	
		}        
                
                if (isset($show_title)) {
                    if ( 'Yes' == $show_title ) { 
                            the_title( '<h1>', '</h1>', TRUE ); 
                    }
                }
		the_content();

        echo '</div>';

        if ( $sidebar ) {

		    echo '<div class="hidden-xs col-sm-5 col-md-4">';
		    echo '<div class="well">';
		    echo do_shortcode( wpautop( $sidebar_content ) );
		    echo '</div>';
		    echo '</div>';

        }

    }

}

?>

<div class="container" id="skb-deals">
	<div class="investments news-lead">
		<div class="row">
                <?php
 $postslist = get_posts('numberposts=1&order=DESC&orderby=date');
 foreach ($postslist as $post) :
    setup_postdata($post);
 ?>
 <div class="col-xs-6">
	    		<h2 style="margin-top: 0;">NEWS</h2>
 <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 <?php //the_time(get_option('date_format')) ?>
 <?php the_excerpt(); ?>
 </div>
<?php $thumb_url_news = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
 <div class="col-xs-6"><img src="<?php echo $thumb_url_news ?>" width="100%"><br /></div>
 <?php endforeach; ?>
		</div>
	</div>
</div>


<?php get_footer();