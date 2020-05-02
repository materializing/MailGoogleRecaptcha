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
	public $events = [
		'Mail.MailMessage.beforeValidate',
	];

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

		$mailGoogleRecaptchaSetting = MailGoogleRecaptchaUtil::getMailSetting($Model->mailContent['MailContent']['id']);
		if (!$mailGoogleRecaptchaSetting) {
			return true;
		}

		if (!$mailGoogleRecaptchaSetting['use_recaptcha']) {
			return true;
		}

		if (!empty($Model->data['MailMessage']['mail_google_recaptcha_token'])) {
			$token = $Model->data['MailMessage']['mail_google_recaptcha_token'];
			$result = $this->validateReCaptcha($mailGoogleRecaptchaConfig, $token);

			if ($result['success']) {
				// Google reCAPTCHA との認証成功時は、返ってきたスコア値を元に設定値と比較する
				$score = isset($result['score']) ? floatval($result['score']) : null;
				if ($score >= $mailGoogleRecaptchaSetting['score']) {
					return true;
				} else {
					// 設定スコア値より低い場合はボットとみなしてエラーとする
					CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, '[mailMailMessageBeforeValidate.validateReCaptcha]');
					CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, print_r($mailGoogleRecaptchaSetting, true));
					CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, print_r($result, true));
					$Model->invalidate('mail_google_recaptcha_token', $mailGoogleRecaptchaSetting['message_at_spam_decision']);
					// invalidate発生させておくとreturn falseは不要
				}

			} else {
				// エラー時はGoogle reCAPTCHA で認証した際のエラー内容
				CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, '[mailMailMessageBeforeValidate.validateReCaptcha]');
				CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, print_r($result, true));
				if (is_null($result)) {
					CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, 'validateReCaptcha() 内、curl_exec の返り値に何もありません');
				}

				$configErrorCodeList = Configure::read('MailGoogleRecaptcha.error_code_list');
				$errorList = [];
				if (is_array($result)) {
					foreach ($result as $key => $errorCode) {
						if ($key === 'error-codes') {
							$errorList = $errorCode;
						}
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
			CURLOPT_SSL_VERIFYPEER => false,
		]);

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}

}
