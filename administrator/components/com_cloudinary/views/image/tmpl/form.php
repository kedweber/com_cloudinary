<?php
/**
 * @version     $Id: form.php 3314 2012-02-10 02:14:52Z johanjanssens $
 * @category    Nooku
 * @package     Nooku_Server
 * @subpackage  Articles
 * @copyright   Copyright (C) 2011 - 2012 Timble CVBA and Contributors. (http://www.timble.net).
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        http://www.nooku.org
 */

defined('KOOWA') or die('Restricted access') ?>

<?= @helper('behavior.mootools') ?>
<script src="media://lib_koowa/js/koowa.js" />

<style src="media://com_articles/css/article-form.css" />

<div id="main" class="grid_12">
	<form method="post" action="#" class="-koowa-form">
		<div class="panel title clearfix">
			<input class="inputbox required" type="text" name="title" id="title" size="40" maxlength="255" disabled="disabled" value="<?= $image->path?>" placeholder="<?= @text('Title') ?>" />
		</div>

		<div class="panel title">
			<h2><?= @text('Original Image') ?></h2>

			<img src="<?= str_replace(JPATH_ROOT, JURI::root(), JPATH_FILES) ?>/<?= $image->path; ?>" />
		</div>

		<div class="panel title">
			<h2><?= @text('Derived Images') ?></h2>

			<?= @overlay(array(
				'url' => @route('view=derivatives&public_id='.$image->public_id.'&cloudinary_account_id='.$image->cloudinary_account_id)
			)); ?>
		</div>
	</form>
</div>