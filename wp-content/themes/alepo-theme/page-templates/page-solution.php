<?php
/**
 * Template Name: Solution Page
 * 
 * Wireframe-compliant solution page template with 12 sections
 * Fully compatible with Gutenberg block editor
 * Word count: 550-650 per page
 */

get_header(); ?>

<main id="primary" class="site-main solution-page" role="main">
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Section 1: Breadcrumb Navigation -->
        <nav class="breadcrumb-section" aria-label="Breadcrumb">
            <div class="container">
                <?php alepo_breadcrumbs(); ?>
            </div>
        </nav>

        <!-- Section 2: Hero Section -->
        <section class="hero-section" style="min-height: 500px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
            <div class="container">
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                <div class="wp-block-group">
                    
                    <!-- wp:columns {"verticalAlignment":"center"} -->
                    <div class="wp-block-columns are-vertically-aligned-center">
                        
                        <!-- wp:column {"width":"60%"} -->
                        <div class="wp-block-column" style="flex-basis:60%">
                            
                            <!-- wp:heading {"level":1,"fontSize":"48px-desktop-32px-mobile"} -->
                            <h1 class="wp-block-heading has-custom-font-size" style="font-size:48px">
                                <?php 
                                $hero_headline = alepo_get_field('hero_headline');
                                echo $hero_headline ? esc_html($hero_headline) : get_the_title();
                                ?>
                            </h1>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"fontSize":"24px-desktop-18px-mobile","className":"hero-subheadline"} -->
                            <p class="hero-subheadline has-custom-font-size" style="font-size:24px">
                                <?php 
                                $hero_subheadline = alepo_get_field('hero_subheadline');
                                echo $hero_subheadline ? esc_html($hero_subheadline) : 'Transform your network operations with proven, scalable solutions.';
                                ?>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph -->
                            <p><?php 
                                $hero_description = alepo_get_field('hero_description');
                                echo $hero_description ? esc_html($hero_description) : 'Our carrier-grade platform delivers the reliability and performance CSPs need to thrive in today\'s competitive landscape.';
                            ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph {"className":"trust-badge"} -->
                            <p class="trust-badge">
                                <strong>Trusted by leading CSPs worldwide with <?php echo alepo_get_field('trust_metric', null, '100+ million'); ?> subscribers</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons">
                                <!-- wp:button {"backgroundColor":"primary","className":"cta-primary"} -->
                                <div class="wp-block-button cta-primary">
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
                            
                            <!-- wp:image {"sizeSlug":"large","className":"hero-visual"} -->
                            <figure class="wp-block-image size-large hero-visual">
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

        <!-- Section 3: Value Proposition Section -->
        <section class="value-proposition-section" style="background: #ffffff; padding: 80px 0;">
            <div class="container">
                
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                <div class="wp-block-group">

                    <!-- wp:columns {"className":"value-props-grid"} -->
                    <div class="wp-block-columns value-props-grid">

                        <?php 
                        $value_propositions = alepo_get_field('value_propositions');
                        if ($value_propositions) {
                            foreach ($value_propositions as $index => $prop) :
                        ?>
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:paragraph {"fontSize":"48px","className":"value-prop-icon"} -->
                            <p class="value-prop-icon has-custom-font-size" style="font-size:48px">
                                <?php echo esc_html($prop['icon']); ?>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"fontSize":"24px"} -->
                            <h3 class="wp-block-heading has-custom-font-size" style="font-size:24px">
                                <?php echo esc_html($prop['title']); ?>
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p><?php echo esc_html($prop['description']); ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph {"className":"metric-highlight"} -->
                            <p class="metric-highlight">
                                <strong><?php echo esc_html($prop['metric']); ?></strong>
                            </p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:column -->
                        <?php 
                            endforeach;
                        } else {
                            // Default value propositions
                            $default_props = [
                                ['icon' => '🚀', 'title' => 'Performance', 'description' => 'Industry-leading speed and reliability with 99.999% uptime guarantee.', 'metric' => '36,000+ TPS'],
                                ['icon' => '🔧', 'title' => 'Flexibility', 'description' => 'Modular architecture adapts to your specific business requirements.', 'metric' => '30-day deployment'],
                                ['icon' => '📈', 'title' => 'Growth', 'description' => 'Scalable platform grows with your subscriber base and service portfolio.', 'metric' => '500% capacity increase']
                            ];
                            
                            foreach ($default_props as $prop) :
                        ?>
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:paragraph {"fontSize":"48px","className":"value-prop-icon"} -->
                            <p class="value-prop-icon has-custom-font-size" style="font-size:48px">
                                <?php echo esc_html($prop['icon']); ?>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"fontSize":"24px"} -->
                            <h3 class="wp-block-heading has-custom-font-size" style="font-size:24px">
                                <?php echo esc_html($prop['title']); ?>
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p><?php echo esc_html($prop['description']); ?></p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph {"className":"metric-highlight"} -->
                            <p class="metric-highlight">
                                <strong><?php echo esc_html($prop['metric']); ?></strong>
                            </p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:column -->
                        <?php endforeach; } ?>

                    </div>
                    <!-- /wp:columns -->

                </div>
                <!-- /wp:group -->

            </div>
        </section>

        <!-- Section 4: Key Capabilities Section -->
        <section class="key-capabilities-section">
            <div class="container">
                
                <?php 
                $capabilities = alepo_get_field('key_capabilities');
                if ($capabilities) {
                    foreach ($capabilities as $index => $capability) :
                        $is_reverse = $index % 2 == 1;
                        $bg_color = $index % 2 == 0 ? '#ffffff' : '#f8f9fa';
                ?>
                
                <div class="capability-block" style="background: <?php echo $bg_color; ?>; padding: 80px 0;">
                    
                    <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                    <div class="wp-block-group">

                        <!-- wp:columns {"verticalAlignment":"center"} -->
                        <div class="wp-block-columns are-vertically-aligned-center">

                            <?php if (!$is_reverse) : ?>
                            <!-- wp:column {"width":"60%"} -->
                            <div class="wp-block-column" style="flex-basis:60%">
                                
                                <!-- wp:heading {"level":2,"fontSize":"32px"} -->
                                <h2 class="wp-block-heading has-custom-font-size" style="font-size:32px">
                                    <?php echo esc_html($capability['name']); ?>
                                </h2>
                                <!-- /wp:heading -->

                                <!-- wp:list -->
                                <ul class="wp-block-list">
                                    <?php foreach ($capability['features'] as $feature) : ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:paragraph {"className":"benefit-statement"} -->
                                <p class="benefit-statement">
                                    <strong><?php echo esc_html($capability['benefit']); ?></strong>
                                </p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"width":"40%"} -->
                            <div class="wp-block-column" style="flex-basis:40%">
                                
                                <!-- wp:image {"sizeSlug":"large"} -->
                                <figure class="wp-block-image size-large">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='400' viewBox='0 0 500 400'%3E%3Crect width='500' height='400' fill='%23e9ecef'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%236c757d'%3E<?php echo esc_attr($capability['name']); ?> Diagram%3C/text%3E%3C/svg%3E" alt="<?php echo esc_attr($capability['name']); ?> visualization" class="wp-image-0" />
                                </figure>
                                <!-- /wp:image -->

                            </div>
                            <!-- /wp:column -->
                            
                            <?php else : ?>
                            
                            <!-- wp:column {"width":"40%"} -->
                            <div class="wp-block-column" style="flex-basis:40%">
                                
                                <!-- wp:image {"sizeSlug":"large"} -->
                                <figure class="wp-block-image size-large">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='400' viewBox='0 0 500 400'%3E%3Crect width='500' height='400' fill='%23e9ecef'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%236c757d'%3E<?php echo esc_attr($capability['name']); ?> Diagram%3C/text%3E%3C/svg%3E" alt="<?php echo esc_attr($capability['name']); ?> visualization" class="wp-image-0" />
                                </figure>
                                <!-- /wp:image -->

                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"width":"60%"} -->
                            <div class="wp-block-column" style="flex-basis:60%">
                                
                                <!-- wp:heading {"level":2,"fontSize":"32px"} -->
                                <h2 class="wp-block-heading has-custom-font-size" style="font-size:32px">
                                    <?php echo esc_html($capability['name']); ?>
                                </h2>
                                <!-- /wp:heading -->

                                <!-- wp:list -->
                                <ul class="wp-block-list">
                                    <?php foreach ($capability['features'] as $feature) : ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:paragraph {"className":"benefit-statement"} -->
                                <p class="benefit-statement">
                                    <strong><?php echo esc_html($capability['benefit']); ?></strong>
                                </p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:column -->
                            
                            <?php endif; ?>

                        </div>
                        <!-- /wp:columns -->

                    </div>
                    <!-- /wp:group -->

                </div>

                <?php 
                    endforeach;
                } else {
                    // Default capabilities if none set
                    $default_capabilities = [
                        [
                            'name' => 'Advanced Authentication',
                            'features' => ['RADIUS & Diameter support', '5G & WiFi unified auth', 'Real-time policy control', 'Fraud detection & prevention'],
                            'benefit' => 'Secure every connection with carrier-grade reliability'
                        ],
                        [
                            'name' => 'Scalable Performance',
                            'features' => ['36,000+ transactions per second', '99.999% uptime guarantee', 'Auto-scaling capability', 'Multi-cloud deployment'],
                            'benefit' => 'Handle millions of subscribers without performance degradation'
                        ]
                    ];
                    
                    foreach ($default_capabilities as $index => $capability) :
                        $is_reverse = $index % 2 == 1;
                        $bg_color = $index % 2 == 0 ? '#ffffff' : '#f8f9fa';
                ?>
                
                <div class="capability-block" style="background: <?php echo $bg_color; ?>; padding: 80px 0;">
                    
                    <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                    <div class="wp-block-group">

                        <!-- wp:columns {"verticalAlignment":"center"} -->
                        <div class="wp-block-columns are-vertically-aligned-center">

                            <?php if (!$is_reverse) : ?>
                            <!-- wp:column {"width":"60%"} -->
                            <div class="wp-block-column" style="flex-basis:60%">
                                
                                <!-- wp:heading {"level":2,"fontSize":"32px"} -->
                                <h2 class="wp-block-heading has-custom-font-size" style="font-size:32px">
                                    <?php echo esc_html($capability['name']); ?>
                                </h2>
                                <!-- /wp:heading -->

                                <!-- wp:list -->
                                <ul class="wp-block-list">
                                    <?php foreach ($capability['features'] as $feature) : ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:paragraph {"className":"benefit-statement"} -->
                                <p class="benefit-statement">
                                    <strong><?php echo esc_html($capability['benefit']); ?></strong>
                                </p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"width":"40%"} -->
                            <div class="wp-block-column" style="flex-basis:40%">
                                
                                <!-- wp:image {"sizeSlug":"large"} -->
                                <figure class="wp-block-image size-large">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='400' viewBox='0 0 500 400'%3E%3Crect width='500' height='400' fill='%23e9ecef'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%236c757d'%3E<?php echo esc_attr($capability['name']); ?> Diagram%3C/text%3E%3C/svg%3E" alt="<?php echo esc_attr($capability['name']); ?> visualization" class="wp-image-0" />
                                </figure>
                                <!-- /wp:image -->

                            </div>
                            <!-- /wp:column -->
                            
                            <?php else : ?>
                            
                            <!-- wp:column {"width":"40%"} -->
                            <div class="wp-block-column" style="flex-basis:40%">
                                
                                <!-- wp:image {"sizeSlug":"large"} -->
                                <figure class="wp-block-image size-large">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='400' viewBox='0 0 500 400'%3E%3Crect width='500' height='400' fill='%23e9ecef'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%236c757d'%3E<?php echo esc_attr($capability['name']); ?> Diagram%3C/text%3E%3C/svg%3E" alt="<?php echo esc_attr($capability['name']); ?> visualization" class="wp-image-0" />
                                </figure>
                                <!-- /wp:image -->

                            </div>
                            <!-- /wp:column -->

                            <!-- wp:column {"width":"60%"} -->
                            <div class="wp-block-column" style="flex-basis:60%">
                                
                                <!-- wp:heading {"level":2,"fontSize":"32px"} -->
                                <h2 class="wp-block-heading has-custom-font-size" style="font-size:32px">
                                    <?php echo esc_html($capability['name']); ?>
                                </h2>
                                <!-- /wp:heading -->

                                <!-- wp:list -->
                                <ul class="wp-block-list">
                                    <?php foreach ($capability['features'] as $feature) : ?>
                                    <li><?php echo esc_html($feature); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:paragraph {"className":"benefit-statement"} -->
                                <p class="benefit-statement">
                                    <strong><?php echo esc_html($capability['benefit']); ?></strong>
                                </p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:column -->
                            
                            <?php endif; ?>

                        </div>
                        <!-- /wp:columns -->

                    </div>
                    <!-- /wp:group -->

                </div>

                <?php endforeach; } ?>

            </div>
        </section>

        <!-- Continue with remaining sections in next part due to length -->
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

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>