<?php
/**
 * Solution Template Part: Technical Features Section
 * Section 5 of wireframe - 2-column grid of technical features
 */
?>

<!-- Section 5: Technical Features Section -->
<section class="technical-features-section" style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px"} -->
            <h2 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:32px">
                <?php echo alepo_get_field('technical_features_title', null, 'Technical Features & Key Capabilities'); ?>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:columns {"className":"technical-features-grid"} -->
            <div class="wp-block-columns technical-features-grid">

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <?php 
                    $technical_features = alepo_get_field('technical_features');
                    if ($technical_features) {
                        $half = ceil(count($technical_features) / 2);
                        $first_half = array_slice($technical_features, 0, $half);
                        
                        foreach ($first_half as $feature) :
                    ?>
                    
                    <!-- wp:group {"className":"feature-item","style":{"spacing":{"padding":{"bottom":"20px"}}}} -->
                    <div class="wp-block-group feature-item" style="padding-bottom:20px">
                        
                        <!-- wp:paragraph {"className":"feature-icon","fontSize":"24px"} -->
                        <p class="feature-icon has-custom-font-size" style="font-size:24px">
                            <?php echo esc_html($feature['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":4,"fontSize":"18px"} -->
                        <h4 class="wp-block-heading has-custom-font-size" style="font-size:18px">
                            <?php echo esc_html($feature['title']); ?>
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"fontSize":"14px"} -->
                        <p class="has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($feature['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                    <?php 
                        endforeach;
                    } else {
                        // Default first column features
                        $default_features_col1 = [
                            ['icon' => '🔐', 'title' => 'RADIUS/Diameter Support', 'description' => 'Full protocol compliance with advanced routing capabilities'],
                            ['icon' => '📡', 'title' => '5G & WiFi Authentication', 'description' => 'Unified authentication across all access technologies'],
                            ['icon' => '⚡', 'title' => 'Real-time Policy Control', 'description' => 'Dynamic policy enforcement and bandwidth management'],
                            ['icon' => '🛡️', 'title' => 'Security & Fraud Management', 'description' => 'Advanced threat detection and prevention capabilities']
                        ];
                        
                        foreach ($default_features_col1 as $feature) :
                    ?>
                    
                    <!-- wp:group {"className":"feature-item","style":{"spacing":{"padding":{"bottom":"20px"}}}} -->
                    <div class="wp-block-group feature-item" style="padding-bottom:20px">
                        
                        <!-- wp:paragraph {"className":"feature-icon","fontSize":"24px"} -->
                        <p class="feature-icon has-custom-font-size" style="font-size:24px">
                            <?php echo esc_html($feature['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":4,"fontSize":"18px"} -->
                        <h4 class="wp-block-heading has-custom-font-size" style="font-size:18px">
                            <?php echo esc_html($feature['title']); ?>
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"fontSize":"14px"} -->
                        <p class="has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($feature['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                    <?php endforeach; } ?>

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <?php 
                    if ($technical_features) {
                        $second_half = array_slice($technical_features, $half);
                        
                        foreach ($second_half as $feature) :
                    ?>
                    
                    <!-- wp:group {"className":"feature-item","style":{"spacing":{"padding":{"bottom":"20px"}}}} -->
                    <div class="wp-block-group feature-item" style="padding-bottom:20px">
                        
                        <!-- wp:paragraph {"className":"feature-icon","fontSize":"24px"} -->
                        <p class="feature-icon has-custom-font-size" style="font-size:24px">
                            <?php echo esc_html($feature['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":4,"fontSize":"18px"} -->
                        <h4 class="wp-block-heading has-custom-font-size" style="font-size:18px">
                            <?php echo esc_html($feature['title']); ?>
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"fontSize":"14px"} -->
                        <p class="has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($feature['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                    <?php 
                        endforeach;
                    } else {
                        // Default second column features
                        $default_features_col2 = [
                            ['icon' => '📊', 'title' => 'Advanced Analytics', 'description' => 'Real-time monitoring and comprehensive reporting dashboard'],
                            ['icon' => '☁️', 'title' => 'Multi-Cloud Deployment', 'description' => 'Flexible deployment across AWS, Azure, and Google Cloud'],
                            ['icon' => '🔄', 'title' => 'API Integration', 'description' => 'RESTful APIs for seamless third-party integrations'],
                            ['icon' => '⚙️', 'title' => 'Automated Provisioning', 'description' => 'Zero-touch subscriber and service provisioning']
                        ];
                        
                        foreach ($default_features_col2 as $feature) :
                    ?>
                    
                    <!-- wp:group {"className":"feature-item","style":{"spacing":{"padding":{"bottom":"20px"}}}} -->
                    <div class="wp-block-group feature-item" style="padding-bottom:20px">
                        
                        <!-- wp:paragraph {"className":"feature-icon","fontSize":"24px"} -->
                        <p class="feature-icon has-custom-font-size" style="font-size:24px">
                            <?php echo esc_html($feature['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":4,"fontSize":"18px"} -->
                        <h4 class="wp-block-heading has-custom-font-size" style="font-size:18px">
                            <?php echo esc_html($feature['title']); ?>
                        </h4>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"fontSize":"14px"} -->
                        <p class="has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($feature['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:group -->

                    <?php endforeach; } ?>

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</section>