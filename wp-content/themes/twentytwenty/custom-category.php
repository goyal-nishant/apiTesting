<?php
/*
Template Name: Custom Categories Template
*/
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        if (isset($_GET['category_id'])) {
            $category_id = intval($_GET['category_id']);
            $category = get_category($category_id);
            if ($category) {
                echo '<h1>' . $category->name . '</h1>';

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
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post -->
                    <?php
                    endwhile;
                else :
                    echo 'No posts found';
                endif;

                wp_reset_postdata();
            } else {
                echo 'Invalid category';
            }
        } else {
            // If no category is clicked, display all categories
            echo '<h1>All Categories</h1>';
            echo '<ul>';
            $categories = get_categories();
            foreach ($categories as $category) {
                echo '<li><a href="' . esc_url(add_query_arg('category_id', $category->term_id)) . '">' . $category->name . '</a></li>';
            }
            echo '</ul>';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
