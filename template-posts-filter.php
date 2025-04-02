<?php
/**
 * Template Name: Template Page Posts
 */
get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-title"><?php the_title(); ?></h1>
            
            <!-- Фильтр по тегам -->
            <div class="tags-filter">
                <?php
                $tags = get_tags(array('orderby' => 'count', 'order' => 'DESC'));
                if ($tags) :
                ?>
                <ul class="nav nav-pills">
                    <li class="active"><a href="#" data-tag="all">Все</a></li>
                    <?php
                    foreach ($tags as $tag) {
                        echo '<li><a href="#" data-tag="' . $tag->slug . '">' . $tag->name . '</a></li>';
                    }
                    ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Контейнер для постов -->
    <div class="row posts-container">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'post_status' => 'publish'
        );
        
        $query = new WP_Query($args);
        
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $post_tags = get_the_tags();
                $tag_classes = '';
                if ($post_tags) {
                    foreach ($post_tags as $tag) {
                        $tag_classes .= ' tag-' . $tag->slug;
                    }
                }
        ?>
            <div class="col-md-4 col-sm-6 post-item<?php echo $tag_classes; ?>">
                <div class="post-box">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium', array('class' => 'img-responsive')); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    
                    <div class="post-meta">
                        <span class="date"><?php echo get_the_date(); ?></span>
                        <?php if ($post_tags) : ?>
                        <span class="tags">
                            <?php the_tags('<i class="glyphicon glyphicon-tag"></i> ', ', '); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Читать далее</a>
                </div>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    
    <div class="row">
        <div class="col-xs-12 text-center">
            <button id="load-more" class="btn btn-lg btn-success" data-page="1" data-max="<?php echo $query->max_num_pages; ?>">Загрузить еще</button>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Фильтрация постов по тегам
    $('.tags-filter a').click(function(e) {
        e.preventDefault();
        var tag = $(this).data('tag');
        
        // Визуальное выделение активного тега
        $('.tags-filter li').removeClass('active');
        $(this).parent().addClass('active');
        
        if (tag === 'all') {
            $('.post-item').show();
        } else {
            $('.post-item').hide();
            $('.post-item.tag-' + tag).show();
        }
        
        // Сбросить счетчик загрузки до 1
        $('#load-more').data('page', 1);
    });
    
    // Загрузка дополнительных постов
    $('#load-more').click(function() {
        var button = $(this),
            currentPage = button.data('page'),
            maxPages = button.data('max'),
            activeTag = $('.tags-filter li.active a').data('tag');
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'load_more_posts',
                page: currentPage + 1,
                tag: activeTag !== 'all' ? activeTag : ''
            },
            success: function(response) {
                if (response) {
                    $('.posts-container').append(response);
                    button.data('page', currentPage + 1);
                    
                    // Скрыть кнопку, если это последняя страница
                    if (currentPage + 1 >= maxPages) {
                        button.hide();
                    }
                    
                    // Применить активный фильтр к новым постам
                    if (activeTag !== 'all') {
                        $('.post-item').not('.tag-' + activeTag).hide();
                    }
                } else {
                    button.hide();
                }
            }
        });
    });
});
</script>

<?php get_footer(); ?>