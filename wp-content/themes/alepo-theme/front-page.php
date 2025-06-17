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
        
        <!-- Hero Section -->
        <section class="hero-section" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 100px 0;">
            <div class="container">
                
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                <div class="wp-block-group">

                    <!-- wp:heading {"level":1,"textAlign":"center","fontSize":"48px"} -->
                    <h1 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:48px">
                        <?php echo alepo_get_field('hero_headline', null, 'Smart Software for Serious Networks'); ?>
                    </h1>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px","className":"hero-subheadline"} -->
                    <h2 class="wp-block-heading hero-subheadline has-text-align-center has-custom-font-size" style="font-size:32px">
                        <?php echo alepo_get_field('hero_subheadline', null, 'Empowering CSPs with Modern, Intelligent Solutions'); ?>
                    </h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"textAlign":"center","fontSize":"18px","className":"hero-description"} -->
                    <p class="hero-description has-text-align-center has-custom-font-size" style="font-size:18px">
                        <?php echo alepo_get_field('hero_description', null, 'Alepo delivers cloud-native software that drives revenue growth, operational efficiency, and exceptional customer experiences for Communication Service Providers (CSPs) worldwide. From carrier-grade network infrastructure to AI-powered customer engagement, our proven platforms help CSPs move faster, operate smarter, and serve customers better.'); ?>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","className":"trust-statement"} -->
                    <p class="trust-statement has-text-align-center has-custom-font-size" style="font-size:16px">
                        <strong><?php echo alepo_get_field('trust_statement', null, 'Trusted by leading CSPs managing 100+ million subscribers globally'); ?></strong>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"primary","className":"cta-primary"} -->
                        <div class="wp-block-button cta-primary">
                            <a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo alepo_get_field('primary_cta_url', null, '/request-demo'); ?>">
                                <?php echo alepo_get_field('primary_cta_text', null, 'Request a Demo'); ?>
                            </a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
        </section>

        <!-- Three Pillars Section -->
        <section class="three-pillars-section" style="background: #ffffff; padding: 80px 0;">
            <div class="container">
                
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
                <div class="wp-block-group">

                    <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px"} -->
                    <h2 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:32px">
                        Three Pillars of CSP Success
                    </h2>
                    <!-- /wp:heading -->

                    <!-- wp:columns {"className":"pillars-grid"} -->
                    <div class="wp-block-columns pillars-grid">

                        <!-- Network Access Control Pillar -->
                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:group {"className":"pillar-card","style":{"spacing":{"padding":{"all":"40px"}},"border":{"radius":"8px"}}} -->
                            <div class="wp-block-group pillar-card" style="border-radius:8px;padding:40px">
                                
                                <!-- wp:paragraph {"className":"pillar-icon","fontSize":"48px","textAlign":"center"} -->
                                <p class="pillar-icon has-text-align-center has-custom-font-size" style="font-size:48px">🔐</p>
                                <!-- /wp:paragraph -->

                                <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px"} -->
                                <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:24px">
                                    Network Access Control
                                </h3>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","className":"pillar-subtitle"} -->
                                <p class="pillar-subtitle has-text-align-center has-custom-font-size" style="font-size:16px">
                                    <strong>Secure, scalable authentication for modern networks</strong>
                                </p>
                                <!-- /wp:paragraph -->

                                <!-- wp:paragraph {"fontSize":"14px"} -->
                                <p class="has-custom-font-size" style="font-size:14px">
                                    Carrier-grade AAA servers, policy control, and WiFi monetization solutions that optimize network performance while enabling service innovation.
                                </p>
                                <!-- /wp:paragraph -->

                                <!-- wp:list {"className":"pillar-benefits"} -->
                                <ul class="wp-block-list pillar-benefits">
                                    <li><strong>99.999% uptime</strong> with 36,000+ TPS performance</li>
                                    <li><strong>Unified authentication</strong> across 5G, WiFi, and broadband</li>
                                    <li><strong>Real-time policy control</strong> for service differentiation</li>
                                </ul>
                                <!-- /wp:list -->

                                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                                <div class="wp-block-buttons">
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
        
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>