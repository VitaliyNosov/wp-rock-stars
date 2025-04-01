<?php
/**
 * Page template (page.php)
 */

get_header(); // Include header.php
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

            <?php
            // Display comments section if comments are enabled
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
        </article>
    <?php endwhile; ?>
</main>

<?php
get_footer(); // Include footer.php
