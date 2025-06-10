<?php
/**
 * The front page template file
 *
 * @package Alepo
 * @since 1.0.0
 */

get_header();
?>

<main id="main" class="site-main">
    <?php while ( have_posts() ) : the_post(); ?>
        
        <!-- Page Content -->
        <div class="page-content">
            <?php the_content(); ?>
        </div>
        
        <!-- Page Builder Sections -->
        <?php if ( function_exists( 'have_rows' ) && have_rows( 'page_sections' ) ) : ?>
            <?php while ( have_rows( 'page_sections' ) ) : the_row(); ?>
                <?php
                // Include template parts for each section layout
                $layout = get_row_layout();
                get_template_part( 'template-parts/sections/section', $layout );
                ?>
            <?php endwhile; ?>
        <?php endif; ?>
        
    <?php endwhile; ?>
</main>

<?php
get_footer();