<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;
use Element_Ready_Pro\Base\Traits\Helper as Utility;

class Conditional_Widgets extends Conditional {
    use Utility;  
    public function register(){
        
        if( $this->element_ready_get_modules_option('pro_conditional_content') ) { 
           
            add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'add_controls_section' ], 1 );
            add_action( 'elementor/frontend/widget/should_render', [ $this, 'filter_section' ], 10,2 );
            add_action( 'elementor/frontend/before_render', [ $this, 'before_render' ] );

        }
    }

    public function add_controls_section( Element_Base $element ){
           
            $element->start_controls_section(
              'element_ready_widget_conditinal_tags_section',
              [
                  'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
                  'label' => esc_html__( 'Conditional Content', 'element-ready' ),
              ]
            );

                $element->add_control(
                    'element_ready_pro_conditianal_tag_active',
                    [
                        'label'        => esc_html__('Enable', 'element-ready'),
                        'type'         => Controls_Manager::SWITCHER,
                        'default'      => '',
                        'return_value' => 'yes',
                    
                    ]
                );

                $element->add_control(
                    'element_ready_pro_conditional_important_note',
                    [
                        'label' => esc_html__( 'Important Note', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::RAW_HTML,
                        'raw' => esc_html__( 'Please check change in frontend view', 'element-ready-pro' ),
                       
                    ]
                );

                $repeater = new \Elementor\Repeater();

                $repeater->add_control(
                    'list_title', [
                        'label' => esc_html__( 'Title', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'List Title' , 'element-ready' ),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'condition',
                    [
                        'label'   => esc_html__( 'Condition', 'element-ready' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'login_status'    => esc_html__( 'Login Status', 'element-ready' ),
                            'date_time'       => esc_html__( 'Date And Time', 'element-ready' ),
                            'current_page'    => esc_html__( 'Current Post / Page', 'element-ready' ),
                            'current_archive' => esc_html__( 'Current archive', 'element-ready' ),
                           
                        ],
                    ]
                );


                // Current Archive start
                $repeater->add_control(
                    'archive_where',
                    [
                        'label'   => esc_html__( 'Where', 'element-ready' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'match'     => esc_html__( 'Match', 'element-ready' ),
                            'not_match' => esc_html__( 'Not Match', 'element-ready' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_archive']
                        ]
                    ]
                );

                $repeater->add_control(
                    'archive_template',
                    [
                        'label'   => esc_html__( 'With', 'element-ready' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'none'   => esc_html__( 'None', 'element-ready' ),
                            'is_home'   => esc_html__( 'Home', 'element-ready' ),
                            'is_search' => esc_html__( 'Search', 'element-ready' ),
                            'is_tag'    => esc_html__( 'Category', 'element-ready' ),
                            'is_404'    => esc_html__( '404', 'element-ready' ),
                            'is_author' => esc_html__( 'Author', 'element-ready' ),
                            'is_tag'    => esc_html__( 'Tag', 'element-ready' ),
                            'is_page'    => esc_html__( 'Page', 'element-ready' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_archive']
                        ]
                    ]
                );
                // end Current Archive
                // Current page

                $repeater->add_control(
                    'page_where',
                    [
                        'label'   => esc_html__( 'Where', 'element-ready' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'match'    => esc_html__( 'Match', 'element-ready' ),
                            'not_match'  => esc_html__( 'Not Match', 'element-ready' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_page']
                        ]
                    ]
                );

                $repeater->add_control(
                    'post_ids',
                    [
                        'label'       => esc_html__( 'Post ids', 'element-ready' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => '',
                        'placeholder' => esc_html__( '15,25,989', 'element-ready' ),
                        'description' => esc_html__( 'Give posts id with commas', 'element-ready' ),
                        'condition'    => [
                            'condition' => ['current_page'],
                        ]
                    ]
                );

                $repeater->add_control(
                    'page_where2',
                    [
                        'label' => esc_html__( 'Where', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            ''    => esc_html__( 'None', 'element-ready' ),
                            'or'  => esc_html__( 'Or', 'element-ready' ),
                            'and' => esc_html__( 'And', 'element-ready' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_page'],
                        ]
                    ]
                );

                $repeater->add_control(
                    'post_templates',
                    [
                        'label'   => esc_html__( 'Post Templates', 'element-ready' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'groups' => element_ready_get_post_templates() ,
                        'condition'    => [
                            'page_where2!' => [''],
                            'condition' => ['current_page']
                        ]
                    ]
                );
        
                // end current page

                // Login Status
                $repeater->add_control(
                    'login_status',
                    [
                        'label' => esc_html__( 'Is', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'is'  => esc_html__( 'Is', 'element-ready' ),
                            'is_not' => esc_html__( 'Is Not', 'element-ready' ),
                        ],
                        'condition'    => [
                            'condition' => ['login_status']
                        ]
                    ]
                );

                $repeater->add_control(
                    'login',
                    [
                        'label' => esc_html__( 'Login', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'logged_in'  => esc_html__( 'Logged In', 'element-ready' ),
                            'logged_in_role' => esc_html__( 'Logged In With Role', 'element-ready' ),
                        ],
                        'condition'    => [
                            'condition' => ['login_status']
                        ]
                    ]
                );

                $repeater->add_control(
                    'role',
                    [
                        'label' => esc_html__( 'User Role with logged in', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'options' => element_ready_get_editable_roles(true),
                        'multiple' => true,
                        'condition'    => [
                            'login' => ['logged_in_role'],
                            'login_status' => ['is'],
                            'condition' => ['login_status']
                        ]
                    ]
                );

                
                // End login status
                // Date Time

                $repeater->add_control(
                    'date_range',
                    [
                        'label'        => esc_html__('Date Range', 'element-ready'),
                        'type'         => Controls_Manager::SWITCHER,
                        'default'      => '',
                        'return_value' => 'yes',
                        'condition'    => [
                            'condition' => ['date_time'],
                           
                        ]
                    
                    ]
                );

                $repeater->add_control(
                    'due_date',
                    [
                        'label' => esc_html__( 'Due Date', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::DATE_TIME,
                        'condition'    => [
                            'condition' => ['date_time'],
                            'date_range!' => ['yes'],
                        ]
                    ]
                );

                $repeater->add_control(
                    'date_from',
                    [
                        'label' => esc_html__( 'From', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::DATE_TIME,
                        'condition'    => [
                            'condition' => ['date_time'],
                            'date_range' => ['yes'],
                        ]
                    ]
                );

                $repeater->add_control(
                    'date_to',
                    [
                        'label' => esc_html__( 'To', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::DATE_TIME,
                        'condition'    => [
                            'condition' => ['date_time'],
                            'date_range' => ['yes'],
                        ]
                    ]
                );
        
                // end Date Time

                $element->add_control(
                    'element_ready_condition_list',
                    [
                        'label' => esc_html__( 'Conditions', 'element-ready' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'title_field' => '{{{ list_title }}}',
                        'condition'    => [
                            'element_ready_pro_conditianal_tag_active' => ['yes']
                        ]
                    ]
                );

            $element->end_controls_section();
    }

    public function filter_section($should , $widget){

        $settings   = $widget->get_settings_for_display();
        $active     = $settings['element_ready_pro_conditianal_tag_active'];
       
        if($active=='yes'){
            return $this->list($settings);
        }
        return true;
    }
    public function before_render($element){
      //error_log("before_render");
    }

   

}