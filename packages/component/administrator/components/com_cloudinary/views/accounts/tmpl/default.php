<?php
/**
 * ComCloudinary
 *
 * @author      Jasper van Rijbroek <jasper@moyoweb.nl>
 * @category    Nooku
 * @package     Moyo Components
 * @subpackage  Cloudinary
 */

defined('KOOWA') or die('Protected Resource'); ?>

<?= @helper('behavior.mootools'); ?>
<script src="media://lib_koowa/js/koowa.js" />

<form method="get" action="<?= @route() ?>" class="-koowa-grid">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th><?= @helper('grid.checkall') ?></th>
				<th>#</th>
				<th><?= @text('Cloud Name') ?></th>
				<th><?= @text('Default') ?></th>
			</tr>
		</thead>
		<tbody>
			<?= @template('default_items') ?>
		</tbody>
	</table>
</form>