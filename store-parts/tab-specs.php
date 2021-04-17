<?php if ( get_field('tires') ): ?>

	<div class="table-responsive">
		
		<table class="table-specs table table-bordered table-striped mb-0">
								
			<?php if ( $post->post_title == 'Cooper RS3-R' || $post->post_title == 'Cooper RS3-RS' ): ?>
				
				<thead>	
				
					<tr>	
						
						<th><?php _e('Tire size'); ?></th>
						
						<th><?php _e('Service Index'); ?></th>
						
						<th><?php _e('UTQG Treadwear'); ?></th>
						
						<th><?php _e('UTQG Traction'); ?></th>
						
						<th><?php _e('UTQG Temperature'); ?></th>
						
						<th><?php _e('Rim choice'); ?></th>
						
						<th><?php _e('Rim used'); ?></th>
						
						<th colspan='2'><?php _e('Measured at'); ?></th>
						
						<th colspan='2'><?php _e('Diameter'); ?></th>
						
						<th colspan='2'><?php _e('Section'); ?></th>
						
						<th colspan='2'><?php _e('Tread'); ?></th>
						
						<th colspan='2'><?php _e('Revolutions'); ?></th>
						
					</tr>
					
					<tr>
						
						<th colspan='7'></th>
						
						<th><?php _e('psi'); ?></th> 
						
						<th><?php _e('Bar'); ?></th>
						
						<th><?php _e('ins'); ?></th>
						
						<th><?php _e('mm'); ?></th>
						
						<th><?php _e('ins'); ?></th>
						
						<th><?php _e('mm'); ?></th>
						
						<th><?php _e('ins'); ?></th>
						
						<th><?php _e('mm'); ?></th>
						
						<th><?php _e('miles'); ?></th>
						
						<th><?php _e('km'); ?></th>
						
					</tr>
			
				</thead>
				
			<?php else: ?>
				
				<thead>
					
					<tr>	
						
						<th><?php _e('Tire size'); ?></th>
						
						<th><?php _e('Service Index'); ?></th>
						
						<th><?php _e('Rim choice'); ?></th>
						
						<th><?php _e('Rim used'); ?></th>
						
						<th colspan='2'><?php _e('Measured at'); ?></th>
						
						<th colspan='2'><?php _e('Diameter'); ?></th>
						
						<th colspan='2'><?php _e('Section'); ?></th>
						
						<th colspan='2'><?php _e('Tread'); ?></th>
						
						<th colspan='2'><?php _e('Revolutions'); ?></th>
						
					</tr>
					
					<tr>
						
						<th colspan='4'></th>
						
						<th><?php _e('psi'); ?></th> 
						
						<th><?php _e('Bar'); ?></th>
						
						<th><?php _e('ins'); ?></th>
						
						<th><?php _e('mm'); ?></th>
						
						<th><?php _e('ins'); ?></th>
						
						<th><?php _e('mm'); ?></th>
						
						<th><?php _e('ins'); ?></th>
						
						<th><?php _e('mm'); ?></th>
						
						<th><?php _e('miles'); ?></th>
						
						<th><?php _e('km'); ?></th>
						
					</tr>
				
				</thead>
				
			<?php endif; ?>
			
			<?php if ( $post->post_title == 'Cooper RS3-R' || $post->post_title == 'Cooper RS3-RS' ): ?>
			
				<tr>
						
					<td><?php the_sub_field('tire_size'); ?></td>
					
					<td><?php the_sub_field('service_index'); ?></td>
					
					<td><?php the_sub_field('utqg_treadwear'); ?></td>
					
					<td><?php the_sub_field('utqg_traction'); ?></td>

					<td><?php the_sub_field('utqg_temperature'); ?></td>
					
					<td><?php the_sub_field('rim_choice'); ?></td>
					
					<td><?php the_sub_field('rim_used'); ?></td>

					<td><?php the_sub_field('measured_at_psi'); ?></td>

					<td><?php the_sub_field('measured_at_bar'); ?></td>

					<td><?php the_sub_field('diameter_ins'); ?></td>

					<td><?php the_sub_field('diameter_mm'); ?></td>

					<td><?php the_sub_field('section_ins'); ?></td>

					<td><?php the_sub_field('section_mm'); ?></td>

					<td><?php the_sub_field('tread_ins'); ?></td>

					<td><?php the_sub_field('tread_mm'); ?></td>

					<td><?php the_sub_field('revolutions_miles'); ?></td>

					<td><?php the_sub_field('revolutions_km'); ?></td>
					
				</tr>
			
			<?php else: ?>
	
				<?php while ( have_rows( 'tires' ) ): the_row(); ?>
						
					<tr>
						
						<td><?php the_sub_field('tire_size'); ?></td>
						
						<td><?php the_sub_field('service_index'); ?></td>
						
						<td><?php the_sub_field('rim_choice'); ?></td>
						
						<td><?php the_sub_field('rim_used'); ?></td>
	
						<td><?php the_sub_field('measured_at_psi'); ?></td>
	
						<td><?php the_sub_field('measured_at_bar'); ?></td>
	
						<td><?php the_sub_field('diameter_ins'); ?></td>
	
						<td><?php the_sub_field('diameter_mm'); ?></td>
	
						<td><?php the_sub_field('section_ins'); ?></td>
	
						<td><?php the_sub_field('section_mm'); ?></td>
	
						<td><?php the_sub_field('tread_ins'); ?></td>
	
						<td><?php the_sub_field('tread_mm'); ?></td>
	
						<td><?php the_sub_field('revolutions_miles'); ?></td>
	
						<td><?php the_sub_field('revolutions_km'); ?></td>
						
					</tr>	
					
				<?php endwhile; ?>
			
			<?php endif; ?>
			
		</table>
		
	</div>
	
<?php endif; ?>