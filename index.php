<!DOCTYPE html>
<html>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>
		<?php echo wp_get_document_title(); ?>
	</title>

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" />

	<?php wp_head(); ?>
</head>

<body>
	
    <?php get_header(); ?>

	<div class="middle">
	<?php
		
		if ( have_posts() ){
			while ( have_posts() ){
				the_post();

				echo '<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a> </h3>';

				echo get_the_excerpt();
			}
		}
		
		else{
			echo ' <p>  </p>';
		}
		?>
	</div>
	<section class="search-filter">
    <form id="ajax-search-form" action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST">
        <input type="text" name="keyword" placeholder="Поиск">

        <input type="text" name="author_meta" placeholder="Имя автора">

        <select name="year">
            <option value="">Годы</option>
            <?php 
            $years = range(date('Y'), 2020);
            foreach($years as $year) echo "<option value='$year'>$year</option>";
            ?>
        </select>

        <button type="submit">Найти</button>
        <input type="hidden" name="action" value="article_search">
    </form>

    <div id="search-results">
        </div>
	</section>
	
	<?php get_footer(); ?>
	<?php wp_footer(); ?>

</body>

</html>
