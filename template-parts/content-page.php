<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xtremetm
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="global-store-container">
		<div class="container">
			<div class="box s p-1 p-lg-2">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
			
			
				<div class="entry-content">
					<?php the_content(); ?>
			
				</div><!-- .entry-content -->
			</div>
		</div>
	</div>
</div>
