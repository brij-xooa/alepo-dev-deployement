<?php
/**
 * Solution Template Part: Integration/Security Section
 * Section 9 of wireframe - Optional 3-column grid or tabbed interface
 */
?>

<!-- Section 9: Integration/Security Section -->
<section class="integration-security-section" style="background: #ffffff; padding: 80px 0;">
    <div class="container">
        
        <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
        <div class="wp-block-group">

            <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"32px"} -->
            <h2 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:32px">
                <?php echo alepo_get_field('integration_security_title', null, 'Integration, Security & Support'); ?>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:columns {"className":"integration-security-grid"} -->
            <div class="wp-block-columns integration-security-grid">

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"info-tab","style":{"spacing":{"padding":{"all":"30px"}}}} -->
                    <div class="wp-block-group info-tab" style="padding:30px">
                        
                        <!-- wp:paragraph {"className":"tab-icon","fontSize":"40px","textAlign":"center"} -->
                        <p class="tab-icon has-text-align-center has-custom-font-size" style="font-size:40px">🔗</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:24px">Integration</h3>
                        <!-- /wp:heading -->

                        <!-- wp:list -->
                        <ul class="wp-block-list">
                            <?php 
                            $integration_features = alepo_get_field('integration_features');
                            if ($integration_features) {
                                foreach ($integration_features as $feature) :
                            ?>
                            <li><?php echo esc_html($feature['feature']); ?></li>
                            <?php 
                                endforeach;
                            } else {
                                // Default integration features
                                $default_integration = [
                                    'RESTful APIs for all functions',
                                    'RADIUS/Diameter compatibility',
                                    'Standards-compliant protocols',
                                    'Pre-built vendor integrations',
                                    'Custom connector development',
                                    'Real-time data synchronization'
                                ];
                                
                                foreach ($default_integration as $feature) :
                            ?>
                            <li><?php echo esc_html($feature); ?></li>
                            <?php endforeach; } ?>
                        </ul>
                        <!-- /wp:list -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"info-tab","style":{"spacing":{"padding":{"all":"30px"}}}} -->
                    <div class="wp-block-group info-tab" style="padding:30px">
                        
                        <!-- wp:paragraph {"className":"tab-icon","fontSize":"40px","textAlign":"center"} -->
                        <p class="tab-icon has-text-align-center has-custom-font-size" style="font-size:40px">🛡️</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:24px">Security</h3>
                        <!-- /wp:heading -->

                        <!-- wp:list -->
                        <ul class="wp-block-list">
                            <?php 
                            $security_features = alepo_get_field('security_features');
                            if ($security_features) {
                                foreach ($security_features as $feature) :
                            ?>
                            <li><?php echo esc_html($feature['feature']); ?></li>
                            <?php 
                                endforeach;
                            } else {
                                // Default security features
                                $default_security = [
                                    'End-to-end encryption (TLS 1.3)',
                                    'SOC 2 Type II compliance',
                                    'ISO 27001 certification',
                                    'Data protection & privacy',
                                    'Advanced threat detection',
                                    'Multi-factor authentication'
                                ];
                                
                                foreach ($default_security as $feature) :
                            ?>
                            <li><?php echo esc_html($feature); ?></li>
                            <?php endforeach; } ?>
                        </ul>
                        <!-- /wp:list -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column -->
                <div class="wp-block-column">
                    
                    <!-- wp:group {"className":"info-tab","style":{"spacing":{"padding":{"all":"30px"}}}} -->
                    <div class="wp-block-group info-tab" style="padding:30px">
                        
                        <!-- wp:paragraph {"className":"tab-icon","fontSize":"40px","textAlign":"center"} -->
                        <p class="tab-icon has-text-align-center has-custom-font-size" style="font-size:40px">🎧</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"24px"} -->
                        <h3 class="wp-block-heading has-text-align-center has-custom-font-size" style="font-size:24px">Support</h3>
                        <!-- /wp:heading -->

                        <!-- wp:list -->
                        <ul class="wp-block-list">
                            <?php 
                            $support_features = alepo_get_field('support_features');
                            if ($support_features) {
                                foreach ($support_features as $feature) :
                            ?>
                            <li><?php echo esc_html($feature['feature']); ?></li>
                            <?php 
                                endforeach;
                            } else {
                                // Default support features
                                $default_support = [
                                    '24/7/365 technical support',
                                    '30-minute response SLA',
                                    'Dedicated customer success manager',
                                    'Comprehensive training programs',
                                    'Ongoing optimization guidance',
                                    'Global support centers'
                                ];
                                
                                foreach ($default_support as $feature) :
                            ?>
                            <li><?php echo esc_html($feature); ?></li>
                            <?php endforeach; } ?>
                        </ul>
                        <!-- /wp:list -->

                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

            <!-- wp:separator {"className":"section-separator"} -->
            <hr class="wp-block-separator has-alpha-channel-opacity section-separator"/>
            <!-- /wp:separator -->

            <!-- wp:columns {"verticalAlignment":"center","className":"compliance-certifications"} -->
            <div class="wp-block-columns are-vertically-aligned-center compliance-certifications">

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:heading {"level":4,"fontSize":"18px"} -->
                    <h4 class="wp-block-heading has-custom-font-size" style="font-size:18px">Compliance & Certifications:</h4>
                    <!-- /wp:heading -->

                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center"} -->
                <div class="wp-block-column is-vertically-aligned-center">
                    
                    <!-- wp:list {"className":"compliance-list"} -->
                    <ul class="wp-block-list compliance-list">
                        <?php 
                        $compliance_items = alepo_get_field('compliance_certifications');
                        if ($compliance_items) {
                            foreach ($compliance_items as $item) :
                        ?>
                        <li><?php echo esc_html($item['certification']); ?></li>
                        <?php 
                            endforeach;
                        } else {
                            // Default compliance
                            $default_compliance = [
                                'SOC 2 Type II',
                                'ISO 27001',
                                'GDPR Compliant',
                                'HIPAA Ready',
                                'FedRAMP Authorized'
                            ];
                            
                            foreach ($default_compliance as $cert) :
                        ?>
                        <li><?php echo esc_html($cert); ?></li>
                        <?php endforeach; } ?>
                    </ul>
                    <!-- /wp:list -->

                </div>
                <!-- /wp:column -->

            </div>
            <!-- /wp:columns -->

        </div>
        <!-- /wp:group -->

    </div>
</section>