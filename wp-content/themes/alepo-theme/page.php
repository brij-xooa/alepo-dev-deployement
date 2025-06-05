<?php
/**
 * The template for displaying all pages
 *
 * @package Alepo
 */

get_header();
?>

<main id="primary" class="site-main">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section -->
        <?php if (alepo_get_field('hero_headline') || is_front_page()) : ?>
            <section class="hero <?php echo is_front_page() ? 'hero-homepage' : 'hero-page'; ?>">
                <div class="container">
                    <div class="hero-content">
                        <?php if (!is_front_page()) : ?>
                            <?php alepo_breadcrumbs(); ?>
                        <?php endif; ?>
                        
                        <h1 class="hero-headline">
                            <?php 
                            $hero_headline = alepo_get_field('hero_headline');
                            if ($hero_headline) {
                                echo esc_html($hero_headline);
                            } else {
                                the_title();
                            }
                            ?>
                        </h1>
                        
                        <?php if (alepo_get_field('hero_subheadline')) : ?>
                            <p class="hero-subheadline">
                                <?php echo esc_html(alepo_get_field('hero_subheadline')); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (alepo_get_field('hero_cta_primary') || alepo_get_field('hero_cta_secondary')) : ?>
                            <div class="hero-actions">
                                <?php if (alepo_get_field('hero_cta_primary')) : ?>
                                    <a href="<?php echo esc_url(alepo_get_field('hero_cta_primary_url', null, '/request-demo')); ?>" 
                                       class="btn-primary">
                                        <?php echo esc_html(alepo_get_field('hero_cta_primary')); ?>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (alepo_get_field('hero_cta_secondary')) : ?>
                                    <a href="<?php echo esc_url(alepo_get_field('hero_cta_secondary_url', null, '/contact')); ?>" 
                                       class="btn-secondary">
                                        <?php echo esc_html(alepo_get_field('hero_cta_secondary')); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php 
                    $hero_image = alepo_get_field('hero_image');
                    if ($hero_image && is_array($hero_image)) : 
                    ?>
                        <div class="hero-image">
                            <img src="<?php echo esc_url($hero_image['url']); ?>" 
                                 alt="<?php echo esc_attr($hero_image['alt'] ?: $hero_image['title']); ?>"
                                 loading="lazy">
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Page Content -->
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            <div class="container">
                
                <!-- Page Template Specific Content -->
                <?php if (alepo_is_template('page-product')) : ?>
                    <?php get_template_part('template-parts/content', 'product'); ?>
                    
                <?php elseif (alepo_is_template('page-solution')) : ?>
                    <?php get_template_part('template-parts/content', 'solution'); ?>
                    
                <?php elseif (alepo_is_template('page-industry')) : ?>
                    <?php get_template_part('template-parts/content', 'industry'); ?>
                    
                <?php elseif (alepo_is_template('page-company')) : ?>
                    <?php get_template_part('template-parts/content', 'company'); ?>
                    
                <?php else : ?>
                    <!-- Default Page Content -->
                    <div class="page-content-wrapper">
                        <div class="entry-content">
                            <?php the_content(); ?>
                            
                            <?php
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'alepo'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- ACF Flexible Content -->
                <?php if (function_exists('have_rows') && have_rows('flexible_content')) : ?>
                    <div class="flexible-content">
                        <?php while (have_rows('flexible_content')) : the_row(); ?>
                            
                            <?php if (get_row_layout() == 'content_section') : ?>
                                <section class="content-section">
                                    <?php if (get_sub_field('section_headline')) : ?>
                                        <h2><?php echo esc_html(get_sub_field('section_headline')); ?></h2>
                                    <?php endif; ?>
                                    
                                    <?php if (get_sub_field('section_content')) : ?>
                                        <div class="section-content">
                                            <?php echo wp_kses_post(get_sub_field('section_content')); ?>
                                        </div>
                                    <?php endif; ?>
                                </section>
                                
                            <?php elseif (get_row_layout() == 'feature_grid') : ?>
                                <section class="feature-grid">
                                    <?php if (get_sub_field('grid_headline')) : ?>
                                        <h2 class="grid-headline"><?php echo esc_html(get_sub_field('grid_headline')); ?></h2>
                                    <?php endif; ?>
                                    
                                    <?php if (have_rows('features')) : ?>
                                        <div class="features-container">
                                            <?php while (have_rows('features')) : the_row(); ?>
                                                <div class="feature-item card hover-lift">
                                                    <?php if (get_sub_field('feature_icon')) : ?>
                                                        <div class="feature-icon">
                                                            <?php echo esc_html(get_sub_field('feature_icon')); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (get_sub_field('feature_title')) : ?>
                                                        <h3><?php echo esc_html(get_sub_field('feature_title')); ?></h3>
                                                    <?php endif; ?>
                                                    
                                                    <?php if (get_sub_field('feature_description')) : ?>
                                                        <p><?php echo esc_html(get_sub_field('feature_description')); ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </section>
                                
                            <?php elseif (get_row_layout() == 'cta_section') : ?>
                                <section class="cta-section <?php echo esc_attr(get_sub_field('cta_background') ?: 'light'); ?>">
                                    <div class="cta-content">
                                        <?php if (get_sub_field('cta_headline')) : ?>
                                            <h2><?php echo esc_html(get_sub_field('cta_headline')); ?></h2>
                                        <?php endif; ?>
                                        
                                        <?php if (get_sub_field('cta_description')) : ?>
                                            <p><?php echo esc_html(get_sub_field('cta_description')); ?></p>
                                        <?php endif; ?>
                                        
                                        <div class="cta-actions">
                                            <?php if (get_sub_field('cta_primary_text')) : ?>
                                                <a href="<?php echo esc_url(get_sub_field('cta_primary_url') ?: '/request-demo'); ?>" 
                                                   class="btn-primary">
                                                    <?php echo esc_html(get_sub_field('cta_primary_text')); ?>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <?php if (get_sub_field('cta_secondary_text')) : ?>
                                                <a href="<?php echo esc_url(get_sub_field('cta_secondary_url') ?: '/contact'); ?>" 
                                                   class="btn-secondary">
                                                    <?php echo esc_html(get_sub_field('cta_secondary_text')); ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </section>
                                
                            <?php elseif (get_row_layout() == 'testimonial_section') : ?>
                                <section class="testimonial-section">
                                    <?php if (get_sub_field('testimonial_headline')) : ?>
                                        <h2><?php echo esc_html(get_sub_field('testimonial_headline')); ?></h2>
                                    <?php endif; ?>
                                    
                                    <?php if (have_rows('testimonials')) : ?>
                                        <div class="testimonials-container">
                                            <?php while (have_rows('testimonials')) : the_row(); ?>
                                                <div class="testimonial-item card">
                                                    <?php if (get_sub_field('testimonial_quote')) : ?>
                                                        <blockquote>
                                                            <?php echo esc_html(get_sub_field('testimonial_quote')); ?>
                                                        </blockquote>
                                                    <?php endif; ?>
                                                    
                                                    <div class="testimonial-attribution">
                                                        <?php if (get_sub_field('testimonial_name')) : ?>
                                                            <strong><?php echo esc_html(get_sub_field('testimonial_name')); ?></strong>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (get_sub_field('testimonial_company')) : ?>
                                                            <span><?php echo esc_html(get_sub_field('testimonial_company')); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </section>
                                
                            <?php elseif (get_row_layout() == 'stats_section') : ?>
                                <section class="stats-section">
                                    <?php if (get_sub_field('stats_headline')) : ?>
                                        <h2><?php echo esc_html(get_sub_field('stats_headline')); ?></h2>
                                    <?php endif; ?>
                                    
                                    <?php if (have_rows('statistics')) : ?>
                                        <div class="stats-container">
                                            <?php while (have_rows('statistics')) : the_row(); ?>
                                                <div class="stat-item">
                                                    <div class="stat-number">
                                                        <?php echo esc_html(get_sub_field('stat_number')); ?>
                                                    </div>
                                                    <div class="stat-label">
                                                        <?php echo esc_html(get_sub_field('stat_label')); ?>
                                                    </div>
                                                    <?php if (get_sub_field('stat_description')) : ?>
                                                        <div class="stat-description">
                                                            <?php echo esc_html(get_sub_field('stat_description')); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                </section>
                                
                            <?php endif; ?>
                            
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <!-- Global CTA Sections -->
                <?php 
                $cta_sections = alepo_get_field('cta_sections');
                if ($cta_sections && is_array($cta_sections)) : 
                ?>
                    <div class="global-cta-sections">
                        <?php foreach ($cta_sections as $cta) : ?>
                            <section class="global-cta-section <?php echo esc_attr($cta['cta_background'] ?: 'light'); ?>">
                                <div class="cta-content">
                                    <?php if (!empty($cta['cta_headline'])) : ?>
                                        <h2><?php echo esc_html($cta['cta_headline']); ?></h2>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($cta['cta_description'])) : ?>
                                        <p><?php echo esc_html($cta['cta_description']); ?></p>
                                    <?php endif; ?>
                                    
                                    <div class="cta-actions">
                                        <?php if (!empty($cta['cta_primary_text'])) : ?>
                                            <a href="<?php echo esc_url($cta['cta_primary_url'] ?: '/request-demo'); ?>" 
                                               class="btn-primary">
                                                <?php echo esc_html($cta['cta_primary_text']); ?>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($cta['cta_secondary_text'])) : ?>
                                            <a href="<?php echo esc_url($cta['cta_secondary_url'] ?: '/contact'); ?>" 
                                               class="btn-secondary">
                                                <?php echo esc_html($cta['cta_secondary_text']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        </article>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>

</main>

<style>
/* Page Styles */
.page-content {
    padding: var(--space-7) 0;
}

.page-content-wrapper {
    max-width: var(--container-content);
    margin: 0 auto;
}

.entry-content {
    font-size: var(--font-size-body);
    line-height: var(--line-height-normal);
}

.entry-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: var(--shadow-md);
}

