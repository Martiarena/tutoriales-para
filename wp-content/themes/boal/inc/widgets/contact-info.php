<?php
 /* *
  * widgets contact info
  **/
  class boal_contact_info extends WP_Widget{

      /*function construct*/
      public function __construct() {
          parent::__construct(
            'contact_info',esc_html__('+NA: Contact info','boal'),
             array('description'=>esc_html__('Display Contact info', 'boal'))
          );
      }
      /**
       * font-end widgets
      */

      public function widget($args, $instance) {
          extract($args);
          $title = apply_filters('widget_title', $instance['title']);
          $image = $instance['image'];

          echo ent2ncr($args['before_widget']);

          if($title) {
              echo ent2ncr($args['before_title']) . esc_html($title) . ent2ncr($args['after_title']);
          }

      ?>
      <div class="contact-inner clearfix">
          <?php if($image): ?>
              <img class="about-image" src="<?php echo esc_url($image)?>" alt="img" />
          <?php endif; ?>
          <?php if($instance['description']): ?>
              <p class="description">
                  <span><?php echo esc_attr($instance['description']); ?></span>
              </p>
          <?php endif; ?>

          <ul class="contact-info">
                <?php  if($instance['address']): ?>
                <li>
                    <b><?php  echo esc_html('Address: ','boal');  ?></b>
                    <span><?php  echo esc_attr($instance['address']);  ?></span>
                </li>
                <?php  endif; ?>

                <?php if($instance['mobile']): ?>
                  <li>
                      <b><?php  echo esc_html('Mobile: ','boal');  ?></b>
                      <span><?php   echo esc_attr($instance['mobile']);  ?></span>
                  </li>

                <?php endif; ?>
                <?php if($instance['phone']): ?>
                  <li>
                      <b><?php  echo esc_html('Phone: ','boal');  ?></b>
                      <span><?php   echo esc_attr($instance['phone']);  ?></span>
                  </li>

                <?php endif; ?>

                <?php if($instance['skype']): ?>
                    <li>
                        <b><?php  echo esc_html('Skype: ','boal');  ?></b>
                        <a href="skype:<?php echo esc_attr($instance['skype']);?>?chat" ><span><?php echo esc_attr($instance['skype']); ?></span></a>
                    </li>
                <?php endif; ?>

                <?php if($instance['email']): ?>
                    <li>
                        <b><?php  echo esc_html('Email: ','boal');  ?></b>
                        <a href="mailto:<?php echo esc_attr($instance['email']);?>" ><span><?php echo esc_attr($instance['email']); ?></span></a>
                    </li>
                <?php endif; ?>
          </ul>
      </div>
      <?php
      echo ent2ncr($args['after_widget']);
      }

      /**
       * Back-end widgets form
      */
      public function form($instance){
          $instance =   wp_parse_args($instance,array(
              'title'       =>  'Contact info',
              'image'       => '',
              'address'     =>  '',
              'phone'       =>  '',
              'mobile'      =>  '',
              'skype'       =>  '',
              'email'       =>  '',
              'description' =>'',
          ));
          ?>
          <p>
              <label for=<?php echo esc_attr($this->get_field_id('title')); ?>><?php echo esc_html_e('Title:','boal') ; ?></label>
              <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
          </p>
          <p id="<?php echo esc_attr($this->get_field_id('image').'-wrapp'); ?>">
              <label for="<?php echo esc_attr($this->get_field_id('image')); ?>"><?php esc_html_e('Image:', 'boal'); ?></label>
              <img id="<?php echo esc_attr($this->get_field_id('image').'-img'); ?>" src="<?php echo esc_url($instance['image'])?>" class="custom_media_image <?php echo($instance['image']==''?  esc_attr('hidden'):''); ?>"/>
              <input type="text" class="widefat custom_media_url hidden" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" />
              <br>
              <input type="button" class="button button-primary custom_media_button" id="<?php echo esc_attr($this->get_field_id('image').'-button'); ?>" value="Select Image" />
          </p>
          <p>
              <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php echo esc_html_e('Address:','boal'); ?></label>
              <input type="text" id="<?php echo esc_attr($this->get_field_id('address')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('address')); ?>" value="<?php echo esc_attr($instance['address']); ?>" />
          </p>
          <p>
              <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php echo esc_html_e( 'Phone:', 'boal' ); ?></label>
              <input type="text" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" value="<?php echo esc_attr($instance['phone']); ?>" />
          </p>
          <p>
              <label for="<?php echo esc_attr($this->get_field_id('mobile')); ?>"><?php echo esc_html_e( 'Mobile:', 'boal' ); ?></label>
              <input type="text" id="<?php echo esc_attr($this->get_field_id('mobile')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('mobile')); ?>" value="<?php echo esc_attr($instance['mobile']); ?>" />
          </p>
          <p>
              <label for="<?php echo esc_attr($this->get_field_id('skype')); ?>"><?php echo esc_html_e('Skype:', 'boal'); ?></label>
              <input type="text" id="<?php echo esc_attr($this->get_field_id('skype')); ?>" name="<?php echo esc_attr($this->get_field_name('skype')); ?>" class="widefat" value="<?php echo esc_attr($instance['skype']); ?>" />
          </p>
          <p>
              <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php echo esc_html_e('Email:', 'boal'); ?></label>
              <input type="text" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" class="widefat" value="<?php echo esc_attr($instance['email']); ?>" />
          </p>

          <!-- description -->
          <p>
              <label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php echo esc_html_e('About me text::', 'boal'); ?></label>
              <textarea id="<?php echo esc_attr($this->get_field_id( 'description')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" rows="6"><?php echo esc_attr($instance['description']); ?></textarea>
          </p>


      <?php
      }

      /**
      * function update widget
      */
      public function update( $new_instance, $old_instance ) {
          $instance = $old_instance;
          $instance['title']        = $new_instance['title'];
          $instance['image']        = $new_instance['image'];
          $instance['address']      = $new_instance['address'];
          $instance['phone']        =   $new_instance['phone'];
          $instance['mobile']       = $new_instance['mobile'];
          $instance['skype']        = $new_instance['skype'];
          $instance['email']        =   $new_instance['email'];
          $instance['description']  =   $new_instance['description'];
          return $instance;
      }
  }
  function boal_contact_info(){
      register_widget('boal_contact_info');
  }
  add_action('widgets_init','boal_contact_info');
?>