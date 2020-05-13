console.log('AKGShelter js Ready!');

wp.domReady( function() {
    // only needs to be here to unregister blocks
    
    wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
    
} );