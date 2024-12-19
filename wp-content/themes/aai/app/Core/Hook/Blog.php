<?php

namespace Aai\Core\Hook;

/**
 * Tags.
 */
class Blog
{
	/**
	 * register default hooks and actions for WordPress
	 * @return
	 */
	public function register()
	{

		add_filter('comment_form_defaults', [$this, 'add_submit_button_attr_class']);
		add_filter('get_search_form', [$this, 'search_form']);
		add_filter('render_block', [$this, 'search_render_block_core_group'], null, 2);
	}





	public function next_posts_link_attributes($attr)
	{
		return 'class="page-link"';
	}

	public function previous_posts_link_attributes($attr)
	{
		return 'class="page-link"';
	}

	public function search_form($form)
	{

		$form = '
			<form  method="get" action="' . esc_url(home_url('/')) . '" class="search-form">
			       
					<input name="s" type="search" placeholder="' . esc_attr__('Search here', 'aai') . '">
					<button type="submit"><i class="fal fa-search"></i></button>
				    
			</form>';
		return $form;
	}

	public function search_render_block_core_group($block_content, $block)
	{

		if ($block['blockName'] === 'core/search') {

			$form = '
			<form  method="get" action="' . esc_url(home_url('/')) . '" class="search-form">
			       
					<input name="s" type="search" placeholder="' . esc_attr__('Search here', 'aai') . '">
					<button type="submit"><i class="fal fa-search"></i></button>
				    
			</form>';

			return $form;
		}
		return $block_content;
	}

	public function add_submit_button_attr_class($arg)
	{

		$arg['class_submit'] = 'submit btn-comment btn btn-primary';

		return $arg;
	}


	// allow search post type
	function search_filter($query)
	{

		if ($query->is_search) {
			$query->set('post_type', 'post');
		}
		return $query;
	}
}
