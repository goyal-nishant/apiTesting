<?php
/*
Template Name: Custom Category Posts Template
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        $category_id = get_queried_object_id(); 

        $args = array(
            'cat' => $category_id,
            'posts_per_page' => -1, 
        );
        
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>

        <?php
            endwhile;
        else :
            echo 'No posts found';
        endif;
        wp_reset_postdata();
        ?>

    </main>
</div>

<?php
get_footer();
?>
