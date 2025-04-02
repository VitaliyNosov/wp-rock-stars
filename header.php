<?php
/**
 * The header template file for Rock Star theme.
 *
 * Displays all of the <head> section and everything up to the main content.
 *
 * @package Rock_Star
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>    
    
    <!-- <style>
        /* Изолированные стили для меню с префиксами, чтобы избежать конфликтов */
        .rs-site-header {
            position: relative;
            z-index: 1000;
        }

        .rs-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        /* Стили для основного меню */
        .primary-navigation .menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .primary-navigation .menu > li {
            position: relative;
            margin: 0 5px;
        }

        .primary-navigation .menu > li > a {
            padding: 10px;
            display: block;
            transition: color 0.3s ease;
        }

        /* Стили для подменю */
        .primary-navigation .menu > li > .sub-menu {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 200px;
            background-color: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 100;
            border-radius: 4px;
            padding: 5px 0;
            margin: 0;
        }

        .primary-navigation .menu > li:hover > .sub-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .primary-navigation .menu > li > .sub-menu > li {
            display: block;
            margin: 0;
            padding: 0;
        }

        .primary-navigation .menu > li > .sub-menu > li > a {
            display: block;
            padding: 8px 15px;
            transition: all 0.2s ease;
        }

        .primary-navigation .menu > li > .sub-menu > li > a:hover {
            background-color: rgba(0, 0, 0, 0.05);
            padding-left: 20px;
        }

        /* Стили для бургер-меню */
        .rs-burger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 20px;
            cursor: pointer;
            z-index: 1010;
            position: relative;
        }

        .rs-burger-menu div {
            width: 100%;
            height: 3px;
            background-color: #333;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        /* Стили для мобильного меню */
        .rs-mobile-menu {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background-color: #fff;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: right 0.3s ease;
            overflow-y: auto;
            padding-top: 60px;
        }

        .rs-mobile-menu.active {
            right: 0;
        }

        .rs-mobile-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .rs-mobile-menu ul li {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .rs-mobile-menu ul li a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
        }

        /* Стили для подменю в мобильной версии */
        .rs-mobile-menu .sub-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background-color: rgba(0, 0, 0, 0.02);
        }

        .rs-mobile-menu .menu-item-has-children {
            position: relative;
        }

        .rs-mobile-menu .menu-item-has-children::after {
            content: '+';
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .rs-mobile-menu .menu-item-has-children.active::after {
            transform: rotate(45deg);
        }

        .rs-mobile-menu .menu-item-has-children.active > .sub-menu {
            max-height: 1000px; /* Достаточно большое значение для любого подменю */
        }

        .rs-mobile-menu .sub-menu li:last-child {
            border-bottom: none;
        }

        .rs-mobile-menu .sub-menu a {
            padding-left: 35px;
        }

        /* Анимация для бургер-меню при активации */
        .rs-burger-menu.active div:nth-child(1) {
            transform: translateY(8.5px) rotate(45deg);
        }

        .rs-burger-menu.active div:nth-child(2) {
            opacity: 0;
        }

        .rs-burger-menu.active div:nth-child(3) {
            transform: translateY(-8.5px) rotate(-45deg);
        }

        /* Затемнение при открытом мобильном меню */
        .rs-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 990;
        }

        .rs-overlay.active {
            display: block;
        }

        /* Медиа-запросы для адаптивности */
        @media (max-width: 992px) {
            .primary-navigation {
                display: none;
            }
            
            .rs-burger-menu {
                display: flex;
            }
            .rs-container {
                display: flex;
                justify-content: left !important;
                /* background-color: red;  */
            }
        }

        @media (min-width: 993px) {
            .rs-mobile-menu {
                display: none;
            }
        }
    </style> -->
</head>
<body <?php body_class(); ?>>
    <header id="site-header" class="site-header rs-site-header">
        <div class="container rs-container">
            <div class="site-logo">
                <?php 
                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }
                ?>
            </div><!-- .site-logo -->

            <nav id="primary-navigation" class="primary-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'menu',
                    'depth' => 2, // Supports submenus
                ) );
                ?>
            </nav><!-- #primary-navigation -->

            <!-- Burger Menu -->
            <div class="rs-burger-menu" id="rs-burger-menu">
                <div></div>
                <div></div>
                <div></div>
            </div><!-- .burger-menu -->
        </div><!-- .container -->
    </header><!-- #site-header -->

    <!-- Mobile Menu -->
    <div id="rs-mobile-menu" class="rs-mobile-menu">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'container' => false,
            'menu_class' => '',
            'echo' => true,
            'fallback_cb' => false
        ) );
        ?>
    </div><!-- #mobile-menu -->

    <div id="content" class="site-content">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Переменные для элементов меню
            const burgerMenu = document.getElementById('rs-burger-menu');
            const mobileMenu = document.getElementById('rs-mobile-menu');
            const body = document.body;
            
            // Создаем элемент overlay
            const overlay = document.createElement('div');
            overlay.className = 'rs-overlay';
            body.appendChild(overlay);
            
            // Переключение мобильного меню при клике на бургер
            burgerMenu.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                overlay.classList.toggle('active');
            });
            
            // Закрытие меню при клике на overlay
            overlay.addEventListener('click', function() {
                burgerMenu.classList.remove('active');
                mobileMenu.classList.remove('active');
                this.classList.remove('active');
            });
            
            // Обработка подменю в мобильной версии
            const mobileMenuItems = mobileMenu.querySelectorAll('.menu-item-has-children');
            
            mobileMenuItems.forEach(function(item) {
                // Добавляем обработчик клика только на ссылку в элементе с подменю
                const itemLink = item.querySelector('a');
                
                itemLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    item.classList.toggle('active');
                });
            });
            
            // Изменение размера окна
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    burgerMenu.classList.remove('active');
                    mobileMenu.classList.remove('active');
                    overlay.classList.remove('active');
                }
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>
</html>