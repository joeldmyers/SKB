<div class="userpro-post-wrap">

	<?php if ($post_query->have_posts() ) { ?>
	
	<div class="userpro-posts">
	
	<?php while ($post_query->have_posts()) { $post_query->the_post(); ?>
	
		<?php if ($postsbyuser_mode == 'compact' ) { ?>
		
		<div class="userpro-post userpro-post-compact">

			<?php if ($postsbyuser_showthumb == 1) {?>
			<div class="userpro-post-img">
				<a href="<?php the_permalink(); ?>"><?php echo $userpro->post_thumb( $post->ID, $postsbyuser_thumb ); ?><span class="shadowed"></span><span class="iconed"></span></a>
			</div>
			<?php } ?>
				
			<div class="userpro-post-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			
			<div class="userpro-post-stat">
				<a href="<?php the_permalink(); ?>#comments"><i class="userpro-icon-comment"></i> <?php echo get_comments_number(); ?></a>
			</div>
			
			<div class="userpro-clear"></div>
		
		</div><div class="userpro-clear"></div>
		
		<?php } else { ?>
		
		<div class="userpro-post">

			<div class="userpro-post-img">
				<a href="<?php the_permalink(); ?>"><?php echo $userpro->post_thumb( $post->ID ); ?><span class="shadowed"></span><span class="iconed"></span></a>
			</div>
			
			<div class="userpro-post-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
			
			<div class="userpro-post-stat">
				<?php  
				
				$my_post = get_post($post->ID); // $id - Post ID
       		 		 $author_id= $my_post->post_author;
				if($args['usercanedit']==1 &&(get_current_user_id()==$author_id || is_super_admin(get_current_user_id()))) {?>
				<input type="button" value="Delete" id='postsbyuserddelete' class="userpro-button" onclick="userpro_delete_userpost(<?php echo $post->ID;?>,this);" />
	                         <?php $link=get_publish_page_link();
			
				
					$link.=	"?post_id=".$post->ID;			
					?>
				
				<a href="<?php echo $link?>"><i class="userpro-icon-edit"></i> Edit </a>&nbsp;&nbsp;
				<?php }?>
				<a href="<?php the_permalink(); ?>#comments"><i class="userpro-icon-comment"></i> <?php echo get_comments_number(); ?></a>
			</div>
		
		</div>
		
		<?php } ?>
	
	<?php } ?>
	
	</div>
		
	<?php } else { // no results ?>
		
	<?php } ?>
	
</div><div class="userpro-clear"></div>
<?php if($is_paginate) { ?>
<div class="userpro-paginate bottom"><?php echo $paginate; ?></div>
<?php  } ?>
