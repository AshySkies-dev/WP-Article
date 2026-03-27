<?php
get_header(); 
?>

<div id="primary" class="content-area container">
    <main id="main" class="site-main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?= esc_attr(get_the_ID()); ?>" <?php post_class(); ?>>
                <h2><?= get_the_title(); ?></h2>
                <ul>
                    <li><b>?????: <?= get_post_meta(get_the_ID(), 'authors', true); ?></b></li>
                </ul>
                <br>
                <div><?= apply_filters('the_content', get_the_content()); ?></div>
            </article>
        <?php endwhile; endif; ?>
    </main>
</div>

<?php get_footer(); ?>