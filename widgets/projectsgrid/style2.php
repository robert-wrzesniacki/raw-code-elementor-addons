<article>
    <div class="rcode-projects-box">
        <div class="rcode-projects-img">
            <?php
            if ( has_post_thumbnail() ) { ?>
                <img src='<?php the_post_thumbnail_url(); ?>'>
            <?php } ?>
        </div>
        
        <div class="rcode-projects-overlay">
            <div class="rcode-projects-heading">
                <?php if($settings['projectsgrid_title'] == 'yes') : ?> 
                    <a href="<?php the_permalink(); ?>">
                    <h3 class="rcode-projects-title"><?php echo esc_attr( get_the_title() ); ?></h3>
                    </a>
                <?php endif; ?>
                <?php if($settings['projectsgrid_category'] == 'yes' && $settings['projectsgrid_catlimit']['size'] > 0 ) : ?> 
                    <div class="rcode-projects-categories">
                        <span>
                            <?php
                                $cats = get_the_terms( get_the_ID(), 'projects-category' );
                                if ( $cats ) {
                                    $count = 0;
                                    $cat_list = '';
                                    $limit = $settings['projectsgrid_catlimit']['size']; // ustawiamy limit categorii
                                    foreach ( $cats as $cat ) {
                                        $cat_list .= $cat->name . ', ';
                                        $count++;
                                        if ( $count >= $limit ) {
                                            break;
                                        }
                                    }
                                    $cat_list = rtrim( $cat_list, ', ' ); // usuń ostatni przecinek i spację
                                    echo $cat_list;
                                }
                            ?>
                        </span>
                    </div>
                <?php endif; ?>
                <?php if($settings['projectsgrid_separator'] == 'yes') : ?> 
                    <div class="rcode-projects-separator"></div>
                <?php endif; ?>
                <?php if($settings['projectsgrid_likes'] == 'yes') : ?> 
                    <div class="rcode-projects-like">
                        <div>
                            <span class="post-views">
                                <i class="fa fa-eye"></i>
                                    <?php 
                                    $postviews = get_post_meta( get_the_ID(), 'post_views_count', true );
                                    echo ($postviews) ? $postviews : '0';
                                    echo ' ';
                                    echo __( 'Views', 'rawcodeplugin' ); 
                                    ?>
                            </span>
                        </div>
                        <div>
                            <span class="post-likes">
                                <i class="fa fa-heart"></i>
                                    <?php 
                                    $postlikes = get_post_meta( get_the_ID(), '_likes', true );
                                    echo ($postlikes) ? $postlikes : '0';
                                    echo ' ';
                                    echo __( 'Likes', 'rawcodeplugin' );
                                    ?>
                            </span>                
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php if($settings['projectsgrid_button'] == 'yes') : ?> 
                <a href="<?php the_permalink(); ?>" class="rcode-projects-button"><?php echo $settings['projectsgrid_button_text'] ?><i class="fas fa-long-arrow-alt-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</article>
