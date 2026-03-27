<?php
require_once 'post_types/index.php';
require_once "taxonomies/index.php";

function handle_search_articles() {
    $search_text = isset($_POST['text']) ? sanitize_text_field($_POST['text']) : '';
    $search_author = isset($_POST['author']) ? sanitize_text_field($_POST['author']) : '';
    $search_institution = isset($_POST['institution']) ? sanitize_text_field($_POST['institution']) : '';
    $search_language = isset($_POST['language']) ? sanitize_text_field($_POST['language']) : '';
    $search_year = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';

    $args = [
        'post_type' => 'article',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        's' => $search_text,
    ];

    $meta_query = [];

    if (!empty($search_author)) {
        $meta_query[] = [
            'key' => 'authors',
            'value' => $search_author,
            'compare' => 'LIKE'
        ];
    }

    if (!empty($search_institution)) {
        $meta_query[] = [
            'key' => 'institution',
            'value' => $search_institution,
            'compare' => 'LIKE'
        ];
    }

    if (!empty($search_language)) {
        $meta_query[] = [
            'key' => 'language',
            'value' => $search_language,
            'compare' => 'LIKE'
        ];
    }

    if (!empty($search_year)) {
        $meta_query[] = [
            'key' => 'year',
            'value' => $search_year,
            'compare' => 'LIKE'
        ];
    }

    if ($meta_query) {
        $args['meta_query'] = $meta_query;
    }

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<div class="articles-container">'; // ?????????? ?? ?? ?????????
    while ($query->have_posts()) {
        $query->the_post();
        ?>
        <div class="article-card">
            <a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a>
            
            <!-- ??????????? ????????? -->
            <?php
            $categories = wp_get_post_terms( get_the_ID(), 'article_category' );
            if ( !empty($categories) && !is_wp_error($categories) ) {
                $category_names = array();
                foreach ( $categories as $category ) {
                    $category_names[] = esc_html( $category->name );
                }
                 echo '<div class="article-categories" style="font-size:25px; color:##010a24; margin-top:10px; text-align: center;">' . implode( ', ', $category_names ) . '</div>';
            }
            ?>
        </div>
        <?php
    }
    echo '</div>';

    } else {
        echo '<p>?????? ?? ???????.</p>';
    }

    wp_die();
}

add_action('wp_ajax_search', 'handle_search_articles');
add_action('wp_ajax_nopriv_search', 'handle_search_articles');


function my_enqueue_scripts() {
    wp_enqueue_style('style-name', get_template_directory_uri() . '/style.css');

    wp_enqueue_script('search-js', get_template_directory_uri() . '/JS/search.js', ['jquery']);

    // ??????????? ??????? ??? AJAX
    wp_localize_script('search-js', 'ajax_object', [
        'ajaxurl' => admin_url('admin-ajax.php')
    ]);

    // wp_enqueue_script('search-js');
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');
?>