.page-links {
    margin: var(--space-6) 0;
    text-align: center;
}

.page-links a {
    display: inline-block;
    padding: var(--space-2) var(--space-3);
    margin: 0 var(--space-1);
    background: var(--light-gray);
    color: var(--primary-blue);
    text-decoration: none;
    border-radius: 4px;
    transition: all var(--transition-fast);
}

.page-links a:hover {
    background: var(--primary-blue);
    color: var(--white);
}

/* Hero Section */
.hero {
    background: var(--gradient-light);
    padding: var(--space-8) 0;
    text-align: center;
}

.hero-homepage {
    padding: var(--space-9) 0;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero-headline {
    font-size: var(--font-size-hero);
    margin-bottom: var(--space-4);
    color: var(--dark-gray);
    font-weight: var(--font-weight-semibold);
}

.hero-subheadline {
    font-size: var(--font-size-large);
    color: var(--text-gray);
    margin-bottom: var(--space-6);
    line-height: var(--line-height-normal);
}

.hero-actions {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: var(--space-6);
}

.hero-image {
    margin-top: var(--space-6);
    max-width: 100%;
}

.hero-image img {
    width: 100%;
    max-width: 800px;
    height: auto;
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
}

/* Breadcrumbs */
.breadcrumbs {
    margin-bottom: var(--space-5);
    text-align: left;
}

.breadcrumb-list {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: var(--font-size-small);
}

.breadcrumb-list li {
    display: flex;
    align-items: center;
}

.breadcrumb-list li:not(:last-child)::after {
    content: '›';
    margin: 0 var(--space-2);
    color: var(--text-gray);
}

.breadcrumb-list a {
    color: var(--text-gray);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.breadcrumb-list a:hover {
    color: var(--primary-blue);
}

.breadcrumb-list li[aria-current="page"] {
    color: var(--dark-gray);
    font-weight: var(--font-weight-medium);
}

/* Flexible Content Sections */
.flexible-content {
    margin: var(--space-8) 0;
}

.content-section,
.feature-grid,
.cta-section,
.testimonial-section,
.stats-section,
.global-cta-section {
    margin-bottom: var(--space-8);
    padding: var(--space-7) 0;
}

.content-section h2,
.feature-grid .grid-headline,
.testimonial-section h2,
.stats-section h2 {
    text-align: center;
    margin-bottom: var(--space-6);
}

.section-content {
    max-width: var(--container-narrow);
    margin: 0 auto;
}

/* Feature Grid */
.features-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-6);
    margin-top: var(--space-6);
}

