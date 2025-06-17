<?php
/**
 * Solution Template Part: Business Benefits Section
 * Section 6 of wireframe - 4-column grid of business benefits
 */
?>

<!-- Section 6: Business Benefits Section -->
<section class="business-benefits-section" style="background: #ffffff; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px"} -->
            <h2 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:32px">
                <?php echo alepo_get_field('business_benefits_title', null, 'Business Benefits That Drive Results'); ?>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"textAlign":"center","fontSize":"18px"} -->
            <p class="has-text-align-center has-custom-font-size" style="font-size:18px">
                <?php echo alepo_get_field('business_benefits_description', null, 'Measurable outcomes that impact your bottom line and operational efficiency.'); ?>
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:columns {"className":"benefits-grid"} -->
            <div class="wp-block-columns benefits-grid">

                <?php 
                $business_benefits = alepo_get_field('business_benefits');
                if ($business_benefits) {
                    foreach ($business_benefits as $benefit) :
                ?>
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"benefit-card","style":{"spacing":{"padding":{"all":"30px"}},"border":{"radius":"8px"}}} -->
                    <div class="wp-block-group benefit-card" style="border-radius:8px;padding:30px">
                        
                        <!-- wp:paragraph {"className":"benefit-icon","fontSize":"48px","textAlign":"center"} -->
                        <p class="benefit-icon has-text-align-center has-custom-font-size" style="font-size:48px">
                            <?php echo esc_html($benefit['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"20px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:20px">
                            <?php echo esc_html($benefit['title']); ?>
                        </h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($benefit['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <?php if (!empty($benefit['metric'])) : ?>
                        <!-- wp:paragraph {"className":"metric-highlight","textAlign":"center","style":{"color":{"text":"#0056b3"}}} -->
                        <p class="metric-highlight has-text-align-center has-text-color" style="color:#0056b3">
                            <strong><?php echo esc_html($benefit['metric']); ?></strong>
                        </p>
                        <!-- /wp:paragraph -->
                        <?php endif; ?>

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <?php 
                    endforeach;
                } else {
                    // Default business benefits
                    $default_benefits = [
                        [
                            'icon' => '📈',
                            'title' => 'Revenue Growth',
                            'description' => 'Accelerate service launches and increase ARPU through innovative offerings and flexible monetization.',
                            'metric' => '15% ARPU increase'
                        ],
                        [
                            'icon' => '⚡',
                            'title' => 'Operational Efficiency',
                            'description' => 'Reduce operational costs through automation and streamlined processes.',
                            'metric' => '30% cost reduction'
                        ],
                        [
                            'icon' => '🚀',
                            'title' => 'Innovation Speed',
                            'description' => 'Launch new services faster with agile platforms and pre-built integrations.',
                            'metric' => '50% faster launches'
                        ],
                        [
                            'icon' => '😊',
                            'title' => 'Customer Satisfaction',
                            'description' => 'Improve customer experience with reliable services and proactive support.',
                            'metric' => '25% satisfaction improvement'
                        ]
                    ];
                    
                    foreach ($default_benefits as $benefit) :
                ?>
                
                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"benefit-card","style":{"spacing":{"padding":{"all":"30px"}},"border":{"radius":"8px"}}} -->
                    <div class="wp-block-group benefit-card" style="border-radius:8px;padding:30px">
                        
                        <!-- wp:paragraph {"className":"benefit-icon","fontSize":"48px","textAlign":"center"} -->
                        <p class="benefit-icon has-text-align-center has-custom-font-size" style="font-size:48px">
                            <?php echo esc_html($benefit['icon']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"20px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:20px">
                            <?php echo esc_html($benefit['title']); ?>
                        </h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:14px">
                            <?php echo esc_html($benefit['description']); ?>
                        </p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"className":"metric-highlight","textAlign":"center","style":{"color":{"text":"#0056b3"}}} -->
                        <p class="metric-highlight has-text-align-center has-text-color" style="color:#0056b3">
                            <strong><?php echo esc_html($benefit['metric']); ?></strong>
                        </p>
                        <!-- /wp:paragraph -->

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