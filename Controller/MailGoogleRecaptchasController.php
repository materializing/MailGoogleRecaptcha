<?php
/**
 * [Controller] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
class MailGoogleRecaptchasController extends AppController {

	/**
	 * Model
	 *
	 * @var array
	 */
	public $uses = ['SiteConfig', 'Content'];

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
		$this->keyName = Configure::read('MailGoogleRecaptcha.key_name');
	}

	/**
	 * [ADMIN] 設定一覧
	 *
	 */
	public function admin_index() {
		$this->pageTitle = 'フォーム別設定';
		$this->help = 'mail_google_recaptchas_index';

		 if ($this->request->is('post')) {
			// 利用設定値の追加・更新: uses に設定するとテーブルを探しに行くためこのタイミングでモデルを取る
			$MailGoogleRecaptchaModel = ClassRegistry::init('MailGoogleRecaptcha.MailGoogleRecaptcha');
			$MailGoogleRecaptchaModel->set($this->request->data);
			if (!$MailGoogleRecaptchaModel->validates()) {
				$this->setMessage(__d('baser', '入力エラーです。内容を修正してください。'), true);
			} else {
				$requestData = [
					'MailGoogleRecaptcha' => $this->request->data['MailGoogleRecaptcha'],
				];
				$data = [
					$this->keyName => json_encode($requestData, JSON_UNESCAPED_UNICODE),
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
			$mailGoogleRecaptchaConfig = MailGoogleRecaptchaUtil::getUseConfig();
			if (!MailGoogleRecaptchaUtil::hasUseConfig($mailGoogleRecaptchaConfig)) {
				$this->setMessage('利用設定が未完了です。', true);
			}

			$this->request->data = MailGoogleRecaptchaUtil::getSettingList();

			$MailContentsModel = ClassRegistry::init('Mail.MailContent');
			$MailContentsModel->unbindModel(['hasMany' => ['MailField']]);
			$dataList = $MailContentsModel->find('all', [
				'order' => 'MailContent.id ASC',
			]);
			$this->set(compact('dataList'));
		}
	}

}