.feature-item {
    text-align: center;
    padding: var(--space-6);
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: var(--space-4);
    background: var(--gradient-blue);
    width: 80px;
    height: 80px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-4);
}

.feature-item h3 {
    margin-bottom: var(--space-3);
    font-size: var(--font-size-h4);
}

/* CTA Sections */
.cta-section,
.global-cta-section {
    text-align: center;
    border-radius: 12px;
    padding: var(--space-8) var(--space-6);
}

.cta-section.light,
.global-cta-section.light {
    background: var(--light-gray);
}

.cta-section.gradient,
.global-cta-section.gradient {
    background: var(--gradient-light);
}

.cta-section.blue,
.global-cta-section.blue {
    background: var(--primary-blue);
    color: var(--white);
}

.cta-content h2 {
    margin-bottom: var(--space-4);
}

.cta-content p {
    font-size: var(--font-size-large);
    margin-bottom: var(--space-6);
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-actions {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
    flex-wrap: wrap;
}

/* Testimonials */
.testimonials-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: var(--space-6);
    margin-top: var(--space-6);
}

.testimonial-item {
    padding: var(--space-6);
    text-align: center;
}

.testimonial-item blockquote {
    font-style: italic;
    font-size: var(--font-size-large);
    margin-bottom: var(--space-4);
    color: var(--dark-gray);
    position: relative;
}

