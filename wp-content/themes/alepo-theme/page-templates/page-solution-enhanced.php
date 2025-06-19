<?php
/**
 * Template Name: Solution Page (Enhanced)
 * 
 * Enhanced solution page template with Alepo Components Library
 * Features advanced hover effects, parallax scrolling, and sophisticated animations
 */

get_header(); ?>

<main id="primary" class="site-main solution-page enhanced-solution" role="main">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Add background effects for enhanced pages -->
        <div class="alepo-gradient-mesh"></div>
        <div class="alepo-curved-lines"></div>
        <div class="alepo-particles-bg"></div>
        
        <!-- Section 1: Breadcrumb Navigation -->
        <nav class="breadcrumb-section" aria-label="Breadcrumb">
            <div class="container">
                <?php alepo_breadcrumbs(); ?>
            </div>
        </nav>

        <!-- Section 2: Hero Section (existing code) -->
        <section class="hero-section" style="min-height: 500px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
            <div class="container">
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                <div class="wp-block-group">
                    
                    <!-- wp:columns {"verticalAlignment":"center"} -->
                    <div class="wp-block-columns are-vertically-aligned-center">
                        
                        <!-- wp:column {"width":"60%"} -->
                        <div class="wp-block-column" style="flex-basis:60%">
                            
                            <!-- wp:heading {"level":1,"fontSize":"48px-desktop-32px-mobile"} -->
                            <h1 class="wp-block-heading has-custom-font-size alepo-fade-in-up" style="font-size:48px">
                                <?php 
                                $hero_headline = alepo_get_field('hero_headline');
                                echo $hero_headline ? esc_html($hero_headline) : get_the_title();
                                ?>
                            </h1>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"fontSize":"24px-desktop-18px-mobile","className":"hero-subheadline"} -->
                            <p class="hero-subheadline has-custom-font-size alepo-fade-in-up" style="font-size:24px; animation-delay: 0.2s;">
                                <?php 
                                $hero_subheadline = alepo_get_field('hero_subheadline');
                                echo $hero_subheadline ? esc_html($hero_subheadline) : 'Transform your network operations with proven, scalable solutions.';
                                ?>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph -->
                            <p class="alepo-fade-in-up" style="animation-delay: 0.4s;"><?php 
                                $hero_description = alepo_get_field('hero_description');
                                echo $hero_description ? esc_html($hero_description) : 'Our carrier-grade platform delivers the reliability and performance CSPs need to thrive in today\'s competitive landscape.';
                            ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph {"className":"trust-badge"} -->
                            <p class="trust-badge alepo-fade-in-up" style="animation-delay: 0.6s;">
                                <strong>Trusted by leading CSPs worldwide with <?php echo alepo_get_field('trust_metric', null, '100+ million'); ?> subscribers</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons alepo-fade-in-up" style="animation-delay: 0.8s;">
                                <!-- wp:button {"backgroundColor":"primary","className":"cta-primary alepo-hover-lift"} -->
                                <div class="wp-block-button cta-primary alepo-hover-lift">
                                    <a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo alepo_get_field('cta_primary_url', null, '/request-demo'); ?>">
                                        <?php echo alepo_get_field('cta_primary_text', null, 'Request Demo'); ?>
                                    </a>
                                </div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->

                        </div>
                        <!-- /wp:column -->

                        <!-- wp:column {"width":"40%"} -->
                        <div class="wp-block-column" style="flex-basis:40%">
                            
                            <!-- wp:image {"sizeSlug":"large","className":"hero-visual alepo-hover-lift"} -->
                            <figure class="wp-block-image size-large hero-visual alepo-hover-lift">
                                <?php 
                                $hero_image = alepo_get_field('hero_image');
                                if ($hero_image) : ?>
                                    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" class="wp-image-<?php echo $hero_image['ID']; ?>" />
                                <?php else : ?>
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='400' viewBox='0 0 600 400'%3E%3Crect width='600' height='400' fill='%23e9ecef'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%236c757d'%3ESolution Diagram%3C/text%3E%3C/svg%3E" alt="Solution visualization" class="wp-image-0" />
                                <?php endif; ?>
                            </figure>
                            <!-- /wp:image -->

                        </div>
                        <!-- /wp:column -->

                    </div>
                    <!-- /wp:columns -->

                </div>
                <!-- /wp:group -->
            </div>
        </section>

        <!-- Section 3: Enhanced Capabilities Section with Alepo Components -->
        <section class="capabilities-section alepo-bg-gray-50 alepo-py-11">
            <div class="alepo-container">
                
                <!-- Section Title -->
                <h2 class="alepo-text-center alepo-mb-9 alepo-title-underline alepo-fade-in-up">
                    <span class="alepo-title-gradient">
                        <?php echo alepo_get_field('capability_group_title', null, 'Solution'); ?>
                    </span> Framework
                </h2>
                
                <!-- Enhanced Grid Layout -->
                <div class="alepo-grid-2">
                    
                    <!-- Left: Feature Cards with Advanced Effects -->
                    <div class="alepo-flex-column">
                        <?php 
                        $capabilities = alepo_get_field('key_capabilities');
                        if ($capabilities) {
                            foreach ($capabilities as $index => $capability) :
                                // Get icon based on capability name or use default
                                $icon_map = [
                                    'authentication' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
                                    'performance' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />',
                                    'migration' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />',
                                    'security' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
                                ];
                                
                                $capability_key = strtolower(str_replace(' ', '', $capability['name']));
                                $icon = isset($icon_map[$capability_key]) ? $icon_map[$capability_key] : '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>';
                        ?>
                        
                        <div class="alepo-feature-card">
                            <!-- Aim dot animation -->
                            <div class="alepo-aim-dot"></div>
                            
                            <!-- Mouse follow gradient -->
                            <div class="alepo-mouse-gradient"></div>
                            
                            <!-- Icon wrapper -->
                            <div class="alepo-icon-wrapper">
                                <svg class="alepo-icon" viewBox="0 0 24 24">
                                    <?php echo $icon; ?>
                                </svg>
                            </div>
                            
                            <!-- Content -->
                            <h3 class="alepo-feature-title"><?php echo esc_html($capability['name']); ?></h3>
                            <p class="alepo-feature-description">
                                <?php 
                                if (isset($capability['features']) && is_array($capability['features'])) {
                                    echo esc_html(implode('. ', array_slice($capability['features'], 0, 2)) . '.');
                                } else {
                                    echo esc_html($capability['benefit']);
                                }
                                ?>
                            </p>
                        </div>
                        
                        <?php 
                            endforeach;
                        } else {
                            // Default capabilities using ACF field data or fallback
                            $default_capabilities = [
                                [
                                    'name' => 'Zero-Downtime Migration',
                                    'description' => 'Seamlessly transition from legacy systems to modern architecture with parallel deployment strategy.',
                                    'icon' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />'
                                ],
                                [
                                    'name' => 'Performance Amplification', 
                                    'description' => '10x performance improvement with cloud-native architecture and elastic scaling.',
                                    'icon' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />'
                                ],
                                [
                                    'name' => 'Security Enhancement',
                                    'description' => 'Advanced threat detection and zero-trust principles protect against evolving cyber threats.',
                                    'icon' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />'
                                ]
                            ];
                            
                            foreach ($default_capabilities as $capability) :
                        ?>
                        
                        <div class="alepo-feature-card">
                            <!-- Aim dot animation -->
                            <div class="alepo-aim-dot"></div>
                            
                            <!-- Mouse follow gradient -->
                            <div class="alepo-mouse-gradient"></div>
                            
                            <!-- Icon wrapper -->
                            <div class="alepo-icon-wrapper">
                                <svg class="alepo-icon" viewBox="0 0 24 24">
                                    <?php echo $capability['icon']; ?>
                                </svg>
                            </div>
                            
                            <!-- Content -->
                            <h3 class="alepo-feature-title"><?php echo esc_html($capability['name']); ?></h3>
                            <p class="alepo-feature-description"><?php echo esc_html($capability['description']); ?></p>
                        </div>
                        
                        <?php endforeach; } ?>
                    </div>
                    
                    <!-- Right: Sticky Diagram Container -->
                    <div class="alepo-sticky-container">
                        <div class="alepo-sticky-wrapper">
                            
                            <h3 class="alepo-fade-in-up" style="font-size: var(--font-size-h3); font-weight: var(--font-weight-semibold); color: var(--c-gray-900); margin-bottom: var(--space-5);">
                                Integrated Solution Architecture
                            </h3>
                            
                            <div class="alepo-diagram-container" style="min-height: 500px;">
                                <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                                    
                                    <!-- Floating particles -->
                                    <div class="alepo-particle-container"></div>
                                    
                                    <!-- Diagram content -->
                                    <div style="position: relative; z-index: 2; color: var(--c-gray-600); text-align: center;">
                                        <?php 
                                        $solution_diagram = alepo_get_field('solution_diagram');
                                        if ($solution_diagram) : ?>
                                            <img src="<?php echo esc_url($solution_diagram['url']); ?>" alt="<?php echo esc_attr($solution_diagram['alt']); ?>" style="max-width: 100%; height: auto;" />
                                        <?php else : ?>
                                            <p style="font-size: var(--font-size-body-lg); margin-bottom: var(--space-3); font-weight: var(--font-weight-medium);">
                                                <?php echo alepo_get_field('capability_group_title', null, 'Solution'); ?> Architecture
                                            </p>
                                            <p style="font-size: var(--font-size-small); opacity: 0.7;">
                                                [Your architecture diagram here]
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>

        <!-- Continue with remaining sections -->
        <?php 
        // Include the rest of the template sections
        include(get_template_directory() . '/template-parts/solution/technical-features.php');
        include(get_template_directory() . '/template-parts/solution/business-benefits.php');
        include(get_template_directory() . '/template-parts/solution/customer-success.php');
        include(get_template_directory() . '/template-parts/solution/implementation-roi.php');
        include(get_template_directory() . '/template-parts/solution/integration-security.php');
        include(get_template_directory() . '/template-parts/solution/related-solutions.php');
        include(get_template_directory() . '/template-parts/solution/final-cta.php');
        ?>

        <!-- Floating Action Button -->
        <button class="alepo-fab">
            <svg viewBox="0 0 24 24">
                <path d="M7 14l5-5 5 5" />
            </svg>
        </button>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>