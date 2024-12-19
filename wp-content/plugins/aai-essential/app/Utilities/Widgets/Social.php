<?php

// Control core classes for avoid errors
if (class_exists('CSF')) {

  //
  // Create a about widget
  //
  CSF::createWidget('aai_essential_social', array(
    'title'       => esc_html__('Aai Social', 'aai-essential'),
    'classname'   => 'qstm-widget social',
    'description' => esc_html__('Social', 'aai-essential'),
    'fields'      => array(

      array(
        'id'      => 'title',
        'type'    => 'text',
        'title'   => esc_html__('Title', 'aai-essential'),
      ),


      array(
        'id'     => 'social_list',
        'type'   => 'repeater',
        'title'  => esc_html__('Social List', 'aai-essential'),
        'fields' => array(

          array(
            'id'    => 'social_icon',
            'type'  => 'icon',
            'title' => esc_html__('Icon', 'aai-essential'),
          ),
          array(
            'id'      => 'social_url',
            'type'    => 'text',
            'title'   => esc_html__('Url', 'aai-essential'),
          ),

        ),
      ),


    )
  ));

  if (!function_exists('aai_essential_social')) {
    function aai_essential_social($args, $instance)
    {

      echo $args['before_widget'];

      if (!empty($instance['title'])) {
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
      }

?>

      <?php if (is_array($instance['social_list'])) : ?>
        <div class="footer-about-widget">
          <div class="social">
            <ul>

              <?php foreach ($instance['social_list'] as $item) : ?>
                <li>
                  <a class="fac" href="<?php echo esc_url($item['social_url']); ?>"><i class="<?php echo esc_attr($item['social_icon']); ?>"></i></a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endif; ?>

<?php

      echo $args['after_widget'];
    }
  }
}
