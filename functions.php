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

function create_meta_box() {
    add_meta_box(
        'extra_details_box',      
        'Дополнительные параметры', 
        'render_meta_box',     
        'post',                 
        'normal',                 
        'high'                   
    );
}
add_action('add_meta_boxes', 'create_meta_box');

function render_meta_box($post) {
    wp_nonce_field('meta_box_nonce_action', 'meta_box_nonce_field');
	
    $text_val     = get_post_meta($post->ID, '_my_text_field', true);
    $textarea_val = get_post_meta($post->ID, '_my_textarea_field', true);
    $select_val   = get_post_meta($post->ID, '_my_select_field', true);
    $checkbox_val = get_post_meta($post->ID, '_my_checkbox_field', true);

    ?>
    <p>
        <label for="my_text_field"><strong>Подзаголовок:</strong></label><br />
        <input type="text" id="my_text_field" name="my_text_field" value="<?php echo esc_attr($text_val); ?>" style="width:100%;" />
    </p>

    <p>
        <label for="my_textarea_field"><strong>Заметки автора:</strong></label><br />
        <textarea id="my_textarea_field" name="my_textarea_field" rows="4" style="width:100%;"><?php echo esc_textarea($textarea_val); ?></textarea>
    </p>

    <p>
        <label for="my_select_field"><strong>Сложность материала:</strong></label><br />
        <select id="my_select_field" name="my_select_field">
            <option value="easy" <?php selected($select_val, 'easy'); ?>>Легкий</option>
            <option value="medium" <?php selected($select_val, 'medium'); ?>>Средний</option>
            <option value="hard" <?php selected($select_val, 'hard'); ?>>Сложный</option>
        </select>
    </p>

    <p>
        <label>
            <input type="checkbox" name="my_checkbox_field" value="yes" <?php checked($checkbox_val, 'yes'); ?> />
            <strong>Скрыть дату публикации?</strong>
        </label>
    </p>
    <?php
}

function save_meta_box_data($post_id) {
    if (!isset($_POST['meta_box_nonce_field']) || !wp_verify_nonce($_POST['meta_box_nonce_field'], 'meta_box_nonce_action')) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['my_text_field'])) {
        update_post_meta($post_id, '_my_text_field', sanitize_text_field($_POST['my_text_field']));
    }

    if (isset($_POST['my_textarea_field'])) {
        update_post_meta($post_id, '_my_textarea_field', sanitize_textarea_field($_POST['my_textarea_field']));
    }

    if (isset($_POST['my_select_field'])) {
        update_post_meta($post_id, '_my_select_field', $_POST['my_select_field']);
    }

    $checkbox_value = isset($_POST['my_checkbox_field']) ? 'yes' : 'no';
    update_post_meta($post_id, '_my_checkbox_field', $checkbox_value);
}
add_action('save_post', 'save_meta_box_data');
?>
