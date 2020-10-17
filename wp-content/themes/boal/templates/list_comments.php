<?php

$GLOBALS['comment'] = $comment;
$add_below = '';

if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
	<div class="comment-body">
		<?php esc_html_e( 'Pingback:', 'boal' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'boal' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
<?php else : ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	<div class="the-comment comment-box">
		<div class="comment-top">
			<div class="avatar">
				<?php echo get_avatar($comment, 70); ?>
			</div>
			<div class="ground-user">
				<strong class="text-user">
					<?php echo get_comment_author_link(); ?>
				</strong>
				<span class="comment-time"><?php echo human_time_diff( get_comment_date('U'), current_time('timestamp') ) . esc_html__(' ago', 'boal'); ?></span>
			</div>
			<small class="meta-user">
				<?php edit_comment_link(__('Edit', 'boal'),'  ',' ') ?>
				<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__('Reply', 'boal'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			</small>

		</div>

		<div class="comment-bottom">
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
					<em><?php esc_html_e('Your comment is awaiting moderation.', 'boal') ?></em>
					<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
		</div>

	</div>
	<?php
endif;