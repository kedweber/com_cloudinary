<? defined('KOOWA') or die('Restricted Access'); ?>

<? $i = 0; ?>

<? foreach($derivatives as $derivative) : ?>
	<? $i++; ?>
	<tr>
		<td><?= $i; ?></td>
		<td><?= $derivative->transformation ?></td>
		<td><?= $derivative->format ?></td>
		<td><?= $derivative->bytes ?></td>
		<td><a href="<?= $derivative->url ?>" class="modal"><?= $derivative->url ?></a></td>
	</tr>
<? endforeach; ?>