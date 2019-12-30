<?php
/**
 * [Lib] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
class MailGoogleRecaptchaUtil {

	public static function hasUseConfig($configData = []) {
		if (!$configData) {
			$configData = self::getUseConfig();
		}

		if (!empty($configData['MailGoogleRecaptchaConfig']['site_key']
			&& !empty($configData['MailGoogleRecaptchaConfig']['secret_key']))) {
			return true;
		}

		return false;
	}

	public static function getSettingList() {
		$SiteConfigModel = ClassRegistry::init('SiteConfig');
		$data = $SiteConfigModel->findByName(Configure::read('MailGoogleRecaptcha.key_name'));
		return json_decode($data['SiteConfig']['value'], true);
	}

	public static function getUseConfig() {
		$SiteConfigModel = ClassRegistry::init('SiteConfig');
		$data = $SiteConfigModel->findByName(Configure::read('MailGoogleRecaptcha.config_key_name'));
		return BcUtil::unserialize($data['SiteConfig']['value']);
	}

}
