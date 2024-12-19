
    <?php if( has_tag('', $post_id) ) : ?>
        <div class="element-ready-blog-post-tags-container"> 
            <?php if($settings['show_heading'] == 'yes'): ?>
                <h6 class="er-tags-heading">

                    <?php
                        echo element_ready_render_icons($settings['heading_icon'], 'tags--icon');
                        echo '<span>'. esc_html($settings['heading']) .'</span>'; 
                    ?> 

                </h6> 
            <?php endif; ?>
            <div class="element-ready-blog-post-tags-style1"> 
            
                <?php echo get_the_tag_list('', '',  '', $post_id); ?>
            </div>
        </div>
    <?php endif; ?>


