<?php
/**
 * [ADMIN] サブメニュー
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
?>
<tr>
	<th>メールGoogleRecaptcha管理</th>
	<td>
		<ul>
			<li><?php $this->BcBaser->link('利用設定', array('admin' => true, 'plugin' => 'mail_google_recaptcha', 'controller' => 'mail_google_recaptcha_configs', 'action' => 'index')); ?></li>
			<li><?php $this->BcBaser->link('フォーム別設定', array('admin' => true, 'plugin' => 'mail_google_recaptcha', 'controller' => 'mail_google_recaptchas', 'action' => 'index')); ?></li>
		</ul>
	</td>
</tr>
