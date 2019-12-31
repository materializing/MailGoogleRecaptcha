<?php
/**
 * [ADMIN] MailGoogleRecaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
$this->BcListTable->setColumnNumber(3);
?>
<?php echo $this->BcForm->create('MailGoogleRecaptcha', ['url' => ['action' => 'index']]); ?>

<div class="section">
<table cellpadding="0" cellspacing="0" class="list-table" id="ListTable">
	<thead>
		<tr>
			<th>
				ID<!-- MailContentId -->
			</th>
			<th>
				タイトル（URL）
			</th>
			<th>
				利用状態&nbsp;/&nbsp;reCAPTCHAバッジの表示
			</th>
		</tr>
	</thead>
	<tbody>
	<?php if (!empty($dataList)): ?>
		<?php $count = 0; ?>
		<?php foreach ($dataList as $key => $data): ?>
		<?php
			$mailContentId = $data['MailContent']['id'];
			$isPublish = $this->BcContents->isAllowPublish($data, true);
		?>
		<tr id="Row<?php echo $count + 1 ?>"<?php $this->BcListTable->rowClass($isPublish, $data) ?>>
			<td class="col-head">
				<?php echo h($mailContentId); ?>
			</td>
			<td class="col-input">
				<?php echo h($data['Content']['title']); ?>
				（<?php echo h($data['Content']['url']); ?>）
			</td>
			<td class="col-input">
				<?php echo $this->BcForm->input('MailGoogleRecaptcha.' . $mailContentId . '.use_recaptcha', ['type' => 'checkbox', 'label' => '利用する']); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptcha.' . $mailContentId . '.use_recaptcha'); ?>
				&nbsp;/&nbsp;
				<?php echo $this->BcForm->input('MailGoogleRecaptcha.' . $mailContentId . '.position', [
					'type' => 'select', 'options' => Configure::read('MailGoogleRecaptcha.position'), 'empty' => '表示する'
				]); ?>
				<?php echo $this->BcForm->error('MailGoogleRecaptcha.' . $mailContentId . '.position'); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	<?php else: ?>
		<tr>
			<td colspan="<?php echo $this->BcListTable->getColumnNumber() ?>">
				<p class="no-data"><?php echo __d('baser', 'データがありません。')?></p>
			</td>
		</tr>
	<?php endif; ?>
	<?php echo $this->BcForm->dispatchAfterForm() ?>
	</tbody>
</table>

<?php echo $this->BcFormTable->dispatchAfter() ?>

<div class="submit">
	<?php echo $this->BcForm->submit('保　存', array('div' => false, 'class' => 'btn-red button', 'id' => 'BtnSave')); ?>
</div>

<?php echo $this->BcForm->end(); ?>
