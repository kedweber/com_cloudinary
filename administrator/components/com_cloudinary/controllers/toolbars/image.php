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

class ComCloudinaryControllerToolbarImage extends ComDefaultControllerToolbarDefault
{
	public function getCommands()
	{
		$this->reset();

		$this->addCancel();

		return parent::getCommands();
	}
}