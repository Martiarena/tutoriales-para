<?php
/**
 * @package     boal
 * @version     1.0
 * @author      NanoAgency
 * @link        http://www.nanoagency.co
 * @copyright   Copyright (c) 2016 NanoAgency
 * @license     GPL v2
 */

class boal_featured_post extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'featured_post',esc_html__('+NA: Featured Post','boal'),
            array('description'=>esc_html__('Featured Post', 'boal'))
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $number = $instance['number'];
        $categories = $instance['categories'];
        $type_post = $instance['type_post'];
        $title = apply_filters('widget_title', $instance['title']);
        $arr2=array();
        $arr = array(
            'category_name' => $categories,
            'showposts'     => $number,
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'orderby'       => 'date',
            'order'         => 'DESC'
        );
        if( $type_post == 'featured' ){
            $meta_query[] = array(
                'key'   => '_featured',
                'value' => 'yes'
            );
            $arr['meta_query'] = $meta_query;
        }
        if( $type_post == 'views' ){
            $arr2 = array(
                'meta_key'      => 'post_views_count',
                'orderby'       =>'meta_value_num',
            );
        }
        $att=array_merge($arr,$arr2);
        $popular_posts = new WP_Query( $att);

        echo ent2ncr($args['before_widget']);
        if($title) {
            echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
        }
        ?>

        <!-- Tab panes -->
        <div class="article-content archive-blog">
                <div class="featured-post">
                    <?php
                    if($popular_posts->have_posts()): ?>
                            <?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                                <?php get_template_part( 'templates/layout/content-list'); ?>
                            <?php endwhile; ?>
                    <?php endif; ?>
                </div>
        </div>
        <?php
        echo ent2ncr($args['after_widget']);
    }
// Widget Backend
    public function form( $instance ) {
        $instance = wp_parse_args($instance,array(
            'title'         => esc_html__('Most Popular','boal'),
            'number'        => '5',
            'type_post'     => 'news',
            'categories'    => ''
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
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Categories:', 'boal') ?></label>
            <select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" class="widefat categories">
                <option value='' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php  esc_html_e('All categories', 'boal'); ?></option>
                <?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
                <?php foreach($categories as $category) { ?>
                    <option value='<?php echo esc_attr($category->slug); ?>' <?php if ($category->slug == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html($category->cat_name); ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('type_post')); ?>">
                <strong><?php esc_html_e('Type Post', 'boal') ?>:</strong>
                <select class="widefat" id="<?php echo esc_attr($this->get_field_id('type')); ?>"
                        name="<?php echo esc_attr($this->get_field_name('type_post')); ?>">
                    <option
                        value="news"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'news') ? ' selected="selected"' : '' ?>><?php esc_html_e('News', 'boal') ?>
                    </option>
                    <option
                        value="views"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'views') ? ' selected="selected"' : '' ?>><?php esc_html_e('Most Views', 'boal') ?>
                    </option>
                    <option
                        value="featured"<?php echo (isset($instance['type_post']) && $instance['type_post'] == 'featured') ? ' selected="selected"' : '' ?>><?php esc_html_e('Featured', 'boal') ?>
                    </option>

                </select>
            </label>
        </p>
        <?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title']  = $new_instance['title'];
        $instance['number'] = $new_instance['number'];
        $instance['categories']    = $new_instance['categories'];
        $instance['type_post']    = $new_instance['type_post'];
        return $instance;
    }
}
function boal_featured_post(){
    register_widget('boal_featured_post');
}
add_action('widgets_init','boal_featured_post');