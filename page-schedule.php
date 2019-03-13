<?php
/**
 * Template Name: Schedule
 *
 * @package xtremetm
 */

get_header();
?>
<?php get_template_part('store-parts/section', 'header-bar'); ?>
<div class="py-3">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h1 class="mb-1 title"><?php the_field('schedule_title'); ?></h1>
				<h3 class="mb-0 subtitle"><?php the_field('schedule_sub_title'); ?></h3>
			</div>
		</div>
	</div>
</div>

<?php while(have_rows('events')): the_row(); ?>

	<div class="schedule-list-item py-2">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="row">
						<div class="col-lg-9">
							<div class="schedule-list-info">
								<h2 class="mb-1 text-primary"><?php the_sub_field('event_name'); ?></h2>
								<h4><?php the_sub_field('event_track'); ?>, <?php the_sub_field('event_location'); ?></h4>								
							</div>
						</div>
						<div class="col-lg-3 align-self-center">
							<div class="schedule-list-date text-secondary"><?php the_sub_field('event_date'); ?></div>
						</div>
						
						<?php if (get_sub_field('event_additional')): ?>
						
							<div class="col-12 mt-1">
								<div class="schedule-list-additional"><?php the_sub_field('event_additional'); ?></div>
							</div>
						
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>		
	</div>
	
<?php endwhile; ?>

<?php
get_footer();
