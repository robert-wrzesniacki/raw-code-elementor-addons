<article>
    <div class="rcode-postlist-img">
        <a href="<?php the_permalink(); ?>">
        <?php

            if ( has_post_thumbnail() ) { ?>
                <div class="rcode-post-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></div>
            <?php } ?>

        <?php if($settings['postlist_data'] == 'yes') : ?>  
            <span class="rcode-data"><?php echo esc_attr( get_the_date( $settings['date_format'] )); ?></span>
        <?php endif; ?>
        </a>
    </div>
    <div class="rcode-postlist-content">
        <div>
        <?php if($settings['postlist_tag'] == 'yes' && $settings['postlist_taglimit']['size'] > 0 ) : ?>    
            <div class="rcode-postlist-taglist"><span>
            <?php

                $tags = get_the_tags();
                if ( $tags ) {
                    $count = 0;
                    $tag_list = '';
                    $limit = $settings['postlist_taglimit']['size']; // ustawiamy limit tagów
                    foreach ( $tags as $tag ) {
                        $tag_link = get_tag_link( $tag->term_id );
                        $tag_list .= '<a href="' . $tag_link . '">' . $tag->name . '</a>, ';
                        $count++;
                        if ( $count >= $limit ) {
                            break;
                        }
                    }
                    $tag_list = rtrim( $tag_list, ', ' ); // usuń ostatni przecinek i spację
                    echo $tag_list;
                }

            ?>
            </span></div>
        <?php endif; ?>
                
        <div class="rcode-postlist-title"><a href="<?php the_permalink(); ?>"><h3><?php echo esc_attr( get_the_title() ); ?></h3></a></div>
        </div>
        <?php if($settings['postlist_author'] == 'yes') : ?>    
            <div class="rcode-postlist-autor"><h4><?php echo esc_attr( get_the_author() ); ?></h4></div>
        <?php endif; ?>

    </div>
</article>
