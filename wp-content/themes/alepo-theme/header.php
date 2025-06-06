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
                                    <h2 class="mega-menu-header"><?php esc_html_e('OUR SOLUTION PORTFOLIO', 'alepo'); ?></h2>
                                    <div class="solutions-grid">
                                        <!-- Network Access Control -->
                                        <div class="product-column">
                                            <div class="product-header">
                                                <span class="product-icon">🛡️</span>
                                                <h3><?php esc_html_e('NETWORK ACCESS CONTROL', 'alepo'); ?></h3>
                                            </div>
                                            <p class="product-tagline"><?php esc_html_e('Secure Every Connection', 'alepo'); ?></p>
                                            <a href="/solutions/network-access-control" class="product-overview-btn"><?php esc_html_e('Solution Overview', 'alepo'); ?></a>
                                            
                                            <h4><?php esc_html_e('Highlights:', 'alepo'); ?></h4>
                                            <ul class="feature-list">
                                                <li><a href="/products/aaa-server" class="feature-link"><?php esc_html_e('AAA Server', 'alepo'); ?></a></li>
                                                <li><?php esc_html_e('RADIUS, Diameter, TACACS+', 'alepo'); ?></li>
                                                <li><a href="/products/5g-ausf" class="feature-link"><?php esc_html_e('AUSF for 5G Authentication', 'alepo'); ?></a></li>
                                                <li><?php esc_html_e('99.999% Uptime', 'alepo'); ?></li>
                                            </ul>
                                            
                                            <div class="stat-card">
                                                <div class="stat">36,000 TPS</div>
                                                <div class="label"><?php esc_html_e('Transaction Speed', 'alepo'); ?></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Digital BSS -->
                                        <div class="product-column">
                                            <div class="product-header">
                                                <span class="product-icon">💼</span>
                                                <h3><?php esc_html_e('DIGITAL BSS', 'alepo'); ?></h3>
                                            </div>
                                            <p class="product-tagline"><?php esc_html_e('Complete Business Support System', 'alepo'); ?></p>
                                            <a href="/products/digital-bss" class="product-overview-btn"><?php esc_html_e('Solution Overview', 'alepo'); ?></a>
                                            
                                            <h4><?php esc_html_e('Highlights:', 'alepo'); ?></h4>
                                            <ul class="feature-list">
                                                <li><?php esc_html_e('Convergent Charging', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Customer Management', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Product Catalog', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Real-time Analytics', 'alepo'); ?></li>
                                            </ul>
                                            
                                            <div class="stat-card bss-now">
                                                <div class="stat"><?php esc_html_e('BSS Now', 'alepo'); ?></div>
                                                <div class="label"><?php esc_html_e('SaaS - Launch in 30 days', 'alepo'); ?></div>
                                            </div>
                                        </div>
                                        
                                        <!-- AI-Powered CX -->
                                        <div class="product-column">
                                            <div class="product-header">
                                                <span class="product-icon">🤖</span>
                                                <h3><?php esc_html_e('AI-POWERED CX', 'alepo'); ?></h3>
                                            </div>
                                            <p class="product-tagline"><?php esc_html_e('Transform Customer Engagement', 'alepo'); ?></p>
                                            <a href="/products/ai-customer-assistant" class="product-overview-btn"><?php esc_html_e('Solution Overview', 'alepo'); ?></a>
                                            
                                            <h4><?php esc_html_e('Highlights:', 'alepo'); ?></h4>
                                            <ul class="feature-list">
                                                <li><?php esc_html_e('AI Customer Assistant', 'alepo'); ?></li>
                                                <li><?php esc_html_e('AI Agent Assistant', 'alepo'); ?></li>
                                                <li><?php esc_html_e('Digital Self-Care Suite', 'alepo'); ?></li>
                                                <li><?php esc_html_e('100+ Language Support', 'alepo'); ?></li>
                                            </ul>
                                            
                                            <div class="stat-card">
                                                <div class="stat">90%</div>
                                                <div class="label"><?php esc_html_e('Resolution Rate', 'alepo'); ?></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Quick Links Section -->
                                        <div class="quick-links-section">
                                            <h3><span>🚀</span> <?php esc_html_e('Quick Access', 'alepo'); ?></h3>
                                            <ul>
                                                <li><a href="/resources/roi-calculator"><span class="resource-icon">📊</span> <?php esc_html_e('ROI Calculator', 'alepo'); ?></a></li>
                                                <li><a href="/request-demo"><span class="resource-icon">📅</span> <?php esc_html_e('Schedule Consultation', 'alepo'); ?></a></li>
                                                <li><a href="/resources/solution-finder"><span class="resource-icon">📄</span> <?php esc_html_e('Solution Finder Quiz', 'alepo'); ?></a></li>
                                                <li><a href="/security"><span class="resource-icon">🔒</span> <?php esc_html_e('Security', 'alepo'); ?></a></li>
                                                <li><a href="/integrations"><span class="resource-icon">🔗</span> <?php esc_html_e('Integrations', 'alepo'); ?></a></li>
                                                <li><a href="/contact"><span class="resource-icon">💬</span> <?php esc_html_e('Live Chat', 'alepo'); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="solutions-mega-footer">
                                        <div class="other-solutions">
                                            <span class="other-solutions-label"><?php esc_html_e('Other Solutions:', 'alepo'); ?></span>
                                            <a href="/solutions/carrier-wifi"><?php esc_html_e('Carrier Wi-Fi', 'alepo'); ?></a>
                                            <a href="/solutions/pcf"><?php esc_html_e('PCF', 'alepo'); ?></a>
                                            <a href="/solutions/sdm"><?php esc_html_e('SDM', 'alepo'); ?></a>
                                        </div>
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
                                    <h2 class="mega-menu-header"><?php esc_html_e('SOLUTIONS BY INDUSTRY', 'alepo'); ?></h2>
                                    <div class="industries-grid">
                                        <div class="industry-card">
                                            <div class="industry-icon">📱</div>
                                            <h4><?php esc_html_e('Mobile Network Operators', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Tier-1 to regional MNOs', 'alepo'); ?></p>
                                            <a href="/industries/mobile-operators"><?php esc_html_e('View MNO Solutions', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🌐</div>
                                            <h4><?php esc_html_e('ISPs', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Regional & national providers', 'alepo'); ?></p>
                                            <a href="/industries/internet-service-providers"><?php esc_html_e('View ISP Solutions', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">📡</div>
                                            <h4><?php esc_html_e('Cable & Broadband', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Fiber & cable operators', 'alepo'); ?></p>
                                            <a href="/industries/cable-broadband"><?php esc_html_e('View Cable Solutions', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🚀</div>
                                            <h4><?php esc_html_e('MVNOs', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Quick launch solutions', 'alepo'); ?></p>
                                            <a href="/industries/mvno"><?php esc_html_e('View MVNO Solutions', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🎧</div>
                                            <h4><?php esc_html_e('CCaaS', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Enhances service with Voice AI', 'alepo'); ?></p>
                                            <a href="/industries/ccaas"><?php esc_html_e('View CCaaS Solutions', 'alepo'); ?></a>
                                        </div>
                                        <div class="industry-card">
                                            <div class="industry-icon">🏛️</div>
                                            <h4><?php esc_html_e('Gov & Smart Cities', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Secure citizen services', 'alepo'); ?></p>
                                            <a href="/industries/government-smart-cities"><?php esc_html_e('View Gov Solutions', 'alepo'); ?></a>
                                        </div>
                                    </div>
                                    
                                    <div class="success-story">
                                        <div class="story-logo">SaskTel</div>
                                        <div class="story-content">
                                            <p class="story-quote"><?php esc_html_e('"Alepo\'s solutions enabled us to reduce operational costs by 40% while improving customer satisfaction to 65% NPS"', 'alepo'); ?></p>
                                            <p class="story-attribution"><strong><?php esc_html_e('CTO, Major Operator', 'alepo'); ?></strong> • <?php esc_html_e('Saskatchewan, Canada', 'alepo'); ?></p>
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
                            <div class="mega-menu customers-mega-menu">
                                <div class="mega-menu-content">
                                    <h2 class="mega-menu-header"><?php esc_html_e('OUR GLOBAL CUSTOMERS', 'alepo'); ?></h2>
                                    <div class="customers-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 48px;">
                                        <div class="customers-section">
                                            <h3 style="font-size: 18px; margin-bottom: 24px;"><?php esc_html_e('🌟 Case Studies', 'alepo'); ?></h3>
                                            <div class="customer-story" style="background: var(--light-gray); padding: 24px; border-radius: 8px; margin-bottom: 16px;">
                                                <h4 style="color: var(--primary-blue); margin-bottom: 8px;"><?php esc_html_e('Lüm Mobile (SaskTel)', 'alepo'); ?></h4>
                                                <p style="font-size: 14px; color: var(--text-gray); margin-bottom: 12px;"><?php esc_html_e('AI transformation success: 70% support automation, 25% churn reduction', 'alepo'); ?></p>
                                                <a href="/customers/case-studies/lum-mobile" style="color: var(--primary-blue); font-weight: 500; text-decoration: none;"><?php esc_html_e('Read Case Study →', 'alepo'); ?></a>
                                            </div>
                                            <div class="customer-story" style="background: var(--light-gray); padding: 24px; border-radius: 8px; margin-bottom: 16px;">
                                                <h4 style="color: var(--primary-blue); margin-bottom: 8px;"><?php esc_html_e('STC', 'alepo'); ?></h4>
                                                <p style="font-size: 14px; color: var(--text-gray); margin-bottom: 12px;"><?php esc_html_e('BSS modernization: Unified platform for fiber & mobile services', 'alepo'); ?></p>
                                                <a href="/customers/case-studies/stc" style="color: var(--primary-blue); font-weight: 500; text-decoration: none;"><?php esc_html_e('Read Case Study →', 'alepo'); ?></a>
                                            </div>
                                            <div class="customer-story" style="background: var(--light-gray); padding: 24px; border-radius: 8px;">
                                                <h4 style="color: var(--primary-blue); margin-bottom: 8px;"><?php esc_html_e('Global Tier-1 Operator', 'alepo'); ?></h4>
                                                <p style="font-size: 14px; color: var(--text-gray); margin-bottom: 12px;"><?php esc_html_e('Zero-downtime AAA migration for 50M+ subscribers', 'alepo'); ?></p>
                                                <a href="/customers/case-studies/tier1-operator" style="color: var(--primary-blue); font-weight: 500; text-decoration: none;"><?php esc_html_e('Read Case Study →', 'alepo'); ?></a>
                                            </div>
                                        </div>
                                        <div class="customers-right">
                                            <h3 style="font-size: 18px; margin-bottom: 24px;"><?php esc_html_e('🌍 Client Experience', 'alepo'); ?></h3>
                                            <div style="background: var(--light-gray); padding: 24px; border-radius: 8px; height: 200px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                                                <p style="color: var(--text-gray);"><?php esc_html_e('[Interactive World Map]', 'alepo'); ?></p>
                                            </div>
                                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                                                <div style="text-align: center;">
                                                    <div style="font-size: 32px; font-weight: bold; color: var(--primary-blue);">100+</div>
                                                    <div style="font-size: 14px; color: var(--text-gray);"><?php esc_html_e('Service Providers', 'alepo'); ?></div>
                                                </div>
                                                <div style="text-align: center;">
                                                    <div style="font-size: 32px; font-weight: bold; color: var(--primary-blue);">6</div>
                                                    <div style="font-size: 14px; color: var(--text-gray);"><?php esc_html_e('Continents', 'alepo'); ?></div>
                                                </div>
                                            </div>
                                            <p style="font-size: 14px; color: var(--text-gray);"><?php esc_html_e('Trusted by leading operators worldwide including STC, Digicel, Orange, Zain, SaskTel, and many more.', 'alepo'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mega-menu-footer">
                                    <?php esc_html_e('🛠️ Customer Support: Access our global technical assistance center →', 'alepo'); ?> <a href="/support"><?php esc_html_e('Get Support', 'alepo'); ?></a>
                                </div>
                            </div>
                        </li>

                        <!-- Resources Menu Item -->
                        <li class="nav-item" role="none">
                            <a href="/resources" class="nav-link" role="menuitem" aria-haspopup="true" aria-expanded="false">
                                <?php esc_html_e('Resources', 'alepo'); ?>
                                <span class="dropdown-arrow">▼</span>
                            </a>
                            <div class="mega-menu resources-mega-menu">
                                <div class="mega-menu-content">
                                    <h2 class="mega-menu-header"><?php esc_html_e('EXPLORE OUR RESOURCES', 'alepo'); ?></h2>
                                    <div class="resources-grid">
                                        <div class="resources-section clean-nav">
                                            <ul class="clean-nav-list">
                                                <li><a href="/resources"><?php esc_html_e('Resource Library', 'alepo'); ?></a></li>
                                                <li><a href="/resources/blog"><?php esc_html_e('Blog', 'alepo'); ?></a></li>
                                                <li><a href="/resources/roi-calculator"><?php esc_html_e('ROI Tools', 'alepo'); ?></a></li>
                                                <li><a href="/events"><?php esc_html_e('Events', 'alepo'); ?></a></li>
                                                <li><a href="/news"><?php esc_html_e('News', 'alepo'); ?></a></li>
                                            </ul>
                                        </div>
                                        
                                        <div class="resources-section featured-blog">
                                            <div class="featured-blog-post">
                                                <div class="featured-badge"><?php esc_html_e('FEATURED', 'alepo'); ?></div>
                                                <div class="blog-image-placeholder"><?php esc_html_e('[Blog Image]', 'alepo'); ?></div>
                                                <div class="blog-content">
                                                    <h4><?php esc_html_e('How AI is Revolutionizing Telecom Customer Service', 'alepo'); ?></h4>
                                                    <p><?php esc_html_e('5 min read • Dec 2024', 'alepo'); ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="featured-blog-post">
                                                <div class="featured-badge"><?php esc_html_e('FEATURED', 'alepo'); ?></div>
                                                <div class="blog-image-placeholder"><?php esc_html_e('[ROI Tool Image]', 'alepo'); ?></div>
                                                <div class="blog-content">
                                                    <h4><?php esc_html_e('Featured ROI tool and Description here', 'alepo'); ?></h4>
                                                    <p><?php esc_html_e('Interactive calculator • Nov 2024', 'alepo'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resources-mega-footer">
                                    <div class="newsletter-signup">
                                        <div class="newsletter-content">
                                            <h4><?php esc_html_e('📧 Stay Updated', 'alepo'); ?></h4>
                                            <p><?php esc_html_e('Get the latest telco insights delivered to your inbox', 'alepo'); ?></p>
                                        </div>
                                        <div class="newsletter-form">
                                            <input type="email" placeholder="<?php esc_attr_e('Enter your email address', 'alepo'); ?>" class="email-input">
                                            <button class="subscribe-btn"><?php esc_html_e('Subscribe', 'alepo'); ?></button>
                                        </div>
                                    </div>
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
                                    <a href="/company/about" class="single-link"><?php esc_html_e('About Alepo', 'alepo'); ?></a>
                                    <a href="/company/leadership" class="single-link"><?php esc_html_e('Leadership Team', 'alepo'); ?></a>
                                    <a href="/company/why-alepo" class="single-link"><?php esc_html_e('Why Alepo', 'alepo'); ?></a>
                                    <a href="/partners" class="single-link"><?php esc_html_e('Partners', 'alepo'); ?></a>
                                    <a href="/company/careers" class="single-link"><?php esc_html_e('Careers', 'alepo'); ?></a>
                                    <a href="/contact" class="single-link"><?php esc_html_e('Contact Us', 'alepo'); ?></a>
                                    <a href="/company/locations" class="single-link"><?php esc_html_e('Locations', 'alepo'); ?></a>
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