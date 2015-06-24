<?php
/*
 * Plugin Name: Latest Tweets
 * Plugin URI: http://www.ishyoboy.com
 * Description: A widget that displays your latest tweets
 * Version: 1.0
 * Author: IshYoBoy
 * Author URI: http://www.ishyoboy.com
 */
class Ishyoboy_Dribbble_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'ishyoboy-dribbble-widget', // Base ID
            'Ishyo Dribbble images', // Name
            array(
                'description' => __( 'A widget that displays your latest dribbble images.', 'ishyoboy_assets' ),
            )
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

        wp_enqueue_script( 'ish-dribbble' );

        $title = apply_filters( 'widget_title', $instance['title'] );

        echo str_replace( 'class="', 'class="icon-dribbble ', $before_widget);

        $widget_username = $instance['username'];
        $widget_postcount = $instance['postcount'];
        $widget_buttontext = $instance['buttontext'];
        ?>
            <?php
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            ?>

            <div class="dribbble-widget" data-user-name="<?php echo $widget_username ?>" data-shots-count="<?php echo $widget_postcount ?>"><div class="loader"><?php _e( 'Loading dribbble images...', 'ishyoboy_assets' );?></div></div>

            <?php if( !empty($widget_buttontext) ) { ?>
                <?php if( !empty($widget_username) ) { ?>
                    <a class="ish-button-small" href="http://dribbble.com/<?php echo $widget_username ?>/"><?php echo $widget_buttontext; ?></a>
                <?php } else { ?>
                    <a class="ish-button-small" href="http://dribbble.com/"><?php echo $widget_buttontext; ?></a>
                <?php } ?>
            <?php } ?>

        <?php

        echo $after_widget;

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

        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['username'] = strip_tags( $new_instance['username'] );
        $instance['postcount'] = strip_tags( $new_instance['postcount'] );
        $instance['buttontext'] = strip_tags( $new_instance['buttontext'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {

        $username = 'MattImling';

        // Default widget settings.
        $defaults = array(
            'title' => __( 'Latest Dribbble Shots', 'ishyoboy_assets' ),
            'username' => $username,
            'postcount' => '9',
            'buttontext' => __( 'Follow us on Dribbble', 'ishyoboy_assets' ),
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'ishyoboy_assets') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Dribble Username e.g. ishyoboy', 'ishyoboy_assets') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php _e('Number of images', 'ishyoboy_assets') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'buttontext' ); ?>"><?php _e('Button Text e.g. Follow us on Flickr', 'ishyoboy_assets') ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'buttontext' ); ?>" name="<?php echo $this->get_field_name( 'buttontext' ); ?>" value="<?php echo $instance['buttontext']; ?>" />
        </p>

        <?php
    }

}
add_action( 'widgets_init', create_function( '', 'register_widget( "Ishyoboy_Dribbble_Widget" );' ) );