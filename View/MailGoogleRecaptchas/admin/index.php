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

<?php echo $this->BcFormTable->dispatchBefore() ?>

<div class="section">
	<table cellpadding="0" cellspacing="0" class="list-table bca-table-listup" id="ListTable">
		<thead class="bca-table-listup__thead">
			<tr>
				<th class="bca-table-listup__thead-th">
					ID<!-- MailContentId -->
				</th>
				<th class="bca-table-listup__thead-th">
					タイトル（URL）
				</th>
				<th class="bca-table-listup__thead-th">
					利用状態&nbsp;/&nbsp;reCAPTCHAバッジの表示&nbsp;/&nbsp;判定スコア閾値
				</th>
				<th class="bca-table-listup__thead-th">
					確認
				</th>
			</tr>
		</thead>
		<tbody class="bca-table-listup__tbody">
		<?php if (!empty($dataList)): ?>
			<?php $count = 1; ?>
			<?php foreach ($dataList as $key => $data): ?>
			<?php
				$mailContentId = $data['MailContent']['id'];
				$isPublish = $this->BcContents->isAllowPublish($data, true);
			?>
			<tr id="Row<?php echo $count; ?>"<?php $this->BcListTable->rowClass($isPublish, $data) ?>>
				<td class="col-head bca-table-listup__tbody-td">
					<?php echo h($mailContentId); ?>
				</td>
				<td class="col-head bca-table-listup__tbody-td">
					<?php echo h($data['Content']['title']); ?>
					（<?php echo h($data['Content']['url']); ?>）
				</td>
				<td class="col-head bca-table-listup__tbody-td">
					<?php echo $this->BcForm->input('MailGoogleRecaptcha.' . $mailContentId . '.use_recaptcha', ['type' => 'checkbox', 'label' => '利用する']); ?>
					<?php echo $this->BcForm->error('MailGoogleRecaptcha.' . $mailContentId . '.use_recaptcha'); ?>
					&nbsp;/&nbsp;
					<?php echo $this->BcForm->input('MailGoogleRecaptcha.' . $mailContentId . '.position', [
						'type' => 'select', 'options' => Configure::read('MailGoogleRecaptcha.position'), 'empty' => '表示する'
					]); ?>
					<?php echo $this->BcForm->error('MailGoogleRecaptcha.' . $mailContentId . '.position'); ?>
					&nbsp;/&nbsp;
					<?php echo $this->BcForm->input('MailGoogleRecaptcha.' . $mailContentId . '.score', [
						'type' => 'select', 'options' => Configure::read('MailGoogleRecaptcha.score_list'), 'default' => '0.5'
					]); ?>
					<?php echo $this->BcForm->error('MailGoogleRecaptcha.' . $mailContentId . '.score'); ?>
				</td>
				<?php echo $this->BcListTable->dispatchShowRow($data) ?>
				<td class="row-tools bca-table-listup__tbody-td bca-table-listup__tbody-td--actions">
					<?php if ($isPublish): ?>
						<?php if ($siteConfig['admin_theme']): ?>
							<?php $this->BcBaser->link('', $data['Content']['url'], [
								'title' => __d('baser', '確認'), 'target' => '_blank',
								'class' => 'bca-btn-icon', 'data-bca-btn-type' => 'preview','data-bca-btn-size' => 'lg',
							]); ?>
						<?php else: ?>
							<?php $this->BcBaser->link($this->BcBaser->getImg('admin/icn_tool_check.png', ['alt' => __d('baser', '確認'), 'class' => 'btn']), $data['Content']['url'], [
								'title' => __d('baser', '確認'), 'class' => 'btn-check', 'target' => '_blank',
							]) ?>
						<?php endif; ?>
					<?php endif; ?>
				</td>
			</tr>
			<?php $count++; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="<?php echo $this->BcListTable->getColumnNumber() ?>" class="bca-table-listup__tbody-td">
					<p class="no-data"><?php echo __d('baser', 'データがありません。') ?></p>
				</td>
			</tr>
		<?php endif; ?>
		<?php echo $this->BcForm->dispatchAfterForm() ?>
		</tbody>
	</table>
	<?php echo $this->BcFormTable->dispatchAfter() ?>

	<div class="submit bca-actions">
		<?php echo $this->BcForm->submit('保　存', [
			'div' => false, 'class' => 'button bca-btn bca-actions__item',
			'data-bca-btn-type' => 'save', 'data-bca-btn-size' => 'lg', 'data-bca-btn-width' => 'lg', 'id' => 'BtnSave',
		]); ?>
	</div>
</div>

<?php echo $this->BcForm->end(); ?>
