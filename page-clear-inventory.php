<?php
/**
 * Template Name: Clear Tire Inventory
 *
 * @package xtremetm
 */

wp_head();

?>

<?php if ( $_POST ): ?>
	
	<?php clear_inventory(); ?>

<?php else: ?>

	<div class="d-flex h-100 align-items-center">
		
		<div class="text-center w-100">
			
			<form name="clear-inventory" id="clear-inventory" method="post" action="<?php echo  get_permalink($page_id); ?>">
				
				 <input class="btn btn-primary" type="submit" name="submit" value="Clear Inventory" id="submit"/>
				
			</form>
		
		</div>
		
	</div>
	
<?php endif; ?>

<?php

wp_footer();