<?php 
$class = 'image';
if($module['width']=='column') : 
	$class .= ' inner';
endif;	
if($module['fixed_position']==true) :
	$class .= ' fixed-scroll';
endif;
?>
<div class="module full-width-image outer pink">
		<div class="<?= $class; ?>" style="background-image: url('<?php echo $module['image']['sizes']['carousel']; ?>')">
			<img src="<?php echo $module['image']['sizes']['carousel']; ?>" width="<?php echo $module['image']['sizes']['carousel-width']; ?>" height="<?php echo $module['image']['sizes']['carousel-height']; ?>" alt="<?php echo $module['image']['alt']; ?>" />
		</div>
		<?php if($module['image']['caption']!='') : ?>
		<div class="inner caption"><?= $module['image']['caption']; ?></div>
		<?php endif; ?>
</div>