.testimonial-item blockquote::before {
    content: '"';
    font-size: 4rem;
    color: var(--primary-blue);
    opacity: 0.3;
    position: absolute;
    top: -20px;
    left: -10px;
    font-family: Georgia, serif;
}

.testimonial-attribution strong {
    display: block;
    margin-bottom: var(--space-1);
}

.testimonial-attribution span {
    color: var(--text-gray);
    font-size: var(--font-size-small);
}

/* Statistics */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-6);
    margin-top: var(--space-6);
}

.stat-item {
    text-align: center;
    padding: var(--space-5);
    background: var(--white);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    transition: all var(--transition-medium);
}

.stat-item:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.stat-number {
    font-size: 3rem;
    font-weight: var(--font-weight-bold);
    color: var(--primary-blue);
    margin-bottom: var(--space-2);
    line-height: 1;
}

.stat-label {
    font-weight: var(--font-weight-semibold);
    margin-bottom: var(--space-2);
    color: var(--dark-gray);
}

.stat-description {
    font-size: var(--font-size-small);
    color: var(--text-gray);
}

/* Global CTA Sections */
.global-cta-sections {
    margin-top: var(--space-8);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-headline {
        font-size: var(--font-size-display);
    }
    
    .hero-subheadline {
        font-size: var(--font-size-body);
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-primary,
    .btn-secondary {
        width: 100%;
        max-width: 300px;
        text-align: center;
    }
    
    .features-container {
        grid-template-columns: 1fr;
        gap: var(--space-5);
    }
    
    .testimonials-container {
        grid-template-columns: 1fr;
    }
    
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .cta-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .breadcrumb-list {
        flex-wrap: wrap;
    }
}

@media (max-width: 480px) {
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .hero {
        padding: var(--space-6) 0;
    }
    
    .page-content {
        padding: var(--space-5) 0;
    }
    
    .content-section,
    .feature-grid,
    .cta-section,
    .testimonial-section,
    .stats-section {
        padding: var(--space-5) 0;
        margin-bottom: var(--space-6);
    }
}
</style>

<?php
get_footer();
?>