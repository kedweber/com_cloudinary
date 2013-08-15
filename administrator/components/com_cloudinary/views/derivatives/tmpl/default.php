<? defined('KOOWA') or die('Restricted Access'); ?>

<?= @helper('behavior.mootools') ?>
<?= @helper('behavior.modal') ?>

<table class="adminlist">
	<thead>
		<tr>
			<th>#</th>
			<th><?= @text('Transformation') ?></th>
			<th><?= @text('Format') ?></th>
			<th><?= @text('Size') ?></th>
			<th><?= @text('Url') ?></th>
		</tr>
	</thead>
	<tbody>
		<?= @template('default_items') ?>
	</tbody>
</table>