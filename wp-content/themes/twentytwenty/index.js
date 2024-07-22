// fetch("/wp-json/wp/v2/posts",{
//     method: "POST",
//     headers: {
//         "content-type": "application/json",
//         "X-WP-Nonce": myData.nonce  
//     },
//     body: JSON.stringify({
//         title: "BLog Post",
//         content: "This is content of the post",
//         status: "pubish"
//     })   
// })


(function($) {

    // we create a copy of the WP inline edit post function
    var $wp_inline_edit = inlineEditPost.edit;

    // and then we overwrite the function with our own code
    inlineEditPost.edit = function( id ) {

        // "call" the original WP edit function
        // we don't want to leave WordPress hanging
        $wp_inline_edit.apply( this, arguments );

        // now we take care of our business

        // get the post ID
        var $post_id = 0;
        if ( typeof( id ) == 'object' ) {
            $post_id = parseInt( this.getId( id ) );
        }

        if ( $post_id > 0 ) {
            // define the edit row
            var $edit_row = $( '#edit-' + $post_id );
            var $post_row = $( '#post-' + $post_id );

            // get the data
            var membershipType = $( '.column-membership_type', $post_row ).text().trim();

            // populate the data
            $( ':input[name="membership_type"]', $edit_row ).val( membershipType );
        }
    };

})(jQuery);
