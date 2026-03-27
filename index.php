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

	
	<?php get_footer(); ?>
	<?php wp_footer(); ?>

</body>

</html>