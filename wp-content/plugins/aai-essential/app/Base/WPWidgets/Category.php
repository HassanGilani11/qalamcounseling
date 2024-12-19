<?php

namespace AaiEssential\Base\WPWidgets;

use AaiEssential\Base\BaseWPWidget;


class Category extends BaseWPWidget
{


	function __construct()
	{
		$widget_opt = array(
			'classname'		 => 'widget-categories',
			'description'	 => esc_html__('Aai Popular Category', 'aai-essential')
		);

		parent::__construct('quomodo-category-list', esc_html__('Aai Popular Category ', 'aai-essential'), $widget_opt);
	}


	public function widget($args, $instance)
	{

		echo $args['before_widget'];

		$va_category_HTML = '';

		if (!empty($instance['quomodo_title']) && !$instance['quomodo_hide_title']) {

			echo $args['before_title'] . apply_filters('widget_title', $instance['quomodo_title']) . $args['after_title'];
		}


		$va_category_HTML .= '<div class="categories-list">';
		if ($instance['quomodo_taxonomy_type']) {

			if ($instance['quomodo_text_center']) {
				$va_category_HTML .= '<ul class="text-center">';
			} else {
				$va_category_HTML .= '<ul>';
			}

			$args_val              = array('hide_empty=0');
			$excludeCat            = $instance['quomodo_selected_categories'] ? $instance['quomodo_selected_categories'] : '';
			$quomodo_action_on_cat = $instance['quomodo_action_on_cat'] ? $instance['quomodo_action_on_cat'] : '';
			if ($excludeCat && $quomodo_action_on_cat != '')
				$args_val[$quomodo_action_on_cat] = $excludeCat;

			$terms = get_terms($instance['quomodo_taxonomy_type'], $args_val);

			if ($terms) {

				foreach ($terms as $term) {

					$term_link = get_term_link($term);

					if (is_wp_error($term_link)) {
						continue;
					}

					$carrentActiveClass = '';
					$category_image = '';
					if ($term->taxonomy == 'category' && is_category()) {
						$thisCat = get_category(get_query_var('cat'), false);
						if ($thisCat->term_id == $term->term_id)
							$carrentActiveClass = 'class="active-cat"';
					}

					if (is_tax()) {
						$currentTermType = get_query_var('taxonomy');
						$termId = get_queried_object()->term_id;
						if (is_tax($currentTermType) && $termId == $term->term_id)
							$carrentActiveClass = 'class="active-cat"';
					}

					$va_category_HTML .= '<li ' . $carrentActiveClass . '> <a ' . wp_kses_post($category_image) . ' href="' . esc_url($term_link) . '"><span>' .  $term->name . '</span>';

					if (empty($instance['quomodo_hide_count'])) {
						$va_category_HTML .= '<span class="category-count">(' . $term->count . ')</span>';
					}

					$va_category_HTML .= '</a></li>';
				}
			}
			$va_category_HTML .= '</ul>';
			$va_category_HTML .= '</div>';
		}


		echo wp_kses_post($va_category_HTML);
		echo $args['after_widget'];
	}


