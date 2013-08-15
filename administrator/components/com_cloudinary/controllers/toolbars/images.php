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

class ComCloudinaryControllerToolbarImages extends ComDefaultControllerToolbarDefault
{
	public function getCommands()
	{
		$this->reset();

		$this->addDelete();

		return parent::getCommands();
	}
}