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

class ComCloudinaryControllerImage extends ComDefaultControllerDefault
{
	/**
	 * getRequest make sure the
	 *
	 * @return mixed
	 */
	public function getRequest()
	{
		$this->_request->layout = 'default';

		return parent::getRequest();
	}

	/**
	 * _actionGet here we will check if the we access a singular or a plural,
	 * when plural the action will return true if singular we will check if the requested tile exists.
	 *
	 * @param KCommandContext $context
	 * @return bool|KDatabaseRow
	 */
	protected function _actionGet(KCommandContext $context)
    {
		if(KInflector::isSingular($this->_request->view))
		{
			if(!file_exists(JPATH_FILES . '/' . $this->_request->path) || is_dir(JPATH_FILES . '/' . $this->_request->path)) {
				return false;
			}
		}

        return parent::_actionGet($context);
    }
}