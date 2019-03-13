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

<div class="py-3 py-lg-4">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6 text-center">
				<h1 class="mb-3 title"><?php the_field('home_title', $term); ?></h1>
				<h3 class="mb-3 subtitle"><?php the_field('home_sub_title', $term); ?></h3>
				<i class="fas fa-chevron-down fa-3x text-primary"></i>
			</div>
		</div>
	</div>
</div>
<div id="section-brands" class="bg-light">
	<div class="container-fluid p-0">
		<div class="row no-gutters align-items-stretch">
			<div class="col-lg-4">
				<div class="bg-img h-100" style="background-image: url(<?php echo $brand_1_bg_src[0]; ?>)">
					<div class="bg-overlay"></div>
					<div class="bg-img-content py-2 px-1 px-sm-3 d-flex align-content-end flex-column  h-100">
						<div class="mt-auto">
							<?php echo wp_get_attachment_image($brand_1['brand_logo']['id'], 'full', false, array('class'=>'img-fluid mb-2', 'style'=>'width: 125px')); ?>
							<h3 class="mb-1 text-white"><?php echo $brand_1['brand_title']; ?></h3>
							<p class="mb-2 text-white"><?php echo $brand_1['brand_text']; ?></p>
							<a href="<?php echo $brand_1['brand_button_link']; ?>" class="btn btn-white"><?php echo $brand_1['brand_button_label']; ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="bg-img h-100" style="background-image: url(<?php echo $brand_2_bg_src[0]; ?>)">
					<div class="bg-overlay"></div>
					<div class="bg-img-content py-2 px-sm-3 d-flex align-content-end flex-column  h-100">
						<div class="mt-auto">
							<?php echo wp_get_attachment_image($brand_2['brand_logo']['id'], 'full', false, array('class'=>'img-fluid mb-2', 'style'=>'width: 125px')); ?>
							<h3 class="mb-1 text-white"><?php echo $brand_2['brand_title']; ?></h3>
							<p class="mb-2 text-white"><?php echo $brand_2['brand_text']; ?></p>
							<a href="<?php echo $brand_2['brand_button_link']; ?>" class="btn btn-white"><?php echo $brand_2['brand_button_label']; ?></a>
						</div>
					</div>
				</div>			
			</div>
			<div class="col-lg-4">
				<div class="bg-img h-100" style="background-image: url(<?php echo $brand_3_bg_src[0]; ?>)">
					<div class="bg-overlay"></div>
					<div class="bg-img-content py-2 px-sm-3 d-flex align-content-end flex-column  h-100">
						<div class="mt-auto">
							<?php echo wp_get_attachment_image($brand_3['brand_logo']['id'], 'full', false, array('class'=>'img-fluid mb-2', 'style'=>'width: 180px')); ?>
							<h3 class="mb-1 text-white"><?php echo $brand_3['brand_title']; ?></h3>
							<p class="mb-2 text-white"><?php echo $brand_3['brand_text']; ?></p>
							<a href="<?php echo $brand_3['brand_button_link']; ?>" class="btn btn-white"><?php echo $brand_3['brand_button_label']; ?></a>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>
<div id="section-company" class="py-3 py-lg-5 bg-light">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-lg-5 align-content-center">
				<?php echo wp_get_attachment_image(get_field('home_company_image', $term), 'hero banner', false, array('class'=>'img-full')); ?>
			</div>
			<div class="col-lg-7 bg-white p-1 p-sm-3 p-lg-4">
				<h1 class="mt-3 mt-lg-0 mb-2 mb-lg-3"><?php the_field('home_company_title', $term); ?></h1>
				<div class="text-lg mb-2 mb-lg-3"><?php the_field('home_company_description', $term); ?></div>
				<a href="<?php the_field('home_company_button_link', $term); ?>" class="btn btn-primary d-block d-sm-inline-block text-center text-lg-left"><span><?php the_field('home_company_button_label', $term); ?></span></a>
			</div>
		</div>
	</div>
</div>