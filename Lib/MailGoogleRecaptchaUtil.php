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

	/**
	 * 利用設定が済んでいるか確認する
	 *
	 * @param array $configData
	 * @return boolean
	 */
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

	/**
	 * フォーム別設定の一覧を取得する
	 *
	 * @return array
	 */
	public static function getSettingList() {
		$SiteConfigModel = ClassRegistry::init('SiteConfig');
		$data = $SiteConfigModel->findByName(Configure::read('MailGoogleRecaptcha.key_name'));
		return json_decode($data['SiteConfig']['value'], true);
	}

	/**
	 * 利用設定の値を取得する
	 *
	 * @return array
	 */
	public static function getUseConfig() {
		$SiteConfigModel = ClassRegistry::init('SiteConfig');
		$data = $SiteConfigModel->findByName(Configure::read('MailGoogleRecaptcha.config_key_name'));
		return BcUtil::unserialize($data['SiteConfig']['value']);
	}

}
