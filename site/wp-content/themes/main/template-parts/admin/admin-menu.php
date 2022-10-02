<?php
    $current_page = get_queried_object();

    $assigned_page_paintings = get_field('pages_assignment_paintings_management', 'option');
    $assigned_page_account = get_field('pages_assignment_account_settings', 'option');
?>

<section class="admin-menu">
    <div class="list-group">
        <a href="<?= esc_url(get_permalink($assigned_page_paintings->ID)); ?>" class="list-group-item list-group-item-action <?= ($current_page->ID === $assigned_page_paintings->ID) ? 'active' : ''; ?>">
            Zarządzaj obrazami
        </a>
        <a href="<?= esc_url(get_permalink($assigned_page_account->ID)); ?>" class="list-group-item list-group-item-action <?= ($current_page->ID === $assigned_page_account->ID) ? 'active' : ''; ?>">
            Zarządzaj kontem
        </a>
    </div>
</section>
