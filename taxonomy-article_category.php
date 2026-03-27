<?php
$args = [
    'post_type'      => 'article',
    'posts_per_page' => 10,
];

if (is_tax('article_category')) {
    $args['tax_query'] = [[
        'taxonomy' => 'article_category',
        'field'    => 'term_id',
        'terms'    => get_queried_object_id(),
    ]];
}

$articles = get_posts($args);

if ($articles) :
    foreach ($articles as $post) : setup_postdata($post); ?>
        <article>
            <h2><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></h2>
            <div><?php echo get_the_excerpt($post->ID); ?></div>
        </article>
    <?php endforeach;
    wp_reset_postdata();
endif; ?>
