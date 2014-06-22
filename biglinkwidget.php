<?php
/*
Plugin Name: Big Link Widget
Description: Puts a direct link to a provided URL in the sidebar as a heading.
Author: Josh Clark
Version: 1
Author URI: http://khameleon.org/work
*/

class BigLinkWidget extends WP_Widget {
	function BigLinkWidget() {
		$widget_ops = array(
			'classname' => 'BigLinkWidget',
			'description' => 'Displays a link in the sidebar as a heading.'
		);
		
		$this->WP_Widget('BigLinkWidget', 'Sidebar heading link', $widget_ops);
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title' => '', 'link' => ''));
		$title = $instance['title'];
		$link = $instance['link']
		?>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('link'); ?>">Link: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo attribute_escape($link); ?>" /></label></p>
		
		<?php
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['link'] = $new_instance['link'];
		
		return $instance;
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		
		echo '<pre>';
		print_r($instance);
		echo '</pre>';
		
		echo $before_widget, $before_title, '<a href="', $link, '">', !empty($title) ? $title : null, '</a>', $after_title, $after_widget;
	}
}

add_action('widgets_init', create_function('', 'return register_widget("BigLinkWidget");'));

?>