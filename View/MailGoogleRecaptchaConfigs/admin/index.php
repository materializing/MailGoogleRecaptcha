<?php
/**
 * [ADMIN] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
?>
<?php echo $this->BcForm->create('MailGoogleRecaptchaConfig', ['url' => ['action' => 'index']]); ?>

<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
		<tr>
			<th class="col-head">
				<?php echo $this->BcForm->label('MailGoogleRecaptchaConfig.site_key', 'サイトキー'); ?>
				&nbsp;<span class="required">*</span>
			</th>
			<td class="col-input">
				<?php echo $this->BcForm->input('MailGoogleRecaptchaConfig.site_key', array(
					'type' => 'text', 'size' => 255, 'maxlength' => 255, 'counter' => true, 'class' => 'full-width', 'autocomplete' => 'off',
					'placeholder' => 'Google reCAPTCHAで取得したサイトキーを入力',
				)); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptchaConfig.site_key'); ?>
			</td>
		</tr>
		<tr>
			<th class="col-head">
				<?php echo $this->BcForm->label('MailGoogleRecaptchaConfig.secret_key', 'シークレットキー'); ?>
				&nbsp;<span class="required">*</span>
			</th>
			<td class="col-input">
				<?php echo $this->BcForm->input('MailGoogleRecaptchaConfig.secret_key', array(
					'type' => 'text', 'size' => 255, 'maxlength' => 255, 'counter' => true, 'class' => 'full-width', 'autocomplete' => 'off',
					'placeholder' => 'Google reCAPTCHAで取得したシークレットキーを入力',
				)); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptchaConfig.secret_key'); ?>
			</td>
		</tr>
		<?php echo $this->BcForm->dispatchAfterForm() ?>
	</table>
	<?php echo $this->BcFormTable->dispatchAfter() ?>

	<div class="submit">
		<?php echo $this->BcForm->submit('保　存', array('div' => false, 'class' => 'btn-red button', 'id' => 'BtnSave')); ?>
	</div>
</div>

<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table">
		<tr>
			<th class="col-head">
				初期化
			</th>
			<td class="col-input">
				<?php echo $this->BcForm->input('MailGoogleRecaptchaConfig.do_initialize', array(
					'type' => 'checkbox', 'label' => 'キー設定値を空にする',
				)); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptchaConfig.do_initialize'); ?>
				<small style="color: #C00">※チェックして保存すると、設定済のキーが削除されます。</small>
			</td>
		</tr>
	</table>
</div>

<?php echo $this->BcForm->end(); ?>
