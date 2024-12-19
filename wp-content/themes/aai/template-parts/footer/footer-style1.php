<?php

$copyright_text       = aai_option('copyright_text', 'Copyright © 2023 All rights reserved.');
$footer_multi_buttons = aai_option('footer_multi_buttons', []);

?>

<!--====== FOOTER PART START ======-->
<footer class="footer-1 aai-footer-area footer-area <?php echo esc_attr(aai_is_footer_widget_active() ? 'with-widget' : 'no-widget'); ?>">
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
                <div class="<?php echo esc_attr(aai_is_footer_widget_active() ? '' : 'without-widget-bar') ?> <?php echo esc_attr(empty($footer_multi_buttons) ? 'justify-content-center' : 'justify-content-between'); ?> footer-copyright d-flex align-items-center pt-35">
                    <?php if (is_array($footer_multi_buttons) && !empty($footer_multi_buttons)) : ?>
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
                    <?php endif; ?>
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