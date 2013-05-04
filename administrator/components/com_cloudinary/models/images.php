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

class ComCloudinaryModelImages extends ComCloudinaryModelCloudinary
{
	/**
	 * __construct declaration of states.
	 *
	 * @param KConfig $config
	 */
	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->getState()->insert('width', 'int')
						 ->insert('height', 'int')
						 ->insert('path', 'string', null, true)
						 ->insert('gravity', 'word')
						 ->insert('crop', 'string', 'fill')
						 ->insert('cache', 'string')
						 ->insert('container', 'string')
						 ->insert('radius', 'string')
						 ->insert('quality', 'int')
						 ->insert('angle', 'string')
						 ->insert('effect', 'string')
						 ->insert('border', 'string')
						 ->insert('background', 'string')
						 ->insert('overlay', 'string')
						 ->insert('underlay', 'string')
						 ->insert('page', 'int')
						 ->insert('density', 'int')
						 ->insert('fetch_format', 'string');
	}
}