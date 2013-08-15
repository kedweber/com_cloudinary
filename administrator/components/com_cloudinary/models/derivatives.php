<?php

require_once JPATH_LIBRARIES.'/cloudinary/src/Cloudinary.php';
require_once JPATH_LIBRARIES.'/cloudinary/src/Uploader.php';
require_once JPATH_LIBRARIES.'/cloudinary/src/Api.php';

class ComCloudinaryModelDerivatives extends ComDefaultModelDefault
{
	public function __construct(KConfig $config)
	{
		parent::__construct($config);

		$this->_state->insert('public_id', 'string')
					 ->insert('cloudinary_account_id', 'int');
	}

	public function getList()
	{
		$state = $this->_state;

		$account = $this->getService('com://admin/cloudinary.model.accounts')->id($state->cloudinary_account_id)->getItem();

		// Set the configuration
		Cloudinary::config(array(
			'cloud_name' => $account->cloud_name,
			'api_key' => $account->api_key,
			'api_secret' => $account->api_secret
		));

		$api = new \Cloudinary\Api();

		$data = $api->resource($state->public_id)->getArrayCopy()['derived'];

		return $this->getRowset(array(
			'data' => $data
		));
	}

	public function getRowset(array $options = array())
	{
		$identifier         = clone $this->getIdentifier();
		$identifier->path   = array('database', 'rowset');

		return $this->getService($identifier, $options);
	}
}