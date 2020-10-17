<?php 

$orig_post = $post;

$categories = get_the_category($post->ID);

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args = array(
		'category__in'     => $category_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   =>4, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
		<div class="post-related">
			<h4 class="widgettitle">
				<?php esc_html_e('You may also like', 'boal'); ?>
			</h4>
			<div class="row archive-blog">
				<?php while( $my_query->have_posts() ) {
					$my_query->the_post();?>
						<div class="col-md-6 col-sm-6 col-xs-6 item-related col-item">
							<?php get_template_part( 'templates/layout/content-grid'); ?>
						</div>
				<?php } ?>
			</div>
		</div>
	<?php }
}
$post = $orig_post;
wp_reset_postdata();

?>