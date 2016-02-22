<?php /* Template Name: Docusign Started */ 
if ( isset( $_REQUEST['url'] ) ) {

	$docusign_url = urldecode( $_REQUEST['url'] ) ;

} else {

	wp_redirect( home_url() );

}

get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<img title="SKB IN CROWD" src="/wp-content/themes/skb/library/images/logo.png" alt="SKB IN CROWD">
		</div>
	</div>
</div>

<iframe src="<?php echo $docusign_url; ?>" scrolling="yes" width="100%" height="800" frameborder="0"></iframe>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ul>
					<li><img title="SKB IN CROWD" src="/wp-content/themes/skb/library/images/logo-footer.png" alt=""></li>
					<li>810 NW Marshall Street</li>
					<li>Portland, Oregon 97209</li>
					<li>877-795-4679</li>
				</ul>
			</div>
		</div>
	</div>
</footer>