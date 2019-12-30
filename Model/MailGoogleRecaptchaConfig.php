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
	public $validate = array(
		'site_key' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => '必須入力です。',
			),
		),
		'secret_key' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => '必須入力です。',
			),
		),
	);

}
