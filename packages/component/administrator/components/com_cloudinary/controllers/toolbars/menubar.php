<?php
/**
 * ComCloudinary
 *
 * @author      Jasper van Rijbroek <jasper@moyoweb.nl>
 * @category    Nooku
 * @package     Moyo Components
 * @subpackage  Cloudinary
 */

defined('KOOWA') or die('Protected Resource');

class ComCloudinaryControllerToolbarMenubar extends ComDefaultControllerToolbarMenubar
{
	public function getCommands()
	{
		$name = $this->getController()->getIdentifier()->name;

		$this->addCommand('Images' , array(
			'href'   => JRoute::_('index.php?option=com_cloudinary&view=images'),
			'active' => ($name == 'image')
		));

		$this->addCommand('Accounts' , array(
			'href'   => JRoute::_('index.php?option=com_cloudinary&view=accounts'),
			'active' => ($name == 'account')
		));

		return parent::getCommands();
	}
}