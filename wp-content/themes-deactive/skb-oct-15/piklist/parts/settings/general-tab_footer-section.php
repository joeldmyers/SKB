<?php
/*
Title: Footer Settings
Setting: skb_theme_settings
Order: 20
*/

piklist( 'field', array(
		'type' => 'editor',
		'field' => 'footer_contact',
		'label' => __( 'Footer Contact Info' ),
		'description' => __( 'Contact info to show in last footer spot.' ),
		'value' => '<ul class="pull-right">
<li>skb in crowd</li>
<li>810 nw marshall street</li>
<li>portland, oregon 97209</li>
<li>888-123-4567</li>
</ul>',
		'options' => array (
			'wpautop' => false,
			'media_buttons' => false,
			'tabindex' => '',
			'editor_css' => '',
			'editor_class' => '',
			'teeny' => false,
			'dfw' => false,
			'tinymce' => true,
			'quicktags' => true,
		)
	)
);