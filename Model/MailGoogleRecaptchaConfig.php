<?php
/**
 * [Model] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
class MailGoogleRecaptchaConfig extends AppModel {

	/**
	 * DBテーブルの利用
	 */
	public $useTable = false;

	/**
	 * Validation
	 *
	 * @var array
	 */
	public $validate = [
		'site_key' => [
			'notBlank' => [
				'rule' => ['notBlank'],
				'message' => '必須入力です。',
			],
		],
		'secret_key' => [
			'notBlank' => [
				'rule' => ['notBlank'],
				'message' => '必須入力です。',
			],
		],
	];

}
