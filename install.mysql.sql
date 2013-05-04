SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `#__cloudinary_images`
-- ----------------------------
DROP TABLE IF EXISTS `#___cloudinary_images`;
CREATE TABLE `#___cloudinary_images` (
  `cloudinary_image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `public_id` varchar(255) NOT NULL DEFAULT '',
  `format` varchar(10) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`cloudinary_image_id`,`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `#__cloudinary_accounts`
-- ----------------------------
DROP TABLE IF EXISTS `#__cloudinary_accounts`;
CREATE TABLE `#__cloudinary_accounts` (
  `cloudinary_account_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `cloud_name` varchar(255) NOT NULL DEFAULT '',
  `api_key` varchar(255) NOT NULL,
  `api_secret` varchar(255) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`cloudinary_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
