<?php
/**
 * Enhanced Capabilities Section with Alepo Components
 * 
 * This replaces the basic capabilities section with advanced hover effects,
 * parallax scrolling, and sophisticated animations.
 */

// Check if we should use enhanced components
$use_enhanced = alepo_get_field('use_enhanced_components', null, false);
?>

<!-- Enhanced Capabilities Section with Alepo Components -->
<section class="capabilities-section alepo-bg-gray-50 alepo-py-11">
    <div class="alepo-container">
        
        <!-- Section Title -->
        <h2 class="alepo-text-center alepo-mb-9 alepo-title-underline alepo-fade-in-up">
            <span class="alepo-title-gradient">
                <?php echo alepo_get_field('capability_group_title', null, 'Solution'); ?>
            </span> Framework
        </h2>
        
        <!-- Enhanced Grid Layout -->
        <div class="alepo-grid-2">
            
            <!-- Left: Feature Cards with Advanced Effects -->
            <div class="alepo-flex-column">
                <?php 
                $capabilities = alepo_get_field('key_capabilities');
                if ($capabilities) {
                    foreach ($capabilities as $index => $capability) :
                        // Map capability names to icons
                        $icon_map = [
                            'zero-downtime' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />',
                            'performance' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />',
                            'migration' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />',
                            'security' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
                            'authentication' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />',
                            'scalable' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />',
                            'cloud' => '<path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"/>',
                            'default' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>'
                        ];
                        
                        // Determine icon based on capability name
                        $name_lower = strtolower(str_replace([' ', '-'], '', $capability['name']));
                        $icon = $icon_map['default']; // Default icon
                        
                        foreach ($icon_map as $key => $svg) {
                            if (strpos($name_lower, $key) !== false) {
                                $icon = $svg;
                                break;
                            }
                        }
                ?>
                
                <div class="alepo-feature-card">
                    <!-- Aim dot animation -->
                    <div class="alepo-aim-dot"></div>
                    
                    <!-- Mouse follow gradient -->
                    <div class="alepo-mouse-gradient"></div>
                    
                    <!-- Icon wrapper -->
                    <div class="alepo-icon-wrapper">
                        <svg class="alepo-icon" viewBox="0 0 24 24">
                            <?php echo $icon; ?>
                        </svg>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="alepo-feature-title"><?php echo esc_html($capability['name']); ?></h3>
                    <p class="alepo-feature-description">
                        <?php 
                        // Use description if available, otherwise combine features
                        if (isset($capability['description'])) {
                            echo esc_html($capability['description']);
                        } elseif (isset($capability['features']) && is_array($capability['features'])) {
                            echo esc_html(implode('. ', array_slice($capability['features'], 0, 2)) . '.');
                        } else {
                            echo esc_html($capability['benefit']);
                        }
                        ?>
                    </p>
                </div>
                
                <?php 
                    endforeach;
                } else {
                    // Default capabilities from metadata or fallback
                    $default_capabilities = [
                        [
                            'name' => alepo_get_field('capability_1_title', null, 'Zero-Downtime Migration'),
                            'description' => alepo_get_field('capability_1_desc', null, 'Seamlessly transition from legacy systems to modern architecture with parallel deployment strategy.'),
                            'icon' => '<path d="M12 2L2 7L12 12L22 7L12 2Z" /><path d="M2 17L12 22L22 17" /><path d="M2 12L12 17L22 12" />'
                        ],
                        [
                            'name' => alepo_get_field('capability_2_title', null, 'Performance Amplification'),
                            'description' => alepo_get_field('capability_2_desc', null, '10x performance improvement with cloud-native architecture and elastic scaling.'),
                            'icon' => '<path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" />'
                        ],
                        [
                            'name' => alepo_get_field('capability_3_title', null, 'Security Enhancement'),
                            'description' => alepo_get_field('capability_3_desc', null, 'Advanced threat detection and zero-trust principles protect against evolving cyber threats.'),
                            'icon' => '<path d="M12 2L3.5 7V11.5C3.5 16.5 6.5 21 12 22C17.5 21 20.5 16.5 20.5 11.5V7L12 2Z" /><path d="M9 12L11 14L15 10" />'
                        ]
                    ];
                    
                    foreach ($default_capabilities as $capability) :
                ?>
                
                <div class="alepo-feature-card">
                    <!-- Aim dot animation -->
                    <div class="alepo-aim-dot"></div>
                    
                    <!-- Mouse follow gradient -->
                    <div class="alepo-mouse-gradient"></div>
                    
                    <!-- Icon wrapper -->
                    <div class="alepo-icon-wrapper">
                        <svg class="alepo-icon" viewBox="0 0 24 24">
                            <?php echo $capability['icon']; ?>
                        </svg>
                    </div>
                    
                    <!-- Content -->
                    <h3 class="alepo-feature-title"><?php echo esc_html($capability['name']); ?></h3>
                    <p class="alepo-feature-description"><?php echo esc_html($capability['description']); ?></p>
                </div>
                
                <?php endforeach; } ?>
            </div>
            
            <!-- Right: Sticky Diagram Container -->
            <div class="alepo-sticky-container">
                <div class="alepo-sticky-wrapper">
                    
                    <h3 class="alepo-fade-in-up" style="font-size: var(--font-size-h3); font-weight: var(--font-weight-semibold); color: var(--c-gray-900); margin-bottom: var(--space-5);">
                        Integrated Solution Architecture
                    </h3>
                    
                    <div class="alepo-diagram-container" style="min-height: 500px;">
                        <div class="alepo-bg-gradient-light" style="height: 100%; border-radius: 12px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;">
                            
                            <!-- Floating particles -->
                            <div class="alepo-particle-container"></div>
                            
                            <!-- Diagram content -->
                            <div style="position: relative; z-index: 2; color: var(--c-gray-600); text-align: center;">
                                <?php 
                                $solution_diagram = alepo_get_field('solution_diagram');
                                if ($solution_diagram) : ?>
                                    <img src="<?php echo esc_url($solution_diagram['url']); ?>" alt="<?php echo esc_attr($solution_diagram['alt']); ?>" style="max-width: 100%; height: auto;" />
                                <?php else : ?>
                                    <p style="font-size: var(--font-size-body-lg); margin-bottom: var(--space-3); font-weight: var(--font-weight-medium);">
                                        <?php echo alepo_get_field('capability_group_title', null, 'Solution'); ?> Architecture
                                    </p>
                                    <p style="font-size: var(--font-size-small); opacity: 0.7;">
                                        [Your architecture diagram here]
                                    </p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
        
    </div>
</section>