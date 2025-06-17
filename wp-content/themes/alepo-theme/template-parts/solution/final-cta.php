<?php
/**
 * Solution Template Part: Final CTA Section
 * Section 11 of wireframe - Conversion-focused call-to-action
 */
?>

<!-- Section 11: Final CTA Section -->
<section class="final-cta-section" style="background: linear-gradient(135deg, #0056b3 0%, #004085 100%); color: white; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px","textColor":"white"} -->
            <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:32px">
                <?php echo alepo_get_field('final_cta_title', null, 'Ready to Transform Your Network?'); ?>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"textAlign":"center","fontSize":"18px","textColor":"white"} -->
            <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:18px">
                <?php echo alepo_get_field('final_cta_description', null, 'Join hundreds of operators worldwide who trust Alepo to power their digital transformation. Let\'s discuss your specific requirements and create a solution tailored to your business.'); ?>
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:columns {"verticalAlignment":"center","className":"cta-actions"} -->
            <div class="wp-block-columns are-vertically-aligned-center cta-actions">

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill">
                            <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="<?php echo alepo_get_field('primary_cta_link', null, '/contact'); ?>">
                                <?php echo alepo_get_field('primary_cta_text', null, 'Schedule Your Demo'); ?>
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
                            <a class="wp-block-button__link has-border-color wp-element-button" href="<?php echo alepo_get_field('secondary_cta_link', null, '/resources'); ?>" style="border-color:#ffffff;border-width:2px;color:white">
                                <?php echo alepo_get_field('secondary_cta_text', null, 'Download Solution Guide'); ?>
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

            <!-- wp:columns {"verticalAlignment":"center","className":"contact-info"} -->
            <div class="wp-block-columns are-vertically-aligned-center contact-info">

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:16px">
                        <strong>📞 Call:</strong> <?php echo alepo_get_field('contact_phone', null, '+1 (650) 425-3300'); ?>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:16px">
                        <strong>✉️ Email:</strong> <?php echo alepo_get_field('contact_email', null, 'sales@alepo.com'); ?>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:paragraph {"textAlign":"center","fontSize":"16px","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center has-custom-font-size" style="font-size:16px">
                        <strong>🌐 Global:</strong> <?php echo alepo_get_field('global_presence', null, '24/7 Support Available'); ?>
                    </p>
                    <!-- /wp:paragraph -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

            <!-- wp:paragraph {"textAlign":"center","fontSize":"14px","className":"trust-indicators","style":{"color":{"text":"rgba(255,255,255,0.8)"}}} -->
            <p class="trust-indicators has-text-color has-text-align-center has-custom-font-size" style="color:rgba(255,255,255,0.8);font-size:14px">
                <?php echo alepo_get_field('trust_indicators', null, 'Trusted by 200+ operators worldwide | SOC 2 Type II Compliant | 99.999% SLA Guaranteed'); ?>
            </p>
            <!-- /wp:paragraph -->

        </div>
        <!-- /wp:group -->

    </div>
</section>