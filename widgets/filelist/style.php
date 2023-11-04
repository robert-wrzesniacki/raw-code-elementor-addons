<?php
$file = get_field('plik');
$url = $file['url'];
$image = get_field('ikona_pliku');

?>


<div class="rcode-file-container">
    <a href="<?php echo esc_attr($url); ?>" download target="_blank" class="rcode-file-link">
        <div class="rcode-file-img">
            <div class="rcode-file-img-box">
                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
            </div>
        </div>
        <div class="rcode-file-content">
            <div class="rcode-file-title"><h3><?php echo esc_attr( get_the_title() ); ?></h3></div>
            <div class="rcode-file-description"><?php if(the_field('opis_pliku')) : the_field('opis_pliku'); endif ?></div>
        </div>
    </a>
</div>