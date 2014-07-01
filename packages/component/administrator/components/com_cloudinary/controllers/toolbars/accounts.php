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

class ComCloudinaryControllerToolbarAccounts extends ComDefaultControllerToolbarDefault
{
	public function getCommands()
	{
		$this->addCommand('default');

		return parent::getCommands();
	}
}