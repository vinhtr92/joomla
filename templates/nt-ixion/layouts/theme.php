<?php
/**
 * @package   yoo_master2
 * @author    YOOtheme http://www.yootheme.com
 * @copyright Copyright (C) YOOtheme GmbH
 * @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

// get theme configuration
include($this['path']->path('layouts:theme.config.php'));

?>
<!DOCTYPE HTML>
<html lang="<?php echo $this['config']->get('language'); ?>" dir="<?php echo $this['config']->get('direction'); ?>"
      data-config='<?php echo $this['config']->get('body_config', '{}'); ?>'>

<head>
	<?php echo $this['template']->render('head'); ?>
</head>

<body class="<?php echo $this['config']->get('body_classes'); ?>">

<div class="tm-header">

	<?php if ($this['widgets']->count('toolbar-l + toolbar-r + toolbar-block')) : ?>
		<div class="tm-toolbar uk-clearfix">

			<div class="uk-container uk-container-center uk-hidden-small">

				<?php if ($this['widgets']->count('toolbar-l')) : ?>
					<div class="uk-float-left"><?php echo $this['widgets']->render('toolbar-l'); ?></div>
				<?php endif; ?>

				<?php if ($this['widgets']->count('toolbar-r')) : ?>
					<div class="uk-float-right"><?php echo $this['widgets']->render('toolbar-r'); ?></div>
				<?php endif; ?>

			</div>

			<?php if ($this['widgets']->count('toolbar-block')) : ?>
				<div class="uk-container uk-container-center uk-container--toolbar-block">
					<section class="<?php echo $grid_classes['toolbar-block'];
					echo $display_classes['toolbar-block']; ?> toolbar-block" data-uk-grid-match="{target:'> div > .uk-panel'}">
						<?php echo $this['widgets']->render('toolbar-block', array('layout' => $this['config']->get('grid.toolbar-block.layout'))); ?>
					</section>
				</div>
			<?php endif; ?>

		</div>
	<?php endif; ?>

	<div class="uk-container uk-container-center">

		<?php if ($this['widgets']->count('menu + search + logo + offcanvas +logo-small ')) : ?>
			<div class="tm-headerbar">


				<div class="uk-navbar">

					<?php if ($this['widgets']->count('logo')) : ?>
						<a class="tm-logo uk-navbar-logo uk-visible-large"
						   href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo'); ?></a>
					<?php endif; ?>

					<?php if ($this['widgets']->count('menu')) : ?>
						<nav class="uk-visible-large">
							<?php echo $this['widgets']->render('menu'); ?>
						</nav>
					<?php endif; ?>

					<?php if ($this['widgets']->count('search')) : ?>
						<div class="uk-navbar-flip">
							<div
								class="uk-navbar-search uk-visible-large"><?php echo $this['widgets']->render('search'); ?></div>
						</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('offcanvas')) : ?>
						<div class="uk-hidden-large">
							<a href="#offcanvas" class="uk-navbar-toggle" data-uk-offcanvas></a>
						</div>
					<?php endif; ?>

					<?php if ($this['widgets']->count('logo-small')) : ?>
						<div class="uk-navbar-content uk-navbar-center uk-hidden-large"><a class="tm-logo-small"
						                                                                   href="<?php echo $this['config']->get('site_url'); ?>"><?php echo $this['widgets']->render('logo-small'); ?></a>
						</div>
					<?php endif; ?>

				</div>

			</div>

		<?php endif; ?>

		<?php if ($this['widgets']->count('top-a + breadcrumbs')) : ?>
			<?php if ($this['widgets']->count('top-a')) : ?>
				<section class="<?php echo $grid_classes['top-a'];
				echo $display_classes['top-a']; ?> tm-theme-showcase" data-uk-grid-match="{target:'> div > .uk-panel'}"
				         data-uk-grid-margin>
					<?php echo $this['widgets']->render('top-a', array('layout' => $this['config']->get('grid.top-a.layout'))); ?>
					<i class="tm-theme-showcase-bg-module"></i>
				</section>
			<?php endif; ?>
			<?php if ($this['widgets']->count('breadcrumbs')) : ?>
				<div class="tm-breadcrumbs tm-theme-showcase">
					<?php echo $this['widgets']->render('breadcrumbs'); ?>
					<i class="tm-theme-showcase-bg"></i>
				</div>
			<?php endif; ?>
		<?php endif; ?>

	</div>
</div>


<div class="uk-container uk-container-center">

	<div class="tm-theme-maintext">

		<?php if ($this['widgets']->count('top-b')) : ?>
			<section class="<?php echo $grid_classes['top-b'];
			echo $display_classes['top-b']; ?> tm-main-box" data-uk-grid-match="{target:'> div > .uk-panel'}"
			         data-uk-grid-margin>
				<?php echo $this['widgets']->render('top-b', array('layout' => $this['config']->get('grid.top-b.layout'))); ?>
				<i class="tm-gradient-line"></i>
			</section>
		<?php endif; ?>

		<?php if ($this['widgets']->count('top-c')) : ?>
			<section class="<?php echo $grid_classes['top-c'];
			echo $display_classes['top-c']; ?> tm-main-box" data-uk-grid-match="{target:'> div > .uk-panel'}"
			         data-uk-grid-margin>
				<?php echo $this['widgets']->render('top-b', array('layout' => $this['config']->get('grid.top-c.layout'))); ?>
				<i class="tm-gradient-line"></i>
			</section>
		<?php endif; ?>

		<?php if ($this['widgets']->count('main-top + main-bottom + sidebar-a + sidebar-b') || $this['config']->get('system_output', true)) : ?>
			<div class="tm-middle uk-grid tm-main-box" data-uk-grid-match data-uk-grid-margin>

				<?php if ($this['widgets']->count('main-top + main-bottom') || $this['config']->get('system_output', true)) : ?>
					<div class="<?php echo $columns['main']['class'] ?>">

						<?php if ($this['widgets']->count('main-top')) : ?>
							<section class="<?php echo $grid_classes['main-top'];
							echo $display_classes['main-top']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}"
							         data-uk-grid-margin><?php echo $this['widgets']->render('main-top', array('layout' => $this['config']->get('grid.main-top.layout'))); ?></section>
						<?php endif; ?>

						<?php if ($this['config']->get('system_output', true)) : ?>
							<main class="tm-content">

								<?php echo $this['template']->render('content'); ?>

							</main>
						<?php endif; ?>

						<?php if ($this['widgets']->count('main-bottom')) : ?>
							<section class="<?php echo $grid_classes['main-bottom'];
							echo $display_classes['main-bottom']; ?>" data-uk-grid-match="{target:'> div > .uk-panel'}"
							         data-uk-grid-margin><?php echo $this['widgets']->render('main-bottom', array('layout' => $this['config']->get('grid.main-bottom.layout'))); ?></section>
						<?php endif; ?>

					</div>
				<?php endif; ?>

				<?php foreach ($columns as $name => &$column) : ?>
					<?php if ($name != 'main' && $this['widgets']->count($name)) : ?>
						<aside
							class="<?php echo $column['class'] ?>"><?php echo $this['widgets']->render($name) ?></aside>
					<?php endif ?>
				<?php endforeach ?>
				<i class="tm-gradient-line"></i>
			</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-a')) : ?>
			<section class="<?php echo $grid_classes['bottom-a'];
			echo $display_classes['bottom-a']; ?> tm-main-box" data-uk-grid-match="{target:'> div > .uk-panel'}"
			         data-uk-grid-margin>
				<?php echo $this['widgets']->render('bottom-a', array('layout' => $this['config']->get('grid.bottom-a.layout'))); ?>
				<i class="tm-gradient-line"></i>
			</section>
		<?php endif; ?>

		<?php if ($this['widgets']->count('bottom-b')) : ?>
			<section class="<?php echo $grid_classes['bottom-b'];
			echo $display_classes['bottom-b']; ?> tm-main-box" data-uk-grid-match="{target:'> div > .uk-panel'}"
			         data-uk-grid-margin>
				<?php echo $this['widgets']->render('bottom-b', array('layout' => $this['config']->get('grid.bottom-b.layout'))); ?>
				<i class="tm-gradient-line"></i>
			</section>
		<?php endif; ?>

	</div>

</div>

<?php if ($this['widgets']->count('footer + debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
	<footer class="tm-footer">

		<?php if ($this['widgets']->count('footer')) : ?>
			<div class="uk-container uk-container-center">
				<div class="uk-grid tm-footer-pos">
					<?php echo $this['widgets']->render('footer', array('layout' => $this['config']->get('grid.footer.layout'))); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ($this['widgets']->count('debug') || $this['config']->get('warp_branding', true) || $this['config']->get('totop_scroller', true)) : ?>
			<div class="uk-container uk-container-center">
				<?php if ($this['config']->get('totop_scroller', true)) : ?>
					<a class="tm-totop-scroller" data-uk-smooth-scroll href="#"></a>
				<?php endif; ?>

				<?php
				$this->output('warp_branding');
				echo $this['widgets']->render('debug');
				?>
			</div>
		<?php endif; ?>
	</footer>
<?php endif; ?>

<?php echo $this->render('footer'); ?>

<?php if ($this['widgets']->count('offcanvas')) : ?>
	<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar"><?php echo $this['widgets']->render('offcanvas'); ?></div>
	</div>
<?php endif; ?>

</body>
</html>