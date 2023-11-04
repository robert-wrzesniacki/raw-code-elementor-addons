<div class="rcode-opinions-container style-2 swiper" 
<?php echo 'data-swiper=\'{"autoplay":'.$autoplay.',"loop":'.$loop.',"speed":'.$speed.',"delay":'.$delay.'}\''; ?>>
<div class="swiper-wrapper">
    <?php 
            $quote = new \WP_Query( $args );
            if ($quote->have_posts()) : while  ($quote->have_posts()) : $quote->the_post();   
        ?>

    <div class="swiper-slide">
        <div class="rcode-opinions-single ">
            <div class="rcode-quote">

                <p class="quote"><q><?php if(the_field('tresc_opinii')) : the_field('tresc_opinii'); endif ?></q></p>
                
                <?php if ( $settings['opinions_author']) : ?>
                    <span class="quote-author"><?php if(the_field('autor_opinii')) : the_field('autor_opinii'); endif ?></span>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?php endwhile;  ?>
    <?php endif;  wp_reset_postdata();  ?>
    </div>
    <div class="swiper-pagination"></div>
    <div class="slider-nav">
        <div class="swiper-button-prev"><i aria-hidden="true" class="fas fa-angle-left"></i></div>
        <div class="swiper-button-next"><i aria-hidden="true" class="fas fa-angle-right"></i></div>
    </div>
</div>