<?php
/**
 * The template for displaying search results pages.
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

$style_css                  ="";
$bg_header                  = get_theme_mod('boal_cat_image');
$bg_header_color            = get_theme_mod('boal_cat_bg');
if($bg_header){
	$cat_header           ="background-image:url('$bg_header')";
	$style_css            ='style = '.$cat_header.'';
}
if($bg_header_color){
	$cat_header           ="background:$bg_header_color";
	$style_css            ='style = '.$cat_header.'';
}

get_header(); ?>
<div class="wrap-content page-search" role="main">
	<div class="cat-header clearfix" <?php echo esc_attr($style_css);?>>
		<div class="container">
				<h1 class="title-page"><?php printf( esc_html__( 'Search Results for: %s', 'boal' ), get_search_query() ); ?></h1>
		</div>
	</div>
	<div class="container wrap-content-inner">
		<div class="row">
			<div class="main-content col-sm-12 col-md-8 col-lg-8" role="main">
				<?php if ( have_posts() ) : ?>
					<div class="archive-blog">
						<div class="row affect-isotopes">
							<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();
								?>
								<div class="col-md-12">
									<?php get_template_part( 'templates/layout/content-list'); ?>
								</div>
								<?php
							endwhile; ?>
						</div>
					</div>
				<?php else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif;

				the_posts_pagination( array(
					'prev_text'          => '<i class="fa fa-angle-left"></i>',
					'next_text'          => '<i class="fa fa-angle-right"></i>',
					'before_page_number' => '<span class="meta-nav screen-reader-text"></span>',
				) );
				?>


			</div>
			<div id="archive-sidebar" class="sidebar sidebar-right  hidden-sx hidden-sm col-sx-12 col-sm-12 col-md-4 col-lg-4 archive-sidebar">
				<div class="content-inner">
					<?php get_sidebar('sidebar'); ?>
				</div>
			</div>

		</div><!-- .content-area -->
	</div>
</div>
<?php get_footer(); ?>
