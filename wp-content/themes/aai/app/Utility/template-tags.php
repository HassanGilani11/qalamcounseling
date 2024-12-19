<?php

if (!function_exists('aai_post_thumbnail')) :

    function aai_post_thumbnail()
    {

        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) : ?>

            <div class="post-thumbnail post_img">
                <?php the_post_thumbnail(); ?>
            </div>

        <?php else : ?>

            <a class="post-thumbnail post_img" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail('post-thumbnail', array(
                    'alt' => the_title_attribute(array(
                        'echo' => false,
                    )),
                ));
                ?>
            </a>

        <?php
        endif;
    }
endif;

if (!function_exists('aai_return')) :

    function aai_return($arg)
    {

        return $arg;
    }

endif;


// display meta information for a specific post
// ----------------------------------------------------------------------------------------
if (!function_exists('aai_get_breadcrumbs')) {

    function aai_get_breadcrumbs($seperator = '/', $word = '')
    {

        $general_breadcrumb_limit = aai_option('general_breadcrumb_limit');
        $breadcrumb_post_title    = aai_option('general_breadcrumb_post_title_show', 0);
        $breadcrumb_page_title    = aai_option('general_breadcrumb_page_title_show', 0);

        $breadcrumb_enable        = aai_option('blog_show_breadcrumb', 1);

        if (!$breadcrumb_enable) {
            return;
        }

        if ($general_breadcrumb_limit > 0) {
            $word = $general_breadcrumb_limit;
        }

        echo '<ol class="breadcrumb" >';
        if (!is_home()) {

            echo '<li class="breadcrumb-item"><a href="';
            echo esc_url(get_home_url('/'));
            echo '">';

            echo esc_html__('Home', 'aai');
            echo "</a>" . '' . wp_kses_post($seperator) . '' . "</li> ";



            if (is_category() || is_single()) {

                if (is_single()) {

                    $category = get_the_category();
                    if (empty($category) || is_array($category)) {
                        $category = get_the_category(get_queried_object_id());
                    }
                } else {

                    if (function_exists('learn_press_is_course_archive') && learn_press_is_course_archive()) {
                        $category = get_term(get_queried_object_id(), 'course_category');
                    } else {
                        $category = get_category(get_query_var('cat'));
                    }
                }

                if (is_array($category) && isset($category[0])) {
                    echo '<li class="breadcrumb-item">' . wp_kses_post($seperator) . '<a href=' . get_category_link($category[0]->term_id) . '>';
                } else {
                    if (isset($category->term_id)) {
                        echo '<li class="breadcrumb-item"> <a href=' . get_category_link($category->term_id) . '>';
                    }
                }

                $post         = get_queried_object();

                $postType     = get_post_type_object(get_post_type($post));

                if (!empty($category)) {
                    if (is_array($category)) {

                        echo esc_html($category[0]->cat_name) . '</a> </li>';
                    } else {

                        if (isset($category->name)) {
                            echo esc_html($category->name) . '</a> </li>';
                        } else {
                            echo esc_html($category->cat_name) . '</a> </li>';
                        }
                    }
                } elseif ($postType) {

                    echo esc_html($postType->labels->singular_name) . '</a></li>';
                }

                if (is_single() && $breadcrumb_post_title) {

                    echo '<li class="breadcrumb-item">' . '' . wp_kses_post($seperator) . '';
                    echo esc_html($word) != '' ? wp_trim_words(get_the_title(), $word) : get_the_title();
                    echo '</li>';
                }
            } elseif (is_page() && $breadcrumb_page_title) {

                echo '<li class="breadcrumb-item">';
                echo esc_html($word) != '' ? wp_trim_words(get_the_title(), $word) : get_the_title();
                echo '</li>';
            }
        }
        if (is_tag()) {

            echo '<li class="breadcrumb-item">';
            single_tag_title();
            echo '</li>';
        } elseif (is_day()) {

            echo '<li class="breadcrumb-item">' . " ";
            the_time('F jS, Y');
            echo '</li>';
        } elseif (is_month()) {

            echo '<li class="breadcrumb-item">' . " ";
            the_time('F, Y');
            echo '</li>';
        } elseif (is_year()) {

            echo '<li class="breadcrumb-item">' . " ";
            the_time('Y');
            echo '</li>';
        } elseif (is_author()) {

            echo '<li class="breadcrumb-item">' . esc_html__('Author Blogs', 'aai');
            echo '</li>';
        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {

            echo '<li class="breadcrumb-item">' . esc_html__('Blogs', 'aai');
            echo '</li>';
        } elseif (is_search()) {

            echo '<li class="breadcrumb-item">' . esc_html__('Search Result', 'aai');
            echo '</li>';
        } elseif (is_404()) {

            echo '<li class="breadcrumb-item">' . esc_html__('404 Not Found', 'aai');
            echo '</li>';
        }

        echo '</ol>';
    }
}

// wp_body_open() backword compatibility
if (!function_exists('wp_body_open')) :

    function wp_body_open()
    {
        do_action('wp_body_open');
    }

endif;

/*-----------------------------
	RANDOM SINGLE TAG
------------------------------*/
if (!function_exists('aai_random_tag_retrip')) :
    function aai_random_tag_retrip()
    {

        if ('post' === get_post_type()) {

            if (has_tag()) {
                $tags       = get_the_tags();
                $tag_count  = count($tags);
                $single_tag = $tags[random_int(0, $tag_count - 1)];

                if (get_the_tags()) {
                    echo '<a href="' . esc_url(get_category_link($single_tag->term_id)) . '">' . esc_html($single_tag->name) . '</a>';
                }
            }
        }
    }
endif;

/*-----------------------------
	RANDOM SINGLE CATEGORY
------------------------------*/
if (!function_exists('aai_random_category_retrip')) :

    function aai_random_category_retrip()
    {

        $blog_cat_show   = aai_option('blog_category', 1);
        $single          = aai_option('blog_category_single', 1);

        // post details page 
        if (is_singular('post')) {

            if (!aai_option('blog_single_banner_show', 1)) {
                return;
            }
        }

        if (!get_the_category()) {
            return;
        }

        if (!$blog_cat_show) {
            return;
        }

        if ('post' === get_post_type()) {

            $category        = get_the_category();
            $cat_count       = count($category);
            $single_cat      = $category[random_int(0, $cat_count - 1)];


            if ($single) {
                echo   '<a 	class="post-cate" href="' . esc_url(get_category_link($single_cat->term_id)) . '"><i class="fal fa-folder" aria-hidden="true"></i>' .
                    esc_html(get_cat_name($single_cat->term_id)) .
                    '</a>';
            } else {

                foreach ($category as $value) :
                    echo   '<a 	class="post-cate" href="' . esc_url(get_category_link($value->term_id)) . '"><i class="fal fa-folder" aria-hidden="true"></i>' .
                        esc_html(get_cat_name($value->term_id)) .
                        '</a>';
                endforeach;
            }
        }
    }

endif;

/*--------------------------
    POSTS PAGINATION
---------------------------*/

if (!function_exists('aai_pagination')) {
    function aai_pagination()
    {
        the_posts_pagination(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="ti-arrow-left"></i>',
            'next_text'          => '<i class="ti-arrow-right"></i>',
            'type'               => 'list',
            'mid_size'           => 1,
        ));
    }
}

