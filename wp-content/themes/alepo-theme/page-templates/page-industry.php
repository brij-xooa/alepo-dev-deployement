<?php
/**
 * Template Name: Industry Page
 * Template for displaying industry pages
 */

get_header(); ?>

<main id="primary" class="site-main industry-page">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <div class="container">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div>
            </header>

            <div class="entry-content">
                <div class="container">
                    <?php
                    the_content();
                    
                    // ACF Fields if available
                    if( function_exists('get_field') ) {
                        $hero_content = get_field('hero_content');
                        $cta_primary = get_field('cta_primary');
                        
                        if( $hero_content ) {
                            echo '<div class="hero-content">' . $hero_content . '</div>';
                        }
                        
                        if( $cta_primary ) {
                            echo '<div class="cta-section">';
                            echo '<a href="' . esc_url($cta_primary['url']) . '" class="btn btn-primary">' . esc_html($cta_primary['text']) . '</a>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php
get_footer();