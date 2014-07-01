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

class ComCloudinaryDispatcher extends ComDefaultDispatcher
{
	public function _initialize(KConfig $config)
	{
		$config->append(array(
			'controller' => 'images'
		));

		parent::_initialize($config);
	}
}