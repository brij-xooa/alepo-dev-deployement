    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <!-- Main Footer -->
        <div class="footer-main">
            <div class="container">
                <div class="footer-content">
                    <!-- Footer Column 1: Company Info -->
                    <div class="footer-column">
                        <div class="footer-branding">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                                    <?php bloginfo('name'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <p class="footer-description">
                            <?php 
                            $description = get_bloginfo('description');
                            if ($description) {
                                echo esc_html($description);
                            } else {
                                esc_html_e('Leading provider of telecom software solutions for 5G, BSS, and network modernization.', 'alepo');
                            }
                            ?>
                        </p>
                        <div class="footer-contact">
                            <?php if (get_theme_mod('alepo_utility_phone')) : ?>
                                <div class="contact-item">
                                    <span class="contact-icon">📞</span>
                                    <span><?php echo esc_html(get_theme_mod('alepo_utility_phone')); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (get_theme_mod('alepo_utility_email')) : ?>
                                <div class="contact-item">
                                    <span class="contact-icon">✉️</span>
                                    <a href="mailto:<?php echo esc_attr(get_theme_mod('alepo_utility_email')); ?>">
                                        <?php echo esc_html(get_theme_mod('alepo_utility_email')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="footer-social">
                            <a href="#" class="social-link" aria-label="<?php esc_attr_e('LinkedIn', 'alepo'); ?>">💼</a>
                            <a href="#" class="social-link" aria-label="<?php esc_attr_e('Twitter', 'alepo'); ?>">🐦</a>
                            <a href="#" class="social-link" aria-label="<?php esc_attr_e('YouTube', 'alepo'); ?>">📺</a>
                        </div>
                    </div>

                    <!-- Footer Column 2: Solutions -->
                    <div class="footer-column">
                        <?php if (is_active_sidebar('footer-1')) : ?>
                            <?php dynamic_sidebar('footer-1'); ?>
                        <?php else : ?>
                            <h3 class="footer-title"><?php esc_html_e('Solutions', 'alepo'); ?></h3>
                            <ul class="footer-menu">
                                <li><a href="/solutions/legacy-aaa-replacement"><?php esc_html_e('Legacy AAA Replacement', 'alepo'); ?></a></li>
                                <li><a href="/solutions/5g-network-evolution"><?php esc_html_e('5G Network Evolution', 'alepo'); ?></a></li>
                                <li><a href="/solutions/bss-modernization"><?php esc_html_e('BSS Modernization', 'alepo'); ?></a></li>
                                <li><a href="/solutions/ai-driven-automation"><?php esc_html_e('AI-Driven Automation', 'alepo'); ?></a></li>
                                <li><a href="/solutions/5g-monetization"><?php esc_html_e('5G Monetization', 'alepo'); ?></a></li>
                                <li><a href="/solutions/omnichannel-cx"><?php esc_html_e('Omnichannel CX', 'alepo'); ?></a></li>
                                <li><a href="/solutions"><?php esc_html_e('View All Solutions', 'alepo'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Footer Column 3: Products & Industries -->
                    <div class="footer-column">
                        <?php if (is_active_sidebar('footer-2')) : ?>
                            <?php dynamic_sidebar('footer-2'); ?>
                        <?php else : ?>
                            <h3 class="footer-title"><?php esc_html_e('Products', 'alepo'); ?></h3>
                            <ul class="footer-menu">
                                <li><a href="/products/aaa-server"><?php esc_html_e('AAA Authentication Server', 'alepo'); ?></a></li>
                                <li><a href="/products/digital-bss"><?php esc_html_e('Digital BSS Platform', 'alepo'); ?></a></li>
                                <li><a href="/products/pcrf"><?php esc_html_e('Policy Control (PCRF)', 'alepo'); ?></a></li>
                                <li><a href="/products/ai-customer-assistant"><?php esc_html_e('AI Customer Assistant', 'alepo'); ?></a></li>
                                <li><a href="/products/ai-agent-assistant"><?php esc_html_e('AI Agent Assistant', 'alepo'); ?></a></li>
                            </ul>
                            
                            <h3 class="footer-title footer-title-secondary"><?php esc_html_e('Industries', 'alepo'); ?></h3>
                            <ul class="footer-menu">
                                <li><a href="/industries/mobile-operators"><?php esc_html_e('Mobile Operators', 'alepo'); ?></a></li>
                                <li><a href="/industries/internet-service-providers"><?php esc_html_e('Internet Service Providers', 'alepo'); ?></a></li>
                                <li><a href="/industries/enterprise-private-networks"><?php esc_html_e('Enterprise & Private Networks', 'alepo'); ?></a></li>
                                <li><a href="/industries"><?php esc_html_e('View All Industries', 'alepo'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Footer Column 4: Resources & Company -->
                    <div class="footer-column">
                        <?php if (is_active_sidebar('footer-3')) : ?>
                            <?php dynamic_sidebar('footer-3'); ?>
                        <?php else : ?>
                            <h3 class="footer-title"><?php esc_html_e('Resources', 'alepo'); ?></h3>
                            <ul class="footer-menu">
                                <li><a href="/resources/blog"><?php esc_html_e('Blog & Insights', 'alepo'); ?></a></li>
                                <li><a href="/resources/case-studies"><?php esc_html_e('Case Studies', 'alepo'); ?></a></li>
                                <li><a href="/resources/whitepapers"><?php esc_html_e('Whitepapers', 'alepo'); ?></a></li>
                                <li><a href="/resources/webinars"><?php esc_html_e('Webinars & Events', 'alepo'); ?></a></li>
                                <li><a href="/support/documentation"><?php esc_html_e('Documentation', 'alepo'); ?></a></li>
                                <li><a href="/support/training"><?php esc_html_e('Training', 'alepo'); ?></a></li>
                            </ul>
                            
                            <h3 class="footer-title footer-title-secondary"><?php esc_html_e('Company', 'alepo'); ?></h3>
                            <ul class="footer-menu">
                                <li><a href="/company/about"><?php esc_html_e('About Alepo', 'alepo'); ?></a></li>
                                <li><a href="/company/leadership"><?php esc_html_e('Leadership Team', 'alepo'); ?></a></li>
                                <li><a href="/company/careers"><?php esc_html_e('Careers', 'alepo'); ?></a></li>
                                <li><a href="/company/news"><?php esc_html_e('Press & News', 'alepo'); ?></a></li>
                                <li><a href="/partners"><?php esc_html_e('Partners', 'alepo'); ?></a></li>
                                <li><a href="/contact"><?php esc_html_e('Contact Us', 'alepo'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <!-- Footer Column 5: Newsletter & CTA -->
                    <div class="footer-column">
                        <?php if (is_active_sidebar('footer-4')) : ?>
                            <?php dynamic_sidebar('footer-4'); ?>
                        <?php else : ?>
                            <h3 class="footer-title"><?php esc_html_e('Stay Connected', 'alepo'); ?></h3>
                            <p class="newsletter-description">
                                <?php esc_html_e('Get the latest insights on telecom innovation, 5G trends, and industry best practices.', 'alepo'); ?>
                            </p>
                            
                            <form class="newsletter-form" action="#" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="<?php esc_attr_e('Enter your email', 'alepo'); ?>" required>
                                    <button type="submit" class="btn-newsletter">
                                        <?php esc_html_e('Subscribe', 'alepo'); ?>
                                    </button>
                                </div>
                                <p class="form-disclaimer">
                                    <?php esc_html_e('By subscribing, you agree to our Privacy Policy and consent to receive updates from our company.', 'alepo'); ?>
                                </p>
                            </form>
                            
                            <div class="footer-cta">
                                <h4 class="cta-title"><?php esc_html_e('Ready to Transform Your Network?', 'alepo'); ?></h4>
                                <a href="/request-demo" class="btn-footer-cta">
                                    <?php esc_html_e('Request Demo', 'alepo'); ?>
                                </a>
                                <a href="/contact" class="btn-footer-secondary">
                                    <?php esc_html_e('Talk to Expert', 'alepo'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="footer-copyright">
                        <p>
                            <?php 
                            $copyright = get_theme_mod('alepo_footer_copyright');
                            if ($copyright) {
                                echo esc_html($copyright);
                            } else {
                                echo esc_html(sprintf(
                                    __('© %d %s. All rights reserved.', 'alepo'),
                                    date('Y'),
                                    get_bloginfo('name')
                                ));
                            }
                            ?>
                        </p>
                    </div>
                    
                    <div class="footer-legal">
                        <?php if (has_nav_menu('footer')) : ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'container' => false,
                                'menu_class' => 'footer-legal-menu',
                                'fallback_cb' => false,
                            )); ?>
                        <?php else : ?>
                            <ul class="footer-legal-menu">
                                <li><a href="/privacy-policy"><?php esc_html_e('Privacy Policy', 'alepo'); ?></a></li>
                                <li><a href="/terms-of-service"><?php esc_html_e('Terms of Service', 'alepo'); ?></a></li>
                                <li><a href="/cookie-policy"><?php esc_html_e('Cookie Policy', 'alepo'); ?></a></li>
                                <li><a href="/sitemap.xml"><?php esc_html_e('Sitemap', 'alepo'); ?></a></li>
                            </ul>
                        <?php endif; ?>
                    </div>

                    <div class="footer-certifications">
                        <span class="certification-badge">🔒 <?php esc_html_e('ISO 27001', 'alepo'); ?></span>
                        <span class="certification-badge">✅ <?php esc_html_e('SOC 2', 'alepo'); ?></span>
                        <span class="certification-badge">🛡️ <?php esc_html_e('GDPR Compliant', 'alepo'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'alepo'); ?>" style="display: none;">
        ↑
    </button>

</div><!-- #page -->

<?php wp_footer(); ?>

<style>
/* Footer Styles */
.site-footer {
    background: var(--dark-gray);
    color: var(--white);
    margin-top: auto;
}

.footer-main {
    padding: var(--space-8) 0 var(--space-7);
}

.footer-content {
    display: grid;
    grid-template-columns: 1.5fr repeat(4, 1fr);
    gap: var(--space-7);
}

.footer-column {
    display: flex;
    flex-direction: column;
}

.footer-branding .footer-logo {
    font-size: var(--font-size-h2);
    font-weight: var(--font-weight-bold);
    color: var(--white);
    text-decoration: none;
    margin-bottom: var(--space-4);
    display: inline-block;
}

.footer-description {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: var(--space-5);
    line-height: var(--line-height-normal);
}

.footer-contact {
    margin-bottom: var(--space-5);
}

.contact-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    margin-bottom: var(--space-2);
    color: rgba(255, 255, 255, 0.9);
}

.contact-item a {
    color: inherit;
    text-decoration: none;
}

.contact-item a:hover {
    color: var(--white);
}

.footer-social {
    display: flex;
    gap: var(--space-3);
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    text-decoration: none;
    font-size: var(--font-size-h5);
    transition: all var(--transition-fast);
}

.social-link:hover {
    background: var(--primary-blue);
    transform: translateY(-2px);
}

.footer-title {
    font-size: var(--font-size-h5);
    font-weight: var(--font-weight-semibold);
    margin-bottom: var(--space-4);
    color: var(--white);
}

.footer-title-secondary {
    margin-top: var(--space-5);
}

.footer-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-menu li {
    margin-bottom: var(--space-2);
}

.footer-menu a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: var(--font-size-small);
    transition: color var(--transition-fast);
}

.footer-menu a:hover {
    color: var(--white);
    padding-left: var(--space-1);
}

.newsletter-description {
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: var(--space-4);
    font-size: var(--font-size-small);
}

.newsletter-form {
    margin-bottom: var(--space-6);
}

.form-group {
    display: flex;
    gap: var(--space-2);
    margin-bottom: var(--space-2);
}

.newsletter-form input[type="email"] {
    flex: 1;
    padding: var(--space-3) var(--space-4);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 4px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--white);
    font-size: var(--font-size-small);
}

.newsletter-form input[type="email"]::placeholder {
    color: rgba(255, 255, 255, 0.6);
}

.newsletter-form input[type="email"]:focus {
    outline: none;
    border-color: var(--primary-blue);
    background: rgba(255, 255, 255, 0.15);
}

.btn-newsletter {
    padding: var(--space-3) var(--space-4);
    background: var(--primary-blue);
    color: var(--white);
    border: none;
    border-radius: 4px;
    font-size: var(--font-size-small);
    font-weight: var(--font-weight-medium);
    cursor: pointer;
    transition: background var(--transition-fast);
}

.btn-newsletter:hover {
    background: var(--primary-blue-dark);
}

.form-disclaimer {
    font-size: var(--font-size-tiny);
    color: rgba(255, 255, 255, 0.6);
    line-height: var(--line-height-snug);
}

.footer-cta {
    padding: var(--space-5);
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    text-align: center;
}

.cta-title {
    font-size: var(--font-size-h6);
    margin-bottom: var(--space-4);
    color: var(--white);
}

.btn-footer-cta {
    display: block;
    background: var(--primary-blue);
    color: var(--white);
    padding: var(--space-3) var(--space-5);
    border-radius: 4px;
    text-decoration: none;
    font-weight: var(--font-weight-medium);
    margin-bottom: var(--space-3);
    transition: all var(--transition-fast);
}

.btn-footer-cta:hover {
    background: var(--primary-blue-dark);
    transform: translateY(-1px);
}

.btn-footer-secondary {
    display: block;
    background: transparent;
    color: var(--white);
    padding: var(--space-3) var(--space-5);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 4px;
    text-decoration: none;
    font-weight: var(--font-weight-medium);
    transition: all var(--transition-fast);
}

.btn-footer-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.5);
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.3);
    padding: var(--space-5) 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.footer-copyright p {
    margin: 0;
    color: rgba(255, 255, 255, 0.7);
    font-size: var(--font-size-small);
}

