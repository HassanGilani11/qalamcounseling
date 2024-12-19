
    <div class="element-ready-blog-post-meta-style1"> 
        <div class="posts__bottom__meta style2">
            <?php
                $categories = get_the_category( );
                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                        echo sprintf('<div class="single__random__category">%s<a href="%s">%s</a></div>',
                        element_ready_render_icons($settings['cat_icon'], 'cat--icon'),
                        get_term_link($categories[0]),
                        esc_html( $categories[0]->name )
                    );
                }
            ?>

            <?php if($settings['show_author'] == 'yes'): 
                $author_url = get_author_posts_url(get_the_author_meta('ID'));
                ?>
                <div class="post__author er-meta">
                        <?php if($settings['show_author_img'] == 'yes'): ?>
                        
                        <a class="author__thumbnail" href="<?php echo esc_url($author_url); ?>">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
                        </a>
                    <?php endif; ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['author_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <a class="author__link" href="<?php echo esc_url($author_url); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>
                </div>
            <?php endif; ?>
            
            <?php if($settings['show_date']): ?>      
                <div class="post__date er-meta">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['date_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <a href="<?php echo esc_url( get_day_link( get_the_time( 'Y' ),  get_the_time( 'm' ), get_the_time( 'd' ) ) ); ?>"><?php echo get_the_date(get_option( 'date_format' )); ?></a>
                </div>
            <?php endif; ?> 
            
            <?php if($settings['show_comment']):
                $comments_text = get_comments_number_text( 'No comments', '1 comment', '% comments', get_the_id() );
            ?>      
            <div class="post__comment er-meta">
                <?php \Elementor\Icons_Manager::render_icon( $settings['comment_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <a href="#">
                    <?php echo esc_html( $settings['show_comment_text'] == 'yes'? $comments_text : get_comments_number(get_the_ID()) ); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>


