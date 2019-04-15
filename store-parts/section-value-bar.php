<?php if (have_rows('value_list', $store)): ?>
	<div id="section-value-bar" class="sb box">
		<div class="container">
			<div class="row justify-content-center text-center">
				<div class="col">
					<ul class="list-inline mb-0">
						
						<?php while (have_rows('value_list', $store)): the_row() ?>
						
							<li class="list-inline-item"><i class="fas fa-check-circle"></i> <?php the_sub_field('value_list_item'); ?></li>
						
						<?php endwhile; ?>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>