<?php
    $assigned_page_paintings = get_field('pages_assignment_paintings_management', 'option');
    $assigned_page_account = get_field('pages_assignment_account_settings', 'option');
?>


<section class="admin-dashboard-content">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <div class="admin-dashboard-content__text">
                    <h2>
                        Witaj w panelu zarządzania!
                    </h2>
                    <p>
                        Z tego miejsca używając menu nawigacyjnego po prawej stronie, możesz przejść do strony <a href="<?= esc_url(get_permalink($assigned_page_paintings->ID)); ?>">zarządzania obrazami</a>, lub <a href="<?= esc_url(get_permalink($assigned_page_account->ID)); ?>">zarządzania kontem</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
