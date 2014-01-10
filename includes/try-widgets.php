<?php

function load_widgets() {
	register_widget('custom_widget');
}
add_action('widgets_init', 'load_widgets');

/**
 * Custom Widget
 */
class custom_widget extends WP_Widget {
	function custom_widget() {
		$widget_ops = array('classname' => 'custom_widget', 'description' => 'Example Description');
		$control_ops = array('width' => 400, 'height' => 450);
		$this->WP_Widget('custom_widget', 'Custom Widget', $widget_ops, $control_ops);
	}

	/**
	* Determines the front end display of the widget using args from the theme
	*/
	function widget($args, $instance) {
		global $post;
		extract($args);
		$title = $instance['title'];

		echo $before_widget.$before_title.$title.$after_title;
		?>

		<?php echo $after_widget;
	}

	/**
	* Take user settings and update/save them
	*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	/**
	* Determines the back-end (cms) display used to update settings
	*/
	function form($instance) {
		$defaults = array('title' => '');
		$instance = wp_parse_args((array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text"></input>
		</p>
	<?php
	}
}