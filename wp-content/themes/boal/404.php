<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

                <section class="error-404 not-found">
                    <header class="page-header">
                        <div class="container">
                        <h1 class="title-page"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.','boal' ); ?></h1>
                        </div>
                    </header><!-- .page-header -->
                    <div class="container">
                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'boal'); ?></p>
                            <?php get_search_form(); ?>
                        </div><!-- .page-content -->
                    </div>
                </section><!-- .error-404 -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
