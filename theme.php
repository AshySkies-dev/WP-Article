<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if ( have_posts() ) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php single_term_title(); ?></h1>
            </header>

            <?php

            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content', 'archive' );
            endwhile;
        else :
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>
    </main>
</div>

<?php get_footer(); ?>