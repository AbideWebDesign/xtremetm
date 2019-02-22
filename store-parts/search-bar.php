<div id="header-search">
	<form role="search" id="sites-search" class="search-form" action="/store/<?php echo $store->slug; ?>/" method="get">
		<div class="form-group float-right" id="search">
			<label class="sr-only" for="search-text">Search</label>
			<input type="text" class="form-control input-sm" id="search-text" placeholder="" name="s">
			<button type="submit" id="btn-search" class="form-control form-control-submit h-100"></button>
			<span class="search-label h-100 d-flex align-items-center justify-content-center"><i class="fas fa-search"></i></span>
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>
</div>
