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

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table bca-form-table" id="FormTable">
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('MailGoogleRecaptchaConfig.site_key', 'サイトキー'); ?>
				&nbsp;<span class="bca-label required size-small" data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span>
			</th>
			<td class="col-input bca-form-table__input">
				<?php echo $this->BcForm->input('MailGoogleRecaptchaConfig.site_key', [
					'type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true,
					'class' => 'full-width bca-textbox__input', 'autocomplete' => 'off',
					'placeholder' => 'Google reCAPTCHAで取得したサイトキーを入力',
				]); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptchaConfig.site_key'); ?>
			</td>
		</tr>
		<tr>
			<th class="col-head bca-form-table__label">
				<?php echo $this->BcForm->label('MailGoogleRecaptchaConfig.secret_key', 'シークレットキー'); ?>
				&nbsp;<span class="bca-label required size-small" data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span>
			</th>
			<td class="col-input bca-form-table__input">
				<?php echo $this->BcForm->input('MailGoogleRecaptchaConfig.secret_key', [
					'type' => 'text', 'size' => 60, 'maxlength' => 255, 'counter' => true,
					'class' => 'full-width bca-textbox__input', 'autocomplete' => 'off',
					'placeholder' => 'Google reCAPTCHAで取得したシークレットキーを入力',
				]); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptchaConfig.secret_key'); ?>
			</td>
		</tr>
		<?php echo $this->BcForm->dispatchAfterForm() ?>
	</table>
	<?php echo $this->BcFormTable->dispatchAfter() ?>

	<div class="submit bca-actions">
		<?php echo $this->BcForm->submit('保　存', [
			'div' => false, 'class' => 'button bca-btn bca-actions__item',
			'data-bca-btn-type' => 'save', 'data-bca-btn-size' => 'lg', 'data-bca-btn-width' => 'lg', 'id' => 'BtnSave',
			'onClick'=>"return confirm('本当に保存して良いですか？')",
		]); ?>
	</div>
</div>

<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table bca-form-table">
		<tr>
			<th class="col-head bca-form-table__label">
				初期化
			</th>
			<td class="col-input bca-form-table__input">
				<?php echo $this->BcForm->input('MailGoogleRecaptchaConfig.do_initialize', [
					'type' => 'checkbox', 'label' => 'キー設定値を空にする',
				]); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptchaConfig.do_initialize'); ?>
				<small style="color: #C00">※チェックして保存すると、設定済のキーが削除されます。</small>
			</td>
		</tr>
	</table>
</div>

<?php echo $this->BcForm->end(); ?>
