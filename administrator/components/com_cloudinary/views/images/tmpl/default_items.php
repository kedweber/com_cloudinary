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

<? $i = 0; ?>
<? foreach($images as $image): ?>
	<? $i++; ?>
	<tr>
		<td><?= @helper('grid.checkbox', array('row' => $image)) ?></td>
		<td><?= $i; ?></td>
		<td><a href="<?= @route('view=image&path='.$image->path.'&cloudinary_account_id='.$image->cloudinary_account_id) ?>"><?= $image->path ?></a></td>
		<td>
			<a class="modal" href="<?= $image->getUrl() ?>">
				<?= @text('Preview') ?>
			</a>
		</td>
	</tr>
<? endforeach ?>

<? if(!count($images)): ?>
	<tr>
		<td colspan="7" style="text-align: center;"><?= @text('No images found') ?>.</td>
	</tr>
<? endif; ?>