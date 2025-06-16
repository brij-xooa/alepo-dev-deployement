/**
 * Drag & Drop Enhancements for Gutenberg Editor
 */

(function(wp) {
    const { domReady } = wp;
    const { subscribe, select } = wp.data;

    domReady(function() {
        // Add custom drag handles and visual indicators
        addDragDropEnhancements();
        
        // Subscribe to block editor changes
        subscribe(function() {
            addDragDropEnhancements();
        });
    });

    function addDragDropEnhancements() {
        // Add visual indicators for draggable elements
        const floatingElements = document.querySelectorAll('.alepo-floating-badge, .alepo-floating-info, .alepo-overlay-badge');
        
        floatingElements.forEach(function(element) {
            if (!element.classList.contains('drag-enhanced')) {
                element.classList.add('drag-enhanced');
                addDragIndicator(element);
            }
        });

        // Enhance block inserter with preview animations
        enhanceBlockInserter();
        
        // Add keyboard navigation support
        addKeyboardNavigation();
    }

    function addDragIndicator(element) {
        // Add a subtle drag handle indicator
        const indicator = document.createElement('div');
        indicator.className = 'alepo-drag-indicator';
        indicator.innerHTML = '⋮⋮';
        indicator.style.cssText = `
            position: absolute;
            top: -10px;
            right: -10px;
            background: #0056b3;
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: grab;
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 100;
        `;

        element.style.position = 'relative';
        element.appendChild(indicator);

        // Show indicator on hover
        element.addEventListener('mouseenter', function() {
            indicator.style.opacity = '1';
        });

        element.addEventListener('mouseleave', function() {
            indicator.style.opacity = '0';
        });

        // Handle dragging
        indicator.addEventListener('mousedown', function(e) {
            e.preventDefault();
            handleDragStart(element, e);
        });
    }

    function handleDragStart(element, e) {
        const startX = e.clientX;
        const startY = e.clientY;
        const rect = element.getBoundingClientRect();
        const container = element.closest('.wp-block') || element.parentElement;
        const containerRect = container.getBoundingClientRect();

        element.style.cursor = 'grabbing';
        element.style.zIndex = '1000';
        element.style.opacity = '0.8';

        function handleDragMove(e) {
            const deltaX = e.clientX - startX;
            const deltaY = e.clientY - startY;
            
            // Calculate new position as percentage
            const newLeft = ((rect.left + deltaX - containerRect.left) / containerRect.width) * 100;
            const newTop = ((rect.top + deltaY - containerRect.top) / containerRect.height) * 100;
            
            // Constrain to container bounds
            const constrainedLeft = Math.max(0, Math.min(100, newLeft));
            const constrainedTop = Math.max(0, Math.min(100, newTop));
            
            element.style.left = constrainedLeft + '%';
            element.style.top = constrainedTop + '%';
            element.style.transform = 'translate(-50%, -50%)';

            // Update block attributes if it's a Gutenberg block
            updateBlockAttributes(element, {
                position: { x: constrainedLeft, y: constrainedTop }
            });
        }

        function handleDragEnd() {
            element.style.cursor = 'grab';
            element.style.zIndex = '';
            element.style.opacity = '';
            
            document.removeEventListener('mousemove', handleDragMove);
            document.removeEventListener('mouseup', handleDragEnd);
        }

        document.addEventListener('mousemove', handleDragMove);
        document.addEventListener('mouseup', handleDragEnd);
    }

    function updateBlockAttributes(element, attributes) {
        // Find the parent Gutenberg block
        const blockWrapper = element.closest('[data-block]');
        if (!blockWrapper) return;

        const blockId = blockWrapper.getAttribute('data-block');
        if (!blockId) return;

        // Update block attributes using WordPress data store
        const { updateBlockAttributes } = wp.data.dispatch('core/block-editor');
        if (updateBlockAttributes) {
            updateBlockAttributes(blockId, attributes);
        }
    }

    function enhanceBlockInserter() {
        const inserterItems = document.querySelectorAll('.block-editor-block-types-list__item');
        
        inserterItems.forEach(function(item) {
            const blockName = item.getAttribute('data-id');
            
            if (blockName && blockName.startsWith('alepo/')) {
                if (!item.classList.contains('alepo-enhanced')) {
                    item.classList.add('alepo-enhanced');
                    
                    // Add preview animation on hover
                    item.addEventListener('mouseenter', function() {
                        const icon = item.querySelector('.block-editor-block-types-list__item-icon');
                        if (icon) {
                            icon.style.transform = 'scale(1.1)';
                            icon.style.transition = 'transform 0.2s ease';
                        }
                    });

                    item.addEventListener('mouseleave', function() {
                        const icon = item.querySelector('.block-editor-block-types-list__item-icon');
                        if (icon) {
                            icon.style.transform = 'scale(1)';
                        }
                    });
                }
            }
        });
    }

    function addKeyboardNavigation() {
        // Add keyboard support for moving floating elements
        document.addEventListener('keydown', function(e) {
            const activeElement = document.activeElement;
            
            if (activeElement && activeElement.classList.contains('alepo-floating-info')) {
                const step = e.shiftKey ? 10 : 1; // Larger steps with Shift
                let moved = false;
                
                switch(e.key) {
                    case 'ArrowLeft':
                        moveElement(activeElement, -step, 0);
                        moved = true;
                        break;
                    case 'ArrowRight':
                        moveElement(activeElement, step, 0);
                        moved = true;
                        break;
                    case 'ArrowUp':
                        moveElement(activeElement, 0, -step);
                        moved = true;
                        break;
                    case 'ArrowDown':
                        moveElement(activeElement, 0, step);
                        moved = true;
                        break;
                }
                
                if (moved) {
                    e.preventDefault();
                }
            }
        });
    }

    function moveElement(element, deltaX, deltaY) {
        const currentLeft = parseFloat(element.style.left) || 50;
        const currentTop = parseFloat(element.style.top) || 50;
        
        const newLeft = Math.max(0, Math.min(100, currentLeft + deltaX));
        const newTop = Math.max(0, Math.min(100, currentTop + deltaY));
        
        element.style.left = newLeft + '%';
        element.style.top = newTop + '%';
        
        // Update block attributes
        updateBlockAttributes(element, {
            position: { x: newLeft, y: newTop }
        });
    }

    // Add CSS for drag enhancements
    const dragStyles = document.createElement('style');
    dragStyles.textContent = `
        .alepo-drag-indicator {
            user-select: none;
        }
        
        .drag-enhanced:hover {
            box-shadow: 0 0 10px rgba(0, 86, 179, 0.3);
        }
        
        .block-editor-block-types-list__item.alepo-enhanced {
            transition: all 0.2s ease;
        }
        
        .block-editor-block-types-list__item.alepo-enhanced:hover {
            background-color: rgba(0, 86, 179, 0.05);
        }
        
        .alepo-floating-info:focus {
            outline: 2px solid #0056b3;
            outline-offset: 2px;
        }
    `;
    document.head.appendChild(dragStyles);

})(window.wp);