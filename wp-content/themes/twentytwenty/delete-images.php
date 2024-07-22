<?php
function delete_book_attachments() {
    // Arguments for fetching posts of custom post type 'books'
    $args = array(
        'post_type'      => 'book',
        'posts_per_page' => -1,
        'post_status'    => 'any',
    );

    $book_posts = new WP_Query($args);

    if ($book_posts->have_posts()) {
        while ($book_posts->have_posts()) {
            $book_posts->the_post();
            $post_id = get_the_ID();

            $attachments = get_attached_media('', $post_id);

            foreach ($attachments as $attachment) {
                wp_delete_attachment($attachment->ID, true);
            }

            if ( has_post_thumbnail($post_id) ) {
                $featured_image_id = get_post_thumbnail_id($post_id);

                delete_post_thumbnail($post_id);
            }
        }
    }

    wp_reset_postdata();
}


function remove_images_from_custom_posts() {
    $args = array(
        'post_type' => 'book',
        'posts_per_page' => -1, 
    );

    $books_query = new WP_Query($args);

    if ($books_query->have_posts()) {
        while ($books_query->have_posts()) {
            $books_query->the_post();

            $post_id = get_the_ID();

            $post_content = get_post_field('post_content', $post_id);

            $updated_content = remove_images_from_content($post_content);

            wp_update_post(array(
                'ID'           => $post_id,
                'post_content' => $updated_content,
            ));
        }
    }

    wp_reset_postdata();
}

function remove_images_from_content($content) {
    $updated_content = preg_replace('/<img[^>]+>/', '', $content);
    return $updated_content;
}

?>

