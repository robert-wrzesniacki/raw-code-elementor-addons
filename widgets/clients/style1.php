<div class="rcode-clients-container style-1">
    <?php foreach ( $settings['clients_gallery'] as $image ) { ?>

        <div class="rcode-clients-single">
            <img src="<?php echo esc_url ( $image['url']); ?>">
        </div>

    <?php } ?>
</div>