.footer-legal-menu {
    display: flex;
    list-style: none;
    gap: var(--space-5);
    margin: 0;
    padding: 0;
}

.footer-legal-menu a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: var(--font-size-small);
    transition: color var(--transition-fast);
}

.footer-legal-menu a:hover {
    color: var(--white);
}

.footer-certifications {
    display: flex;
    gap: var(--space-3);
    flex-wrap: wrap;
}

.certification-badge {
    font-size: var(--font-size-tiny);
    color: rgba(255, 255, 255, 0.8);
    background: rgba(255, 255, 255, 0.1);
    padding: var(--space-1) var(--space-2);
    border-radius: 4px;
    white-space: nowrap;
}

.back-to-top {
    position: fixed;
    bottom: var(--space-5);
    right: var(--space-5);
    width: 50px;
    height: 50px;
    background: var(--primary-blue);
    color: var(--white);
    border: none;
    border-radius: 50%;
    font-size: var(--font-size-h4);
    cursor: pointer;
    z-index: 999;
    transition: all var(--transition-fast);
    box-shadow: var(--shadow-lg);
}

.back-to-top:hover {
    background: var(--primary-blue-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
}

/* Responsive Footer */
@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-6);
    }
    
    .footer-column:first-child {
        grid-column: 1 / -1;
        margin-bottom: var(--space-4);
    }
}

@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        gap: var(--space-5);
    }
    
    .footer-column:first-child {
        grid-column: auto;
        margin-bottom: 0;
    }
    
    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
        gap: var(--space-3);
    }
    
    .footer-legal-menu {
        flex-wrap: wrap;
        justify-content: center;
        gap: var(--space-3);
    }
    
    .footer-certifications {
        justify-content: center;
    }
    
    .form-group {
        flex-direction: column;
    }
    
    .btn-newsletter {
        width: 100%;
    }
}
</style>

<script>
// Back to Top Button Functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');
    
    if (backToTopButton) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter Form Handling
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            // Here you would typically send the email to your newsletter service
            // For now, we'll show a simple success message
            const button = this.querySelector('.btn-newsletter');
            const originalText = button.textContent;
            
            button.textContent = '✓ Subscribed!';
            button.style.background = 'var(--accent-green)';
            
            setTimeout(function() {
                button.textContent = originalText;
                button.style.background = 'var(--primary-blue)';
            }, 2000);
        });
    }
});
</script>

</body>
</html>