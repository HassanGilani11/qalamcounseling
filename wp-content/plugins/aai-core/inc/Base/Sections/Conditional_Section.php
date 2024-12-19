<?php 
namespace Element_Ready_Pro\Base\Sections;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Element_Ready_Pro\Base\Traits\Helper as Utility;
use Elementor\Group_Control_Border;
use Elementor\Element_Base;

class Conditional_Section extends Section_Condition {
    use Utility;  
    
    public function register(){
       
        //if( $this->element_ready_get_modules_option('live_copy') ) { 
            add_action( 'wp_head', [$this, 'inline_script']);
             
            add_action( 'elementor/element/before_section_start', [ $this, 'add_controls_section' ],15,3 );
            add_action( 'elementor/frontend/section/after_render', array($this, 'after_section_render'), 12, 2);
        //}
       
    }

    public function add_controls_section(  $element, $section_id, $args ){
      

        if( 'section' === $element->get_name() && 'section_background' === $section_id ) {
           
        $element->start_controls_section(
            '_section_element_ready_pro_conditional_sec',
            [
                'label' => __( 'Conditional Section', 'element-ready-pro' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

                $element->add_control(
                    'element_ready_pro_conditional_section_btn_enable',
                    [
                        'label'        => esc_html__( 'Enable', 'element-ready-pro' ),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'label_on'     => esc_html__( 'Show', 'element-ready-pro' ),
                        'label_off'    => esc_html__( 'Hide', 'element-ready-pro' ),
                        'return_value' => 'yes',
                        'default'      => '',
                    ]
                );

                $repeater = new \Elementor\Repeater();

                $repeater->add_control(
                    'list_title', [
                        'label' => esc_html__( 'Title', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'List Title' , 'element-ready-pro' ),
                        'label_block' => true,
                    ]
                );

                $repeater->add_control(
                    'condition',
                    [
                        'label'   => esc_html__( 'Condition', 'element-ready-pro' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'login_status'    => esc_html__( 'Login Status', 'element-ready-pro' ),
                            'date_time'       => esc_html__( 'Date And Time', 'element-ready-pro' ),
                            'current_page'    => esc_html__( 'Current Post / Page', 'element-ready-pro' ),
                            'current_archive' => esc_html__( 'Current archive', 'element-ready-pro' ),
                           
                        ],
                    ]
                );


                // Current Archive start
                $repeater->add_control(
                    'archive_where',
                    [
                        'label'   => esc_html__( 'Where', 'element-ready-pro' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'match'     => esc_html__( 'Match', 'element-ready-pro' ),
                            'not_match' => esc_html__( 'Not Match', 'element-ready-pro' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_archive']
                        ]
                    ]
                );

                $repeater->add_control(
                    'archive_template',
                    [
                        'label'   => esc_html__( 'With', 'element-ready-pro' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'none'   => esc_html__( 'None', 'element-ready-pro' ),
                            'is_home'   => esc_html__( 'Home', 'element-ready-pro' ),
                            'is_search' => esc_html__( 'Search', 'element-ready-pro' ),
                            'is_tag'    => esc_html__( 'Category', 'element-ready-pro' ),
                            'is_404'    => esc_html__( '404', 'element-ready-pro' ),
                            'is_author' => esc_html__( 'Author', 'element-ready-pro' ),
                            'is_tag'    => esc_html__( 'Tag', 'element-ready-pro' ),
                            'is_page'    => esc_html__( 'Page', 'element-ready-pro' ),
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
                        'label'   => esc_html__( 'Where', 'element-ready-pro' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'match'    => esc_html__( 'Match', 'element-ready-pro' ),
                            'not_match'  => esc_html__( 'Not Match', 'element-ready-pro' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_page']
                        ]
                    ]
                );

                $repeater->add_control(
                    'post_ids',
                    [
                        'label'       => esc_html__( 'Post ids', 'element-ready-pro' ),
                        'type'        => \Elementor\Controls_Manager::TEXT,
                        'default'     => '',
                        'placeholder' => esc_html__( '15,25,989', 'element-ready-pro' ),
                        'description' => esc_html__( 'Give posts id with commas', 'element-ready-pro' ),
                        'condition'    => [
                            'condition' => ['current_page'],
                        ]
                    ]
                );

                $repeater->add_control(
                    'page_where2',
                    [
                        'label' => esc_html__( 'Where', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            ''    => esc_html__( 'None', 'element-ready-pro' ),
                            'or'  => esc_html__( 'Or', 'element-ready-pro' ),
                            'and' => esc_html__( 'And', 'element-ready-pro' ),
                        ],
                        'condition'    => [
                            'condition' => ['current_page'],
                        ]
                    ]
                );

                $repeater->add_control(
                    'post_templates',
                    [
                        'label'   => esc_html__( 'Post Templates', 'element-ready-pro' ),
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
                        'label' => esc_html__( 'Is', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'is'  => esc_html__( 'Is', 'element-ready-pro' ),
                            'is_not' => esc_html__( 'Is Not', 'element-ready-pro' ),
                        ],
                        'condition'    => [
                            'condition' => ['login_status']
                        ]
                    ]
                );

                $repeater->add_control(
                    'login',
                    [
                        'label' => esc_html__( 'Login', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            'logged_in'  => esc_html__( 'Logged In', 'element-ready-pro' ),
                            'logged_in_role' => esc_html__( 'Logged In With Role', 'element-ready-pro' ),
                        ],
                        'condition'    => [
                            'condition' => ['login_status']
                        ]
                    ]
                );

                $repeater->add_control(
                    'role',
                    [
                        'label' => esc_html__( 'User Role with logged in', 'element-ready-pro' ),
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
                        'label'        => esc_html__('Date Range', 'element-ready-pro'),
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
                        'label' => esc_html__( 'Due Date', 'element-ready-pro' ),
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
                        'label' => esc_html__( 'From', 'element-ready-pro' ),
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
                        'label' => esc_html__( 'To', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::DATE_TIME,
                        'condition'    => [
                            'condition' => ['date_time'],
                            'date_range' => ['yes'],
                        ]
                    ]
                );
        
                // end Date Time

                $element->add_control(
                    'element_ready_pro_conditional_content_list',
                    [
                        'label' => esc_html__( 'Conditions', 'element-ready-pro' ),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => $repeater->get_controls(),
                        'title_field' => '{{{ list_title }}}',
                        'condition'    => [
                            'element_ready_pro_conditional_section_btn_enable' => ['yes']
                        ]
                    ]
                );

        
        $element->end_controls_section();

       }

    }
    
    public function after_section_render( Element_Base $element)
    {

        $data     = $element->get_data();
        $settings = $data['settings'];
     
        if( isset( $settings[ 'element_ready_pro_conditional_section_btn_enable' ] ) && $settings[ 'element_ready_pro_conditional_section_btn_enable' ] == 'yes' ){
           
            $settings[ 'element_ready_pro_conditional_section_show' ] = $this->list( $settings );
           
            echo "
            <script>
                window.element_ready_pro_conditional_section_data.section".$data[ 'id' ]." = JSON.parse('".json_encode($settings)."');
               
            </script>
            ";

        }
       
    }
    public function inline_script(){
       
		echo '
            <script type="text/javascript">
            
				var element_ready_pro_conditional_section_data = {};
               
            </script>
  
		';

        echo '<style>

        .element-ready-pro-conditional-content-hide-if{
           display: none;
        }
       
      </style>';
	}

}  