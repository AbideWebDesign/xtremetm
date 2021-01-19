<?php 
	
	$brand_1 = get_field('brand_1', $term); 
	$brand_1_bg = $brand_1['brand_image'];
	$brand_1_bg_src = wp_get_attachment_image_src($brand_1_bg['id'], 'col-7', false);
	
	$brand_2 = get_field('brand_2', $term); 
	$brand_2_bg = $brand_2['brand_image'];
	$brand_2_bg_src = wp_get_attachment_image_src($brand_2_bg['id'], 'col-7', false);
	
	$brand_3 = get_field('brand_3', $term); 
	$brand_3_bg = $brand_3['brand_image'];
	$brand_3_bg_src = wp_get_attachment_image_src($brand_3_bg['id'], 'col-7', false);
	
?>
<div id="section-brands" class="bg-light py-3">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2 class="mb-2 large">Find Your Tires</h2>
			</div>
		</div>
		<div class="row align-items-stretch justify-content-center">
			<div class="col-md-6 col-lg-4 mt-2 mt-lg-0">
				<div class="bg-white h-100 s">
					<a href="<?php echo $brand_3['brand_button_link']; ?>">
						<div class="bg-img d-flex px-1" style="background-image: url(<?php echo $brand_3_bg_src[0]; ?>)">
							<div class="bg-overlay"></div>
							<div class="d-flex align-content-center w-100 text-center position-relative">
								<h2 class="text-white w-100 text-center align-self-center"><?php echo $brand_3['brand_title']; ?></h2>
							</div>
						</div>
					</a>
					<div class="bg-img-content px-1 px-sm-2 py-2">
						<div class="mt-auto">
							<?php echo wp_get_attachment_image($brand_3['brand_logo']['id'], 'full', false, array('class'=>'img-fluid mb-2', 'style'=>'width: 125px')); ?>
							<p class="mb-2"><?php echo $brand_3['brand_text']; ?></p>
							<a href="<?php echo $brand_3['brand_button_link']; ?>" class="btn btn-primary"><span><?php echo $brand_3['brand_button_label']; ?></span></a>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>