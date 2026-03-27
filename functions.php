<?php
add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'article', [
		'label'  => null,
		'labels' => [
			'name'               => 'Статьи', 
			'singular_name'      => 'Статья', 
			'add_new'            => 'Добавить статью', 
			'add_new_item'       => 'Добавить новую статью', 
			'edit_item'          => 'Редактирование статьи', 
			'new_item'           => 'Новая статья', 
			'view_item'          => 'Посмотреть статью', 
			'search_items'       => 'Найти статью', 
			'not_found'          => 'Статей не найдено', 
			'not_found_in_trash' => 'Статей не найдено в корзине', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'Статьи', 
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true, 
		'show_in_rest'           => true, 
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor' , 'thumbnail', 'excerpt'], 
		'has_archive'            => true,
		'rewrite'                => true,
	] );
}

add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
	register_taxonomy( 'article_category', [ 'article' ], [
		'label'                 => '', 
		'labels'                => [
			'name'              => 'Категории статей',
			'singular_name'     => 'Категория',
			'search_items'      => 'Найти категорию',
			'all_items'         => 'Все категории',
			'view_item '        => 'Посмотреть категорию',
			'parent_item'       => 'Родительская категория',
			'parent_item_colon' => 'Родительская категория:',
			'edit_item'         => 'Изменить категорию',
			'update_item'       => 'Обновить категорию',
			'add_new_item'      => 'Добавить новую категорию',
			'new_item_name'     => 'Имя новой категории',
			'menu_name'         => 'Категории',
			'back_to_items'     => 'Вернуться',
		],
		'description'           => '', 
		'public'                => true,
		'hierarchical'          => true,
        'show_ui'               => true,
		'show_admin_column'     => true, 
		'show_in_rest'          => true, 
	] );
}
?>
