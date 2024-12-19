<?php
namespace Element_Ready_Pro\Base\Crd;

Abstract class Base
{
	protected function get_import_ids($content)
    {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element)
        {
            $element['id'] = \Elementor\Utils::generate_random_string();
            return $element;
        });
	}
	
	protected function get_import_content($content, $method)
    {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element_data) use ($method)
        {
            $element = \Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);

            if (!$element)
            {
                return null;
            }

            $r = $this->get_import_element($element, $method);
            
            return $r;
        });
	}
	
	protected function get_import_element($element, $method)
    {
        $element_data = $element->get_data();
        if (method_exists($element, $method))
        {
            $element_data = $element->{$method}($element_data);
        }
        foreach ($element->get_controls() as $control)
        {
            $control_class = \ELementor\Plugin::$instance
                ->controls_manager
                ->get_control($control['type']);
            if (!$control_class)
            {
                return $element_data;
            }
            if (method_exists($control_class, $method))
            {
                $element_data['settings'][$control['name']] = $control_class->{$method}($element->get_settings($control['name']) , $control);
            }
		}
        return $element_data;
    }
}