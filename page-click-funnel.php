<?php
/**
 * Template Name: Click Funnel
 */

get_header('landing');
?>

<div class="embed-responsive embed-responsive embed-responsive-1by1 h-100">
	 <iframe class="embed-responsive-item" src="<?php the_field('click_funnel_address'); ?>"></iframe>
</div>
<?php
get_footer('landing');
