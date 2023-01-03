<?php
    $object = $args['object'];
?>

<section class="paintings-header">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <?php if (!empty($object->name)) : ?>
                    <h1 class="paintings-header__title">
                        Kategoria: <span><?= esc_html($object->name); ?></span>
                    </h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
