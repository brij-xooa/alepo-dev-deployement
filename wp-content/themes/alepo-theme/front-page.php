<?php
/**
 * The front page template file
 * Homepage with structured content as per wireframe specification
 *
 * @package Alepo
 * @since 1.0.0
 */

get_header();
?>

<main id="main" class="site-main homepage" role="main">
    <?php while (have_posts()) : the_post(); ?>
        
        <?php if (has_blocks()) : ?>
            <!-- If page has Gutenberg blocks, display them -->
            <?php the_content(); ?>
        <?php else : ?>
            <!-- Otherwise, display our template structure -->
        
        <!-- Hero Section -->
        <!-- wp:cover {"customGradient":"linear-gradient(135deg,rgb(49,138,255) 0%,rgb(70,151,160) 100%)","className":"hero-section"} -->
        <div class="wp-block-cover hero-section">
            <span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(135deg,rgb(49,138,255) 0%,rgb(70,151,160) 100%)"></span>
            <div class="wp-block-cover__inner-container">
                
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
                <div class="wp-block-group">

                    <!-- wp:heading {"level":1,"textAlign":"center","textColor":"white","fontSize":"large"} -->
                    <h1 class="wp-block-heading has-white-color has-text-color has-text-align-center has-large-font-size">
                        <?php echo alepo_get_field('hero_headline', null, 'Smart Software for Serious Networks'); ?>
                    </h1>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":2,"textAlign":"center","textColor":"white","fontSize":"medium"} -->
                    <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-medium-font-size">
                        <?php echo alepo_get_field('hero_subheadline', null, 'Empowering CSPs with Modern, Intelligent Solutions'); ?>
                    </h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center">
                        <?php echo alepo_get_field('hero_description', null, 'Alepo delivers cloud-native software that drives revenue growth, operational efficiency, and exceptional customer experiences for Communication Service Providers (CSPs) worldwide. From carrier-grade network infrastructure to AI-powered customer engagement, our proven platforms help CSPs move faster, operate smarter, and serve customers better.'); ?>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center">
                        <strong><?php echo alepo_get_field('trust_statement', null, 'Trusted by leading CSPs managing 100+ million subscribers globally'); ?></strong>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill">
                            <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="<?php echo alepo_get_field('primary_cta_url', null, '/request-demo'); ?>">
                                <?php echo alepo_get_field('primary_cta_text', null, 'Request a Demo'); ?>
                            </a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
        </div>
        <!-- /wp:cover -->

        <!-- Three Pillars Section -->
        <!-- wp:group {"backgroundColor":"white","className":"section-solutions"} -->
        <div class="wp-block-group has-white-background-color has-background section-solutions">
                
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Three Pillars of CSP Success
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- Network Access Control Pillar -->
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background","className":"hover-lift"} -->
                        <div class="wp-block-group has-background-background-color has-background hover-lift" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:paragraph {"textAlign":"center","fontSize":"large"} -->
                            <p class="has-text-align-center has-large-font-size">🔐</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                                Network Access Control
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"textAlign":"center"} -->
                            <p class="has-text-align-center">
                                <strong>Secure, scalable authentication for modern networks</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph -->
                            <p>
                                Carrier-grade AAA servers, policy control, and WiFi monetization solutions that optimize network performance while enabling service innovation.
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:list -->
                            <ul class="wp-block-list">
                                <li><strong>99.999% uptime</strong> with 36,000+ TPS performance</li>
                                <li><strong>Unified authentication</strong> across 5G, WiFi, and broadband</li>
                                <li><strong>Real-time policy control</strong> for service differentiation</li>
                            </ul>
                            <!-- /wp:list -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                            <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
                                <!-- wp:button {"className":"is-style-outline"} -->
                                <div class="wp-block-button is-style-outline">
                                    <a class="wp-block-button__link wp-element-button" href="/solutions/network-access-control">Explore Network Solutions</a>
                                </div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                        <!-- Digital Business Support Pillar -->
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:group {"className":"pillar-card","style":{"spacing":{"padding":{"all":"40px"}},"border":{"radius":"8px"}}} -->
                            <div class="wp-block-group pillar-card" style="border-radius:8px;padding:40px">
                                
                                <!-- wp:paragraph {"className":"pillar-icon","fontSize":"48px","textAlign":"center"} -->
                                <p class="pillar-icon has-text-align-center has-custom-font-size" style="font-size:48px">🔧</p>
                                <!-- /wp:paragraph -->

                                <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px"} -->
                                <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:24px">
                                    Digital Business Support
                                </h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","className":"pillar-subtitle"} -->
                                <p class="pillar-subtitle has-text-align-center has-custom-font-size" style="font-size:16px">
                                    <strong>Cloud-native BSS that accelerates innovation</strong>
                                </p>
                                <!-- /wp:paragraph -->

                                <!-- wp:paragraph {"fontSize":"14px"} -->
                                <p class="has-custom-font-size" style="font-size:14px">
                                    Modern billing, customer management, and operational platforms designed for rapid service launches and superior customer experiences.
                                </p>
                                <!-- /wp:paragraph -->

                                <!-- wp:list {"className":"pillar-benefits"} -->
                                <ul class="wp-block-list pillar-benefits">
                                    <li><strong>Launch services in days</strong>, not months</li>
                                    <li><strong>Convergent charging</strong> across all access types</li>
                                    <li><strong>Omnichannel customer experience</strong> with AI integration</li>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-buttons">
                                    <!-- wp:button {"className":"is-style-outline"} -->
                                    <div class="wp-block-button is-style-outline">
                                        <a class="wp-block-button__link wp-element-button" href="/solutions/digital-bss">Discover BSS Platforms</a>
                                    </div>
                                    <!-- /wp:button -->
                                </div>
                                <!-- /wp:buttons -->

                            </div>
                            <!-- /wp:group -->

                        </div>
                        <!-- /wp:column -->

                        <!-- AI-Powered Customer Experience Pillar -->
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:group {"className":"pillar-card","style":{"spacing":{"padding":{"all":"40px"}},"border":{"radius":"8px"}}} -->
                            <div class="wp-block-group pillar-card" style="border-radius:8px;padding:40px">
                                
                                <!-- wp:paragraph {"className":"pillar-icon","fontSize":"48px","textAlign":"center"} -->
                                <p class="pillar-icon has-text-align-center has-custom-font-size" style="font-size:48px">🤖</p>
                                <!-- /wp:paragraph -->

                                <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px"} -->
                                <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:24px">
                                    AI-Powered Customer Experience
                                </h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","className":"pillar-subtitle"} -->
                                <p class="pillar-subtitle has-text-align-center has-custom-font-size" style="font-size:16px">
                                    <strong>Generative AI that transforms customer engagement</strong>
                                </p>
                                <!-- /wp:paragraph -->

                                <!-- wp:paragraph {"fontSize":"14px"} -->
                                <p class="has-custom-font-size" style="font-size:14px">
                                    Telecom-trained AI solutions that deliver 24/7 support, empower human agents, and drive intelligent sales automation.
                                </p>
                                <!-- /wp:paragraph -->

                                <!-- wp:list {"className":"pillar-benefits"} -->
                                <ul class="wp-block-list pillar-benefits">
                                    <li><strong>90% first-contact resolution</strong> with AI customer assistant</li>
                                    <li><strong>40-70% faster</strong> issue resolution for agents</li>
                                    <li><strong>20% increase</strong> in upsell revenue through AI</li>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-buttons">
                                    <!-- wp:button {"className":"is-style-outline"} -->
                                    <div class="wp-block-button is-style-outline">
                                        <a class="wp-block-button__link wp-element-button" href="/solutions/ai-customer-experience">See AI in Action</a>
                                    </div>
                                    <!-- /wp:button -->
                                </div>
                                <!-- /wp:buttons -->

                            </div>
                            <!-- /wp:group -->

                        </div>
                        <!-- /wp:column -->

                    </div>
                    <!-- /wp:columns -->

                </div>
                <!-- /wp:group -->

            </div>
        </section>

        <!-- Include remaining homepage sections -->
        <?php 
        // Include the rest of the homepage template sections
        include(get_template_directory() . '/template-parts/homepage/why-alepo.php');
        include(get_template_directory() . '/template-parts/homepage/customer-success.php');
        include(get_template_directory() . '/template-parts/homepage/solutions-by-type.php');
        include(get_template_directory() . '/template-parts/homepage/innovation-results.php');
        include(get_template_directory() . '/template-parts/homepage/latest-innovations.php');
        include(get_template_directory() . '/template-parts/homepage/get-started.php');
        ?>
        
        <?php endif; // End of template structure ?>
        
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>