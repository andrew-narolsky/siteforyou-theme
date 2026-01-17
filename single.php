<?php get_header(); ?>

    <main>
        <?php the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </main>

<?php get_footer(); ?>