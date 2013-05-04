<?php
/**
 * ComCloudinary
 *
 * @author      Jasper van Rijbroek <jasper@moyoweb.nl>
 * @category    Nooku
 * @package     Moyo Components
 * @subpackage  Cloudinary
 */

defined('KOOWA') or die('Restricted Access');

class ComCloudinaryControllerAccount extends ComDefaultControllerDefault
{
	public function _actionDefault(KCommandContext $context)
	{
		$context->data->default = 1;

		return parent::_actionEdit($context);
	}
}