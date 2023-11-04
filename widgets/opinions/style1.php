<div class="rcode-opinions-container style-1">

    <?php 
            $quote = new \WP_Query( $args );
            if ($quote->have_posts()) : while ($quote->have_posts()) : $quote->the_post();   
        ?>

    <div class="rcode-opinions-single">
        <div class="rcode-quote">

            <p class="quote"><q><?php if(the_field('tresc_opinii')) : the_field('tresc_opinii'); endif ?></q></p>
            
            <?php if ( $settings['opinions_author']) : ?>
                <span class="quote-author"><?php if(the_field('autor_opinii')) : the_field('autor_opinii'); endif ?></span>
            <?php endif; ?>

        </div>
    </div>

    <?php endwhile;  ?>
    <?php endif;  wp_reset_postdata();  ?>
</div>