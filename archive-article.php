<?php
get_header(); 

$articles = get_posts([
    'numberposts' => -1,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'post_type'   => 'article',
    'suppress_filters' => true,
]);

function get_unique_meta_values($meta_key) {
    global $wpdb;
    $results = $wpdb->get_col($wpdb->prepare(
        "SELECT DISTINCT meta_value FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value != ''",
        $meta_key
    ));
    return $results;
}

$institution_values = get_unique_meta_values('institution');
$language_values = get_unique_meta_values('language');
$year_values = get_unique_meta_values('year');
?>

<div id="primary" class="content-area container">
    <main id="main" class="site-main">
        <h3>My articles</h3>

        <div>
            <h4>Article Search</h4>
            <h5><input type="text" class="search-field" id="search_content" placeholder="Insert Article Name"></h5>
            <h5><input type="text" class="search-field" id="search_author" placeholder="Insert Author Name"></h5>
        </div>

        <h5><button class="buttons" id="toggle_advanced_search">Advanced search</button></h5>

        <div id="advanced_search" style="display:none;">
            <h5>
                <select class="list" id="search_institution">
                    <option value="">Select institution</option>
                    <?php foreach ($institution_values as $institution): ?>
                        <option value="<?= esc_attr($institution); ?>"><?= esc_html($institution); ?></option>
                    <?php endforeach; ?>
                </select>
            </h5>

            <h5>
                <select class="list" id="search_language">
                    <option value="">Select Language</option>
                    <?php foreach ($language_values as $language): ?>
                        <option value="<?= esc_attr($language); ?>"><?= esc_html($language); ?></option>
                    <?php endforeach; ?>
                </select>
            </h5>

            <h5>
                <select class="list" id="search_year">
                    <option value="">Select year</option>
                    <?php foreach ($year_values as $year): ?>
                        <option value="<?= esc_attr($year); ?>"><?= esc_html($year); ?></option>
                    <?php endforeach; ?>
                </select>
            </h5>

            <button class="buttons"  id="search_run" type="button">Search</button>
            <button class="buttons"  id="reset_filters" type="button">Reset filter</button>
        </div>

<div class="articles-container"> 
  <?php if ($articles): ?>
    <?php foreach ($articles as $article): ?>
      <div class="article-card">
        <a href="<?= esc_url(get_permalink($article->ID)); ?>"><?= esc_html($article->post_title); ?></a>
        
         <?php
         $categories = wp_get_post_terms( $article->ID, 'article_category' );
         if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
            $category_names = array();
            foreach ( $categories as $category ) {
                $category_names[] = esc_html( $category->name );
            }
            echo '<div class="article-categories" style="font-size:25px; color:##010a24; margin-top:10px; text-align: center;">' . implode( ', ', $category_names ) . '</div>';
        }
        ?>  
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>Articles not found.</p>
  <?php endif; ?>
</div>
</div>

<?php get_footer(); ?>

</script>
