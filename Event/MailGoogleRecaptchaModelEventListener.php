<?php
/**
 * [ModelEventListener] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
class MailGoogleRecaptchaModelEventListener extends BcModelEventListener {

	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = array(
		'Mail.MailMessage.beforeValidate',
	);

	/**
	 * Google reCAPTCHA で認証した際のエラー内容
	 *
	 * @var Object
	 */
	private $recaptchaError = null;

	/**
	 * mailMessageBeforeValidate
	 *
	 * @param CakeEvent $event
	 */
	public function mailMailMessageBeforeValidate(CakeEvent $event) {
		if (BcUtil::isAdminSystem()) {
			return true;
		}

		// 利用設定が済んでないと稼働させないため
		$mailGoogleRecaptchaConfig = MailGoogleRecaptchaUtil::getUseConfig();
		if (!MailGoogleRecaptchaUtil::hasUseConfig($mailGoogleRecaptchaConfig)) {
			return true;
		}

		$Model = $event->subject();

		$mailGoogleRecaptcha = MailGoogleRecaptchaUtil::getSettingList();
		if (!in_array($Model->mailContent['MailContent']['id'], array_keys($mailGoogleRecaptcha['MailGoogleRecaptcha']))) {
			return true;
		}
		if (!$mailGoogleRecaptcha['MailGoogleRecaptcha'][$Model->mailContent['MailContent']['id']]['use_recaptcha']) {
			return true;
		}

		if (!empty($Model->data['MailMessage']['mail_google_recaptcha_token'])) {
			$token = $Model->data['MailMessage']['mail_google_recaptcha_token'];
			if (!$this->validateReCaptcha($mailGoogleRecaptchaConfig, $token)) {
				$configErrorCodeList = Configure::read('MailGoogleRecaptcha.error_code_list');
				$errorList = [];
				foreach ($this->recaptchaError as $key => $errorCode) {
					if ($key === 'error-codes') {
						$errorList = $errorCode;
					}
				}

				$errorMessage = [
					'Google reCAPTCHAの認証が通りませんでした。',
				];
				foreach ($errorList as $error) {
					$errorMessage[] = $configErrorCodeList[$error];
				}

				$Model->invalidate('mail_google_recaptcha_token', implode(' ', $errorMessage));
				// invalidate発生させておくとreturn falseは不要
			}
		}

		return true;
	}

	/**
	 * Google reCAPTCHA で認証を実施する
	 *
	 * @param array $configData
	 * @param string $token
	 * @return boolean
	 */
	private function validateReCaptcha($configData, $token) {
		$url = 'https://www.google.com/recaptcha/api/siteverify';

		$ch = curl_init();
		curl_setopt_array($ch, [
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query([
				'secret' => $configData['MailGoogleRecaptchaConfig']['secret_key'],
				'response' => $token
			]),
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($response);
		if ($result->success) {
			return true;
		} else {
			$this->recaptchaError = $result;
			CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, '[mailMailMessageBeforeValidate.validateReCaptcha]');
			CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, print_r($result, true));
		}

		return false;
	}

}
