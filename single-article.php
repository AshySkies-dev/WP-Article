<?php get_header(); ?>

<main id="main-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>">
            <h1><?php the_title(); ?></h1>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <div class="post-meta">
                Категории: <?php echo get_the_term_list($post->ID, 'article_category', '', ', '); ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