/*----------------------
    SINGLE POST NAVIGATION
------------------------*/
if (!function_exists('aai_post_navigation')) {
    function aai_post_navigation()
    {
        global $post;
        $next_post = get_adjacent_post(false, '', false);
        $prev_post = get_adjacent_post(false, '', true);
        ?>
        <div class="single-post-navigation clearfix">

            <?php if (!empty($prev_post)) : ?>
                <div class="prev-post">
                    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                        <div class="arrow-link">
                            <i class="fa fa-arrow-left"></i>
                        </div>
                        <div class="title-with-link">
                            <span><?php esc_html_e('Prev Post', 'aai') ?></span>
                            <h3><?php echo esc_html(wp_trim_words($prev_post->post_title, 4, '.')); ?></h3>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <div class="single-post-navigation-center-grid">
                <a href="<?php echo esc_url(home_url('/')) ?>"><i class="fa fa-th-large"></i></a>
            </div>

            <?php if (!empty($next_post)) : ?>
                <div class="next-post">
                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                        <div class="title-with-link">
                            <span><?php esc_html_e('Next Post', 'aai') ?></span>
                            <h3><?php echo esc_html(wp_trim_words($next_post->post_title, 4, '.')); ?></h3>
                        </div>
                        <div class="arrow-link">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    <?php
    }
}

