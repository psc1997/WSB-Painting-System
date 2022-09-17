<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php wp_head(); ?>

    <title>
        <?= esc_attr(is_front_page() ? get_bloginfo() : get_the_title() . ' | ' . get_bloginfo()); ?>
    </title>

    <!-- Theme Color for Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#f9f7f1">
    <meta name="author" content="PastaMedia (Patryk Szulc)">
</head>

<body <?php body_class() ?>>
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <div class="header__wrapper">
                    <div class="row">
                        <div class="col-24 text-center">
                            <a href="<?= esc_url(get_home_url()); ?>" class="header__logo">
                                <p class="header__pretitle">
                                    Virtual Museum
                                </p>
                                <p class="header__title">
                                    Retro Heart
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-24">
                            <nav class="navbar navbar-expand-md header__navbar">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header_menu">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-center" id="header_menu">
                                    <?php
                                        wp_nav_menu([
                                            'theme_location' => 'header_menu',
                                            'walker' => new PastaMedia_Menu_Walker(),
                                            'container' => false,
                                            'fallback_cb' => false,
                                            'menu_class' => 'navbar-nav header__nav',
                                            // 'items_wrap' => '%3$s', // uncomment to remove main menu wrap <>
                                            'submenu_class' => 'main-menu__dropdown',
                                            'menu_item_classes' => [
                                                'nav-item',
                                                'header__nav-item',
                                            ],
                                            'menu_link_classes' => [
                                                'header__nav-link',
                                            ],
                                        ]);
                                    ?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        $page_news = get_field('sites_assign_page_news', 'options');
        $page_faq = get_field('sites_assign_page_faq', 'options');
        $page_contact = get_field('sites_assign_page_contact', 'options');

        $current_permalink = get_permalink(get_queried_object_id());
    ?>
    <div class="header__floating-menu-bar">
        <div class="container px-0 header__floating-menu-bar-container">
            <div class="row">
                <div class="col-6 p-0">
                    <a href="<?= esc_url(get_home_url()); ?>" class="header__floating-menu-bar-item <?= (is_front_page()) ? 'is-current-page' : ''; ?>">
                        <span class="icon icon-mobile-menu-home header__floating-menu-bar-item-icon"></span>
                        Home
                    </a>
                </div>
                <div class="col-6 p-0">
                    <?php if (!empty($page_news)) : ?>
                        <a href="<?= esc_url($page_news); ?>" class="header__floating-menu-bar-item <?= ($page_news === $current_permalink) ? 'is-current-page' : ''; ?>">
                            <span class="icon icon-mobile-menu-news header__floating-menu-bar-item-icon"></span>
                            Aktualności
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-6 p-0">
                    <?php if (!empty($page_faq)) : ?>
                        <a href="<?= esc_url($page_faq); ?>" class="header__floating-menu-bar-item <?= ($page_faq === $current_permalink) ? 'is-current-page' : ''; ?>">
                            <span class="icon icon-mobile-menu-question header__floating-menu-bar-item-icon"></span>
                            FAQ
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-6 p-0">
                    <?php if (!empty($page_contact)) : ?>
                        <a href="<?= esc_url($page_contact); ?>" class="header__floating-menu-bar-item <?= ($page_contact === $current_permalink) ? 'is-current-page' : ''; ?>">
                            <span class="icon icon-mobile-menu-contact header__floating-menu-bar-item-icon"></span>
                            Kontakt
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</header>
