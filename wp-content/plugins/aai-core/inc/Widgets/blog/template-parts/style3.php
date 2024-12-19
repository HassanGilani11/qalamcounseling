
<div class="element-ready-post-container-style1 extend-style2 extend-style3">
    <?php if ( $wp_query->have_posts() ) : ?>
        <?php
            while ( $wp_query->have_posts() ) :
                $wp_query->the_post();
                
                ?>

                    <article id="post-<?php echo get_the_ID(); ?>" <?php post_class(['single-post-item','mb40']); ?>>

                      <?php  $thumb_link  = \Elementor\Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumb_size', $settings ); ?>
                        <div class="post-media">
                            <?php 

                                if ( is_sticky() ) {
                                    echo '<sup class="sticky-meta-featured">';
                                      \Elementor\Icons_Manager::render_icon( $settings['readmore_icon'], [ 'aria-hidden' => 'true' ] );
                                    echo '</sup>';

                                }

                            ?>

                            <?php
                                $categories = get_the_category();
                                    if ( ! empty( $categories) && $settings['show_cat'] == 'yes' ) {
                                        echo sprintf('<div class="single__random__category">%s<a href="%s">%s</a></div>',
                                        element_ready_render_icons($settings['cat_icon'], 'author_icon'),
                                        get_term_link($categories[0]),
                                        esc_html( $categories[0]->name )
                                    );
                                }
                            ?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>">
                                <img src="<?php echo esc_url($thumb_link); ?>" alt="<?php the_title_attribute(); ?>">
                        	</a>
                        </div>

                        <div class="post-details">
                       
                            <?php if($settings['show_post_meta'] == 'yes'): ?>
                                <div class="posts__bottom__meta style2">
                                
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
                                            <a href="<?php echo esc_url( get_day_link(  get_the_time( 'Y' ),  get_the_time( 'm' ), get_the_time( 'd' ) ) ); ?>"><?php echo get_the_date(get_option( 'date_format' )); ?></a>
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
                            <?php endif; ?> 

                            <h3 class="post-title">
                                <a href="<?php echo esc_url( get_permalink() ); ?>">
                                    <?php echo esc_html(wp_trim_words( get_the_title(),$settings['post_title_crop'], '' )); ?>
                                </a>
                            </h3>  

                            <?php if($settings['show_content'] == 'yes'): ?>
                                <div class="post-content fix">
                                    <p> <?php echo esc_html(wp_trim_words( get_the_excerpt(), $settings['post_content_crop'],'' )); ?></p>
                                </div>
                           <?php endif; ?>

                           <?php if( $settings['show_readmore'] == 'yes' ): ?>
                           
                            <div class="posts__readmore style2">
                               
                                <a href="<?php echo esc_url( get_permalink() ); ?>">
                                    <?php echo esc_html($settings['readmore_text']); ?>
                                </a>
                                <?php \Elementor\Icons_Manager::render_icon( $settings['readmore_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </div>	
                         
                        <?php endif; ?>  
                                        
                        </div>
                    </article>

                <?php
               
            endwhile;
        ?>
    <?php endif; ?>
</div>

