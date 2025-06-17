<?php
/**
 * Solution Template Part: Related Solutions Section
 * Section 10 of wireframe - Cross-links to other solution pages
 */
?>

<!-- Section 10: Related Solutions Section -->
<section class="related-solutions-section" style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px"} -->
            <h2 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:32px">
                <?php echo alepo_get_field('related_solutions_title', null, 'Related Solutions'); ?>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"textAlign":"center","fontSize":"18px"} -->
            <p class="has-text-align-center has-custom-font-size" style="font-size:18px">
                <?php echo alepo_get_field('related_solutions_subtitle', null, 'Explore other solutions that complement your digital transformation journey.'); ?>
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:columns {"className":"related-solutions-grid"} -->
            <div class="wp-block-columns related-solutions-grid">

                <?php 
                $related_solutions = alepo_get_field('related_solutions');
                if ($related_solutions) {
                    foreach ($related_solutions as $solution) :
                ?>
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"solution-card","style":{"spacing":{"padding":{"all":"30px"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}}} -->
                    <div class="wp-block-group solution-card has-background" style="background-color:#ffffff;border-radius:8px;padding:30px">
                        
                        <!-- wp:paragraph {"className":"solution-icon","fontSize":"32px","textAlign":"center"} -->
                        <p class="solution-icon has-text-align-center has-custom-font-size" style="font-size:32px">
                            <?php echo esc_html($solution['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"20px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:20px">
                            <?php echo esc_html($solution['title']); ?>
                        </h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($solution['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"backgroundColor":"primary","size":"small"} -->
                            <div class="wp-block-button has-custom-width wp-block-button__width-50 is-style-outline">
                                <a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo esc_url($solution['link']); ?>">Learn More</a>
                            </div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <?php 
                    endforeach;
                } else {
                    // Default related solutions
                    $default_solutions = [
                        [
                            'icon' => '🔧',
                            'title' => 'Digital BSS Platform',
                            'description' => 'Comprehensive business support system for modern service providers.',
                            'link' => '/solutions/digital-bss'
                        ],
                        [
                            'icon' => '🤖',
                            'title' => 'AI Customer Assistant',
                            'description' => 'Intelligent automation for customer service and support operations.',
                            'link' => '/solutions/ai-customer-assistant'
                        ],
                        [
                            'icon' => '☁️',
                            'title' => 'Cloud Migration',
                            'description' => 'Seamless migration to cloud-native telecom infrastructure.',
                            'link' => '/solutions/cloud-migration'
                        ]
                    ];
                    
                    foreach ($default_solutions as $solution) :
                ?>
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"solution-card","style":{"spacing":{"padding":{"all":"30px"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}}} -->
                    <div class="wp-block-group solution-card has-background" style="background-color:#ffffff;border-radius:8px;padding:30px">
                        
                        <!-- wp:paragraph {"className":"solution-icon","fontSize":"32px","textAlign":"center"} -->
                        <p class="solution-icon has-text-align-center has-custom-font-size" style="font-size:32px">
                            <?php echo esc_html($solution['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"20px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:20px">
                            <?php echo esc_html($solution['title']); ?>
                        </h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($solution['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"backgroundColor":"primary","size":"small"} -->
                            <div class="wp-block-button has-custom-width wp-block-button__width-50 is-style-outline">
                                <a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="<?php echo esc_url($solution['link']); ?>">Learn More</a>
                            </div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <?php endforeach; } ?>

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</section>