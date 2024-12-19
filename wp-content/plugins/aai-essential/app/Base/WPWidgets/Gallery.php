<?php

namespace AaiEssential\Base\WPWidgets;

use AaiEssential\Base\BaseWPWidget;

class Gallery extends BaseWPWidget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'qstm-blog-gallery',
            'description' => esc_html__('Aai Gallery', 'aai-essential'),
        );
        parent::__construct('pu_gallery_upload', 'Gallery', $widget_ops);
        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
    }
    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_gmedia_widget', plugin_dir_url(__FILE__) . 'gallery/upload-media.js', array('jquery'));
        wp_enqueue_style('thickbox');
    }
    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    public function widget($args, $instance)
    {

        extract($args);

        // Our variables from the widget settings
        $image  = $instance['image'];
        $images = json_decode($image);

        print $before_widget;
?>
        <?php
        if (!empty($instance['title'])) {
            echo aai_return($args['before_title']) . apply_filters('widget_title', $instance['title']) . aai_return($args['after_title']);
        }
        ?>


        <div class="row instagran__area">
            <?php if (is_array($images)) : ?>
                <?php foreach ($images as $key => $item) : ?>
                    <div class="col-4">
                        <div class="single__instagram">
                            <img alt="<?php echo esc_attr('image-' . $key); ?>" src="<?php echo wp_get_attachment_image_url($item); ?>" />
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>





    <?php
        print $after_widget;
    }
    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    public function update($new_instance, $old_instance)
    {
        // update logic goes here
        $updated_instance = $new_instance;
        return $updated_instance;
    }
    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
    public function form($instance)
    {
        $users = get_users();

        $title = esc_html__('Ahost Gallery ', 'aai-essential');

        if (isset($instance['title'])) {
            $title = $instance['title'];
        }

        $defaults = array(

            'image'                => '',


        );
        $instance = wp_parse_args((array) $instance, $defaults);
        extract($instance);
        $images = json_decode($image);
    ?>

        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>

        <p>
            <input name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" class="widefat ga-image-list" type="hidden" size="36" value="<?php echo $image; ?>" />
        </p>

        <br />
        <input class="upload_gimage_button button" type="button" value="Upload  Image" />
        </p>
        <p class="mediguss-gimage-list">
            <?php if (is_array($images)) :  ?>
                <?php foreach ($images as $item) : ?>
                    <img width="120" height="100" src="<?php echo wp_get_attachment_image_url($item); ?> " />

                <?php endforeach; ?>
            <?php endif; ?>
        </p>


<?php
    }
}
?>