/*--------------------------------
    GET COMMENT COUNT TEXT
----------------------------------*/
if (!function_exists('aai_comment_count_text')) {
    function aai_comment_count_text($post_id)
    {
        $comments_number = get_comments_number($post_id);
        if ($comments_number == 0) {
            $comment_text = esc_html__('No comment', 'aai');
        } elseif ($comments_number == 1) {
            $comment_text = esc_html__('One comment', 'aai');
        } elseif ($comments_number > 1) {
            $comment_text = $comments_number . esc_html__(' Comments', 'aai');
        }
        echo esc_html($comment_text);
    }
}

/*------------------------
    COMMENTS PAGINATION
-------------------------*/
if (!function_exists('aai_comments_pagination')) {
    function aai_comments_pagination()
    {
        the_comments_pagination(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="ti-arrow-left"></i>',
            'next_text'          => '<i class="ti-arrow-right"></i>',
            'type'               => 'list',
            'mid_size'           => 1,
        ));
    }
}

/*------------------------
    COMMENTS NAVIGATION
-------------------------*/
if (!function_exists('aai_comments_navigation')) {
    function aai_comments_navigation()
    {
        the_comments_navigation(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="ti ti-angle-double-left"></i> ' . esc_html__('Older Comments', 'aai'),
            'next_text'          => esc_html__('Newer Comments', 'aai') . ' <i class="ti ti-angle-double-right"></i>',
        ));
    }
}

/*------------------------------
    CUSTOM COMMENT
--------------------------------*/
if (!function_exists('aai_comment')) {
    function aai_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
    ?>

        <?php if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>
            <li id="comment-<?php comment_ID() ?>" class="single-comment pingback-comment">

                <div class="comment-details">
                    <div class="comment-meta">
                        <h4><?php comment_author_link(); ?></h4>
                        <a class="comment-date" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                            <?php printf(esc_html__('%1s', 'aai'), get_comment_date()); ?>
                        </a>
                    </div>
                    <div class="comment-content">
                        <?php wpautop(comment_text()); ?>
                    </div>
                    <div class="comment-edit">
                        <?php edit_comment_link(esc_html__('Edit Comment', 'aai')); ?>
                    </div>
                </div>

            <?php endif; ?>

            <?php if (get_comment_type() == 'comment') : ?>
            <li id="comment-<?php comment_ID() ?>" class="single-comment">
                <div class="comment-details">
                    <div class="comment-author">
                        <?php
                        $avatar_size = 100;
                        if ($comment->comment_parent != '0') {
                            $avatar_size = 80;
                        }
                        echo get_avatar($comment->comment_author_email, $avatar_size);
                        ?>
                    </div>
                    <div class="comment-meta">
                        <div class="comment-left-meta ">
                            <h4 class="author-name"><?php comment_author_link(); ?></h4>
                            <a class="comment-date" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                                <?php printf(esc_html__('%1s', 'aai'), get_comment_date()); ?>
                            </a>
                        </div>
                    </div>
                    <div class="comment-content">
                        <?php wpautop(comment_text()); ?>
                    </div>
                    <div class="comment-reply">
                        <?php
                        comment_reply_link(
                            array_merge(
                                $args,
                                array(
                                    'depth'      => $depth,
                                    'max_depth'  => $args['max_depth'],
                                    'reply_text' => '<i class="fal fa-reply"></i>' . esc_html__('Reply', 'aai'),
                                )
                            )
                        );
                        ?>
                    </div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'aai'); ?></em><br />
                    <?php endif; ?>
                </div>
            <?php endif; ?>
    <?php
    }
}
