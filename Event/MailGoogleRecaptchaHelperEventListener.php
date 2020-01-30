<?php

/**
 * [HelperEventListener] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
class MailGoogleRecaptchaHelperEventListener extends BcHelperEventListener {

	/**
	 * 登録イベント
	 *
	 * @var array
	 */
	public $events = [
		'Form.afterCreate',
		'Form.beforeEnd',
	];

	/**
	 * formAfterCreate
	 *
	 * @param CakeEvent $event
	 */
	public function formAfterCreate(CakeEvent $event) {
		if (BcUtil::isAdminSystem()) {
			return;
		}

		if (!in_array($event->data['id'], ['MailMessageIndexForm', 'MailMessageConfirmForm', 'MailMessageSubmitForm'])) {
			return;
		}

		$View = $event->subject();

		if ($View->request->params['plugin'] !== 'mail') {
			return;
		}
		if ($View->request->params['controller'] !== 'mail') {
			return;
		}

		$showRecaptcha = false;
		// 入力: index_________freezed => false, action => index
		// 入力エラ: confirm____freezed => false, action => confirm
		// 確認: confirm_______freezed => true,  action => confirm
		// 書き直す: submit_____freezed => false, action => submit
		if (empty($View->viewVars['freezed'])) {
			$showRecaptcha = true;
		} else {
			if ($View->request->params['action'] === 'confirm') {
				$showRecaptcha = true;
			}
		}

		if ($showRecaptcha) {
			// 利用設定が済んでないと稼働させないため
			$mailGoogleRecaptchaConfig = MailGoogleRecaptchaUtil::getUseConfig();
			if (!MailGoogleRecaptchaUtil::hasUseConfig($mailGoogleRecaptchaConfig)) {
				return;
			}

			$mailGoogleRecaptcha = MailGoogleRecaptchaUtil::getSettingList();
			if (!in_array($View->request->params['Content']['entity_id'], array_keys($mailGoogleRecaptcha['MailGoogleRecaptcha']))) {
				return;
			}
			$mailGoogleRecaptchaSetting = MailGoogleRecaptchaUtil::getMailSetting($View->request->params['Content']['entity_id']);
			if (!$mailGoogleRecaptchaSetting['use_recaptcha']) {
				return;
			}

			$View->viewVars['MailGoogleRecaptchaConfig'] = $mailGoogleRecaptchaConfig['MailGoogleRecaptchaConfig'];
			$View->viewVars['MailGoogleRecaptcha'] = $mailGoogleRecaptchaSetting;

			$output = $event->data['out'] . $View->element('MailGoogleRecaptcha.mail_google_recaptcha');
			return $output;
		}

		return;
	}

	/**
	 * formBeforeEnd
	 *
	 * @param CakeEvent $event
	 */
	public function formBeforeEnd(CakeEvent $event) {
		if(BcUtil::isAdminSystem()) {
			return;
		}

		if (!in_array($event->data['id'], ['MailMessageIndexForm', 'MailMessageConfirmForm', 'MailMessageSubmitForm'])) {
			return;
		}

		$View = $event->subject();

		if ($View->request->params['plugin'] !== 'mail') {
			return;
		}
		if ($View->request->params['controller'] !== 'mail') {
			return;
		}

		$showRecaptcha = false;
		// 入力: index_________freezed => false, action => index
		// 入力エラ: confirm____freezed => false, action => confirm
		// 確認: confirm_______freezed => true,  action => confirm
		// 書き直す: submit_____freezed => false, action => submit
		if (empty($View->viewVars['freezed'])) {
			$showRecaptcha = true;
		} else {
			if ($View->request->params['action'] === 'confirm') {
				$showRecaptcha = true;
			}
		}

		if ($showRecaptcha) {
			// 利用設定が済んでないと稼働させないため
			$mailGoogleRecaptchaConfig = MailGoogleRecaptchaUtil::getUseConfig();
			if (!MailGoogleRecaptchaUtil::hasUseConfig($mailGoogleRecaptchaConfig)) {
				return;
			}

			$mailGoogleRecaptcha = MailGoogleRecaptchaUtil::getSettingList();
			if (!in_array($View->request->params['Content']['entity_id'], array_keys($mailGoogleRecaptcha['MailGoogleRecaptcha']))) {
				return;
			}
			$mailGoogleRecaptchaSetting = MailGoogleRecaptchaUtil::getMailSetting($View->request->params['Content']['entity_id']);
			if (!$mailGoogleRecaptchaSetting['use_recaptcha']) {
				return;
			}

			$View->viewVars['MailGoogleRecaptchaConfig'] = $mailGoogleRecaptchaConfig['MailGoogleRecaptchaConfig'];
			$View->viewVars['MailGoogleRecaptcha'] = $mailGoogleRecaptchaSetting;

			if ($mailGoogleRecaptchaSetting['position']) {
				echo $View->element('MailGoogleRecaptcha.mail_google_recaptcha_text');
			}
		}

		return;
	}

}
