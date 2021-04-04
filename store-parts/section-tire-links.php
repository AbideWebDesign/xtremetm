<div id="section-links" class="py-3">
	
	<div class="container">
			
		<div class="row">
			
			<div class="col">
				
				<h2 class="large mb-2"><?php the_field('links_title', 'options'); ?></h2>
				
			</div>
						
		</div>	
		
		<div class="row">
			
			<?php while ( have_rows('links', 'options') ): the_row(); ?>
			
				<div class="col-lg-3 align-self-stretch">
					
					<div class="s">
						
						<a href="<?php the_sub_field('link'); ?>" target="_blank"><?php echo wp_get_attachment_image( get_sub_field('image'), 'card', false, array( 'class'=>'img-fluid' ) ); ?></a>
						
						<div class="bg-white p-1">
							
							<div class="mb-1">
								
								<h3 class="mb-0"><a href="<?php the_sub_field('link'); ?>" target="_blank"><?php the_sub_field('title'); ?></a></h3>
								
							</div>
							
							<?php if ( get_sub_field('text') ): ?>
							
								<p class="mb-0 alt text-sm"><?php the_sub_field('text'); ?></p>
							
							<?php endif; ?>
							
						</div>
						
					</div>
					
				</div>
			
			<?php endwhile; ?>
			
		</div>
		
	</div>
	
</div>