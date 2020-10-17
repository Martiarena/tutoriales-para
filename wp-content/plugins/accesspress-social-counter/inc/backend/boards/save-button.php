<?php 

wp_nonce_field('apsc_settings_action', 'apsc_settings_nonce');
?>
<div id="optionsframework-submit" class="ap-settings-submit">
	<input type="submit" class="button button-primary" value="Save all changes" name="ap_settings_submit"/>
	<?php
	$nonce = wp_create_nonce('apsc-restore-default-nonce');
	$cache_nonce = wp_create_nonce('apsc-cache-nonce');
	?>
	<a href="<?php echo admin_url() . 'admin-post.php?action=apsc_restore_default&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?', 'accesspress-social-counter'); ?>')"><input type="button" value="<?php _e('Restore Default Settings','accesspress-social-counter');?>" class="ap-reset-button button button-primary"/></a>
	<a href="<?php echo admin_url() . 'admin-post.php?action=apsc_delete_cache&_wpnonce=' . $cache_nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to delete cache?', 'accesspress-social-counter'); ?>')"><input type="button" value="<?php _e('Delete Cache','accesspress-social-counter');?>" class="ap-reset-button button button-primary"/></a>
</div>