<?php

$copyright_text       = aai_option('copyright_text', 'Copyright © 2023 All rights reserved.');
$override_footer      = aai_meta_option(get_the_id(), 'override_footer', 0);
$topbar_layout        = 'layout-1';
$page_topbar_layout   = aai_meta_option(get_the_id(), 'footer_topbar_layout', 'layout-1');
$footer_topbar_layout = aai_option('footer_topbar_layout');

$no_topbar_cls        = 'with-top-bar';
$footer_multi_buttons = aai_option('footer_multi_buttons', []);


?>

<!--====== FOOTER PART START ======-->
<footer class="footer-1 aai-footer-area footer-area <?php echo esc_attr($no_topbar_cls); ?> <?php echo esc_attr(aai_is_footer_widget_active() ? 'with-widget' : 'no-widget'); ?>">
    <div class="container">

        <?php if (aai_is_footer_widget_active()) : ?>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-xs-12">
                    <?php dynamic_sidebar('footer-one'); ?>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12">
                    <?php dynamic_sidebar('footer-two'); ?>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12">
                    <?php dynamic_sidebar('footer-three'); ?>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12">
                    <?php dynamic_sidebar('footer-four'); ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- Copyrigh -->
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copyright d-flex align-items-center justify-content-between pt-35">
                    <div class="apps-download-btn">
                        <ul>
                            <?php foreach ($footer_multi_buttons as $k => $button) : ?>
                                <li>
                                    <a class="<?php echo esc_attr('item-' . ++$k) ?>" href="<?php echo esc_url($button['link']); ?>">
                                        <?php if ($button['icon'] != '') : ?>
                                            <i class="<?php echo esc_attr($button['icon']); ?>"></i>
                                        <?php endif; ?>
                                        <?php echo esc_html($button['content']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="copyright-text">
                        <p> <?php echo aai_kses($copyright_text); ?> </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyrigh -->
    </div>
</footer>

<!--====== FOOTER PART ENDS ======-->