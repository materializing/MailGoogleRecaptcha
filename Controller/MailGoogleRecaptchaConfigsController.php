<?php
/**
 * [Controller] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
class MailGoogleRecaptchaConfigsController extends AppController {

	/**
	 * Model
	 *
	 * @var array
	 */
	public $uses = ['SiteConfig'];

	/**
	 * コンポーネント
	 *
	 * @var array
	 */
	public $components = ['BcAuth', 'Cookie', 'BcAuthConfigure'];

	/**
	 * サブメニューエレメント
	 *
	 * @var array
	 */
	public $subMenuElements = ['mail_google_recaptcha'];

	/**
	 * ぱんくずナビ
	 *
	 * @var string
	 */
	public $crumbs = [
		['name' => 'プラグイン管理', 'url' => ['plugin' => '', 'controller' => 'plugins', 'action' => 'index']],
		['name' => 'メールGoogleRecaptcha', 'url' => ['plugin' => 'mail_google_recaptcha', 'controller' => 'mail_google_recaptcha_configs', 'action' => 'index']],
	];

	/**
	 * SiteConfigに保存するキー名
	 *
	 * @var string
	 */
	private $keyName = '';

	/**
	 * contructer
	 *
	 * @param [Object] $request
	 * @param [Object] $response
	 */
	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		$this->keyName = Configure::read('MailGoogleRecaptcha.config_key_name');
	}

	/**
	 * [ADMIN] 設定一覧
	 *
	 */
	public function admin_index() {
		$this->pageTitle = '利用設定';
		$this->help = 'mail_google_recaptcha_configs_index';

		if ($this->request->is('post')) {
			if (!empty($this->request->data['MailGoogleRecaptchaConfig']['do_initialize'])) {
				// 初期化実行
				$requestData = [
					'MailGoogleRecaptchaConfig' => [
						'site_key' => '', 'secret_key' => '',
					],
				];
				$data = [$this->keyName => BcUtil::serialize($requestData)];
				if ($this->SiteConfig->saveKeyValue($data)) {
					$this->setMessage('初期化しました。');
				} else {
					CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, print_r($data, true));
					$this->setMessage('初期化できませんでした。', true);
				}
				$this->redirect(['action' => 'index']);
			}

			// 利用設定値の追加・更新: uses に設定するとテーブルを探しに行くためこのタイミングでモデルを取る
			$MailGoogleRecaptchaConfigModel = ClassRegistry::init('MailGoogleRecaptcha.MailGoogleRecaptchaConfig');
			$MailGoogleRecaptchaConfigModel->set($this->request->data);
			if (!$MailGoogleRecaptchaConfigModel->validates()) {
				$this->setMessage(__d('baser', '入力エラーです。内容を修正してください。'), true);
			} else {
				$requestData = [
					'MailGoogleRecaptchaConfig' => $this->request->data['MailGoogleRecaptchaConfig'],
				];
				$data = [
					$this->keyName => BcUtil::serialize($requestData),
				];
				if ($this->SiteConfig->saveKeyValue($data)) {
					$this->setMessage(__d('baser', '保存しました。'));
				} else {
					CakeLog::write(LOG_MAIL_GOOGLE_RECAPTCHA, print_r($data, true));
					$this->setMessage(__d('baser', '保存に失敗しました。'), true);
				}

				$this->redirect(['action' => 'index']);
			}
		} else {
			$this->request->data = MailGoogleRecaptchaUtil::getUseConfig();
		}
	}

}
