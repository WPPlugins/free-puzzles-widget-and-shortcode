<?php 

class puzzle_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'puzzle_widget',
			'Rebus Puzzle Widget',
			array( 'description' => __( 'Display Rebus puzzles for your visitors to solve.', 'text_domain' ), )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$puzzle_id =  $instance['puzzle_id'] ;
		
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		if( $puzzle_id ){
			echo do_shortcode('[puzzle id="'.$puzzle_id.'"]');
		}else{
			echo do_shortcode('[puzzle]');
		}
		
		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['puzzle_id'] = strip_tags( $new_instance['puzzle_id'] );

		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Can you solve this Rebus?', 'text_domain' );
		}
		$puzzle_id= $instance[ 'puzzle_id' ];
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'puzzle_id' ); ?>"><?php _e( 'Specific Rebus Number (if left empty, a random Rebus will be picked):' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'puzzle_id' ); ?>" name="<?php echo $this->get_field_name( 'puzzle_id' ); ?>" type="text" value="<?php echo esc_attr( $puzzle_id ); ?>" />
			
		</p>
		
		<?php 
	}

} // class Foo_Widget
// register Foo_Widget widget
add_action( 'widgets_init', create_function( '', 'register_widget( "puzzle_widget" );' ) );

?>