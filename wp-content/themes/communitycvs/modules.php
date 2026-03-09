<div id="modules">
	<?php 
	$modules = get_field('modules');
	$modN = 1;
	$carouselN = 1;
	if($modules!=false) :
	foreach($modules as $module):
		include(locate_template('modules/'.$module['acf_fc_layout'].'.php')); 
		$modN++;
		if($module['acf_fc_layout']=='carousel' || $module['acf_fc_layout']=='panel_slider'|| $module['acf_fc_layout']=='latest_news') :
			$carouselN++;
		endif;
	endforeach; 
	endif;
	?>
</div>