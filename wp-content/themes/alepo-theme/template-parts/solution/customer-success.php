<?php
/**
 * Solution Template Part: Customer Success Story Section
 * Section 7 of wireframe - Full-width customer testimonial
 */
?>

<!-- Section 7: Customer Success Story Section -->
<section class="customer-success-section" style="background: #0056b3; color: white; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1000px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px","textColor":"white"} -->
            <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:32px">
                <?php echo alepo_get_field('customer_success_title', null, 'Customer Success'); ?>
            </h2>
            <!-- /wp:heading -->

            <?php 
            $customer_story = alepo_get_field('customer_success_story');
            if ($customer_story) :
            ?>

            <!-- wp:quote {"className":"customer-quote","style":{"typography":{"fontSize":"24px"}}} -->
            <blockquote class="wp-block-quote customer-quote" style="font-size:24px">
                <p><?php echo esc_html($customer_story['quote']); ?></p>
                <cite>
                    <strong><?php echo esc_html($customer_story['title']); ?>, <?php echo esc_html($customer_story['company_type']); ?></strong>
                </cite>
            </blockquote>
            <!-- /wp:quote -->

            <?php if (!empty($customer_story['company_logo'])) : ?>
            <!-- wp:image {"align":"center","width":200,"sizeSlug":"medium"} -->
            <figure class="wp-block-image aligncenter size-medium is-resized">
                <img src="<?php echo esc_url($customer_story['company_logo']['url']); ?>" alt="<?php echo esc_attr($customer_story['company_logo']['alt']); ?>" class="wp-image-<?php echo $customer_story['company_logo']['ID']; ?>" width="200"/>
            </figure>
            <!-- /wp:image -->
            <?php endif; ?>

            <?php if (!empty($customer_story['secondary_metric'])) : ?>
            <!-- wp:paragraph {"textAlign":"center","fontSize":"18px","className":"secondary-metric"} -->
            <p class="secondary-metric has-text-align-center has-custom-font-size" style="font-size:18px">
                <strong><?php echo esc_html($customer_story['secondary_metric']); ?></strong>
            </p>
            <!-- /wp:paragraph -->
            <?php endif; ?>

            <?php else : ?>

            <!-- Default customer success content -->
            <!-- wp:quote {"className":"customer-quote","style":{"typography":{"fontSize":"24px"}}} -->
            <blockquote class="wp-block-quote customer-quote" style="font-size:24px">
                <p>"Alepo's solution enabled our 5G launch with zero downtime migration. We migrated 50 million subscribers seamlessly while improving network performance by 40%."</p>
                <cite>
                    <strong>CTO, Major Asian Operator</strong>
                </cite>
            </blockquote>
            <!-- /wp:quote -->

            <!-- wp:paragraph {"textAlign":"center","fontSize":"18px","className":"secondary-metric"} -->
            <p class="secondary-metric has-text-align-center has-custom-font-size" style="font-size:18px">
                <strong>50M+ subscribers migrated with zero downtime</strong>
            </p>
            <!-- /wp:paragraph -->

            <?php endif; ?>

            <!-- wp:columns {"verticalAlignment":"center","className":"additional-success-metrics"} -->
            <div class="wp-block-columns are-vertically-aligned-center additional-success-metrics">

                <?php 
                $success_metrics = alepo_get_field('success_metrics');
                if ($success_metrics) {
                    foreach ($success_metrics as $metric) :
                ?>
                
                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"32px","className":"metric-number"} -->
                    <p class="metric-number has-text-align-center has-custom-font-size" style="font-size:32px">
                        <strong><?php echo esc_html($metric['number']); ?></strong>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","className":"metric-label"} -->
                    <p class="metric-label has-text-align-center has-custom-font-size" style="font-size:14px">
                        <?php echo esc_html($metric['label']); ?>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

                <?php 
                    endforeach;
                } else {
                    // Default success metrics
                    $default_metrics = [
                        ['number' => '99.999%', 'label' => 'Uptime Achieved'],
                        ['number' => '36,000+', 'label' => 'TPS Performance'],
                        ['number' => '50M+', 'label' => 'Subscribers Supported']
                    ];
                    
                    foreach ($default_metrics as $metric) :
                ?>
                
                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"32px","className":"metric-number"} -->
                    <p class="metric-number has-text-align-center has-custom-font-size" style="font-size:32px">
                        <strong><?php echo esc_html($metric['number']); ?></strong>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","className":"metric-label"} -->
                    <p class="metric-label has-text-align-center has-custom-font-size" style="font-size:14px">
                        <?php echo esc_html($metric['label']); ?>
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