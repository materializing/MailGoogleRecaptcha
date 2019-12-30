<?php
/**
 * [Config] 設定ファイル
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
App::uses('MailGoogleRecaptchaUtil', 'MailGoogleRecaptcha.Lib');
/**
 * システムナビ
 */
// $config['BcApp.adminNavi.mail_google_recaptcha'] = array(
// 	'name' => 'メールGoogleRecaptcha プラグイン',
// 	'contents' => array(
// 		array('name' => '利用設定',
// 			'url' => array(
// 				'admin' => true,
// 				'plugin' => 'mail_google_recaptcha',
// 				'controller' => 'mail_google_recaptcha_configs',
// 				'action' => 'index'),
// 		),
// 	),
// );

/**
 * 専用ログ
 */
define('LOG_MAIL_GOOGLE_RECAPTCHA', 'log_mail_google_recaptcha');
CakeLog::config('log_mail_google_recaptcha', array(
	'engine' => 'FileLog',
	'types' => array('log_mail_google_recaptcha'),
	'file' => 'log_mail_google_recaptcha',
	'size' => '3MB',
	'rotate' => 5,
));

/**
 * config
 */
$config['MailGoogleRecaptcha'] = [
	'key_name' => 'mail_google_recaptchas',
	'config_key_name' => 'mail_google_recaptcha_configs',
	/**
	 * Language Codes
	 * @link https://developers.google.com/recaptcha/docs/language
	 */
	'position' => [
		'inline' => 'テキスト表示',
		'not_display' => '何も表示しない（自身でテキストを掲載する）',
	],
	/**
	 * Verifying the user's response
	 * @link https://developers.google.com/recaptcha/docs/verify#error_code_reference
	 */
	'error_code_list' => [
		// The secret parameter is missing.
		'missing-input-secret' => 'シークレットパラメータがありません。',
		// The secret parameter is invalid or malformed.
		'invalid-input-secret' => 'シークレットパラメータが無効であるか、形式が正しくありません。',
		// The response parameter is missing.
		'missing-input-response' => '応答パラメーターがありません。',
		// The response parameter is invalid or malformed.
		'invalid-input-response' => '応答パラメーターが無効であるか、形式が正しくありません。',
		// The request is invalid or malformed.
		'bad-request' => '送信が無効であるか、形式が正しくありません。',
		// The response is no longer valid: either is too old or has been used previously.
		'timeout-or-duplicate' => '時間経過により認証できませんでした。再度送信してください。',
	],
];
