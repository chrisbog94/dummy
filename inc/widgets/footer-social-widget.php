<?php

/**
 * Footer Social widget.
 */


if( ! class_exists('Krystal_Lawyer_Footer_Social_Widget')) :

class Krystal_Lawyer_Footer_Social_Widget extends WP_Widget {

	var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'krystal_lawyer_footer_social_widget', // Base ID
			esc_html__( 'Krystal Lawyer: Footer Social Widget', 'krystal-lawyer' ), // Name
			array( 'description' => esc_html__( 'Adds Social icons to footer widgets.', 'krystal-lawyer'), ) // Args
		);		     
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		extract( wp_parse_args( $instance, $this->defaults ) ); 

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		?>
        	<div id="footer_social_icons_widget" class="section social-icons widget_social_icons_widget">
        		<?php
        			if ( !empty($instance['title']) ) {
			        	echo $args['before_title'] . esc_html($instance['title']) . $args['after_title'];
        			}
        		?>
        		<?php 
        			wp_nav_menu(
			            array(
			                'fallback_cb' => false,
			                'theme_location'    => 'footer-social',
			                'link_before' => '<span class="social-menu-wrap">',
			                'link_after' => '</span>',
			                'menu_class' => 'footer-menu social-menu-list clearfix'
			            )
			        );
			    ?>
        	</div>
        <?php
    }
	
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
	    $title = isset( $instance['title'] ) ? esc_html($instance['title']) : '';
	    ?>     	  	    	
		    <p>
		        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','krystal-lawyer'); ?></label>
		        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		    </p>
    	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;	
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
    	return $instance;
	}

}
endif;

if( ! function_exists('krystal_lawyer_register_footer_social_widget')) :
// register widget
function krystal_lawyer_register_footer_social_widget() {
    register_widget( 'Krystal_Lawyer_Footer_Social_Widget' );
}
endif;

add_action( 'widgets_init', 'krystal_lawyer_register_footer_social_widget' );
