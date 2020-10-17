<?php
/**
 * @package     boal
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

class boal_slider_post extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'slider_post',esc_html__('+NA: Slider Post','boal'),
            array('description'=>esc_html__('Slider Post', 'boal'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $number = $instance['number'];
        $title = apply_filters('widget_title', $instance['title']);
        $arr = array(
            'showposts'   => $number,
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'meta_key'      => '_featured',
            'meta_value'    => 'yes',
            'orderby'       => 'date',
            'order'         => 'DESC'
        );
        $popular_posts = new WP_Query( $arr );

        echo ent2ncr($args['before_widget']);
        if($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
        }
        ?>

        <!-- Tab panes -->
        <div class="archive-blog article-carousel" data-rtl="true"  data-table="1" data-number="1" data-mobile = "1" data-mobilemin = "1" data-dots="false" data-arrows="true">
            <?php
            if($popular_posts->have_posts()): ?>
                    <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                        <?php get_template_part( 'templates/layout/content-trans-vertical'); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php
        echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title' => 'Most Popular',
            'number' => '5'
        ));
        // Widget admin form
        ?>
        <p>
            <label for=<?php echo esc_attr($this->get_field_id('title')); ?>><?php echo esc_html_e('Title:','boal') ; ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo esc_html_e('Number posts:','boal'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['number'] = $new_instance['number'];
        return $instance;
    }
}
function boal_slider_post(){
    register_widget('boal_slider_post');
}
add_action('widgets_init','boal_slider_post');