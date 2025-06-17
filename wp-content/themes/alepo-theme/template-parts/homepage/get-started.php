<?php
/**
 * Homepage Template Part: Get Started Today Section
 */
?>

<!-- Get Started Today Section -->
<section class="get-started-section" style="background: linear-gradient(135deg, #0056b3 0%, #004085 100%); color: white; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1000px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px","textColor":"white"} -->
            <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:32px">
                Get Started Today
            </h2>
            <!-- /wp:heading -->

            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px","textColor":"white"} -->
            <h3 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:24px">
                Ready to Transform Your Operations?
            </h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"textAlign":"center","fontSize":"18px","textColor":"white"} -->
            <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:18px">
                Discover how Alepo's proven platforms can accelerate your digital transformation while reducing complexity and costs.
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:columns {"className":"get-started-options"} -->
            <div class="wp-block-columns get-started-options">

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"get-started-card","style":{"spacing":{"padding":{"all":"30px"}}}} -->
                    <div class="wp-block-group get-started-card" style="padding:30px">
                        
                        <!-- wp:heading {"level":4,"textAlign":"center","fontSize":"18px","textColor":"white"} -->
                        <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:18px">
                            Free Consultation
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                        <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                            Schedule a personalized discussion about your specific requirements and challenges.
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"get-started-card","style":{"spacing":{"padding":{"all":"30px"}}}} -->
                    <div class="wp-block-group get-started-card" style="padding:30px">
                        
                        <!-- wp:heading {"level":4,"textAlign":"center","fontSize":"18px","textColor":"white"} -->
                        <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:18px">
                            Solution Demo
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                        <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                            See our platforms in action with demonstrations tailored to your CSP type and needs.
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"get-started-card","style":{"spacing":{"padding":{"all":"30px"}}}} -->
                    <div class="wp-block-group get-started-card" style="padding:30px">
                        
                        <!-- wp:heading {"level":4,"textAlign":"center","fontSize":"18px","textColor":"white"} -->
                        <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:18px">
                            Technical Deep Dive
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                        <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                            Get detailed technical information and architecture discussions with our experts.
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

            <!-- wp:columns {"verticalAlignment":"center","className":"cta-buttons"} -->
            <div class="wp-block-columns are-vertically-aligned-center cta-buttons">

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill">
                            <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="<?php echo alepo_get_field('demo_cta_url', null, '/request-demo'); ?>">
                                Request Demo
                            </a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"className":"is-style-outline","style":{"border":{"color":"#ffffff","width":"2px"}}} -->
                        <div class="wp-block-button is-style-outline">
                            <a class="wp-block-button__link has-border-color wp-element-button" href="<?php echo alepo_get_field('consultation_cta_url', null, '/contact'); ?>" style="border-color:#ffffff;border-width:2px;color:white">
                                Schedule Consultation
                            </a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

            <!-- wp:separator {"className":"cta-separator","style":{"color":{"background":"rgba(255,255,255,0.2)"}}} -->
            <hr class="wp-block-separator has-alpha-channel-opacity cta-separator has-background" style="background-color:rgba(255,255,255,0.2)"/>
            <!-- /wp:separator -->

            <!-- wp:heading {"level":4,"textAlign":"center","fontSize":"18px","textColor":"white"} -->
            <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:18px">
                Resources to Explore
            </h4>
            <!-- /wp:heading -->

            <!-- wp:columns {"className":"resources-grid"} -->
            <div class="wp-block-columns resources-grid">

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                        <strong>Customer Success Stories</strong><br>
                        Real-world implementations showing measurable results from CSPs worldwide. 
                        <a href="/case-studies" style="color: #ffffff; text-decoration: underline;">View Case Studies</a>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                        <strong>Solution Guides</strong><br>
                        Comprehensive resources on AAA modernization, BSS transformation, and AI implementation. 
                        <a href="/resources" style="color: #ffffff; text-decoration: underline;">Download Guides</a>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                        <strong>Industry Insights</strong><br>
                        Expert analysis on telecom trends, 5G evolution, and customer experience transformation. 
                        <a href="/blog" style="color: #ffffff; text-decoration: underline;">Read Blog</a>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:14px">
                        <strong>Technical Documentation</strong><br>
                        Detailed platform information, APIs, and integration guides for technical teams.
                        <a href="/documentation" style="color: #ffffff; text-decoration: underline;">Access Library</a>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</section>