<div id="header-nav" class="">
	
	<div class="container">
		
		<div class="row">
			
			<div class="col-12">
	
				<div class="d-flex justify-content-center justify-content-xl-between">
			
					<div class="align-self-center d-none d-xl-block">
			
						<ul class="list-inline mb-0">
							
							<li class="list-inline-item <?php echo ( is_product_category( 'indy-lights' ) || has_term( 'indy-lights', 'product_cat' ) && ! is_search() ? 'active' : '' ); ?>"><span><a class="d-flex align-items-center align-self-center" href="<?php echo home_url('/store/contract/indy-lights/'); ?>"><?php _e('Indy Lights'); ?></a></span></li>
							
							<li class="list-inline-item <?php echo ( is_product_category( 'indy-pro-2000' ) || has_term( 'indy-pro-2000', 'product_cat' ) && ! is_search() ? 'active' : '' ); ?>"><span><a class="d-flex align-items-center align-self-center" href="<?php echo home_url('/store/contract/indy-pro-2000/'); ?>"><?php _e('IP2K'); ?></a></span></li>
		
							<li class="list-inline-item <?php echo ( is_product_category( 'usf-2000' ) || has_term( 'usf-2000', 'product_cat' ) && ! is_search() ? 'active' : '' ); ?>"><span><a class="d-flex align-items-center align-self-center" href="<?php echo home_url('/store/contract/usf-2000'); ?>"><?php _e('USF2000'); ?></a></span></li>
							
							<li class="list-inline-item <?php echo ( is_product_category( 'rally' ) || has_term( 'rally', 'product_cat' ) && ! is_search() ? 'active' : '' ); ?>"><span><a class="d-flex align-items-center align-self-center" href="<?php echo home_url('/store/contract/rally'); ?>"><?php _e('Rally'); ?></a></span></li>
		
							<li class="list-inline-item <?php echo ( is_product_category( 'dot_race' ) || has_term( 'dot_race', 'product_cat' ) && ! is_search() ? 'active' : '' ); ?>"><span><a class="d-flex align-items-center align-self-center" href="<?php echo home_url('/store/contract/dot_race'); ?>"><?php _e('DOT-R'); ?></a></span></li>
		
							<li class="list-inline-item <?php echo ( is_product_category( 'rallycross' ) || has_term( 'rallycross', 'product_cat' ) && ! is_search() ? 'active' : '' ); ?>"><span><a class="d-flex align-items-center align-self-center" href="<?php echo home_url('/store/contract/rallycross'); ?>"><?php _e('Rally-X'); ?></a></span></li>
							
						</ul>
					
					</div>
					
					<div class="align-self-center flex-shrink-1 position-md-relative d-md-none d-xl-block">
						
						<div id="header-search">
							
							<form role="search" id="sites-search" class="search-form h-100" action="/store/contract" method="get">
							
								<div class="form-group" id="search">
							
									<label class="sr-only" for="search-text"><?php _e('Search'); ?></label>
							
									<input type="text" id="search-text" class="form-control" placeholder="Search" name="s">
							
									<button type="submit" id="btn-search" class="form-control form-control-submit h-100"></button>
							
									<span class="search-label h-100 d-flex align-items-center justify-content-center"><i class="fas fa-search"></i></span>
							
									<input type="hidden" name="post_type" value="product" />
							
								</div>
							
							</form>
					
						</div>
						
					</div>
					
				</div>
				
			</div>
				
		</div>
	
	</div>

</div>