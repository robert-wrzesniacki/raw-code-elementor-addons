<?php
		$speed    = $settings['slider_speed'] ? $settings['slider_speed'] : 500;
		$autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
		$loop     = 'yes' == $settings['loop'] ? 'true'     : 'false';
		$delay    = $settings['slider_delay'] ? $settings['slider_delay'] : 3000;
		
		$slide_d    = $settings['slider_slide'] ? $settings['slider_slide'] : 6;
		$slide_t    = $settings['slider_slide_tablet'] ? $settings['slider_slide_tablet'] : 3;
		$slide_m    = $settings['slider_slide_mobile'] ? $settings['slider_slide_mobile'] : 1; 
		$space_d    = $settings['slider_space']['size'] ? $settings['slider_space']['size'] : 20;
		$space_t    = $settings['slider_space_tablet']['size'] ? $settings['slider_space_tablet']['size'] : 20;
		$space_m    = $settings['slider_space_mobile']['size'] ? $settings['slider_space_mobile']['size'] : 0;

?>

<div class="rcode-clients-container style-2 swiper" 
<?php echo 'data-swiper=\'{
    "autoplay":'.$autoplay.',
    "loop":'.$loop.',
    "speed":'.$speed.',
    "delay":'.$delay.',
    "slide_d":'.$slide_d.',
    "slide_t":'.$slide_t.',
    "slide_m":'.$slide_m.',
    "space_d":'.$space_d.',
    "space_t":'.$space_t.',
    "space_m":'.$space_m.'
    }\''; ?>>

<div class="swiper-wrapper">
    <?php foreach ( $settings['clients_gallery'] as $image ) { ?>

    <div class="swiper-slide">
        <div class="rcode-clients-single">
            <img src="<?php echo esc_url ( $image['url']); ?>">
        </div>
    </div>

    <?php } ?>
    </div>

</div>