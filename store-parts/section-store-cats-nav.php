<?php $cats = get_parent_cats(); ?>

<div id="header-nav" class="d-none d-lg-block">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-lg-auto flex-grow-1">
				<ul class="list-inline mb-0">
					
					<?php foreach($cats as $cat): ?>
					
						<li class="list-inline-item"><a class="d-flex align-items-center align-self-center" href="<?php echo get_term_link($cat->term_id); ?>"><i class="fas fa-chevron-right"></i> <?php echo $cat->name; ?></a></li>
					
					<?php endforeach; ?>
					
				</ul>
			</div>
			<div class="col-lg-auto align-self-center">
				<?php include(locate_template('/store-parts/search-bar.php', false, false)); ?>
			</div>
			<div class="col-lg-auto align-self-center">
				<div id="header-phone"><a class="text-white" href="tel:<?php the_field('global_phone', 'options'); ?>"><?php the_field('global_phone', 'options'); ?></a></div>
			</div>
		</div>
	</div>
</div>