	public function form($instance)
	{

		$quomodo_title               = !empty($instance['quomodo_title']) ? $instance['quomodo_title'] : esc_html__('Popular Categories', 'aai-essential');
		$quomodo_hide_title          = !empty($instance['quomodo_hide_title']) ? $instance['quomodo_hide_title'] : '';
		$quomodo_text_center         = !empty($instance['quomodo_text_center']) ? $instance['quomodo_text_center'] : '';
		$quomodo_taxonomy_type       = !empty($instance['quomodo_taxonomy_type']) ? $instance['quomodo_taxonomy_type'] : esc_html__('category', 'aai-essential');
		$quomodo_selected_categories = (!empty($instance['quomodo_selected_categories']) && !empty($instance['quomodo_action_on_cat'])) ? $instance['quomodo_selected_categories'] : '';
		$quomodo_action_on_cat       = !empty($instance['quomodo_action_on_cat']) ? $instance['quomodo_action_on_cat'] : '';
		$quomodo_hide_count          = !empty($instance['quomodo_hide_count']) ? $instance['quomodo_hide_count'] : '';

?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('quomodo_title')); ?>"><?php _e(esc_attr('Title:')); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('quomodo_title')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_title')); ?>" type="text" value="<?php echo esc_attr($quomodo_title); ?>">
		</p>
		<p>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('quomodo_text_center')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_text_center')); ?>" type="checkbox" value="1" <?php checked($quomodo_text_center, 1); ?>>
			<label for="<?php echo esc_attr($this->get_field_id('quomodo_text_center')); ?>"><?php _e(esc_attr('List center')); ?> </label>
		</p>
		<p>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('quomodo_hide_title')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_hide_title')); ?>" type="checkbox" value="1" <?php checked($quomodo_hide_title, 1); ?>>
			<label for="<?php echo esc_attr($this->get_field_id('quomodo_hide_title')); ?>"><?php _e(esc_attr('Hide Title')); ?> </label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('quomodo_taxonomy_type')); ?>"><?php _e(esc_attr('Taxonomy Type:')); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('quomodo_taxonomy_type')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_taxonomy_type')); ?>">
				<?php

				$args = array(
					'public'   => true,
					'_builtin' => false
				);

				$output = 'names'; // or objects
				$operator = 'and'; // 'and' or 'or'
				$taxonomies = get_taxonomies($args, $output, $operator);

				array_push($taxonomies, 'category');

				if ($taxonomies) {
					foreach ($taxonomies as $taxonomy) {

						echo '<option value="' . $taxonomy . '" ' . selected($taxonomy, $quomodo_taxonomy_type) . '>' . $taxonomy . '</option>';
					}
				}

				?>
			</select>
		</p>
		<p>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id('quomodo_action_on_cat')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_action_on_cat')); ?>">
				<option value="" <?php selected($quomodo_action_on_cat, '') ?>> <?php echo esc_html__('Show All Category', 'aai-essential') . ' :'; ?> </option>
				<option value="include" <?php selected($quomodo_action_on_cat, 'include') ?>> <?php echo esc_html__("Include Selected Category:", "appscred-essential"); ?> </option>
				<option value="exclude" <?php selected($quomodo_action_on_cat, 'exclude') ?>> <?php echo esc_html__("Exclude Selected Category", "appscred-essential") . ' :'; ?> </option>
			</select>
			<select class="widefat quomodo-category-widget" id="<?php echo esc_attr($this->get_field_id('quomodo_selected_categories')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_selected_categories')); ?>[]" multiple>
				<?php
				if ($quomodo_taxonomy_type) {
					$quomodo_selected_categories = is_array($quomodo_selected_categories) ? $quomodo_selected_categories : [];

					$args = array('hide_empty=0');
					$terms = get_terms($quomodo_taxonomy_type, $args);
					echo '<option value="" ' . selected(true, in_array('', $quomodo_selected_categories), false) . '>' . esc_html('None ', 'aai-essential') . '</option>';
					if ($terms) {
						foreach ($terms as $term) {
							echo '<option value="' . $term->term_id . '" ' . selected(true, in_array($term->term_id, $quomodo_selected_categories), false) . '>' . $term->name . '</option>';
						}
					}
				}

				?>
			</select>
		</p>
		<p>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('quomodo_hide_count')); ?>" name="<?php echo esc_attr($this->get_field_name('quomodo_hide_count')); ?>" type="checkbox" value="1" <?php checked($quomodo_hide_count, 1); ?>>
			<label for="<?php echo esc_attr($this->get_field_id('quomodo_hide_count')); ?>"><?php echo esc_attr__('Hide Count', 'aai-essential'); ?> </label>
		</p>

<?php
	}


	public function update($new_instance, $old_instance)
	{

		$instance                                = array();
		$instance['quomodo_title']               = (!empty($new_instance['quomodo_title'])) ? strip_tags($new_instance['quomodo_title']) : '';
		$instance['quomodo_hide_title']          = (!empty($new_instance['quomodo_hide_title'])) ? strip_tags($new_instance['quomodo_hide_title']) : '';
		$instance['quomodo_text_center']         = (!empty($new_instance['quomodo_text_center'])) ? strip_tags($new_instance['quomodo_text_center']) : '';
		$instance['quomodo_taxonomy_type']       = (!empty($new_instance['quomodo_taxonomy_type'])) ? strip_tags($new_instance['quomodo_taxonomy_type']) : '';
		$instance['quomodo_selected_categories'] = (!empty($new_instance['quomodo_selected_categories'])) ? $new_instance['quomodo_selected_categories'] : '';
		$instance['quomodo_action_on_cat']       = (!empty($new_instance['quomodo_action_on_cat'])) ? $new_instance['quomodo_action_on_cat'] : '';
		$instance['quomodo_hide_count']          = (!empty($new_instance['quomodo_hide_count'])) ? strip_tags($new_instance['quomodo_hide_count']) : '';

		return $instance;
	}
}
