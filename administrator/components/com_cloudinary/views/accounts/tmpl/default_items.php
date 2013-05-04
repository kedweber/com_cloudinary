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
<? foreach($accounts as $account): ?>
	<? $i++; ?>
	<tr>
		<td><?= @helper('grid.checkbox', array('row' => $account)) ?></td>
		<td><?= $i; ?></td>
		<td>
			<a href="<?= @route('view=account&id='.$account->id) ?>">
				<?= $account->cloud_name ?>
			</a>
		</td>
		<td>
			<?php if ( $account->default == 1 ) : ?>
				<img src="templates/default/images/menu/icon-16-default.png" alt="<?php echo JText::_( 'Default' ); ?>" />
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</td>
	</tr>
<? endforeach ?>

<? if(!count($accounts)): ?>
	<tr>
		<td colspan="7" style="text-align: center;"><?= @text('No accounts found') ?>.</td>
	</tr>
<? endif; ?>