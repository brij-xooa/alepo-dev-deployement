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
            <!-- Fallback template structure -->
        
        <!-- Hero Section -->
        <!-- wp:cover {"customGradient":"linear-gradient(135deg,rgb(49,138,255) 0%,rgb(70,151,160) 100%)","className":"hero-section"} -->
        <div class="wp-block-cover hero-section">
            <span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(135deg,rgb(49,138,255) 0%,rgb(70,151,160) 100%)"></span>
            <div class="wp-block-cover__inner-container">
                
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"800px"}} -->
                <div class="wp-block-group">

                    <!-- wp:heading {"level":1,"textAlign":"center","textColor":"white","fontSize":"large"} -->
                    <h1 class="wp-block-heading has-white-color has-text-color has-text-align-center has-large-font-size">
                        Smart Software for Serious Networks
                    </h1>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":2,"textAlign":"center","textColor":"white","fontSize":"medium"} -->
                    <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-medium-font-size">
                        Empowering CSPs with Modern, Intelligent Solutions
                    </h2>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center">
                        Alepo delivers cloud-native software that drives revenue growth, operational efficiency, and exceptional customer experiences for Communication Service Providers (CSPs) worldwide. From carrier-grade network infrastructure to AI-powered customer engagement, our proven platforms help CSPs move faster, operate smarter, and serve customers better.
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center">
                        <strong>Trusted by leading CSPs managing 100+ million subscribers globally</strong>
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill">
                            <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="/request-demo">Request a Demo</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
        </div>
        <!-- /wp:cover -->

        <!-- Three Pillars of CSP Success Section -->
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
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background","className":"hover-lift card-elevated"} -->
                        <div class="wp-block-group has-background-background-color has-background hover-lift card-elevated" style="border-radius:8px;padding:2rem">
                            
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
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background","className":"hover-lift card-elevated"} -->
                        <div class="wp-block-group has-background-background-color has-background hover-lift card-elevated" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:paragraph {"textAlign":"center","fontSize":"large"} -->
                            <p class="has-text-align-center has-large-font-size">🔧</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                                Digital Business Support
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"textAlign":"center"} -->
                            <p class="has-text-align-center">
                                <strong>Cloud-native BSS that accelerates innovation</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph -->
                            <p>
                                Modern billing, customer management, and operational platforms designed for rapid service launches and superior customer experiences.
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:list -->
                            <ul class="wp-block-list">
                                <li><strong>Launch services in days</strong>, not months</li>
                                <li><strong>Convergent charging</strong> across all access types</li>
                                <li><strong>Omnichannel customer experience</strong> with AI integration</li>
                            </ul>
                            <!-- /wp:list -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                            <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
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
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background","className":"hover-lift card-elevated"} -->
                        <div class="wp-block-group has-background-background-color has-background hover-lift card-elevated" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:paragraph {"textAlign":"center","fontSize":"large"} -->
                            <p class="has-text-align-center has-large-font-size">🤖</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                                AI-Powered Customer Experience
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"textAlign":"center"} -->
                            <p class="has-text-align-center">
                                <strong>Generative AI that transforms customer engagement</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:paragraph -->
                            <p>
                                Telecom-trained AI solutions that deliver 24/7 support, empower human agents, and drive intelligent sales automation.
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:list -->
                            <ul class="wp-block-list">
                                <li><strong>90% first-contact resolution</strong> with AI customer assistant</li>
                                <li><strong>40-70% faster</strong> issue resolution for agents</li>
                                <li><strong>20% increase</strong> in upsell revenue through AI</li>
                            </ul>
                            <!-- /wp:list -->

                            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                            <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
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
        <!-- /wp:group -->

        <!-- Why Leading CSPs Choose Alepo Section -->
        <!-- wp:group {"style":{"color":{"background":"#f8f9fa"}},"className":"section-why"} -->
        <div class="wp-block-group section-why has-background" style="background-color:#f8f9fa">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Why Leading CSPs Choose Alepo
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-medium-font-size">Proven Expertise</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph -->
                        <p><strong>20+ years of telecom innovation</strong> From powering early ISPs to enabling 5G networks, we've evolved alongside the industry with deep domain expertise and carrier-grade reliability.</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-medium-font-size">Future-Ready Architecture</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph -->
                        <p><strong>Cloud-native, microservices design</strong> Built for scale and flexibility with open APIs, multi-cloud deployment, and standards-compliant integration that avoids vendor lock-in.</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-medium-font-size">Complete Solutions</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph -->
                        <p><strong>Network to customer experience</strong> Unique breadth covering infrastructure, operations, and customer engagement with pre-integrated platforms that work together seamlessly.</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-medium-font-size">True Partnership</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph -->
                        <p><strong>24/7 expert support included</strong> Industry-leading support with 30-minute response times, dedicated customer success managers, and ongoing optimization guidance.</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- Trusted Worldwide Section -->
        <!-- wp:group {"backgroundColor":"white","className":"section-portfolio"} -->
        <div class="wp-block-group has-white-background-color has-background section-portfolio">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Trusted Worldwide
                </h2>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"textAlign":"center","fontSize":"medium"} -->
                <p class="has-text-align-center has-medium-font-size">
                    Leading CSPs rely on Alepo to power their networks:
                </p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"textAlign":"center"} -->
                <p class="has-text-align-center">
                    [Customer Logos: Saudi Telecom, Digicel, Orange, SaskTel, Zain, Buckeye Broadband]
                </p>
                <!-- /wp:paragraph -->

                <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                    Customer Success Highlights
                </h3>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:1.5rem">
                            
                            <!-- wp:quote -->
                            <blockquote class="wp-block-quote">
                                <p>"Alepo's AAA platform enabled our 5G launch with zero downtime migration. We migrated 50 million subscribers seamlessly."</p>
                                <cite><strong>CTO, Major Asian Operator</strong></cite>
                            </blockquote>
                            <!-- /wp:quote -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:1.5rem">
                            
                            <!-- wp:quote -->
                            <blockquote class="wp-block-quote">
                                <p>"The AI Customer Assistant handled 70% of our support volume within two months. Customer satisfaction improved while costs decreased."</p>
                                <cite><strong>Operations Director, SaskTel Lüm Mobile</strong></cite>
                            </blockquote>
                            <!-- /wp:quote -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:1.5rem">
                            
                            <!-- wp:quote -->
                            <blockquote class="wp-block-quote">
                                <p>"We launched 12 new services this year with Alepo's BSS compared to 2 with our legacy system. Time-to-market improved from 6 months to 2 weeks."</p>
                                <cite><strong>CTO, Regional Mobile Operator</strong></cite>
                            </blockquote>
                            <!-- /wp:quote -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- Solutions by CSP Type Section -->
        <!-- wp:group {"style":{"color":{"background":"#f8f9fa"}},"className":"section-solutions-by-type"} -->
        <div class="wp-block-group section-solutions-by-type has-background" style="background-color:#f8f9fa">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Solutions by CSP Type
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- Mobile Network Operators -->
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"white","className":"hover-lift"} -->
                        <div class="wp-block-group has-white-background-color has-background hover-lift" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:paragraph {"textAlign":"center","fontSize":"large"} -->
                            <p class="has-text-align-center has-large-font-size">📱</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                                Mobile Network Operators
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"textAlign":"center"} -->
                            <p class="has-text-align-center">
                                <strong>Modernize core systems while enabling 5G innovation</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:list -->
                            <ul class="wp-block-list">
                                <li>Upgrade legacy AAA and BSS systems</li>
                                <li>Enable network slicing and edge services</li>
                                <li>Transform customer experience with AI</li>
                                <li>Support millions of subscribers with carrier-grade reliability</li>
                            </ul>
                            <!-- /wp:list -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- ISPs & Broadband Providers -->
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"white","className":"hover-lift"} -->
                        <div class="wp-block-group has-white-background-color has-background hover-lift" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:paragraph {"textAlign":"center","fontSize":"large"} -->
                            <p class="has-text-align-center has-large-font-size">🌐</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                                ISPs & Broadband Providers
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"textAlign":"center"} -->
                            <p class="has-text-align-center">
                                <strong>Optimize network performance and customer engagement</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:list -->
                            <ul class="wp-block-list">
                                <li>Unify authentication across fiber, cable, and WiFi</li>
                                <li>Monetize broadband services with flexible billing</li>
                                <li>Reduce support costs with AI customer service</li>
                                <li>Enable rapid service innovation and competitive differentiation</li>
                            </ul>
                            <!-- /wp:list -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- MVNOs & Digital Brands -->
                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"white","className":"hover-lift"} -->
                        <div class="wp-block-group has-white-background-color has-background hover-lift" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:paragraph {"textAlign":"center","fontSize":"large"} -->
                            <p class="has-text-align-center has-large-font-size">🚀</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:heading {"level":3,"textAlign":"center","fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-text-align-center has-medium-font-size">
                                MVNOs & Digital Brands
                            </h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph {"textAlign":"center"} -->
                            <p class="has-text-align-center">
                                <strong>Launch and scale rapidly with SaaS platforms</strong>
                            </p>
                            <!-- /wp:paragraph -->

                            <!-- wp:list -->
                            <ul class="wp-block-list">
                                <li>Go live in 30 days with BSS Now</li>
                                <li>Support digital-first customer experiences</li>
                                <li>Scale from thousands to millions of subscribers</li>
                                <li>Focus on growth while we handle the technology</li>
                            </ul>
                            <!-- /wp:list -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
                    <!-- wp:button {"backgroundColor":"primary"} -->
                    <div class="wp-block-button">
                        <a class="wp-block-button__link has-primary-background-color has-background wp-element-button" href="/solutions">Find Your Solution</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- Innovation That Drives Results Section -->
        <!-- wp:group {"backgroundColor":"white","className":"section-innovation"} -->
        <div class="wp-block-group has-white-background-color has-background section-innovation">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Innovation That Drives Results
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-medium-font-size">Measurable Business Impact</h3>
                        <!-- /wp:heading -->

                        <!-- wp:list -->
                        <ul class="wp-block-list">
                            <li>30% reduction in operational costs through automation</li>
                            <li>15% ARPU increase via service innovation and AI upselling</li>
                            <li>50% faster service launch capabilities</li>
                            <li>25% improvement in customer satisfaction scores</li>
                        </ul>
                        <!-- /wp:list -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-medium-font-size">Technical Excellence</h3>
                        <!-- /wp:heading -->

                        <!-- wp:list -->
                        <ul class="wp-block-list">
                            <li>Sub-millisecond response times at massive scale</li>
                            <li>Multi-cloud deployment with vendor-neutral architecture</li>
                            <li>Standards compliance ensuring broad compatibility</li>
                            <li>Continuous innovation with regular platform updates</li>
                        </ul>
                        <!-- /wp:list -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- Latest Innovations Section -->
        <!-- wp:group {"style":{"color":{"background":"#f8f9fa"}},"className":"section-latest-innovations"} -->
        <div class="wp-block-group section-latest-innovations has-background" style="background-color:#f8f9fa">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Latest Innovations
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"white"} -->
                        <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">Generative AI for Telecom</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Revolutionary AI customer and agent assistants that understand telecom operations and deliver measurable results.</p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"white"} -->
                        <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">5G-Ready Platforms</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Cloud-native solutions designed for 5G core integration, network slicing, and edge computing capabilities.</p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"white"} -->
                        <div class="wp-block-group has-white-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">SaaS BSS Innovation</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Complete business support systems delivered as a service, enabling rapid market entry with pay-as-you-grow pricing.</p>
                            <!-- /wp:paragraph -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

                <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
                    <!-- wp:button {"className":"is-style-outline"} -->
                    <div class="wp-block-button is-style-outline">
                        <a class="wp-block-button__link wp-element-button" href="/innovations">Explore Our Innovations</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:buttons -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

        <!-- Get Started Today Section -->
        <!-- wp:cover {"customGradient":"linear-gradient(135deg,rgb(49,138,255) 0%,rgb(26,106,246) 100%)","className":"section-cta"} -->
        <div class="wp-block-cover section-cta">
            <span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim has-background-gradient" style="background:linear-gradient(135deg,rgb(49,138,255) 0%,rgb(26,106,246) 100%)"></span>
            <div class="wp-block-cover__inner-container">
                
                <!-- wp:group {"layout":{"type":"constrained","contentSize":"1000px"}} -->
                <div class="wp-block-group">

                    <!-- wp:heading {"level":2,"textAlign":"center","textColor":"white","fontSize":"large"} -->
                    <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-large-font-size">
                        Get Started Today
                    </h2>
                    <!-- /wp:heading -->

                    <!-- wp:heading {"level":3,"textAlign":"center","textColor":"white","fontSize":"medium"} -->
                    <h3 class="wp-block-heading has-white-color has-text-color has-text-align-center has-medium-font-size">
                        Ready to Transform Your Operations?
                    </h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                    <p class="has-white-color has-text-color has-text-align-center">
                        Discover how Alepo's proven platforms can accelerate your digital transformation while reducing complexity and costs.
                    </p>
                    <!-- /wp:paragraph -->

                    <!-- wp:columns -->
                    <div class="wp-block-columns">

                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"className":"text-center"} -->
                            <div class="wp-block-group text-center" style="padding:1.5rem">
                                
                                <!-- wp:heading {"level":4,"textAlign":"center","textColor":"white"} -->
                                <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center">Free Consultation</h4>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                                <p class="has-white-color has-text-color has-text-align-center">Schedule a personalized discussion about your specific requirements and challenges.</p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:group -->

                        </div>
                        <!-- /wp:column -->

                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"className":"text-center"} -->
                            <div class="wp-block-group text-center" style="padding:1.5rem">
                                
                                <!-- wp:heading {"level":4,"textAlign":"center","textColor":"white"} -->
                                <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center">Solution Demo</h4>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                                <p class="has-white-color has-text-color has-text-align-center">See our platforms in action with demonstrations tailored to your CSP type and needs.</p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:group -->

                        </div>
                        <!-- /wp:column -->

                        <!-- wp:column -->
                        <div class="wp-block-column">
                            
                            <!-- wp:group {"style":{"spacing":{"padding":{"all":"1.5rem"}}},"className":"text-center"} -->
                            <div class="wp-block-group text-center" style="padding:1.5rem">
                                
                                <!-- wp:heading {"level":4,"textAlign":"center","textColor":"white"} -->
                                <h4 class="wp-block-heading has-white-color has-text-color has-text-align-center">Technical Deep Dive</h4>
                                <!-- /wp:heading -->

                                <!-- wp:paragraph {"textAlign":"center","textColor":"white"} -->
                                <p class="has-white-color has-text-color has-text-align-center">Get detailed technical information and architecture discussions with our experts.</p>
                                <!-- /wp:paragraph -->

                            </div>
                            <!-- /wp:group -->

                        </div>
                        <!-- /wp:column -->

                    </div>
                    <!-- /wp:columns -->

                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons is-content-justification-center is-layout-flex wp-block-buttons-is-layout-flex">
                        <!-- wp:button {"backgroundColor":"white","textColor":"primary","className":"is-style-fill"} -->
                        <div class="wp-block-button is-style-fill">
                            <a class="wp-block-button__link has-primary-color has-white-background-color has-text-color has-background wp-element-button" href="/request-demo">Request Demo</a>
                        </div>
                        <!-- /wp:button -->

                        <!-- wp:button {"style":{"border":{"width":"2px"}},"borderColor":"white","textColor":"white","className":"is-style-outline"} -->
                        <div class="wp-block-button is-style-outline">
                            <a class="wp-block-button__link has-white-color has-text-color has-border-color has-white-border-color wp-element-button" style="border-width:2px" href="/contact">Schedule Consultation</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->

                </div>
                <!-- /wp:group -->

            </div>
        </div>
        <!-- /wp:cover -->

        <!-- Resources to Explore Section -->
        <!-- wp:group {"backgroundColor":"white","className":"section-resources"} -->
        <div class="wp-block-group has-white-background-color has-background section-resources">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","fontSize":"large"} -->
                <h2 class="wp-block-heading has-text-align-center has-large-font-size">
                    Resources to Explore
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">Customer Success Stories</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Real-world implementations showing measurable results from CSPs worldwide.</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons">
                                <!-- wp:button {"className":"is-style-outline"} -->
                                <div class="wp-block-button is-style-outline">
                                    <a class="wp-block-button__link wp-element-button" href="/case-studies">View Case Studies</a>
                                </div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">Solution Guides</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Comprehensive resources on AAA modernization, BSS transformation, and AI implementation.</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons">
                                <!-- wp:button {"className":"is-style-outline"} -->
                                <div class="wp-block-button is-style-outline">
                                    <a class="wp-block-button__link wp-element-button" href="/resources">Download Guides</a>
                                </div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">Industry Insights</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Expert analysis on telecom trends, 5G evolution, and customer experience transformation.</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons">
                                <!-- wp:button {"className":"is-style-outline"} -->
                                <div class="wp-block-button is-style-outline">
                                    <a class="wp-block-button__link wp-element-button" href="/blog">Read Blog</a>
                                </div>
                                <!-- /wp:button -->
                            </div>
                            <!-- /wp:buttons -->

                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:group {"style":{"spacing":{"padding":{"all":"2rem"}},"border":{"radius":"8px"}},"backgroundColor":"background"} -->
                        <div class="wp-block-group has-background-background-color has-background" style="border-radius:8px;padding:2rem">
                            
                            <!-- wp:heading {"level":3,"fontSize":"medium"} -->
                            <h3 class="wp-block-heading has-medium-font-size">Technical Documentation</h3>
                            <!-- /wp:heading -->

                            <!-- wp:paragraph -->
                            <p>Detailed platform information, APIs, and integration guides for technical teams.</p>
                            <!-- /wp:paragraph -->

                            <!-- wp:buttons -->
                            <div class="wp-block-buttons">
                                <!-- wp:button {"className":"is-style-outline"} -->
                                <div class="wp-block-button is-style-outline">
                                    <a class="wp-block-button__link wp-element-button" href="/documentation">Access Library</a>
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
        <!-- /wp:group -->

        <!-- Connect With Alepo Section -->
        <!-- wp:group {"style":{"color":{"background":"#1a2c32"}},"textColor":"white","className":"section-footer-cta"} -->
        <div class="wp-block-group section-footer-cta has-white-color has-text-color has-background" style="background-color:#1a2c32">
            
            <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
            <div class="wp-block-group">

                <!-- wp:heading {"level":2,"textAlign":"center","textColor":"white","fontSize":"large"} -->
                <h2 class="wp-block-heading has-white-color has-text-color has-text-align-center has-large-font-size">
                    Connect With Alepo
                </h2>
                <!-- /wp:heading -->

                <!-- wp:columns -->
                <div class="wp-block-columns">

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"textColor":"white","fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-white-color has-text-color has-medium-font-size">Global Presence</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textColor":"white"} -->
                        <p class="has-white-color has-text-color"><strong>Headquarters:</strong> Austin, Texas<br><strong>Global Offices:</strong> North America, Europe, Middle East, Asia</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"textColor":"white","fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-white-color has-text-color has-medium-font-size">Contact Information</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textColor":"white"} -->
                        <p class="has-white-color has-text-color"><strong>Sales:</strong> +1 (512) 370-2537<br><strong>Support:</strong> 24/7/365 availability<br><strong>Email:</strong> info@alepo.com</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                    <!-- wp:column -->
                    <div class="wp-block-column">
                        
                        <!-- wp:heading {"level":3,"textColor":"white","fontSize":"medium"} -->
                        <h3 class="wp-block-heading has-white-color has-text-color has-medium-font-size">Follow Our Innovation</h3>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph {"textColor":"white"} -->
                        <p class="has-white-color has-text-color">Stay updated on product releases, industry insights, and customer success stories.</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:paragraph {"textColor":"white"} -->
                        <p class="has-white-color has-text-color">[LinkedIn] [Twitter] [YouTube] [Newsletter Signup]</p>
                        <!-- /wp:paragraph -->

                    </div>
                    <!-- /wp:column -->

                </div>
                <!-- /wp:columns -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->
        
        
        <?php endif; // End conditional ?>
        
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>