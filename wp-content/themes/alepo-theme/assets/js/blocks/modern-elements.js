/**
 * Modern Elements Gutenberg Blocks
 */

(function(wp) {
    const { registerBlockType } = wp.blocks;
    const { __ } = wp.i18n;
    const { 
        InspectorControls,
        ColorPalette,
        MediaUpload,
        MediaUploadCheck,
        BlockControls
    } = wp.blockEditor;
    const {
        PanelBody,
        PanelRow,
        TextControl,
        SelectControl,
        RangeControl,
        ToggleControl,
        ToolbarGroup,
        ToolbarButton,
        Button,
        IconButton
    } = wp.components;
    const { Fragment, useState } = wp.element;

    // 1. Floating Badge Block
    registerBlockType('alepo/floating-badge', {
        title: __('Floating Badge', 'alepo'),
        icon: 'tag',
        category: 'alepo-modern-elements',
        description: __('Add a floating badge overlay like "G6" or "NEW"', 'alepo'),
        example: {
            attributes: {
                badgeText: 'G6',
                badgeColor: '#17a2b8',
                rotation: -45
            }
        },
        attributes: {
            badgeText: {
                type: 'string',
                default: 'NEW'
            },
            badgePosition: {
                type: 'string',
                default: 'top-left'
            },
            badgeStyle: {
                type: 'string',
                default: 'angled'
            },
            badgeColor: {
                type: 'string',
                default: '#17a2b8'
            },
            textColor: {
                type: 'string',
                default: '#ffffff'
            },
            fontSize: {
                type: 'number',
                default: 24
            },
            rotation: {
                type: 'number',
                default: -45
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const {
                badgeText,
                badgePosition,
                badgeStyle,
                badgeColor,
                textColor,
                fontSize,
                rotation
            } = attributes;

            const badgeStyles = {
                backgroundColor: badgeColor,
                color: textColor,
                fontSize: fontSize + 'px',
                transform: `rotate(${rotation}deg)`,
                position: 'absolute',
                padding: '10px 20px',
                fontWeight: 'bold'
            };

            const positionStyles = {
                'top-left': { top: '20px', left: '20px' },
                'top-right': { top: '20px', right: '20px' },
                'bottom-left': { bottom: '20px', left: '20px' },
                'bottom-right': { bottom: '20px', right: '20px' }
            };

            Object.assign(badgeStyles, positionStyles[badgePosition]);

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Badge Settings', 'alepo')}>
                            <TextControl
                                label={__('Badge Text', 'alepo')}
                                value={badgeText}
                                onChange={(value) => setAttributes({ badgeText: value })}
                            />
                            <SelectControl
                                label={__('Position', 'alepo')}
                                value={badgePosition}
                                options={[
                                    { value: 'top-left', label: __('Top Left', 'alepo') },
                                    { value: 'top-right', label: __('Top Right', 'alepo') },
                                    { value: 'bottom-left', label: __('Bottom Left', 'alepo') },
                                    { value: 'bottom-right', label: __('Bottom Right', 'alepo') }
                                ]}
                                onChange={(value) => setAttributes({ badgePosition: value })}
                            />
                            <SelectControl
                                label={__('Style', 'alepo')}
                                value={badgeStyle}
                                options={[
                                    { value: 'angled', label: __('Angled', 'alepo') },
                                    { value: 'rounded', label: __('Rounded', 'alepo') },
                                    { value: 'square', label: __('Square', 'alepo') }
                                ]}
                                onChange={(value) => setAttributes({ badgeStyle: value })}
                            />
                            <RangeControl
                                label={__('Font Size', 'alepo')}
                                value={fontSize}
                                onChange={(value) => setAttributes({ fontSize: value })}
                                min={12}
                                max={48}
                            />
                            <RangeControl
                                label={__('Rotation', 'alepo')}
                                value={rotation}
                                onChange={(value) => setAttributes({ rotation: value })}
                                min={-180}
                                max={180}
                            />
                        </PanelBody>
                        <PanelBody title={__('Colors', 'alepo')} initialOpen={false}>
                            <p>{__('Background Color', 'alepo')}</p>
                            <ColorPalette
                                value={badgeColor}
                                onChange={(value) => setAttributes({ badgeColor: value })}
                            />
                            <p>{__('Text Color', 'alepo')}</p>
                            <ColorPalette
                                value={textColor}
                                onChange={(value) => setAttributes({ textColor: value })}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <div className="alepo-floating-badge-wrapper" style={{ position: 'relative', height: '200px', border: '2px dashed #ccc' }}>
                        <div className={`alepo-floating-badge style-${badgeStyle}`} style={badgeStyles}>
                            {badgeText}
                        </div>
                        <p style={{ textAlign: 'center', marginTop: '80px', color: '#666' }}>
                            {__('Badge Preview Area', 'alepo')}
                        </p>
                    </div>
                </Fragment>
            );
        },
        save: function() {
            return null; // Rendered by PHP
        }
    });

    // 2. Image with Overlay Block
    registerBlockType('alepo/image-overlay', {
        title: __('Image with Overlay', 'alepo'),
        icon: 'format-image',
        category: 'alepo-modern-elements',
        description: __('Add an image with customizable overlay elements', 'alepo'),
        attributes: {
            imageUrl: {
                type: 'string',
                default: ''
            },
            imageId: {
                type: 'number',
                default: 0
            },
            overlayType: {
                type: 'string',
                default: 'badge'
            },
            overlayText: {
                type: 'string',
                default: 'Featured'
            },
            overlayPosition: {
                type: 'string',
                default: 'top-left'
            },
            overlayStyle: {
                type: 'object',
                default: {
                    backgroundColor: '#0056b3',
                    textColor: '#ffffff',
                    padding: '10px 20px',
                    borderRadius: '4px'
                }
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const {
                imageUrl,
                imageId,
                overlayType,
                overlayText,
                overlayPosition,
                overlayStyle
            } = attributes;

            const onSelectImage = (media) => {
                setAttributes({
                    imageUrl: media.url,
                    imageId: media.id
                });
            };

            const overlayPositionStyles = {
                'top-left': { top: '20px', left: '20px' },
                'top-right': { top: '20px', right: '20px' },
                'bottom-left': { bottom: '20px', left: '20px' },
                'bottom-right': { bottom: '20px', right: '20px' },
                'center': { top: '50%', left: '50%', transform: 'translate(-50%, -50%)' }
            };

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Overlay Settings', 'alepo')}>
                            <TextControl
                                label={__('Overlay Text', 'alepo')}
                                value={overlayText}
                                onChange={(value) => setAttributes({ overlayText: value })}
                            />
                            <SelectControl
                                label={__('Overlay Position', 'alepo')}
                                value={overlayPosition}
                                options={[
                                    { value: 'top-left', label: __('Top Left', 'alepo') },
                                    { value: 'top-right', label: __('Top Right', 'alepo') },
                                    { value: 'bottom-left', label: __('Bottom Left', 'alepo') },
                                    { value: 'bottom-right', label: __('Bottom Right', 'alepo') },
                                    { value: 'center', label: __('Center', 'alepo') }
                                ]}
                                onChange={(value) => setAttributes({ overlayPosition: value })}
                            />
                        </PanelBody>
                        <PanelBody title={__('Overlay Style', 'alepo')} initialOpen={false}>
                            <p>{__('Background Color', 'alepo')}</p>
                            <ColorPalette
                                value={overlayStyle.backgroundColor}
                                onChange={(value) => setAttributes({ 
                                    overlayStyle: { ...overlayStyle, backgroundColor: value }
                                })}
                            />
                            <p>{__('Text Color', 'alepo')}</p>
                            <ColorPalette
                                value={overlayStyle.textColor}
                                onChange={(value) => setAttributes({ 
                                    overlayStyle: { ...overlayStyle, textColor: value }
                                })}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <div className="alepo-image-overlay-container" style={{ position: 'relative', display: 'inline-block' }}>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={onSelectImage}
                                allowedTypes={['image']}
                                value={imageId}
                                render={({ open }) => (
                                    <div>
                                        {imageUrl ? (
                                            <div style={{ position: 'relative' }}>
                                                <img src={imageUrl} alt="" style={{ maxWidth: '100%', height: 'auto' }} />
                                                <div 
                                                    className="alepo-overlay-badge"
                                                    style={{
                                                        position: 'absolute',
                                                        ...overlayPositionStyles[overlayPosition],
                                                        backgroundColor: overlayStyle.backgroundColor,
                                                        color: overlayStyle.textColor,
                                                        padding: overlayStyle.padding,
                                                        borderRadius: overlayStyle.borderRadius,
                                                        fontWeight: 'bold',
                                                        fontSize: '14px'
                                                    }}
                                                >
                                                    {overlayText}
                                                </div>
                                                <Button 
                                                    onClick={open} 
                                                    variant="secondary"
                                                    style={{ marginTop: '10px' }}
                                                >
                                                    {__('Change Image', 'alepo')}
                                                </Button>
                                            </div>
                                        ) : (
                                            <Button onClick={open} variant="primary">
                                                {__('Select Image', 'alepo')}
                                            </Button>
                                        )}
                                    </div>
                                )}
                            />
                        </MediaUploadCheck>
                    </div>
                </Fragment>
            );
        },
        save: function() {
            return null; // Rendered by PHP
        }
    });

    // 3. Floating Info Card Block
    registerBlockType('alepo/floating-info', {
        title: __('Floating Info Card', 'alepo'),
        icon: 'info',
        category: 'alepo-modern-elements',
        description: __('Add a floating information card with customizable position', 'alepo'),
        attributes: {
            title: {
                type: 'string',
                default: 'Info Title'
            },
            content: {
                type: 'string',
                default: 'Info content goes here'
            },
            position: {
                type: 'object',
                default: {
                    x: 50,
                    y: 50
                }
            },
            cardStyle: {
                type: 'object',
                default: {
                    backgroundColor: '#ffffff',
                    borderColor: '#dee2e6',
                    shadow: true,
                    arrow: true
                }
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { title, content, position, cardStyle } = attributes;
            const [isDragging, setIsDragging] = useState(false);

            const handleMouseDown = (e) => {
                setIsDragging(true);
                const startX = e.clientX;
                const startY = e.clientY;
                const startPosX = position.x;
                const startPosY = position.y;
                const container = e.currentTarget.parentElement;
                const containerRect = container.getBoundingClientRect();

                const handleMouseMove = (e) => {
                    const deltaX = e.clientX - startX;
                    const deltaY = e.clientY - startY;
                    const newX = Math.max(0, Math.min(100, startPosX + (deltaX / containerRect.width) * 100));
                    const newY = Math.max(0, Math.min(100, startPosY + (deltaY / containerRect.height) * 100));
                    
                    setAttributes({
                        position: { x: newX, y: newY }
                    });
                };

                const handleMouseUp = () => {
                    setIsDragging(false);
                    document.removeEventListener('mousemove', handleMouseMove);
                    document.removeEventListener('mouseup', handleMouseUp);
                };

                document.addEventListener('mousemove', handleMouseMove);
                document.addEventListener('mouseup', handleMouseUp);
            };

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Card Content', 'alepo')}>
                            <TextControl
                                label={__('Title', 'alepo')}
                                value={title}
                                onChange={(value) => setAttributes({ title: value })}
                            />
                            <TextControl
                                label={__('Content', 'alepo')}
                                value={content}
                                onChange={(value) => setAttributes({ content: value })}
                                help={__('Drag the card in the preview to reposition', 'alepo')}
                            />
                        </PanelBody>
                        <PanelBody title={__('Card Style', 'alepo')} initialOpen={false}>
                            <ToggleControl
                                label={__('Show Shadow', 'alepo')}
                                checked={cardStyle.shadow}
                                onChange={(value) => setAttributes({
                                    cardStyle: { ...cardStyle, shadow: value }
                                })}
                            />
                            <ToggleControl
                                label={__('Show Arrow', 'alepo')}
                                checked={cardStyle.arrow}
                                onChange={(value) => setAttributes({
                                    cardStyle: { ...cardStyle, arrow: value }
                                })}
                            />
                            <p>{__('Background Color', 'alepo')}</p>
                            <ColorPalette
                                value={cardStyle.backgroundColor}
                                onChange={(value) => setAttributes({
                                    cardStyle: { ...cardStyle, backgroundColor: value }
                                })}
                            />
                        </PanelBody>
                    </InspectorControls>
                    <div 
                        className="alepo-floating-info-container" 
                        style={{ 
                            position: 'relative', 
                            height: '400px', 
                            border: '2px dashed #ccc',
                            backgroundColor: '#f5f5f5'
                        }}
                    >
                        <div
                            className={`alepo-floating-info ${cardStyle.shadow ? 'has-shadow' : ''} ${cardStyle.arrow ? 'has-arrow' : ''}`}
                            style={{
                                position: 'absolute',
                                left: position.x + '%',
                                top: position.y + '%',
                                transform: 'translate(-50%, -50%)',
                                backgroundColor: cardStyle.backgroundColor,
                                border: `1px solid ${cardStyle.borderColor}`,
                                padding: '15px',
                                borderRadius: '4px',
                                cursor: isDragging ? 'grabbing' : 'grab',
                                boxShadow: cardStyle.shadow ? '0 2px 8px rgba(0,0,0,0.1)' : 'none',
                                minWidth: '200px'
                            }}
                            onMouseDown={handleMouseDown}
                        >
                            <h4 style={{ margin: '0 0 8px 0', fontSize: '16px' }}>{title}</h4>
                            <p style={{ margin: 0, fontSize: '14px' }}>{content}</p>
                        </div>
                    </div>
                </Fragment>
            );
        },
        save: function() {
            return null; // Rendered by PHP
        }
    });

    // 4. Modern CTA Block
    registerBlockType('alepo/modern-cta', {
        title: __('Modern CTA Button', 'alepo'),
        icon: 'button',
        category: 'alepo-modern-elements',
        description: __('Add a modern call-to-action button with effects', 'alepo'),
        attributes: {
            text: {
                type: 'string',
                default: 'Get Started'
            },
            url: {
                type: 'string',
                default: '#'
            },
            style: {
                type: 'string',
                default: 'gradient-shift'
            },
            icon: {
                type: 'string',
                default: 'arrow-right'
            },
            iconPosition: {
                type: 'string',
                default: 'after'
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { text, url, style, icon, iconPosition } = attributes;

            return (
                <Fragment>
                    <InspectorControls>
                        <PanelBody title={__('Button Settings', 'alepo')}>
                            <TextControl
                                label={__('Button Text', 'alepo')}
                                value={text}
                                onChange={(value) => setAttributes({ text: value })}
                            />
                            <TextControl
                                label={__('URL', 'alepo')}
                                value={url}
                                onChange={(value) => setAttributes({ url: value })}
                            />
                            <SelectControl
                                label={__('Button Style', 'alepo')}
                                value={style}
                                options={[
                                    { value: 'gradient-shift', label: __('Gradient Shift', 'alepo') },
                                    { value: 'glow', label: __('Glow Effect', 'alepo') },
                                    { value: 'slide', label: __('Slide Effect', 'alepo') },
                                    { value: 'pulse', label: __('Pulse Effect', 'alepo') }
                                ]}
                                onChange={(value) => setAttributes({ style: value })}
                            />
                            <SelectControl
                                label={__('Icon', 'alepo')}
                                value={icon}
                                options={[
                                    { value: '', label: __('No Icon', 'alepo') },
                                    { value: 'arrow-right', label: __('Arrow Right', 'alepo') },
                                    { value: 'arrow-right-alt', label: __('Arrow Right Alt', 'alepo') },
                                    { value: 'external', label: __('External Link', 'alepo') },
                                    { value: 'download', label: __('Download', 'alepo') }
                                ]}
                                onChange={(value) => setAttributes({ icon: value })}
                            />
                            {icon && (
                                <SelectControl
                                    label={__('Icon Position', 'alepo')}
                                    value={iconPosition}
                                    options={[
                                        { value: 'before', label: __('Before Text', 'alepo') },
                                        { value: 'after', label: __('After Text', 'alepo') }
                                    ]}
                                    onChange={(value) => setAttributes({ iconPosition: value })}
                                />
                            )}
                        </PanelBody>
                    </InspectorControls>
                    <div className="alepo-modern-cta-wrapper">
                        <a 
                            href={url} 
                            className={`alepo-modern-cta style-${style} icon-${iconPosition}`}
                            onClick={(e) => e.preventDefault()}
                        >
                            {iconPosition === 'before' && icon && (
                                <span className={`dashicons dashicons-${icon}`} style={{ marginRight: '8px' }}></span>
                            )}
                            {text}
                            {iconPosition === 'after' && icon && (
                                <span className={`dashicons dashicons-${icon}`} style={{ marginLeft: '8px' }}></span>
                            )}
                        </a>
                    </div>
                </Fragment>
            );
        },
        save: function() {
            return null; // Rendered by PHP
        }
    });

})(window.wp);