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

class ComCloudinaryDatabaseRowImage extends KDatabaseRowDefault
{
	/**
	 * getImage will fire some checks and save the file on the filesystem.
	 * At the end the link to the file is returned.
	 *
	 * @param $url url of the cloudinary image
	 * @param $data image manipulation properties
	 * @return string location of the image locally stored file
	 */
	public function getImage($url, $data)
	{
		$parts = explode('/', $url);

		$dir = JPATH_FILES.'/'.'images'.'/'.'resized'.'/'.$data['height'].'/'.$data['width'];
		if(!is_dir($dir))
		{
			KService::get('com://admin/files.controller.folder')
				->container('resized')
				->folder($data['height'])
				->name($data['width'])
				->add()
				->toArray();
		}

		if(!file_exists($dir.'/'.end($parts)))
		{
			KService::get('com://admin/files.controller.file')
				->container('resized')
				->folder($data['height'].'/'.$data['width'])
				->name(end($parts))
				->add(array('contents' => file_get_contents($url)))
				->toArray();
		}

		// @TODO: I need to do something about the names.
		return 'images/resized'.'/'.$data['height'].'/'.$data['width'].'/'.end($parts);
	}

	public function getContainer()
	{
		return $this->getService('com://admin/cloudinary.model.accounts')->id($this->cloudinary_account_id)->getItem();
	}

	public function getUrl()
	{
		return 'http://res.cloudinary.com/'.$this->getContainer()->cloud_name.'/image/upload/'.$this->public_id.'.'.$this->format;
	}
}