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

class ComCloudinaryModelCloudinary extends ComDefaultModelDefault
{
	/**
	 * getItem will load the image by path, if the image is new
	 * then the image will be uploaded to Cloudinary and resized.
	 *
	 * When cache is enabled, the file is stored in the filesystem
	 *
	 * @return KDatabaseRow
	 */
	public function getItem()
	{
		// Hmm not the most ideal place for this.....
		if($this->getState()->container)
		{
			$container = $this->getService('com://admin/cloudinary.model.accounts')->slug($this->getState()->container)->getItem();
		}
		else
		{
			// Select default account
			$container = $this->getService('com://admin/cloudinary.model.accounts')->default(1)->getItem();
		}

		Cloudinary::config(array(
			'cloud_name' => $container->cloud_name,
			'api_key' => $container->api_key,
			'api_secret' => $container->api_secret
		));

		if (parent::getItem()->isNew())
		{
			// We need to upload and save it before further use.
			$image = \Cloudinary\Uploader::upload(JPATH_FILES . '/' . $this->_state->path);

			$this->_item = $this->getRow()->setData(array(
				'public_id' => $image['public_id'],
				'path' => $this->_state->path,
				'url' => $image['url'],
				'format' => $image['format'],
				'cloudinary_account_id' => $container->id
			));
			$this->_item->save();
		}

		// @TODO: I need to do something about these if checks this isn't actually elegant. But it is functional.
		// @TODO: This can't be a foreach loop because we don't want any tampering inside the component, the API can't handle it :P, see state cache

		$data = array();

		if($this->_state->width)
		{
			$data['width'] = $this->_state->width;
		}

		if($this->_state->height)
		{
			$data['height'] = $this->_state->height;
		}

		if($this->_state->crop)
		{
			$data['crop'] = $this->_state->crop;
            $data['x']    = $this->_state->x ? $this->_state->x : 0;
            $data['y']    = $this->_state->y ? $this->_state->y : 0;
		}

		if($this->_state->gravity)
		{
			$data['gravity'] = $this->_state->gravity;
		}

		if($this->_state->radius)
		{
			$data['radius'] = $this->_state->radius;
		}

		if($this->_state->quality)
		{
			$data['quality'] = $this->_state->quality;
		}

		if($this->_state->angle)
		{
			$data['angle'] = $this->_state->angle;
		}

		if($this->_state->effect)
		{
			$data['effect'] = $this->_state->effect;
		}

		if($this->_state->border)
		{
			$data['border'] = $this->_state->border;
		}

		if($this->_state->background)
		{
			$data['background'] = $this->_state->background;
		}

		if($this->_state->overlay)
		{
			$data['overlay'] = $this->_state->overlay;
		}

		if($this->_state->underlay)
		{
			$data['underlay'] = $this->_state->underlay;
		}

		if($this->_state->page)
		{
			$data['page'] = $this->_state->page;
		}

		if($this->_state->density)
		{
			$data['density'] = $this->_state->density;
		}

		if($this->_state->fetch_format)
		{
			$data['fetch_format'] = $this->_state->fetch_format;
		}

		if($this->_state->flags) {
			if(is_array($this->_state->flags)) {
				$data['flags'] = implode('.', $this->_state->flags);
			} else if(is_string($this->_state->flags)) {
				$data['flags'] = $this->_state->flags;
			}
		}

		if($this->_state->cache)
		{
			$this->_item->setData(array(
				'url' => $this->_item->getImage(cloudinary_url($this->_item->public_id.'.'.$this->_item->format, $data), $data)
			));
		}
		else
		{
			$this->_item->setData(array(
				'url' => cloudinary_url($this->_item->public_id.'.'.$this->_item->format, $data)
			));
		}

        if($this->_state->getsize) {
            list($width, $height) = getimagesize($this->_item->url);
            $this->_item->setData(array(
                'width' => $width,
                'height' => $height
            ));
        }

		return parent::getItem();
	}

	public function getRow(array $options = array())
	{
		$identifier         = clone $this->getIdentifier();
		$identifier->path   = array('database', 'row');
		$identifier->name   = KInflector::singularize($this->getIdentifier()->name);

		return $this->getService($identifier, $options);
	}
}