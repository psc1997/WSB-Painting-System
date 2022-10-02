<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-24 col-md-12">
                
            </div>
            <div class="col-24 col-md-12 text-right">
                <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/logo.svg" alt="Paint IT" class="footer__logo">
                <p class="footer__copyrights">
                    PaintIT &copy; 2022
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Cookie Info -->
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
            <a href="#modalRODO" class="button button--full mb-3" data-toggle="modal">
                Polityka prywatności
            </a>
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
