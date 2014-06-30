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

<?= @helper('behavior.mootools'); ?>
<script src="media://lib_koowa/js/koowa.js" />

<form method="post" action="<?= @route('view=account&id='.$account->id) ?>"  id="article-form" class="-koowa-form">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <div class="control-group">
                    <label class="control-label"><?= @text('Cloudname'); ?></label>
                    <div class="controls">
                        <input class="span12 required" type="text" name="cloud_name" value="<?= @escape($account->cloud_name); ?>" placeholder="<?= @text('Cloud Name'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('Slug'); ?></label>
                    <div class="controls">
                        <input class="span8 required" type="text" name="slug" value="<?= @escape($account->slug); ?>" placeholder="<?= @text('Slug'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('API Key'); ?></label>
                    <div class="controls">
                        <input class="span8 required" type="text" name="api_key" value="<?= @escape($account->api_key); ?>" placeholder="<?= @text('API Key'); ?>" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?= @text('API Secret'); ?></label>
                    <div class="controls">
                        <input class="span8 required" type="text" name="api_secret" value="<?= @escape($account->api_secret); ?>" placeholder="<?= @text('API Secret'); ?>" />
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</form>