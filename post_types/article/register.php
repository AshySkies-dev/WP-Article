<?php
add_action( 'init', 'register_post_types' );

function register_post_types(){

	register_post_type( 'article', [
		'label'  => null,
		'labels' => [
			'name'               => 'article', 
			'singular_name'      => '', 
			'add_new'            => 'Add', 
			'add_new_item'       => 'Addition', 
			'edit_item'          => 'Edit ____', 
			'new_item'           => 'New', 
			'view_item'          => 'View', 
			'search_items'       => 'Search', 
			'not_found'          => 'Not found', 
			'not_found_in_trash' => 'Not found in trash', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'articles', 
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => null, 
		'show_in_rest'        => null, 
		'rest_base'           => null, 
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], 
		'taxonomies'          => [],
        'has_archive' => true,
        'rewrite'     => true,
		'query_var'   => true,
	] );

	  add_action( 'add_meta_boxes_article', 'add_article_meta_box' );

	}
	
	function add_article_meta_box() {
		add_meta_box(
			'article_meta_box', 
			'article meta data', 
			'article_meta_box_callback', 
			'article', 
			'normal', 
			'high' 
		);
	}
