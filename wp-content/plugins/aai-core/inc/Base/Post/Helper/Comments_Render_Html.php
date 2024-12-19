<?php

namespace Element_Ready_Pro\Base\Post\Helper;
$comments_opt = get_option('comments_formet','C');
if( $comments_opt == 'A' ){
    trait Comments_Render_Html{

        /** 
         * Outputs a comment in the HTML5 format.
         *
         * @see wp_list_comments()
         *
         * @param WP_Comment $comment Comment to display.
         * @param int        $depth   Depth of the current comment.
         * @param array      $args    An array of arguments.
         */
        
        protected function html5_comment( $comment, $depth, $args ) {
    
            $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        
            ?>
            <<?php echo $tag; ?> id="qs__post__comment__item__<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'qs__post__comment__item qs__post__parent__comment' : 'qs__post__comment__item', $comment ); ?>>
                <div id="qs__post__comment__body-<?php comment_ID(); ?>" class="qs__post__comment__body"> <!-- .qs__post__comment__body -->
                    <div class="qs__post__comment__meta"><!-- .qs__post__comment__meta -->
                        <div class="qs__post__comment__author qs__post__comment__vcard"><!-- .qs__post__comment__author -->
                            <?php

                            $comment_author_link = get_comment_author_link( $comment );
                            $comment_author_url  = get_comment_author_url( $comment );
                            $comment_author      = get_comment_author( $comment );
                            $avatar              = get_avatar( $comment, $args['avatar_size'] );
                            

                            if ( 0 != $args['avatar_size'] ) {
                                if ( empty( $comment_author_url ) ) {
                                    echo '<div class="qs__comment__author__thumb">'.$avatar.'</div>';
                                } else {
                                    printf( '<div class="qs__comment__author__thumb"><a href="%s" rel="external nofollow" class="qs__post__comment__url">'.$avatar.'</a></div>', $comment_author_url );

                                }
                            }

                            printf(
                                '<div class="qs__post__comment__author__name">' . get_comment_author_link( $comment ) . '<span class="qs__post__comment__screen__reader__text says">says:</span></div>'
                            );
                            ?>
                        </div><!-- .qs__post__comment__author -->
    
                        <div class="qs__post__comment__meta__date">
                            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                <?php
                                    /* translators: 1: comment date, 2: comment time */
                                    $comment_timestamp = sprintf( __( '%1$s at %2$s', 'element-ready-pro' ), get_comment_date( '', $comment ), get_comment_time() );
                                ?>
                                <time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
                                    <?php echo $comment_timestamp; ?>
                                </time>
                            </a>
                        </div><!-- .qs__post__comment__meta__date -->
    
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="qs__post__comment__awaiting__moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'element-ready-pro' ); ?></p>
                        <?php endif; ?>

                    </div><!-- .qs__post__comment__meta -->
    
                    <div class="qs__post__comment__content">
                        <?php comment_text(); ?>
                    </div><!-- .qs__post__comment__content -->
                    <?php
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'qs__post__comment__body',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="qs__post__comment__reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );
                    ?>
                    <div class="qs__comment__edit__link">
                        <?php
                            edit_comment_link( __( 'Edit', 'element-ready-pro' ), '<span class="qs__post__comment__edit__link__sep"></span> <span class="qs__post__comment__edit__link"></span>' );
                        ?>
                    </div>
                </div><!-- .qs__post__comment__body -->
            <?php
        }
    }
}elseif( $comments_opt == 'B' ){
    trait Comments_Render_Html{

        /** 
         * Outputs a comment in the HTML5 format.
         *
         * @see wp_list_comments()
         *
         * @param WP_Comment $comment Comment to display.
         * @param int        $depth   Depth of the current comment.
         * @param array      $args    An array of arguments.
         */
        
        protected function html5_comment( $comment, $depth, $args ) {
     
            $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
           
            ?>
            <<?php echo $tag; ?> id="qs__post__comment__item__<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'qs__post__comment__item qs__post__parent__comment' : 'qs__post__comment__item', $comment ); ?>>
                <div id="qs__post__comment__body-<?php comment_ID(); ?>" class="qs__post__comment__body"> <!-- .qs__post__comment__body -->
                    <div class="qs__post__comment__meta"><!-- .qs__post__comment__meta -->
                        <div class="qs__post__comment__author qs__post__comment__vcard"><!-- .qs__post__comment__author -->
                            <?php
    
                            $comment_author_link = get_comment_author_link( $comment );
                            $comment_author_url  = get_comment_author_url( $comment );
                            $comment_author      = get_comment_author( $comment );
                            $avatar              = get_avatar( $comment, $args['avatar_size'] );
                            
    
                            if ( 0 != $args['avatar_size'] ) {
                                if ( empty( $comment_author_url ) ) {
                                    echo '<div class="qs__comment__author__thumb">'.$avatar.'</div>';
                                } else {
                                    printf( '<div class="qs__comment__author__thumb"><a href="%s" rel="external nofollow" class="qs__post__comment__url">'.$avatar.'</a></div>', $comment_author_url );
    
                                }
                            }
    
                            printf(
                                '<div class="qs__post__comment__author__name">' . get_comment_author_link( $comment ) . '<span class="qs__post__comment__screen__reader__text says">says:</span></div>'
                            );
                            ?>
                        </div><!-- .qs__post__comment__author -->
     
     
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="qs__post__comment__awaiting__moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'element-ready-pro' ); ?></p>
                        <?php endif; ?>
    
                    </div><!-- .qs__post__comment__meta -->
     
                    <div class="qs__post__comment__content">
                        <?php comment_text(); ?>
                    </div><!-- .qs__post__comment__content -->
    
                    <div class="qs__post__comment__meta__date">
                        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                            <?php
                                /* translators: 1: comment date, 2: comment time */
                                $comment_timestamp = sprintf( __( '%1$s at %2$s', 'element-ready-pro' ), get_comment_date( '', $comment ), get_comment_time() );
                            ?>
                            <time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
                                <?php echo $comment_timestamp; ?>
                            </time>
                        </a>
                        <div class="qs__comment__edit__link">
                            <?php
                                edit_comment_link( __( 'Edit', 'element-ready-pro' ), '<span class="qs__post__comment__edit__link__sep"></span> <span class="qs__post__comment__edit__link"></span>' );
                            ?>
                        </div>
                    </div><!-- .qs__post__comment__meta__date -->
    
                    <?php
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'qs__post__comment__body',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="qs__post__comment__reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );
                    ?>
                </div><!-- .qs__post__comment__body -->
            <?php
        }
    }
}elseif( $comments_opt == 'C' ){
    trait Comments_Render_Html{

        /** 
         * Outputs a comment in the HTML5 format.
         *
         * @see wp_list_comments()
         *
         * @param WP_Comment $comment Comment to display.
         * @param int        $depth   Depth of the current comment.
         * @param array      $args    An array of arguments.
         */
        
        protected function html5_comment( $comment, $depth, $args ) {
     
            $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
           
            ?>
            <<?php echo $tag; ?> id="qs__post__comment__item__<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'qs__post__comment__item qs__post__parent__comment' : 'qs__post__comment__item', $comment ); ?>>
                <div id="qs__post__comment__body-<?php comment_ID(); ?>" class="qs__post__comment__body qs__comment__formet__c"> <!-- .qs__post__comment__body -->
                    <div class="qs__post__comment__meta"><!-- .qs__post__comment__meta -->
                        <div class="qs__post__comment__author qs__post__comment__vcard"><!-- .qs__post__comment__author -->
                            <?php
    
                                $comment_author_link = get_comment_author_link( $comment );
                                $comment_author_url  = get_comment_author_url( $comment );
                                $comment_author      = get_comment_author( $comment );
                                $avatar              = get_avatar( $comment, $args['avatar_size'] );
                                
    
                                if ( 0 != $args['avatar_size'] ) {
                                    if ( empty( $comment_author_url ) ) {
                                        echo '<div class="qs__comment__author__thumb">'.$avatar.'</div>';
                                    } else {
                                        printf( '<div class="qs__comment__author__thumb"><a href="%s" rel="external nofollow" class="qs__post__comment__url">'.$avatar.'</a></div>', $comment_author_url );
    
                                    }
                                }
    
    
                            ?>
                            <div class="qs__blog__comment__author__and__comment__date">
                                <?php
                                    printf(
                                        '<div class="qs__post__comment__author__name">' . get_comment_author_link( $comment ) . '<span class="qs__post__comment__screen__reader__text says">says:</span></div>'
                                    );
                                ?>
                                <div class="qs__post__comment__meta__date">
                                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                        <?php
                                            /* translators: 1: comment date, 2: comment time */
                                            $comment_timestamp = sprintf( __( '%1$s', 'element-ready-pro' ), get_comment_date( '', $comment ) );
                                        ?>
                                        <time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
                                            <?php echo $comment_timestamp; ?>
                                        </time>
                                    </a>
                                </div><!-- .qs__post__comment__meta__date -->
                            </div>
    
                        </div><!-- .qs__post__comment__author -->
     
    
     
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="qs__post__comment__awaiting__moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'element-ready-pro' ); ?></p>
                        <?php endif; ?>
    
                    </div><!-- .qs__post__comment__meta -->
     
                    <div class="qs__post__comment__content">
                        <?php comment_text(); ?>
                    </div><!-- .qs__post__comment__content -->
                    <?php
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'add_below' => 'qs__post__comment__body',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<div class="qs__post__comment__reply">',
                                    'after'     => '</div>',
                                )
                            )
                        );
                    ?>
                    <div class="qs__comment__edit__link">
                        <?php
                            edit_comment_link( __( 'Edit', 'element-ready-pro' ), '<span class="qs__post__comment__edit__link__sep"></span> <span class="qs__post__comment__edit__link"></span>' );
                        ?>
                    </div>
                </div><!-- .qs__post__comment__body -->
            <?php
        }
    }
}