<?php
    $object = $args['object'];
?>

<section class="paintings-header">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <div class="paintings-header__box">
                    <?php if (!empty($object->name)) : ?>
                        <h1 class="paintings-header__title">
                            <?= esc_html($object->name); ?>
                        </h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
