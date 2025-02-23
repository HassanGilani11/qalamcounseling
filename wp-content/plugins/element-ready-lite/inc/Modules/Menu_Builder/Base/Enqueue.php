<?php
/**
 * @package  Mega menu
 */
namespace Element_Ready\Modules\Menu_Builder\Base;

use Element_Ready\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        // admin
        add_action('admin_enqueue_scripts', array($this, 'backend'));
        add_action('elementor/frontend/after_register_styles', array($this, 'frontend'));
        add_action('elementor/frontend/after_register_scripts', array($this, 'elementor_frontend'));
        add_action('wp_head', array($this, 'critical_menu_css'));

    }


    public function critical_menu_css()
    { ?>
        <style type="text/css">
            .element-ready-style-3.element-ready-header-nav .navigation .navbar {
                position: relative;
                padding: 0;
                flex-wrap: inherit;
                display: flex;
                justify-content: space-between
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .country-flag img {
                border: 5px solid #fff;
                border-radius: 6px;
                box-shadow: 0 8px 16px 0 rgba(60, 110, 203, .2)
            }

            .element-ready-style-3 .navigation .navbar .navbar-toggler {
                border: 0
            }

            .element-ready-style-3 .navigation .navbar .navbar-toggler .toggler-icon {
                width: 30px;
                height: 2px;
                background-color: #222;
                margin: 5px 0;
                display: block;
                position: relative;
                transition: all .3s ease-out 0s
            }

            .element-ready-style-3 .navigation .navbar .navbar-toggler.active .toggler-icon:nth-of-type(1) {
                transform: rotate(45deg);
                top: 7px
            }

            .element-ready-style-3 .navigation .navbar .navbar-toggler.active .toggler-icon:nth-of-type(2) {
                opacity: 0
            }

            .element-ready-style-3 .navigation .navbar .navbar-toggler.active .toggler-icon:nth-of-type(3) {
                transform: rotate(135deg);
                top: -7px
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-collapse {
                    position: absolute;
                    top: 128%;
                    left: 0;
                    width: 100%;
                    background-color: #fff;
                    z-index: 8;
                    padding: 10px 16px;
                    box-shadow: 0 26px 48px 0 rgba(0, 0, 0, .15)
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav {
                list-style-type: none;
                margin: 0;
                padding: 0;
                display: table
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav {
                    margin-right: 0
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav.right-menu .nav-item a {
                text-align: center
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav.right-menu .nav-item .sub-menu>li a i {
                float: left
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav.right-menu .nav-item .sub-menu>li .sub-menu {
                left: auto;
                right: 100%
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav.right-menu .nav-item .sub-menu>li .sub-menu li .sub-menu {
                left: auto;
                right: 100%
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item {
                position: relative;
                padding: 10px
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item.element-ready-mega-menu-item {
                position: static
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item>a {
                font-size: 16px;
                font-weight: 400;
                color: #222;
                text-transform: capitalize;
                position: relative;
                transition: all .3s ease-out 0s;
                line-height: 45px;
                padding: 0
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item a>i {
                    display: none
                }
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item>a {
                    padding: 0;
                    display: block;
                    border: 0;
                    margin: 0;
                    line-height: 40px
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item a span.badge-manu {
                padding: .25em .4em;
                font-size: 75%
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item a span {
                padding-left: 5px;
                font-size: 15px
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item a span {
                    display: none
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item a i {
                padding-left: 6px
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item:first-child a {
                margin-left: 0
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item:last-child a {
                margin-right: 0
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu {
                position: absolute;
                left: 0;
                top: 110%;
                width: 205px;
                background-color: #fff;
                opacity: 0;
                visibility: hidden;
                transition: all linear .3s;
                z-index: 99;
                box-shadow: 0 2px 6px 0 rgba(0, 0, 0, .16);
                list-style-type: none;
                margin: 0;
                padding: 15px 0;
                border-radius: 5px
            }

            @media only screen and (min-width:1200px) and (max-width:1600px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu {
                    width: 150px
                }
            }

            @media only screen and (min-width:992px) and (max-width:1200px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu {
                    width: 150px
                }
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu {
                    position: relative;
                    width: 100%;
                    left: 0;
                    top: auto;
                    opacity: 1;
                    visibility: visible;
                    display: none;
                    right: auto;
                    transform: translateX(0);
                    transition: all none ease-out 0s;
                    box-shadow: none;
                    text-align: left;
                    border-top: 0;
                    transition: 0s;
                    padding: 0
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li {
                position: relative
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu {
                margin-left: 0
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu {
                    margin-left: 0
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-nav-toggler {
                color: #404040;
                transition: all .3s ease-out 0s
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li a {
                display: block;
                padding: 0 30px;
                position: relative;
                color: #222;
                transition: all .3s ease-out 0s;
                border-radius: 4px;
                margin: 0 0;
                line-height: 2.5
            }

            @media only screen and (min-width:1200px) and (max-width:1600px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li a {
                    padding: 0 20px
                }
            }

            @media only screen and (min-width:992px) and (max-width:1200px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li a {
                    padding: 0 20px
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li a i {
                float: right;
                font-size: 16px;
                margin-top: 10px
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li a i {
                    display: none
                }
            }

            .element-ready-style-3 .element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li a .sub-nav-toggler i {
                display: inline-block
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu {
                right: auto;
                left: 100%;
                top: 50%;
                opacity: 0;
                visibility: hidden;
                transition: all .3s ease-out 0s
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu {
                    padding-left: 30px;
                    transition: all 0s ease-out 0s
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu li {
                position: relative
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu li .sub-menu {
                right: auto;
                left: 100%;
                top: 50%;
                opacity: 0;
                visibility: hidden;
                transition: all .3s ease-out 0s
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li .sub-menu li:hover .sub-menu {
                top: 0;
                opacity: 1;
                visibility: visible
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li:hover .sub-menu {
                top: 0;
                opacity: 1;
                visibility: visible
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li:hover .sub-nav-toggler {
                color: #8b5bff
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-menu>li:hover>a {
                color: #8b5bff
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item:hover .sub-menu {
                opacity: 1;
                visibility: visible;
                top: 100%
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-nav-toggler {
                display: none
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-nav .nav-item .sub-nav-toggler {
                    display: inline-block;
                    position: absolute;
                    top: 0;
                    right: 0;
                    padding: 0;
                    font-size: 16px;
                    background: 0 0;
                    border: 0;
                    color: #222
                }
            }

            @media (max-width:767px) {
                .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-btn {
                    position: absolute;
                    right: 70px;
                    top: 50%;
                    transform: translateY(-50%)
                }
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-btn>a:hover {
                background: #8b5bff;
                border-color: #8b5bff;
                color: #fff
            }

            .element-ready-style-3.element-ready-header-nav .navigation .navbar .navbar-btn .canvas-bar img {
                cursor: pointer
            }

            .element-ready-style-3 .element-ready-navbar .menu-item {
                display: inline-block
            }

            .element-ready-style-3 .element-ready-navbar .menu-item .element-ready-sub-menu .nav-item {
                display: block
            }

            .element-ready-style-3 .element-ready-navbar .menu-item .element-ready-sub-menu .nav-item>a {
                border-right: 0 !important
            }

            .element-ready-style-3 .element-ready-navbar .navigation .navbar .navbar-nav>.nav-item {
                display: inline-block
            }

            .element-ready-style-3 .element-ready-navbar .mega-menu {
                position: absolute;
                left: 0;
                right: 0;
                top: 110%;
                visibility: hidden;
                opacity: 0;
                z-index: 5;
                width: 100%;
                min-width: 200px;
                padding: 11px 25px 15px;
                background: #fff;
                -webkit-box-shadow: 0 10px 30px 0 rgb(35 47 62 / 25%);
                -moz-box-shadow: 0 10px 30px 0 rgba(35, 47, 62, .25);
                box-shadow: 0 10px 30px 0 rgb(35 47 62 / 25%);
                -webkit-transition: all .3s ease;
                -o-transition: all .3s ease;
                transition: all .3s ease;
                margin-left: auto;
                margin-right: auto
            }

            .element-ready-style-3 .element-ready-mega-menu-item .mega-menu {
                left: 50%;
                width: 165%;
                transform: translateX(-50%)
            }

            .element-ready-style-3 .element-ready-header-nav .navbar-nav li:hover .mega-menu,
            .navbar .navbar-nav li:hover .mega-menu {
                visibility: visible;
                opacity: 1;
                top: 100%
            }

            .er-mega-menu-builder>.element-ready-submenu-section {
                display: none
            }
        </style>
    <?php }

    public function frontend()
    {

        wp_register_style('er-round-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-round-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-offcanvas-min-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-offcanvas-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-offcanvas-slide-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-offcanvas-slide.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-standard-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-standard-round', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-round.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-standard-5-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-5-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-standard-offcanvas', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-standard-offcanvas.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-mobile-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-mobile-menu.css', false, ELEMENT_READY_VERSION);
        wp_register_style('er-menu-off-canvas', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/er-menu-off-canvas.css', false, ELEMENT_READY_VERSION);

    }

    public function elementor_frontend()
    {

        wp_register_script('element-ready-menu-frontend-script', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/frontend.js', ['jquery', 'stellarnav'], ELEMENT_READY_VERSION);
        wp_register_script('element-ready-vartical-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/vartical.js', array('jquery'), ELEMENT_READY_VERSION);
        wp_register_script('er-round-menu', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/er-round-menu.js', array('jquery'), ELEMENT_READY_VERSION);
        wp_register_style('stellarnav', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/stellarnav.min.css', null, ELEMENT_READY_VERSION);
        wp_register_style('element-ready-mega-menu-frontend', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/frontend' . ELEMENT_READY_SCRIPT_VAR . 'css');
        wp_register_style('element-ready-mega-menu-style', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/style' . ELEMENT_READY_SCRIPT_VAR . 'css');
        wp_register_script('stellarnav', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/stellarnav.min.js', array('jquery'));

    }

    function backend($handle)
    {
        // enqueue all our scripts
        if ('nav-menus.php' != $handle) {
            return;
        }

        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_register_style('nifty', ELEMENT_READY_ROOT_CSS . 'nifty.css');
        wp_register_script('nifty', ELEMENT_READY_ROOT_JS . 'nifty.js', array('jquery'), ELEMENT_READY_VERSION, true);
        wp_enqueue_style('element-ready-mega-menu-backend', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/css/backend.css', ['nifty'], time());
        wp_enqueue_script('element-ready-mega-menu-backend-script', ELEMENT_READY_MEGA_MENU_MODULE_URL . 'assets/js/backend.js', array('jquery', 'underscore', 'nifty'), time());

        $mege_menu_obj = array(
            'ajax_url' => esc_url_raw(admin_url('admin-ajax.php')),
            'nonce' => wp_create_nonce('element_ready_mega_menu_metabox_nonce'),
            'menu_id' => sanitize_text_field(isset($_REQUEST['menu']) ? $_REQUEST['menu'] : null),
            'mega_menu_title' => esc_html__('Mega Menu', 'element-ready-lite')
        );

        wp_localize_script('element-ready-mega-menu-backend-script', 'mege_menu_obj', $mege_menu_obj);
    }




}