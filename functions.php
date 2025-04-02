<?php
// Theme setup function
function theme_setup() {
    // Add support for title tag
    add_theme_support('title-tag');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Register a primary menu
    register_nav_menus([
        'primary' => __('Primary Menu', 'your-theme-textdomain'),
    ]);
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue styles and scripts
function theme_enqueue_assets() {
    // Enqueue main stylesheet
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/assets/style/style.css', [], '1.0');
    wp_enqueue_style('theme-style-dev', get_template_directory_uri() . '/common/css/theme-style.css', [], '1.0');
    // wp_enqueue_style('like-style', get_template_directory_uri() . '/common/css/post-likes.css', [], '1.0');

    // Enqueue JavaScript file
    wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/common.js', [], '1.0', true);
    // wp_enqueue_script('like-script', get_template_directory_uri() . '/assets/js/post-likes.js', [], '1.0', true);
    
    // Black Template Assets
    // Enqueue Google Fonts
    wp_enqueue_style('black-google-fonts', 'https://fonts.googleapis.com/css?family=Inconsolata:400,700', array(), null);
    
    // Enqueue CSS files
    wp_enqueue_style('black-animate', get_template_directory_uri() . '/common/css/animate.css', array(), '1.0');
    wp_enqueue_style('black-icomoon', get_template_directory_uri() . '/common/css/icomoon.css', array(), '1.0');
    wp_enqueue_style('black-simple-line-icons', get_template_directory_uri() . '/common/css/simple-line-icons.css', array(), '1.0');
    wp_enqueue_style('black-bootstrap', get_template_directory_uri() . '/common/css/bootstrap.css', array(), '1.0');
    wp_enqueue_style('black-style', get_template_directory_uri() . '/common/css/style.css', array(), '1.0');
 
    // Enqueue JavaScript files - in footer
    wp_enqueue_script('black-modernizr', get_template_directory_uri() . '/common/js/modernizr-2.6.2.min.js', array(), '2.6.2', false);
    wp_enqueue_script('black-respond', get_template_directory_uri() . '/common/js/respond.min.js', array(), '1.0', true);
    wp_enqueue_script('black-jquery', get_template_directory_uri() . '/common/js/jquery.min.js', array(), '1.0', true);
    wp_enqueue_script('black-jquery-easing', get_template_directory_uri() . '/common/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
    wp_enqueue_script('black-bootstrap-js', get_template_directory_uri() . '/common/js/bootstrap.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-waypoints', get_template_directory_uri() . '/common/js/jquery.waypoints.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-stellar', get_template_directory_uri() . '/common/js/jquery.stellar.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-countTo', get_template_directory_uri() . '/common/js/jquery.countTo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('black-main', get_template_directory_uri() . '/common/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_assets');

// Register widget areas
function theme_widgets_init() {
    register_sidebar([
        'name'          => __('Sidebar', 'your-theme-textdomain'),
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'theme_widgets_init');

// REST API settings

add_filter('rest_authentication_errors', '__return_false');

add_action('init', function() {
    header("Access-Control-Allow-Origin: *");
});


// template posts page


// Функция для загрузки дополнительных постов через AJAX

function load_more_posts_ajax() {
    $paged = $_POST['page'];
    $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3, // Загружаем по 3 поста за раз
        'paged' => $paged,
        'post_status' => 'publish'
    );
    
    // Добавляем фильтрацию по тегу, если он выбран
    if (!empty($tag)) {
        $args['tag'] = $tag;
    }
    
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
    
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts_ajax');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts_ajax'); // Для неавторизованных пользователей



/**
 * Функции для системы лайков
 */

// Функция для отображения кнопки лайка и количества лайков

function get_post_likes($post_id) {
    $count = get_post_like_count($post_id);
    
    // Проверяем, лайкнул ли уже пользователь этот пост
    $already_liked = check_if_user_liked($post_id);
    $like_class = $already_liked ? 'liked' : '';
    $like_text = $already_liked ? 'Вам нравится' : 'Нравится';
    
    $output = '<div class="post-like-system">';
    $output .= '<a href="#" class="like-button ' . $like_class . '" data-post-id="' . $post_id . '">';
    $output .= '<i class="glyphicon glyphicon-heart"></i> <span class="like-text">' . $like_text . '</span>';
    $output .= '</a>';
    $output .= '<span class="like-count badge">' . $count . '</span>';
    $output .= '</div>';
    
    return $output;
}

// Функция для получения количества лайков
function get_post_like_count($post_id) {
    $count = get_post_meta($post_id, '_post_like_count', true);
    return ($count ? $count : '0');
}

// Функция для проверки, лайкнул ли пользователь пост
function check_if_user_liked($post_id) {
    // Получаем IP пользователя
    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    // Получаем массив IP адресов, которые лайкнули пост
    $liked_ips = get_post_meta($post_id, '_user_ip_likes', true);
    
    if(!$liked_ips) {
        $liked_ips = array();
    }
    
    // Проверяем, есть ли IP пользователя в этом массиве
    if(in_array($user_ip, $liked_ips)) {
        return true;
    }
    
    return false;
}

// Обработка AJAX запроса для лайка
function process_post_like() {
    // Проверка безопасности
    if(!isset($_POST['post_id'])) {
        echo '0';
        die();
    }
    
    $post_id = intval($_POST['post_id']);
    
    // Получаем IP пользователя
    $user_ip = $_SERVER['REMOTE_ADDR'];
    
    // Получаем массив IP адресов, которые лайкнули пост
    $liked_ips = get_post_meta($post_id, '_user_ip_likes', true);
    
    if(!$liked_ips) {
        $liked_ips = array();
    }
    
    $response = array();
    
    // Если пользователь уже лайкнул пост, удаляем его лайк
    if(in_array($user_ip, $liked_ips)) {
        $key = array_search($user_ip, $liked_ips);
        unset($liked_ips[$key]);
        
        // Обновляем массив IP адресов
        update_post_meta($post_id, '_user_ip_likes', $liked_ips);
        
        // Уменьшаем счетчик лайков
        $like_count = get_post_meta($post_id, '_post_like_count', true);
        $like_count = ($like_count > 0) ? $like_count - 1 : 0;
        update_post_meta($post_id, '_post_like_count', $like_count);
        
        $response['status'] = 'unliked';
        $response['count'] = $like_count;
    } else {
        // Добавляем IP пользователя в массив
        $liked_ips[] = $user_ip;
        update_post_meta($post_id, '_user_ip_likes', $liked_ips);
        
        // Увеличиваем счетчик лайков
        $like_count = get_post_meta($post_id, '_post_like_count', true);
        $like_count = ($like_count) ? $like_count + 1 : 1;
        update_post_meta($post_id, '_post_like_count', $like_count);
        
        $response['status'] = 'liked';
        $response['count'] = $like_count;
    }
    
    // Возвращаем результат
    echo json_encode($response);
    die();
}

// Регистрируем AJAX хуки
add_action('wp_ajax_process_post_like', 'process_post_like');
add_action('wp_ajax_nopriv_process_post_like', 'process_post_like');

// Подключаем JS скрипт для обработки лайков
function enqueue_like_scripts() {
    // Регистрируем и подключаем CSS
    wp_enqueue_style('post-likes', get_template_directory_uri() . '/assets/style/post-likes.css');
    
    // Регистрируем и подключаем JS
    // wp_enqueue_script('like-script', get_template_directory_uri() . '/assets/js/post-likes.js', [], '1.0', true);
    wp_enqueue_script('post-likes', get_template_directory_uri() . '/assets/js/post-likes.js', array('jquery'), '1.0', true);
    
    // Передаем параметры в JS
    wp_localize_script('post-likes', 'post_likes', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_like_scripts');

