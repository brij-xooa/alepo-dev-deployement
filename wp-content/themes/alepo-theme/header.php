<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'alepo'); ?></a>

    <!-- Utility Bar -->
    <?php if (get_theme_mod('alepo_utility_phone') || get_theme_mod('alepo_utility_email')) : ?>
    <div class="utility-bar">
        <div class="container">
            <div class="utility-links">
                <?php if (alepo_get_nav_menu('utility')) : ?>
                    <?php echo alepo_get_nav_menu('utility'); ?>
                <?php else : ?>
                    <a href="/support"><?php esc_html_e('Support', 'alepo'); ?></a>
                    <a href="/contact"><?php esc_html_e('Contact', 'alepo'); ?></a>
                    <a href="/resources"><?php esc_html_e('Resources', 'alepo'); ?></a>
                <?php endif; ?>
            </div>
            <div class="utility-right">
                <?php if (get_theme_mod('alepo_utility_phone')) : ?>
                    <span><?php echo esc_html(get_theme_mod('alepo_utility_phone')); ?></span>
                <?php endif; ?>
                <?php if (get_theme_mod('alepo_utility_email')) : ?>
                    <a href="mailto:<?php echo esc_attr(get_theme_mod('alepo_utility_email')); ?>">
                        <?php echo esc_html(get_theme_mod('alepo_utility_email')); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Main Navigation -->
    <header id="masthead" class="site-header">
        <nav class="main-nav" role="navigation" aria-label="<?php esc_attr_e('Main navigation', 'alepo'); ?>">
            <div class="nav-container">
                <!-- Logo -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Primary Menu -->
                <?php // Always show mega menu structure ?>
                <?php if (true) : ?>
                    <ul class="nav-menu" role="menubar">
                        <!-- Solutions Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/solutions" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Solutions', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="mega-menu solutions-mega-menu">
                                <div class="mega-menu-content">
                                    <div class="mega-menu-header"><?php esc_html_e('Our Solutions', 'alepo'); ?></div>
                                    <div class="solutions-grid">
                                        <!-- By Challenge -->
                                        <div class="menu-section">
                                            <h3><span>🔄</span> <?php esc_html_e('By Challenge', 'alepo'); ?></h3>
                                            <ul>
                                                <li class="solution-category">
                                                    <span>🏗️</span> <?php esc_html_e('Modernize Network Infrastructure', 'alepo'); ?>
                                                </li>
                                                <li><a href="/solutions/legacy-aaa-replacement"><?php esc_html_e('Legacy AAA Replacement', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/5g-network-evolution"><?php esc_html_e('5G Network Evolution', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/cloud-migration"><?php esc_html_e('Cloud Migration', 'alepo'); ?></a></li>
                                                
                                                <li class="solution-category">
                                                    <span>💰</span> <?php esc_html_e('Accelerate Digital Transformation', 'alepo'); ?>
                                                </li>
                                                <li><a href="/solutions/bss-modernization"><?php esc_html_e('BSS Modernization', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/ai-driven-automation"><?php esc_html_e('AI-Driven Automation', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/api-gateway"><?php esc_html_e('API Gateway Solutions', 'alepo'); ?></a></li>
                                                
                                                <li class="solution-category">
                                                    <span>🚀</span> <?php esc_html_e('Optimize Revenue & Growth', 'alepo'); ?>
                                                </li>
                                                <li><a href="/solutions/5g-monetization"><?php esc_html_e('5G Monetization', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/digital-services-enablement"><?php esc_html_e('Digital Services Enablement', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/partner-ecosystem-management"><?php esc_html_e('Partner Ecosystem Management', 'alepo'); ?></a></li>
                                                
                                                <li class="solution-category">
                                                    <span>⭐</span> <?php esc_html_e('Enhance Customer Experience', 'alepo'); ?>
                                                </li>
                                                <li><a href="/solutions/omnichannel-cx"><?php esc_html_e('Omnichannel CX', 'alepo'); ?></a></li>
                                                <li><a href="/solutions/self-service-portals"><?php esc_html_e('Self-Service Portals', 'alepo'); ?></a></li>
                                            </ul>
                                        </div>

                                        <!-- By Operator Type -->
                                        <div class="menu-section">
                                            <h3><span>🌟</span> <?php esc_html_e('By Operator Type', 'alepo'); ?></h3>
                                            <ul>
                                                <li>
                                                    <a href="/solutions/mno-mvno" class="operator-link">
                                                        <strong><?php esc_html_e('MNO/MVNO Solutions', 'alepo'); ?></strong>
                                                        <span class="operator-description"><?php esc_html_e('Complete solutions for mobile network operators and virtual operators', 'alepo'); ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/solutions/isp" class="operator-link">
                                                        <strong><?php esc_html_e('ISP Solutions', 'alepo'); ?></strong>
                                                        <span class="operator-description"><?php esc_html_e('Comprehensive platforms for internet service providers', 'alepo'); ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/solutions/enterprise-private-networks" class="operator-link">
                                                        <strong><?php esc_html_e('Enterprise Private Networks', 'alepo'); ?></strong>
                                                        <span class="operator-description"><?php esc_html_e('Dedicated solutions for enterprise network deployment', 'alepo'); ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/solutions/wholesale-operators" class="operator-link">
                                                        <strong><?php esc_html_e('Wholesale Operators', 'alepo'); ?></strong>
                                                        <span class="operator-description"><?php esc_html_e('Scalable platforms for wholesale service providers', 'alepo'); ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Featured Solutions -->
                                        <div class="featured-section">
                                            <h3><span>🌟</span> <?php esc_html_e('Featured Solutions', 'alepo'); ?></h3>
                                            <div class="featured-cards-container">
                                                <div class="featured-card">
                                                    <h4><?php esc_html_e('5G Network Monetization', 'alepo'); ?></h4>
                                                    <p><?php esc_html_e('Unlock new revenue streams with advanced 5G service orchestration and dynamic pricing capabilities.', 'alepo'); ?></p>
                                                    <a href="/solutions/5g-monetization" class="btn"><?php esc_html_e('Learn More', 'alepo'); ?> →</a>
                                                </div>
                                                <div class="featured-card gradient-blue-medium">
                                                    <h4><?php esc_html_e('AI-Powered Customer Experience', 'alepo'); ?></h4>
                                                    <p><?php esc_html_e('Transform customer interactions with intelligent automation and personalized service delivery.', 'alepo'); ?></p>
                                                    <a href="/solutions/omnichannel-cx" class="btn"><?php esc_html_e('Discover', 'alepo'); ?> →</a>
                                                </div>
                                                <div class="featured-card gradient-blue-light">
                                                    <h4><?php esc_html_e('Legacy System Modernization', 'alepo'); ?></h4>
                                                    <p><?php esc_html_e('Seamlessly migrate from legacy AAA to cloud-native infrastructure with zero downtime.', 'alepo'); ?></p>
                                                    <a href="/solutions/legacy-aaa-replacement" class="btn"><?php esc_html_e('Explore', 'alepo'); ?> →</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quick Links -->
                                        <div class="quick-links-section">
                                            <h3><span>🛠️</span> <?php esc_html_e('Quick Links', 'alepo'); ?></h3>
                                            <ul>
                                                <li><a href="/solutions">📋 <?php esc_html_e('All Solutions', 'alepo'); ?></a></li>
                                                <li><a href="/resources/solution-guides">📚 <?php esc_html_e('Solution Guides', 'alepo'); ?></a></li>
                                                <li><a href="/request-demo">🎯 <?php esc_html_e('Request Demo', 'alepo'); ?></a></li>
                                                <li><a href="/contact">💬 <?php esc_html_e('Talk to Expert', 'alepo'); ?></a></li>
                                                <li><a href="/customers/case-studies">📈 <?php esc_html_e('Success Stories', 'alepo'); ?></a></li>
                                                <li><a href="/resources/roi-calculator">💰 <?php esc_html_e('ROI Calculator', 'alepo'); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="solutions-mega-footer">
                                        <?php esc_html_e('Ready to transform your network?', 'alepo'); ?>
                                        <a href="/request-demo"><?php esc_html_e('Schedule Consultation', 'alepo'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Products Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/products" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Products', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="mega-menu products-mega-menu">
                                <div class="mega-menu-content">
                                    <div class="mega-menu-header"><?php esc_html_e('Our Product Portfolio', 'alepo'); ?></div>
                                    <div class="products-grid">
                                        <!-- AAA Solutions -->
                                        <div class="product-column">
                                            <div class="product-header">
                                                <div class="product-icon">🔐</div>
                                                <h3><?php esc_html_e('AAA Solutions', 'alepo'); ?></h3>
                                            </div>
                                            <p class="product-tagline"><?php esc_html_e('Next-generation authentication, authorization, and accounting for modern networks', 'alepo'); ?></p>
                                            <a href="/products/aaa-server" class="product-overview-btn"><?php esc_html_e('Product Overview', 'alepo'); ?></a>
                                            
                                            <ul class="feature-list">
                                                <li><?php esc_html_e('RADIUS & Diameter Support', 'alepo'); ?></li>
                                                <li><?php esc_html_e('5G & WiFi Authentication', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Policy Control & Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Security & Fraud Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Real-time Analytics', 'alepo'); ?></li>
                                            </ul>
                                            
                                            <div class="stat-card">
                                                <div class="stat">99.999%</div>
                                                <div class="label"><?php esc_html_e('Uptime SLA', 'alepo'); ?></div>
                                            </div>
                                            
                                            <a href="/products/aaa-server" class="product-cta"><?php esc_html_e('Explore AAA Solutions', 'alepo'); ?></a>
                                        </div>

                                        <!-- BSS Solutions -->
                                        <div class="product-column">
                                            <div class="product-header">
                                                <div class="product-icon">💼</div>
                                                <h3><?php esc_html_e('Digital BSS Platform', 'alepo'); ?></h3>
                                            </div>
                                            <p class="product-tagline"><?php esc_html_e('Comprehensive business support systems for digital service providers', 'alepo'); ?></p>
                                            <a href="/products/digital-bss" class="product-overview-btn"><?php esc_html_e('Product Overview', 'alepo'); ?></a>
                                            
                                            <ul class="feature-list">
                                                <li><?php esc_html_e('Order Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Billing & Revenue Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Customer Lifecycle Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Product Catalog Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Partner Management', 'alepo'); ?></li>
                                            </ul>
                                            
                                            <div class="stat-card bss-now">
                                                <div class="stat">30 Days</div>
                                                <div class="label"><?php esc_html_e('Time to Market', 'alepo'); ?></div>
                                            </div>
                                            
                                            <a href="/products/digital-bss" class="product-cta"><?php esc_html_e('Discover BSS Platform', 'alepo'); ?></a>
                                        </div>

                                        <!-- AI-Powered CX -->
                                        <div class="product-column">
                                            <div class="product-header">
                                                <div class="product-icon">🤖</div>
                                                <h3><?php esc_html_e('AI-Powered CX', 'alepo'); ?></h3>
                                            </div>
                                            <p class="product-tagline"><?php esc_html_e('Intelligent customer experience automation and agent assistance', 'alepo'); ?></p>
                                            <a href="/products/ai-customer-assistant" class="product-overview-btn"><?php esc_html_e('Product Overview', 'alepo'); ?></a>
                                            
                                            <ul class="feature-list">
                                                <li><?php esc_html_e('AI Customer Assistant', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Agent Assistant & Training', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Omnichannel Support', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Predictive Analytics', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Automated Workflows', 'alepo'); ?></li>
                                            </ul>
                                            
                                            <div class="stat-card">
                                                <div class="stat">80%</div>
                                                <div class="label"><?php esc_html_e('Resolution Rate', 'alepo'); ?></div>
                                            </div>
                                            
                                            <a href="/products/ai-customer-assistant" class="product-cta"><?php esc_html_e('Experience AI CX', 'alepo'); ?></a>
                                        </div>
                                    </div>
                                    <div class="mega-menu-footer">
                                        <a href="/products"><?php esc_html_e('View All Products', 'alepo'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Industries Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/industries" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Industries', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="mega-menu industries-mega-menu">
                                <div class="mega-menu-content">
                                    <div class="mega-menu-header"><?php esc_html_e('Industries We Serve', 'alepo'); ?></div>
                                    <div class="industries-grid">
                                        <div class="industry-card">
                                            <div class="industry-icon">📱</div>
                                            <h4><?php esc_html_e('Mobile Operators', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Complete solutions for MNOs and MVNOs', 'alepo'); ?></p>
                                            <a href="/industries/mobile-operators"><?php esc_html_e('Learn More', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🌐</div>
                                            <h4><?php esc_html_e('Internet Service Providers', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Advanced platforms for ISPs', 'alepo'); ?></p>
                                            <a href="/industries/internet-service-providers"><?php esc_html_e('Learn More', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">📡</div>
                                            <h4><?php esc_html_e('Satellite & Fixed Wireless', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Specialized solutions for satellite operators', 'alepo'); ?></p>
                                            <a href="/industries/satellite-fixed-wireless"><?php esc_html_e('Learn More', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🚀</div>
                                            <h4><?php esc_html_e('Enterprise & Private LTE/5G', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Private network solutions for enterprises', 'alepo'); ?></p>
                                            <a href="/industries/enterprise-private-networks"><?php esc_html_e('Learn More', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🏢</div>
                                            <h4><?php esc_html_e('Wholesale Operators', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Scalable platforms for wholesale providers', 'alepo'); ?></p>
                                            <a href="/industries/wholesale-operators"><?php esc_html_e('Learn More', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🏛️</div>
                                            <h4><?php esc_html_e('Government & Public Sector', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Secure solutions for government networks', 'alepo'); ?></p>
                                            <a href="/industries/government-public-sector"><?php esc_html_e('Learn More', 'alepo'); ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="success-story">
                                        <div class="story-logo">Customer</div>
                                        <div class="story-content">
                                            <div class="story-quote"><?php esc_html_e('"Alepo\'s solutions have transformed our network operations, enabling us to deliver exceptional service quality while reducing operational costs by 40%."', 'alepo'); ?></div>
                                            <div class="story-attribution">
                                                <strong><?php esc_html_e('CTO', 'alepo'); ?></strong>, <?php esc_html_e('Leading Mobile Operator', 'alepo'); ?>
                                            </div>
                                            <a href="/customers/case-studies"><?php esc_html_e('Read Full Case Study', 'alepo'); ?> →</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Customers Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/customers" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Customers', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-section">
                                    <a href="/customers/case-studies"><?php esc_html_e('Case Studies', 'alepo'); ?></a>
                                    <a href="/customers/testimonials"><?php esc_html_e('Testimonials', 'alepo'); ?></a>
                                    <a href="/customers"><?php esc_html_e('Customer Success Stories', 'alepo'); ?></a>
                                </div>
                            </div>
                        </li>

                        <!-- Resources Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/resources" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Resources', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-section">
                                    <h4><?php esc_html_e('Learning Resources', 'alepo'); ?></h4>
                                    <a href="/resources/blog"><?php esc_html_e('Blog & Insights', 'alepo'); ?></a>
                                    <a href="/resources/whitepapers"><?php esc_html_e('Whitepapers', 'alepo'); ?></a>
                                    <a href="/resources/case-studies"><?php esc_html_e('Case Studies', 'alepo'); ?></a>
                                    <a href="/resources/webinars"><?php esc_html_e('Webinars', 'alepo'); ?></a>
                                </div>
                                <div class="dropdown-section">
                                    <h4><?php esc_html_e('Tools & Support', 'alepo'); ?></h4>
                                    <a href="/support/documentation"><?php esc_html_e('Documentation', 'alepo'); ?></a>
                                    <a href="/support/training"><?php esc_html_e('Training', 'alepo'); ?></a>
                                    <a href="/resources/roi-calculator"><?php esc_html_e('ROI Calculator', 'alepo'); ?></a>
                                </div>
                            </div>
                        </li>

                        <!-- Company Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/company/about" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Company', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-section">
                                    <a href="/company/about"><?php esc_html_e('About Alepo', 'alepo'); ?></a>
                                    <a href="/company/leadership"><?php esc_html_e('Leadership Team', 'alepo'); ?></a>
                                    <a href="/company/careers"><?php esc_html_e('Careers', 'alepo'); ?></a>
                                    <a href="/company/news"><?php esc_html_e('Press & News', 'alepo'); ?></a>
                                    <a href="/partners"><?php esc_html_e('Partners', 'alepo'); ?></a>
                                    <a href="/contact"><?php esc_html_e('Contact Us', 'alepo'); ?></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                <?php endif; ?>

                <!-- Navigation Actions -->
                <div class="nav-actions">
                    <div class="search-icon" role="button" tabindex="0" aria-label="<?php esc_attr_e('Search', 'alepo'); ?>">
                        🔍
                    </div>
                    <a href="/request-demo" class="btn-demo"><?php esc_html_e('Request Demo', 'alepo'); ?></a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-label="<?php esc_attr_e('Toggle mobile menu', 'alepo'); ?>" aria-expanded="false">
                    ☰
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu">
            <?php if (has_nav_menu('mobile')) : ?>
                <?php wp_nav_menu(array(
                    'theme_location' => 'mobile',
                    'container' => 'nav',
                    'container_class' => 'mobile-nav',
                    'menu_class' => 'mobile-nav-menu',
                    'fallback_cb' => false,
                )); ?>
            <?php else : ?>
                <nav class="mobile-nav">
                    <ul class="mobile-nav-menu">
                        <li class="mobile-nav-item">
                            <a href="/solutions" class="mobile-nav-link"><?php esc_html_e('Solutions', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/products" class="mobile-nav-link"><?php esc_html_e('Products', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/industries" class="mobile-nav-link"><?php esc_html_e('Industries', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/customers" class="mobile-nav-link"><?php esc_html_e('Customers', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/resources" class="mobile-nav-link"><?php esc_html_e('Resources', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/company/about" class="mobile-nav-link"><?php esc_html_e('Company', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/contact" class="mobile-nav-link"><?php esc_html_e('Contact', 'alepo'); ?></a>
                        </li>
                        <li class="mobile-nav-item">
                            <a href="/request-demo" class="mobile-nav-link btn-primary"><?php esc_html_e('Request Demo', 'alepo'); ?></a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <div id="content" class="site-content">