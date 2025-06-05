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
        
        <!-- Hero Section -->
        <?php if ( function_exists( 'get_field' ) ) : ?>
            <?php
            $hero_headline = get_field( 'hero_headline' );
            $hero_subheadline = get_field( 'hero_subheadline' );
            $hero_cta_primary = get_field( 'hero_cta_primary' );
            $hero_cta_primary_url = get_field( 'hero_cta_primary_url' );
            $hero_cta_secondary = get_field( 'hero_cta_secondary' );
            $hero_cta_secondary_url = get_field( 'hero_cta_secondary_url' );
            ?>
            
            <?php if ( $hero_headline ) : ?>
                <section class="hero hero-home">
                    <div class="container">
                        <div class="hero-content">
                            <h1 class="hero-headline"><?php echo esc_html( $hero_headline ); ?></h1>
                            
                            <?php if ( $hero_subheadline ) : ?>
                                <p class="hero-subheadline"><?php echo esc_html( $hero_subheadline ); ?></p>
                            <?php endif; ?>
                            
                            <?php if ( $hero_cta_primary || $hero_cta_secondary ) : ?>
                                <div class="hero-actions">
                                    <?php if ( $hero_cta_primary && $hero_cta_primary_url ) : ?>
                                        <a href="<?php echo esc_url( $hero_cta_primary_url ); ?>" class="btn btn-primary btn-lg">
                                            <?php echo esc_html( $hero_cta_primary ); ?>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if ( $hero_cta_secondary && $hero_cta_secondary_url ) : ?>
                                        <a href="<?php echo esc_url( $hero_cta_secondary_url ); ?>" class="btn btn-secondary btn-lg">
                                            <?php echo esc_html( $hero_cta_secondary ); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>
        
        <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <?php the_content(); ?>
            </div>
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