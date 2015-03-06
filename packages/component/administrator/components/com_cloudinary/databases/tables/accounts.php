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

class ComCloudinaryDatabaseTableAccounts extends KDatabaseTableDefault
{
    public function _initialize(KConfig $config)
    {
        $sluggable = $this->getBehavior('koowa:database.behavior.sluggable', array(
            'columns' => array('cloud_name')
        ));

        $config->append(array(
            'behaviors' => array(
                'com://admin/moyo.database.behavior.defaultable',
                $sluggable
            )
        ));

        parent::_initialize($config);
    }
}