<?php 
// No direct access
defined('_JEXEC') or die; ?>

<div class="newsflash<?php echo $moduleclass_sfx; ?>">
	<?php foreach ($list as $item) : ?>
		<?php require JModuleHelper::getLayoutPath('mod_helloworld', '_item'); ?>
	<?php endforeach; ?>
</div>
