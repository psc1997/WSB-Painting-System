<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-24 col-md-6 d-flex align-items-center">
                <div>
                    <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/logo.svg" alt="Paint IT" class="footer__logo">
                    <p class="footer__copyrights">
                        PaintIT &copy; 2022
                    </p>
                </div>
            </div>
            <div class="col-24 col-md-6">
                <h5 class="footer__nav-title">
                    Menu
                </h5>
                <?php
                    wp_nav_menu([
                        'theme_location' => 'footer_menu',
                        'walker' => new PastaMedia_Menu_Walker(),
                        'container' => false,
                        'fallback_cb' => false,
                        'menu_class' => 'navbar-nav footer__nav',
                        // 'items_wrap' => '%3$s', // uncomment to remove main menu wrap <>
                        'submenu_class' => 'main-menu__dropdown',
                        'menu_item_classes' => [
                            'nav-item',
                            'footer__nav-item',
                        ],
                        'menu_link_classes' => [
                            'footer__nav-link',
                        ],
                    ]);
                ?>
            </div>
            <div class="col-24 col-md-12">
                <h5 class="footer__nav-title">
                    O nas
                </h5>
                <p class="footer__text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, laudantium pariatur vero doloribus fugiat sit, ipsum mollitia illo voluptates excepturi voluptatibus veritatis, dolores cumque vel corrupti provident? Earum, fuga quo?
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Cookie Info -->
<?php $privacy_policy_link = get_privacy_policy_url(); ?>
<div class="cookie-info js-cookie-info">
    <div class="row">
        <div class="col-24 col-sm-4 col-md-24">
            <p class="text-center">
                <span class="icon icon-cookie cookie-info__icon-cookie"></span>
            </p>
        </div>
        <div class="col-24 col-sm-20 col-md-24">
            <p class="cookie-info__text">
                <?= esc_html(orphan('Ta strona używa plików cookie w celu usprawnienia i ułatwienia dostępu do serwisu oraz prowadzenia danych statystycznych. Dalsze korzystanie z tej witryny oznacza akceptację tego stanu rzeczy.')); ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-24 col-sm-12 col-md-24">
            <?php if (!empty($privacy_policy_link)) : ?>
                <a href="<?= esc_url($privacy_policy_link); ?>" class="button button--full mb-3">
                    Polityka prywatności
                </a>
            <?php endif; ?>
        </div>
        <div class="col-24 col-sm-12 col-md-24">
            <a href="#" class="button button--full js-accept-cookie">
                OK
            </a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
