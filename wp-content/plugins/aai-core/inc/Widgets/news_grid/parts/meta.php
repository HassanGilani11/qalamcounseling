<?php if($settings['show_post_meta'] == 'yes'): ?>
    <div class="post-meta element-ready-post-meta">

        <?php if($settings['show_author'] == 'yes'): ?>
            <div class="meta-author element-ready-meta-author element-ready-meta-list">
            
                    <?php if($settings['meta_author_icon']['library'] !=''): ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_author_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else: ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php endif; ?>

                <?php
                    
                    if($settings['show_author_img'] =='yes'){
                        printf(
                            '<a href="%2$s">%1$s %3$s</a>',
                            get_avatar( get_the_author_meta( 'ID' ), 55 ), 
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                            get_the_author()
                            );
                    }else{
                        printf(
                            '<a class="element-ready-author" href="%1$s">%2$s</a>',
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
                            get_the_author()
                        ); 
                    }    
                    
                            
                        
                ?>
            </div>
        <?php endif; ?>

        <?php  $categories = get_the_category();
            if(! empty( $categories) && $settings['show_cat'] == 'yes' ): ?>
            <div class="meta-categories element-ready-meta-categories element-ready-meta-list">
            
                    <?php if($settings['meta_cat_icon']['library'] !=''): ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_cat_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php else: ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php endif; ?>

                <?php
                        
                    echo '<a class="element-ready-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                        
                ?>
            </div>
        <?php endif; ?>
        <?php if($settings['show_date'] =='yes'): ?>    
            <div class="meta-date element-ready-meta-date element-ready-meta-list">
        
            <?php if($settings['meta_date_icon']['library'] !=''): ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['meta_date_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php else: ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>

                <span class="element-ready-date"><?php echo get_the_date(get_option( 'date_format' )); ?></span>
            </div>
        <?php endif; ?>
        <?php if($settings['show_comment'] =='yes'): ?>    
            <div class="element-ready-meta-comment element-ready-meta-list">
                <?php if($settings['meta_comment_icon']['library'] !=''): ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['meta_comment_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php else: ?>
                <?php \Elementor\Icons_Manager::render_icon( $settings['meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>
                <span class="element-ready-comment"> <?php echo get_comments_number(); ?></span>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>