<?php
/**
 * Solution Template Part: Implementation/ROI Section
 * Section 8 of wireframe - Split layout with ROI metrics and implementation info
 */
?>

<!-- Section 8: Implementation/ROI Section -->
<section class="implementation-roi-section" style="background: #f8f9fa; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
        <div class="wp-block-group">

            <!-- wp:columns {"verticalAlignment":"center"} -->
            <div class="wp-block-columns are-vertically-aligned-center">

                <!-- wp:column {"width":"60%"} -->
                <div class="wp-block-column" style="flex-basis:60%">
                    
                    <!-- wp:heading {"level":2,"fontSize":"32px"} -->
                    <h2 class="wp-block-heading has-custom-font-size" style="font-size:32px">
                        <?php echo alepo_get_field('roi_section_title', null, 'Implementation & ROI'); ?>
                    </h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"fontSize":"18px"} -->
                    <p class="has-custom-font-size" style="font-size:18px">
                        <?php echo alepo_get_field('roi_description', null, 'Proven return on investment with rapid deployment and measurable business outcomes.'); ?>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:heading {"level":3,"fontSize":"24px"} -->
                    <h3 class="wp-block-heading has-custom-font-size" style="font-size:24px">Key Metrics:</h3>
                    <!-- /wp:heading -->

                    <!-- wp:list {"className":"roi-metrics-list"} -->
                    <ul class="wp-block-list roi-metrics-list">
                        <?php 
                        $roi_metrics = alepo_get_field('roi_metrics');
                        if ($roi_metrics) {
                            foreach ($roi_metrics as $metric) :
                        ?>
                        <li><strong><?php echo esc_html($metric['metric']); ?>:</strong> <?php echo esc_html($metric['description']); ?></li>
                        <?php 
                            endforeach;
                        } else {
                            // Default ROI metrics
                            $default_roi_metrics = [
                                ['metric' => '18-month ROI', 'description' => 'Average payback period across customer deployments'],
                                ['metric' => '30% cost reduction', 'description' => 'Operational savings through automation and efficiency'],
                                ['metric' => '50% faster launches', 'description' => 'Accelerated time-to-market for new services'],
                                ['metric' => '99.999% uptime', 'description' => 'Carrier-grade reliability with SLA guarantees']
                            ];
                            
                            foreach ($default_roi_metrics as $metric) :
                        ?>
                        <li><strong><?php echo esc_html($metric['metric']); ?>:</strong> <?php echo esc_html($metric['description']); ?></li>
                        <?php endforeach; } ?>
                    </ul>
                    <!-- /wp:list -->

                    <!-- wp:heading {"level":3,"fontSize":"24px"} -->
                    <h3 class="wp-block-heading has-custom-font-size" style="font-size:24px">Implementation Highlights:</h3>
                    <!-- /wp:heading -->

                    <!-- wp:list {"className":"implementation-highlights"} -->
                    <ul class="wp-block-list implementation-highlights">
                        <?php 
                        $implementation_highlights = alepo_get_field('implementation_highlights');
                        if ($implementation_highlights) {
                            foreach ($implementation_highlights as $highlight) :
                        ?>
                        <li><?php echo esc_html($highlight['highlight']); ?></li>
                        <?php 
                            endforeach;
                        } else {
                            // Default implementation highlights
                            $default_highlights = [
                                '30-90 day deployment timeline',
                                'Zero-downtime migration capability',
                                '24/7 expert support included',
                                'Comprehensive training program',
                                'Ongoing optimization guidance'
                            ];
                            
                            foreach ($default_highlights as $highlight) :
                        ?>
                        <li><?php echo esc_html($highlight); ?></li>
                        <?php endforeach; } ?>
                    </ul>
                    <!-- /wp:list -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column {"width":"40%"} -->
                <div class="wp-block-column" style="flex-basis:40%">
                    
                    <?php 
                    $roi_visual = alepo_get_field('roi_visual');
                    if ($roi_visual) :
                    ?>
                    
                    <!-- wp:image {"sizeSlug":"large"} -->
                    <figure class="wp-block-image size-large">
                        <img src="<?php echo esc_url($roi_visual['url']); ?>" alt="<?php echo esc_attr($roi_visual['alt']); ?>" class="wp-image-<?php echo $roi_visual['ID']; ?>" />
                    </figure>
                    <!-- /wp:image -->

                    <?php else : ?>

                    <!-- Default ROI visualization -->
                    <!-- wp:group {"className":"roi-calculator-mockup","style":{"spacing":{"padding":{"all":"30px"}},"border":{"radius":"8px"},"color":{"background":"#ffffff"}}} -->
                    <div class="wp-block-group roi-calculator-mockup has-background" style="background-color:#ffffff;border-radius:8px;padding:30px">
                        
                        <!-- wp:heading {"level":4,"textAlign":"center","fontSize":"20px"} -->
                        <h4 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:20px">ROI Calculator</h4>
                        <!-- /wp:heading -->

                        <!-- wp:separator {"className":"roi-separator"} -->
                        <hr class="wp-block-separator has-alpha-channel-opacity roi-separator"/>
                        <!-- /wp:separator -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:14px">Initial Investment</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"24px","style":{"color":{"text":"#0056b3"}}} -->
                        <p class="has-text-color has-text-align-center has-custom-font-size" style="color:#0056b3;font-size:24px"><strong>$X</strong></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"14px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:14px">Annual Savings</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"24px","style":{"color":{"text":"#28a745"}}} -->
                        <p class="has-text-color has-text-align-center has-custom-font-size" style="color:#28a745;font-size:24px"><strong>$Y</strong></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:separator {"className":"roi-separator"} -->
                        <hr class="wp-block-separator has-alpha-channel-opacity roi-separator"/>
                        <!-- /wp:separator -->

                        <!-- wp:paragraph {"textAlign":"center","fontSize":"16px"} -->
                        <p class="has-text-align-center has-custom-font-size" style="font-size:16px"><strong>Payback Period: 18 months</strong></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"backgroundColor":"primary","size":"small"} -->
                            <div class="wp-block-button has-custom-width wp-block-button__width-50 is-style-outline">
                                <a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="/roi-calculator">Calculate Your ROI</a>
                            </div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->

                    </div>
                    <!-- /wp:group -->

                    <?php endif; ?>

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</section>