<?php get_header(); ?>

<?php
// Include the hero section
get_template_part('hero-section');
?>

<!-- CONTENT -->

<main class="content<?php echo is_front_page() ? '-1' : ''; ?>">
    <?php the_content(); ?>
    <?php do_action("mytheme_page_content_loaded"); ?>

    <?php if ( is_active_sidebar( 'shop-sidebar' ) ) : ?>
    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'shop-sidebar' ); ?>
    </div><!-- #primary-sidebar -->
<?php endif; ?>
</main>

<?php get_footer(); ?>