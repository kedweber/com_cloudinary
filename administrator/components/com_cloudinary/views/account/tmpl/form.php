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

<script src="media://lib_koowa/js/koowa.js" />
<style src="media://lib_koowa/css/koowa.css" />
<style src="media://com_articles/css/article-form.css" />

<form method="post" action="<?= @route('view=account&id='.$account->id) ?>"  id="article-form" class="-koowa-form">
	<div id="main" class="grid_8">
		<div class="panel title clearfix">
			<input class="inputbox required" type="text" name="cloud_name" id="title" size="40" maxlength="255" value="<?= $account->cloud_name ?>" placeholder="<?= @text('Cloud Name') ?>" />
			<label for="slug"><?= @text('Slug') ?></label>
			<input class="inputbox" type="text" name="slug" id="slug" size="40" maxlength="255" value="<?= $account->slug ?>" placeholder="<?= @text('Slug') ?>" />
		</div>

		<table>
			<tr>
				<td><label class="key"><?= @text('API Key') ?></label></td>
				<td><input class="inputbox" type="text" name="api_key" value="<?= $account->api_key ?>" placeholder="<?= @text('API Key') ?>" /></td>
			</tr>
			<tr>
				<td><label class="key"><?= @text('API Key') ?></label></td>
				<td><input class="inputbox" type="text" name="api_secret" value="<?= $account->api_secret ?>" placeholder="<?= @text('API Secret') ?>" /></td>
			</tr>
		</table>
	</div>
</form>