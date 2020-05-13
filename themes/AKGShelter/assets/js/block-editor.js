console.log('AKGShelter js Ready!');

wp.domReady( function() {
    // only needs to be here to unregister blocks
    
    // wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );

    wp.blocks.registerBlockStyle( 'core/heading', {
        name: 'underline',
        label: 'Underline',
    } );
} );