<?php 
namespace Element_Ready_Pro\Modules\Blog\Settings;
use Element_Ready\Base\BaseController;
use Element_Ready_Pro\Modules\Blog\Templates\Base as Base;
class Blog_Comment extends Base
{
    public $tpl_type = 'post';
	public function register() 
	{
        $template_id   = $this->get_active_data();
        return;
        if( $template_id > 1 ){
            
            add_filter( 'comment_form_defaults' , [ $this , '_comment_form_defaults' ] , 10 );
            add_filter( 'comment_form_default_fields' , [ $this , '_comment_form_default_fields' ] ,10 );
        }
	
	}
    
    function _comment_form_defaults( $defaults ) {
      
        global $aria_req;
        $defaults = array(
            'class_form'    => 'comment-form',
            'title_reply'   => esc_html__( 'Leave A Comment', 'element-ready-pro' ),
            'comment_field' => '<div class="form-group">
                                    <textarea name="comment" placeholder="'.esc_attr__( 'Your Comment here', 'element-ready-pro' ).'" '.$aria_req.' rows="10" data-source="element-ready"></textarea>    
                                </div>',
            'comment_notes_before'  => '',
            'label_submit'  => esc_html__( 'Post Comment', 'element-ready-pro' ),
        );

        return $defaults;
    } 

    function _comment_form_default_fields($fields){
        global $aria_req;
        $commenter     = wp_get_current_commenter();
        $req           = get_option( 'require_name_email' );
        $aria_req      = ($req ? " aria-required='true' " : '');
        $required_text = ' ';    
        $fields        =  array(
            'author'   => '<div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="author" value="'.esc_attr( $commenter['comment_author'] ).'" '.$aria_req.' placeholder="'.esc_attr__( 'Your Name *', 'element-ready-pro' ).'">
                            </div>',
            'email'    => '<div class="col-sm-6">
                                <input type="email" name="email" value="'.esc_attr( $commenter['comment_author_email'] ).'" '.$aria_req.' placeholder="'.esc_attr__( 'Your Email *', 'element-ready-pro' ).'">
                            </div>
                        </div>
                    </div>',
            'url'      => '<div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="url" name="url" value="'.esc_url( $commenter['comment_author_url'] ).'" '.$aria_req.' placeholder="'.esc_attr__( 'Your Website', 'element-ready-pro' ).'">
                                    </div>
                                </div>
                            </div>'
        );
        return $fields;
    }
 
 
}