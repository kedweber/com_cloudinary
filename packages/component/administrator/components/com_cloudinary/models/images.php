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

class ComCloudinaryModelImages extends ComDefaultModelDefault
{
    /**
     * __construct declaration of states.
     *
     * @param KConfig $config
     */
    public function __construct(KConfig $config)
    {
        parent::__construct($config);

        $this->getState()
            ->insert('width', 'int')
            ->insert('height', 'int')
            ->insert('path', 'string', null, true)
            ->insert('gravity', 'word')
            ->insert('crop', 'string', 'fill')
            ->insert('x', 'int', 0)
            ->insert('y', 'int', 0)
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
            ->insert('fetch_format', 'string', 'auto')
            ->insert('flags', 'raw', 'progressive')
            ->insert('type', 'string')
            ->insert('attribs', 'string')
            ->insert('getsize', 'string', 0)
        ;
    }

    public function getItem()
    {
        if ($this->getState()->container) {
            $container = $this->getService('com://admin/cloudinary.model.accounts')->slug($this->getState()->container)->getItem();
        } else {
            // Select default account
            $container = $this->getService('com://admin/cloudinary.model.accounts')->default(1)->getItem();
        }

        Cloudinary::config(array(
            'cloud_name' => $container->cloud_name,
            'api_key' => $container->api_key,
            'api_secret' => $container->api_secret
        ));

        if (parent::getItem()->isNew()) {
            if(!$this->_state->type) {
                $image = \Cloudinary\Uploader::upload(JPATH_FILES . '/' . $this->_state->path);
            }

            $this->_item = $this->getRow()->setData(array(
                'public_id' => ($this->_state->type ? $this->_state->path : $image['public_id']),
                'path' => $this->_state->path,
                'url' => ($this->_state->type ? '' : $image['url']),
                'format' => ($this->_state->type ? '' : $image['format']),
                'cloudinary_account_id' => $container->id
            ));
            $this->_item->save();
        }

        if ($this->_state->flags) {
            if (is_array($this->_state->flags)) {
                $this->_state->flags = implode('.', $this->_state->flags);
            }
        }

        $file = $this->_state->type ? $this->_item->public_id : $this->_item->public_id . '.' . $this->_item->format;
        $this->_item->setData(array(
            'url' => cloudinary_url($file, $this->_state->toArray())
        ));

        if ($this->_state->cache) {
            $this->_item->setData(array(
                'url' => $this->_item->getImage($this->_item->url, $this->_state->toArray())
            ));
        }

        if ($this->_state->getsize) {
            $curl = curl_init($this->_item->url);
            curl_setopt_array($curl, array(
                CURLOPT_HTTPHEADER => array(
                    'Range: bytes=0-32768'
                ),
                CURLOPT_RETURNTRANSFER => 1
            ));

            $image = imagecreatefromstring(curl_exec($curl));

            $this->_item->setData(array(
                'width' => imagesx($image),
                'height' => imagesy($image)
            ));

            curl_close($curl);
        }

        $this->_item->setData(array(
            'attribs' => KHelperArray::toString($this->_state->attribs),
        ));

        return $this->_item;
    }

    public function getRow(array $options = array())
    {
        $identifier         = clone $this->getIdentifier();
        $identifier->path   = array('database', 'row');
        $identifier->name   = KInflector::singularize($this->getIdentifier()->name);

        return $this->getService($identifier, $options);
    }
}