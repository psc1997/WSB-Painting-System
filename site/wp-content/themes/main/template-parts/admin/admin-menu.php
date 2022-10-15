<?php
    $current_page = get_queried_object();

    $assigned_page_paintings = get_field('pages_assignment_paintings_management', 'option');
    $assigned_page_account = get_field('pages_assignment_account_settings', 'option');
    $assigned_page_favorites = get_field('pages_assignment_favourites', 'option');
?>

<section>
    <div class="list-group admin__menu">
        <a href="<?= esc_url(get_permalink($assigned_page_paintings->ID)); ?>" class="list-group-item list-group-item-action admin__menu-item <?= ($current_page->ID === $assigned_page_paintings->ID) ? 'active' : ''; ?>">
            Zarządzaj obrazami
        </a>
        <a href="<?= esc_url(get_permalink($assigned_page_account->ID)); ?>" class="list-group-item list-group-item-action admin__menu-item <?= ($current_page->ID === $assigned_page_account->ID) ? 'active' : ''; ?>">
            Zarządzaj kontem
        </a>
        <a href="<?= esc_url(get_permalink($assigned_page_favorites->ID)); ?>" class="list-group-item list-group-item-action admin__menu-item <?= ($current_page->ID === $assigned_page_favorites->ID) ? 'active' : ''; ?>">
            Ulubione
        </a>
    </div>
</section>
