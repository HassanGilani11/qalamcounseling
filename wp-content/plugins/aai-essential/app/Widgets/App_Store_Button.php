<?php

namespace AaiEssential\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit;


class App_Store_Button extends Widget_Base
{

    public $base;

    public function get_name()
    {
        return 'aai-app-store-button';
    }

    public function get_title()
    {
        return esc_html__('Appstore Button', 'aai-essential');
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
                'label' => esc_html__('App Store Button settings', 'aai-essential'),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__('Style', 'aai-essential'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Duel Button', 'aai-essential'),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title ', 'aai-essential'),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => esc_html__('Use \n for new line break.'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'content',
            [
                'label'       => esc_html__('Content', 'aai-essential'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label'       => esc_html__('Button Url', 'aai-essential'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__('Choose Icon', 'aai-essential'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => AAI_ESSENTIAL_IMG . '/btn.png',
                ],
            ]
        );


        $this->add_control(
            'button_2',
            [
                'label' => esc_html__('Button 2', 'aai-essential'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'button_url_2',
            [
                'label'       => esc_html__('Button 2 Url', 'aai-essential'),
                'type'        => Controls_Manager::URL,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'icon2',
            [
                'label' => __('Choose Icon 2', 'aai-essential'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => AAI_ESSENTIAL_IMG . '/btn2.png',
                ],
            ]
        );


        $this->add_responsive_control(
            'title_align',
            [
                'label'   => esc_html__('Alignment', 'aai-essential'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [

                    'left'         => [

                        'title' => esc_html__('Left', 'aai-essential'),
                        'icon'  => 'fa fa-align-left',

                    ],
                    'center'         => [

                        'title' => esc_html__('Center', 'aai-essential'),
                        'icon'  => 'fa fa-align-center',

                    ],
                    'right'     => [

                        'title' => esc_html__('Right', 'aai-essential'),
                        'icon'  => 'fa fa-align-right',

                    ],
                    'justify'     => [

                        'title' => esc_html__('Justified', 'aai-essential'),
                        'icon'  => 'fa fa-align-justify',

                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .appstore-section' => 'text-align: {{VALUE}};',


                ],
            ]
        ); //Responsive control end
        $this->end_controls_section();

        $this->start_controls_section(
            'section_shape_tab',
            [
                'label' => esc_html__('Media settings', 'aai-essential'),
                'condition' => ['style' => ['style1', 'style2']],
            ]
        );

        $this->add_control(
            'disable_image',
            [
                'label'        => esc_html__('Enable image', 'aai-essential'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'aai-essential'),
                'label_off'    => esc_html__('No', 'aai-essential'),
                'return_value' => 'yes',
                'default'      => 'yes',

            ]
        );

        $this->add_control(
            'left_image',
            [
                'label' => esc_html__('Choose left Image', 'aai-essential'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'right_image',
            [
                'label' => esc_html__('Choose right Image', 'aai-essential'),
                'type'  => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_section_title_style',
            [
                'label' => esc_html__('Heading Title', 'aai-essential'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'heading_title_color',
            [

                'label'         => esc_html__('Title color', 'aai-essential'),
                'type'         => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',


                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_title_typho',
                'label'    => esc_html__('Typography', 'aai-essential'),

                'selector' => '{{WRAPPER}} .title',

            ]
        );
        $this->add_control(
            'heading_bold_text_heading1',
            [
                'label' => esc_html__('Normal Text', 'aai-essential'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );



        $this->add_responsive_control(
            'heading_title_section_padding',
            [
                'label'      => esc_html__('Padding', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [

                    '{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',


                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_title_section_margin',
            [
                'label'      => esc_html__('Margin', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'heading_section_content_style',
            [
                'label' => esc_html__('Heading Content', 'aai-essential'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'heading_content_color',
            [

                'label'         => esc_html__('Color', 'aai-essential'),
                'type'         => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .content' => 'color: {{VALUE}};',


                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_content_typho',
                'label'    => esc_html__('Typography', 'aai-essential'),

                'selector' => '{{WRAPPER}} .content',

            ]
        );


        $this->add_responsive_control(
            'heading_content_section_padding',
            [
                'label'      => esc_html__('Padding', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [

                    '{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',


                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_content_section_margin',
            [
                'label'      => esc_html__('Margin', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style2',
            [
                'label' => esc_html__('Button', 'aai-essential'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );



        $this->add_responsive_control(
            'button_section_padding2',
            [
                'label'      => esc_html__('Padding', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .aai-btn-3.one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_section_margin2',
            [
                'label'      => esc_html__('Margin', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .aai-btn-3.one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'button_section_border_radius2',
            [
                'label' => esc_html__('Border radius', 'aai-essential'),
                'type'  => \Elementor\Controls_Manager::NUMBER,
                'min'   => 0,
                'max'   => 200,
                'step'  => 1,

                'selectors' => [
                    '{{WRAPPER}} .aai-btn-3.one' => 'border-radius: {{VALUE}}px;',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'buttonone_input_section_background2',
                'label'    => esc_html__('Background', 'aai-essential'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .aai-btn-3.one',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button2_section_border',
                'label' => esc_html__('Border', 'aai-essential'),
                'selector' => '{{WRAPPER}} .aai-btn-3.one',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_button2_style2',
            [
                'label' => esc_html__('Button 2', 'aai-essential'),
                'tab'   => Controls_Manager::TAB_STYLE,

            ]
        );


        $this->add_responsive_control(
            'button2_section_padding2',
            [
                'label'      => esc_html__('Padding', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .aai-btn-3.two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'button2_section_margin2',
            [
                'label'      => esc_html__('Margin', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .aai-btn-3.two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'button2_input_section_background2',
                'label'    => esc_html__('Background', 'aai-essential'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .aai-btn-3.two',
            ]
        );




        $this->add_control(
            'button2_section_border_radius2',
            [
                'label' => esc_html__('Border radius', 'aai-essential'),
                'type'  => \Elementor\Controls_Manager::NUMBER,
                'min'   => 0,
                'max'   => 200,
                'step'  => 1,

                'selectors' => [
                    '{{WRAPPER}} .aai-btn-3.two' => 'border-radius: {{VALUE}}px;',

                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_2_section_border',
                'label' => esc_html__('Border', 'aai-essential'),
                'selector' => '{{WRAPPER}} .aai-btn-3.two',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'aai_main_section',
            [
                'label' => esc_html__('Section', 'aai-essential'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'     => 'main_section_background',
                'label'    => esc_html__('Background', 'aai-essential'),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .main-section',
            ]
        );

        $this->add_responsive_control(
            'section_box_margin',
            [
                'label'      => esc_html__('Margin', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            'section_box_padding',
            [
                'label'      => esc_html__('Padding', 'aai-essential'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'main_section_box_shadow',
                'label' => esc_html__('Box Shadow', 'aai-essential'),
                'selector' => '{{WRAPPER}} .main-section',
            ]
        );

        $this->end_controls_section();
    } //Register control end

    protected function render()
    {

        $settings    = $this->get_settings();


?>
        <?php if ($settings['style'] == 'style1') : ?>
            <!-- App Store Start -->
            <section class="appstore-section main-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-<?php echo esc_attr($settings['disable_image'] == 'yes' ? '5' : '12'); ?>">

                            <h2 class="sec-title title"> <?php echo wp_kses_post(str_replace(['\n'], ['</br>'], $settings['title'])); ?> </h2>

                            <p class="sec-desc content">
                                <?php echo esc_html($settings['content']); ?>
                            </p>

                            <?php if ($settings['icon']['url'] != '') : ?>
                                <a href="<?php echo esc_url($settings['button_url']); ?>" class="aai-btn-3 one"><img src="<?php echo esc_url($settings['icon']['url']); ?>" alt="<?php echo esc_attr__('Brand one', 'aai-essential'); ?>"></a>
                            <?php endif; ?>
                            <?php if ($settings['icon2']['url'] != '') : ?>
                                <a href="<?php echo esc_url($settings['button_url_2']); ?>" class="aai-btn-3 two"><img src="<?php echo esc_url($settings['icon2']['url']); ?>" alt="<?php echo esc_attr__('Brand 2', 'aai-essential'); ?>"></a>
                            <?php endif; ?>

                        </div>
                        <?php if ($settings['disable_image'] == 'yes') : ?>
                            <div class="col-lg-7">
                                <div class="app-img">
                                    <?php if ($settings['left_image']['url'] != '') : ?>
                                        <img src="<?php echo esc_url($settings['left_image']['url']); ?>" alt="<?php echo esc_attr__(' Brand Image 1', 'aai-essential'); ?>">
                                    <?php endif; ?>
                                    <?php if ($settings['right_image']['url'] != '') : ?>
                                        <img src="<?php echo esc_url($settings['right_image']['url']); ?>" alt="<?php echo esc_attr__(' Brand Image 2', 'aai-essential'); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!-- App Store End -->
        <?php endif; ?>




<?php

    }

    protected function content_template()
    {
    }
}
