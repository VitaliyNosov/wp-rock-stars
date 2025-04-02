<?php
/**
 * Template for displaying single posts
 */
get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                <header class="post-header">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    
                    <div class="post-meta">
                        <span class="post-date">
                            <i class="glyphicon glyphicon-calendar"></i> <?php echo get_the_date(); ?>
                        </span>
                        
                        <?php if (has_category()) : ?>
                        <span class="post-categories">
                            <i class="glyphicon glyphicon-folder-open"></i> <?php the_category(', '); ?>
                        </span>
                        <?php endif; ?>
                        
                        <?php if (has_tag()) : ?>
                        <span class="post-tags">
                            <i class="glyphicon glyphicon-tag"></i> <?php the_tags('', ', '); ?>
                        </span>
                        <?php endif; ?>
                        
                        <!-- Система лайков -->
                        <span class="post-likes">
                            <?php echo get_post_likes(get_the_ID()); ?>
                        </span>
                    </div>
                </header>
                
                <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                </div>
                <?php endif; ?>
                
                <div class="post-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(array(
                        'before' => '<div class="page-links"><span class="page-links-title">Страницы:</span>',
                        'after' => '</div>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ));
                    ?>
                </div>
                
                <footer class="post-footer">
                    <!-- Социальные кнопки с добавлением LinkedIn и X (Twitter) -->
                    <div class="social-sharing">
                        <span>Поделиться:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="btn btn-sm btn-facebook" title="Поделиться в Facebook">
                            <i class="glyphicon glyphicon-thumbs-up"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="btn btn-sm btn-twitter" title="Поделиться в X/Twitter">
                            <i class="glyphicon glyphicon-retweet"></i> X
                        </a>
                        <a href="https://t.me/share/url?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="btn btn-sm btn-telegram" title="Поделиться в Telegram">
                            <i class="glyphicon glyphicon-send"></i> Telegram
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" class="btn btn-sm btn-linkedin" title="Поделиться в LinkedIn">
                            <i class="glyphicon glyphicon-briefcase"></i> LinkedIn
                        </a>
                    </div>
                    
                    <!-- Навигация по постам -->
                    <nav class="post-navigation">
                        <div class="nav-links">
                            <div class="nav-previous">
                                <?php previous_post_link('%link', '<i class="glyphicon glyphicon-chevron-left"></i> %title'); ?>
                            </div>
                            <div class="nav-next">
                                <?php next_post_link('%link', '%title <i class="glyphicon glyphicon-chevron-right"></i>'); ?>
                            </div>
                        </div>
                    </nav>
                </footer>
            </article>
            
            <?php
                // Если комментарии открыты или есть хотя бы один комментарий, загружаем шаблон комментариев
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
            ?>
            
            <?php endwhile; endif; ?>
        </div>
    </div>
    
    <!-- Похожие посты -->
    <div class="row">
        <div class="col-xs-12">
            <div class="related-posts">
                <h3>Похожие статьи</h3>
                
                <?php
                // Получаем ID текущих категорий
                $categories = get_the_category();
                $category_ids = array();
                
                foreach ($categories as $category) {
                    $category_ids[] = $category->term_id;
                }
                
                // Аргументы для запроса похожих постов
                $related_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'cat' => $category_ids,
                    'orderby' => 'rand'
                );
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) : ?>
                <div class="row">
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="related-post">
                            <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', array('class' => 'img-responsive')); ?>
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            
                            <div class="post-meta">
                                <span class="date"><?php echo get_the_date(); ?></span>
                                <!-- Мини-система лайков для похожих постов -->
                                <span class="post-likes-count">
                                    <i class="glyphicon glyphicon-heart"></i> <?php echo get_post_like_count(get_the_ID()); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>