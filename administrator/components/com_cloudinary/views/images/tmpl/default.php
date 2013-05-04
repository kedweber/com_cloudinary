<?php
/**
 * ComCloudinary
 *
 * @author      Jasper van Rijbroek <jasper@moyoweb.nl>
 * @category    Nooku
 * @package     Moyo Components
 * @subpackage  Cloudinary
 */

defined('KOOWA') or die('Restricted Access'); ?>

<?= @helper('behavior.modal') ?>

<script type="text/javascript">
	function submitform(pressbutton){
		if (pressbutton) {
			document.adminForm.task.value=pressbutton;
		}
		if (typeof document.adminForm.onsubmit == "function") {
			document.adminForm.onsubmit();
		}
		document.adminForm.submit();
	}
</script>

<form method="get" action="<?= @route() ?>" class="-koowa-grid">
	<table class="adminlist">
		<thead>
			<tr>
				<th><?= @helper('grid.checkall') ?></th>
				<th>#</th>
				<th><?= @text('Path') ?></th>
				<th><?= @text('Preview') ?></th>
			</tr>
		</thead>
		<tbody>
			<?= @template('default_items') ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4"><?= @helper('paginator.pagination', array('total' => $total)) ?></td>
			</tr>
		</tfoot>
	</table>
</form>