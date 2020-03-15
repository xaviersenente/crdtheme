
// https://developer.wordpress.org/block-editor/packages/packages-hooks/#api-usage
wp.hooks.addFilter(
  'blocks.getSaveElement',   // The filter to hook into
  'gutenberg-block-gallery', // A unique name for our specific filter
  gutenbergBlockGallery      // A custom callback function that does the filtering
)

wp.hooks.addFilter(
  'blocks.getSaveElement',   
  'gutenberg-block-img', 
  gutenbergBlockImg    
)

function gutenbergBlockGallery( element, blockType, attributes ) {
	if ( blockType.name !== 'core/gallery' ) {
    return element;
	}

	var newElement = wp.element.createElement(
		'div',
		{
			'className': 'carousel',
		},
		attributes.images.map(
			function( image ) {
        
				return wp.element.createElement(
					'div',
					{
						'className': 'carousel__item',
					},
					wp.element.createElement(
						'img',
						{
							'src': image.url,				 // taille 1024x…
							// 'src': image.fullUrl, // taille d'image native
              'alt': image.alt,
              // 'className': 'gallery-item',
              // 'data-slide-no': index,
              // 'data-caption': image.caption[0]
						}
					)
				)
			}
		)
	)
	return newElement
}

function gutenbergBlockImg( element, blockType, attributes ) {
	if ( blockType.name !== 'core/image' ) {
    return element;
	}

	var newElement = wp.element.createElement(
		'figure',
		{
			'className': 'toto',
		},
		wp.element.createElement(
			'img',
			{
				'src': attributes.url,
			}
		),
		wp.element.createElement(
			wp.editor.RichText.Content, {
				tagName: 'figcaption', 
				value: attributes.caption
			}
		)
	)
	return newElement
}