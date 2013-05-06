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

require_once JPATH_LIBRARIES.'/cloudinary/src/Cloudinary.php';
require_once JPATH_LIBRARIES.'/cloudinary/src/Uploader.php';
require_once JPATH_LIBRARIES.'/cloudinary/src/Api.php';

class ComCloudinaryDatabaseRowImage extends KDatabaseRowDefault
{
	/**
	 * First we need to select the account to which the image belongs.
	 *
	 * This function will first get all the derivatives and request the information,
	 * this information will be used to remove the cached files (if any)
	 *
	 * After this the file is removed from cloudinary and the database.
	 *
	 * @return bool result of the delete function.
	 */
	public function delete()
	{
		// Get the account information
		$account = $this->getService('com://admin/cloudinary.model.accounts')->id($this->cloudinary_account_id)->getItem();

		// Set the configuration
		Cloudinary::config(array(
			'cloud_name' => $account->cloud_name,
			'api_key' => $account->api_key,
			'api_secret' => $account->api_secret
		));

		$api = new \Cloudinary\Api();

		$derivatives = $api->resource($this->public_id)->getArrayCopy()['derived'];

		foreach($derivatives as $derivative)
		{
			$data = $this->parseTransformation($derivative['transformation']);

			$dir = JPATH_FILES.DS.'images'.DS.'resized'.DS.$data['height'].DS.$data['width'];
			if(file_exists($dir.DS.$this->public_id.'.'.$this->format))
			{
				KService::get('com://admin/files.controller.file')
					->container('resized')
					->folder($data['height'].DS.$data['width'])
					->name($this->public_id.'.'.$this->format)
					->delete();
			}
		}

		// Remove the image from cloudinary itself.
		$api->delete_resources(array(
			$this->public_id
		));

		// Remove the image from the database.
		return parent::delete();
	}

	/**
	 * This function will parse the transformations string to an array.
	 *
	 * @param $transformation string of transformations
	 * @return array Parsed transformations
	 */
	public function parseTransformation($transformation)
	{
		$array = array();

		$parts = explode(',', $transformation);

		foreach($parts as $part)
		{
			$transformations = explode('_', $part);

			// TODO: This part needs to be extended.
			switch($transformations[0])
			{
				case 'c':
					$array['crop'] = $transformations[1];
					break;
				case 'w':
					$array['width'] = $transformations[1];
					break;
				case 'h':
					$array['height'] = $transformations[1];
					break;
				case 'r':
					$array['radius'] = $transformations[1];
					break;
			}
		}

		return $array;
	}

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

		$dir = JPATH_FILES.DS.'images'.DS.'resized'.DS.$data['height'].DS.$data['width'];
		if(!is_dir($dir))
		{
			KService::get('com://admin/files.controller.folder')
				->container('resized')
				->folder($data['height'])
				->name($data['width'])
				->add()
				->toArray();
		}

		if(!file_exists($dir.DS.end($parts)))
		{
			KService::get('com://admin/files.controller.file')
				->container('resized')
				->folder($data['height'].'/'.$data['width'])
				->name(end($parts))
				->add(array('contents' => file_get_contents($url)))
				->toArray();
		}

		// @TODO: I need to do something about the names.
		return 'images/resized'.DS.$data['height'].DS.$data['width'].DS.end($parts);
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