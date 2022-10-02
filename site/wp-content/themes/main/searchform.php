<form role="search" method="get" id="searchform" action="<?= esc_url(home_url('/')); ?>">
    <div class="input-group">
        <input type="text" class="form-control home-welcome__content-input" placeholder="Znajdź artystę lub styl..." name="s" id="s" minlength="3" maxlength="100" autocomplete="off" required>
        <span class="icon icon-search home-welcome__content-input-icon"></span>
        <div class="input-group-append">
            <button class="button" type="submit">
                Szukaj
            </button>
        </div>
    </div>
</form>
