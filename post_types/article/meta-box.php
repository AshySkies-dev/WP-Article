<?php
function article_meta_box_callback($post) {
    wp_nonce_field( plugin_basename(__FILE__), 'article_meta_nonce' );

    $authors = get_post_meta($post->ID, 'authors', true);
    $institution = get_post_meta($post->ID, 'institution', true);
    $type = get_post_meta($post->ID, 'type', true);
    $language = get_post_meta($post->ID, 'language', true);
    $year = get_post_meta($post->ID, 'year', true);
    $annotation_ru = get_post_meta($post->ID, 'annotation_ru', true);
    $annotation_en = get_post_meta($post->ID, 'annotation_en', true);

    $types = ["??????? ??????","?????? ? ????????","?????"];
    $languages = ["???????", "??????????", "???????????"];

    ?>
    <p>
        <label for="authors">Authors:</label><br>
        <input type="text" style="width: 50%; height: 35px;" name="authors" id="authors" value="<?php echo esc_attr($authors); ?>">
    </p>
    <p>
        <label for="institution">Institution:</label><br>
        <input type="text" style="width: 50%; height: 35px;" name="institution" id="institution" value="<?php echo esc_attr($institution); ?>">
    </p>
    <p>
        <label for="type">Type:</label><br>
        <select name="type" style="width: 30%; height: 35px;" id="type">
            <?php
            foreach ($types as $t) {
                $sel = ($t == $type) ? ' selected' : '';
                echo "<option value='" . esc_attr($t) . "'$sel>" . esc_html($t) . "</option>";
            }
            ?>
        </select>
    </p>
    <p>
        <label for="language">Language:</label><br>
        <select name="language" style="width: 30%; height: 35px;" id="language">
            <?php
            foreach ($languages as $lang) {
                $sel = ($lang == $language) ? ' selected' : '';
                echo "<option value='" . esc_attr($lang) . "'$sel>" . esc_html($lang) . "</option>";
            }
            ?>
        </select>
    </p>

    <label for="year">Year:</label><br>
    <input name="year" type="number" value="<?php echo get_post_meta($post->ID, "year", true); ?>"><br><br>

    <label for="annotation_ru">Annotation in Russian:</label><br>
    <textarea  id="annotation_ru" style="width: 80%; height: 100px;" name="annotation_ru"><?php echo esc_textarea($annotation_ru); ?></textarea><br><br>

    <label for="annotation_en">Annotation in English:</label><br>
    <textarea  id="annotation_en" style="width: 80%; height: 100px;" name="annotation_en"><?php echo esc_textarea($annotation_en); ?></textarea><br><br>

    <label for="annotation_fr">Annotation in French:</label><br>
  <textarea id="annotation_fr" style="width: 80%; height: 100px;" name="annotation_fr"><?php echo esc_textarea($annotation_fr); ?></textarea><br><br>

    <?php
}

function save_article_meta_box_data($post_id) {
    
    if (!isset($_POST['article_meta_nonce']) || !wp_verify_nonce($_POST['article_meta_nonce'], plugin_basename(__FILE__))) {
        return;
    }

    if (!current_user_can('edit_post', $post_id) || empty($_POST)) {
        return;
    }
    
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    update_post_meta($post_id, 'authors', sanitize_text_field($_POST['authors']));
    update_post_meta($post_id, 'institution', sanitize_text_field($_POST['institution']));
    update_post_meta($post_id, 'type', sanitize_text_field($_POST['type']));
    update_post_meta($post_id, 'language', sanitize_text_field($_POST['language']));
    update_post_meta($post_id, 'year', sanitize_text_field($_POST['year']));
    update_post_meta($post_id, 'annotation_ru', sanitize_textarea_field($_POST['annotation_ru']));
    update_post_meta($post_id, 'annotation_en', sanitize_textarea_field($_POST['annotation_en']));
}

add_action('add_meta_boxes', 'add_article_meta_box');

add_action('save_post', 'save_article_meta_box_data', 10, 3);
