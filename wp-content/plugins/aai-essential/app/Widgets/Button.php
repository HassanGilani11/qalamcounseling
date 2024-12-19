<?php

namespace AaiEssential\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit;


class Button extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'aai-appiie-button';
    }

    public function get_title()
    {
        return esc_html__('Test Button', 'aai-essential');
    }

    public function get_icon()
    {
        return 'eicon-dual-button';
    }

    public function get_categories()
    {
        return ['aai-elements'];
    }

    public function get_keywords()
    {
        return ['button', 'duel', 'duel button', 'App store'];
    }

    protected function register_controls()
    {


        $this->start_controls_section(
            'section_button_tab',
            [
                'label' => esc_html__('Test Button settings', 'aai-essential'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'       => esc_html__('Button Text', 'aai-essential'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More',
                'placeholder' => esc_html__('Button text here', 'aai-essential'),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'       => esc_html__('Button Url', 'aai-essential'),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    } //Register control end

    protected function render()
    {

        $settings    = $this->get_settings();


?>
        <a class="test-btn" href="<?php $settings['button_url'] ?>"><?php echo $settings['button_text'] ?></a>

<?php

    }

    protected function content_template()
    {
    }
}
