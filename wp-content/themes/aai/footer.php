        <?php

        // footer style option
        $footer        = aai_option("footer_style", "style1");
        $header_footer = aai_option('disable_header_footer', false);

        if (is_404()) {

            if (!$header_footer) {
                get_template_part('template-parts/footer/footer', $footer);
                get_template_part('template-parts/footer/back-to-top');
            }
        } else {

            get_template_part('template-parts/footer/footer', $footer);
            get_template_part('template-parts/footer/back-to-top');
        }

        ?>

        </div>
        <?php wp_footer(); ?>
        </body>

        </html>