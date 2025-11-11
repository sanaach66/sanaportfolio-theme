<?php get_header(); ?>

<main class="site-main">
<?php
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        // Using a template-part keeps things tidy
        get_template_part( 'template-parts/content', get_post_type() );
    endwhile;
else :
    echo '<p>' . esc_html__( 'No posts found', 'sanaportfolio' ) . '</p>';
endif;
?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
