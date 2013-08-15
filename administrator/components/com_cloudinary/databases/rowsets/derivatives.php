<?php

class ComCloudinaryDatabaseRowsetDerivatives extends KDatabaseRowsetAbstract
{
	protected function _initialize(KConfig $config)
	{
		$config->append(array(
			'identity_column' => 'id'
		));

		parent::_initialize($config);
	}
}