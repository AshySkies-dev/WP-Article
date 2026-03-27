<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
    <h1>Karmanov Artyom</h1>
    <nav>
        <ul>
            <li><a href="<?php echo home_url('/'); ?>">Main</a></li>
            <li><a href="<?php echo home_url('/napravlenie'); ?>">Programme</a></li>
            <li><a href="<?php echo home_url('/web-programmirovanie'); ?>">Tasks</a></li>
            <li><a href="<?php echo home_url('/novosti'); ?>">News</a></li>
            <li><a href="<?php echo get_post_type_archive_link('article'); ?>" class="article">Articles</a></li>
        </ul>
    </nav>
    <?php if (is_front_page()) : ?>
    <div class="about-me">
        <h2>About me:</h2>
        <p> 
       My name is Karmanov Artyom,
       I'm in my third year of the "Business Informatics" programme 
       in the South Ural State University.
       I am passionate about programming and drawing in the style of Pixel-art.
    </p>

    </div>
    <?php endif; ?>
</header>