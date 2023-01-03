<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <?php wp_head(); ?>

    <title>
        <?= esc_attr(is_front_page() ? get_bloginfo() : get_the_title() . ' | ' . get_bloginfo()); ?>
    </title>
</head>

<body <?php body_class() ?>>

    <?php
        $login_url = get_field('pages_assignment_login', 'option');
        $dashboard = get_field('pages_assignment_dashboard', 'option');
    ?>

    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-24">
                    <nav class="navbar navbar-expand-sm header__navbar">
                        <a href="<?= esc_url(get_home_url()); ?>" class="navbar-brand p-0">
                            <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/logo.svg" alt="Paint IT" class="header__logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                            aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarHeader">
                            <ul class="navbar-nav ml-auto">
                                <?php if (!is_user_logged_in() && !empty($login_url)) : ?>
                                    <li class="nav-item header__nav-item">
                                        <a href="<?= esc_url($login_url); ?>" class="nav-link header__nav-link">
                                            <span class="icon icon-account"></span><br>
                                            Zaloguj się
                                        </a>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item header__nav-item">
                                        <a href="<?= esc_url($dashboard); ?>" class="nav-link header__nav-link">
                                            <span class="icon icon-settings"></span><br>
                                            Panel zarządzania
                                        </a>
                                    </li>
                                    <li class="nav-item header__nav-item">
                                        <a href="<?= esc_url(get_author_posts_url(get_current_user_id())); ?>" class="nav-link header__nav-link">
                                            <span class="icon icon-account"></span><br>
                                            Profil
                                        </a>
                                    </li>
                                    <li class="nav-item header__nav-item">
                                        <a href="<?= esc_url($login_url); ?>?logout" class="nav-link header__nav-link">
                                            <span class="icon icon-logout"></span><br>
                                            Wyloguj
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
