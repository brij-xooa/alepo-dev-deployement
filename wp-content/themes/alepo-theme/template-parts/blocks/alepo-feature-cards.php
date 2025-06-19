<?php
/**
 * Alepo Feature Cards Block Template
 * 
 * Usage in wp-admin:
 * 1. Add this as a custom HTML block
 * 2. Copy the HTML structure below
 * 3. Customize content as needed
 * 
 * Features:
 * - Advanced hover effects with aim dots
 * - Mouse-following gradients
 * - Staggered animations
 * - Responsive design
 */

// Get block attributes if called from a custom block
$cards = isset($args['cards']) ? $args['cards'] : [
    [
        'icon' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />',
        'title' => 'Zero-Downtime Migration',
        'description' => 'Seamlessly transition from legacy RADIUS/Diameter infrastructure to cloud-native AAA platform. Parallel deployment strategy ensures continuous service while modernizing authentication backend.'
    ],
    [
        'icon' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />',
        'title' => 'Performance Amplification',
        'description' => 'Transform from thousands to millions of concurrent authentications. Cloud-native architecture delivers 10x performance improvement with elastic scaling and sub-millisecond response times.'
    ],
    [
        'icon' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
        'title' => 'Security Enhancement',
        'description' => 'Eliminate legacy vulnerabilities with modern security protocols. Advanced threat detection, zero-trust principles, and real-time fraud prevention protect against evolving cyber threats.'
    ]
];

$container_class = isset($args['container_class']) ? $args['container_class'] : 'alepo-flex-column';
$show_background = isset($args['show_background']) ? $args['show_background'] : false;
?>

<!-- Alepo Feature Cards Component -->
<?php if ($show_background): ?>
<!-- Background Effects (optional) -->
<div class="alepo-gradient-mesh"></div>
<div class="alepo-curved-lines"></div>
<div class="alepo-particles-bg"></div>
<?php endif; ?>

<div class="<?php echo esc_attr($container_class); ?>">
    <?php foreach ($cards as $index => $card): ?>
    <div class="alepo-feature-card">
        <!-- Aim dot animation -->
        <div class="alepo-aim-dot"></div>
        
        <!-- Mouse follow gradient -->
        <div class="alepo-mouse-gradient"></div>
        
        <!-- Icon wrapper -->
        <div class="alepo-icon-wrapper">
            <svg class="alepo-icon" viewBox="0 0 24 24">
                <?php echo $card['icon']; ?>
            </svg>
        </div>
        
        <!-- Content -->
        <h3 class="alepo-feature-title"><?php echo esc_html($card['title']); ?></h3>
        <p class="alepo-feature-description"><?php echo esc_html($card['description']); ?></p>
    </div>
    <?php endforeach; ?>
</div>

<style>
/* Feature Card Typography */
.alepo-feature-title {
    font-size: var(--font-size-h3);
    font-weight: var(--font-weight-semibold);
    line-height: var(--line-height-snug);
    color: var(--c-gray-900);
    margin-bottom: var(--space-4);
}

.alepo-feature-description {
    font-size: var(--font-size-body);
    line-height: var(--line-height-relaxed);
    color: var(--c-gray-600);
    margin: 0;
}
</style>

<!--
USAGE INSTRUCTIONS FOR WP-ADMIN:

1. CUSTOM HTML BLOCK METHOD:
   - Add Custom HTML block in Gutenberg
   - Copy the HTML structure above (without PHP)
   - Customize titles and descriptions
   - Add your own SVG icons

2. REUSABLE BLOCK METHOD:
   - Create this as a Reusable Block
   - Save for use across multiple pages
   - Edit centrally to update all instances

3. SHORTCODE METHOD (if shortcode support added):
   [alepo_feature_cards cards="3" show_background="true"]

4. CUSTOMIZATION OPTIONS:
   - Change number of cards by adding/removing card divs
   - Update icons by changing SVG paths
   - Modify text content as needed
   - Add container_class for different layouts

EXAMPLE HTML FOR COPY-PASTE:
<div class="alepo-flex-column">
    <div class="alepo-feature-card">
        <div class="alepo-aim-dot"></div>
        <div class="alepo-mouse-gradient"></div>
        <div class="alepo-icon-wrapper">
            <svg class="alepo-icon" viewBox="0 0 24 24">
                <path d="M12 2L2 7L12 12L22 7L12 2Z" />
                <path d="M2 17L12 22L22 17" />
                <path d="M2 12L12 17L22 12" />
            </svg>
        </div>
        <h3 class="alepo-feature-title">Your Feature Title</h3>
        <p class="alepo-feature-description">Your feature description goes here...</p>
    </div>
    <!-- Add more cards as needed -->
</div>
-->