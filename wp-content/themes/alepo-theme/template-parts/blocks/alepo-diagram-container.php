<?php
/**
 * Alepo Diagram Container Block Template
 * 
 * Features:
 * - Sticky parallax scrolling
 * - Floating particles animation
 * - Responsive design
 * - Customizable content
 */

$heading = isset($args['heading']) ? $args['heading'] : 'Integrated Solution Architecture';
$content = isset($args['content']) ? $args['content'] : 'Solution Capability Diagram';
$subtext = isset($args['subtext']) ? $args['subtext'] : '[Your architecture diagram here]';
$min_height = isset($args['min_height']) ? $args['min_height'] : '500px';
$show_particles = isset($args['show_particles']) ? $args['show_particles'] : true;
$sticky = isset($args['sticky']) ? $args['sticky'] : true;
?>

<!-- Alepo Diagram Container Component -->
<div class="<?php echo $sticky ? 'alepo-sticky-container' : ''; ?>">
    <div class="<?php echo $sticky ? 'alepo-sticky-wrapper' : ''; ?>">
        
        <?php if ($heading): ?>
        <h2 class="alepo-fade-in-up" style="font-size: var(--font-size-h3); font-weight: var(--font-weight-semibold); color: var(--c-gray-900); margin-bottom: var(--space-5);">
            <?php echo esc_html($heading); ?>
        </h2>
        <?php endif; ?>
        
        <div class="alepo-diagram-container" style="min-height: <?php echo esc_attr($min_height); ?>;">
            <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                
                <?php if ($show_particles): ?>
                <!-- Floating particles -->
                <div class="alepo-particle-container"></div>
                <?php endif; ?>
                
                <!-- Content -->
                <div style="position: relative; z-index: 2; color: var(--c-gray-600); text-align: center;">
                    <p style="font-size: var(--font-size-body-lg); margin-bottom: var(--space-3); font-weight: var(--font-weight-medium);">
                        <?php echo esc_html($content); ?>
                    </p>
                    <?php if ($subtext): ?>
                    <p style="font-size: var(--font-size-small); opacity: 0.7;">
                        <?php echo esc_html($subtext); ?>
                    </p>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

<!--
USAGE INSTRUCTIONS FOR WP-ADMIN:

1. BASIC USAGE - Custom HTML Block:
<div class="alepo-sticky-container">
    <div class="alepo-sticky-wrapper">
        <h2 class="alepo-fade-in-up" style="font-size: var(--font-size-h3); font-weight: var(--font-weight-semibold); color: var(--c-gray-900); margin-bottom: var(--space-5);">
            Your Diagram Title
        </h2>
        <div class="alepo-diagram-container" style="min-height: 500px;">
            <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                <div class="alepo-particle-container"></div>
                <div style="position: relative; z-index: 2; color: var(--c-gray-600); text-align: center;">
                    <p style="font-size: var(--font-size-body-lg); margin-bottom: var(--space-3);">Your Content Here</p>
                    <p style="font-size: var(--font-size-small);">[Insert your diagram or image]</p>
                </div>
            </div>
        </div>
    </div>
</div>

2. WITH IMAGE:
Replace the content div with:
<div style="position: relative; z-index: 2; width: 100%; height: 100%;">
    <img src="your-diagram.png" alt="Diagram" style="width: 100%; height: 100%; object-fit: contain;" />
</div>

3. WITH CUSTOM CONTENT:
Replace the content div with your own HTML, charts, or embedded content

4. VARIATIONS:
- Remove alepo-sticky-container class for non-sticky behavior
- Change min-height for different container sizes
- Remove alepo-particle-container for static background
- Add custom CSS classes for specific styling

5. GRID LAYOUT EXAMPLE:
<div class="alepo-grid-2">
    <div class="alepo-flex-column">
        <!-- Feature cards here -->
    </div>
    <div class="alepo-sticky-container">
        <!-- Diagram container here -->
    </div>
</div>
-->