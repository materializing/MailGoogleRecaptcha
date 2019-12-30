<?php
/**
 * [PUBLISH] reCaptcha
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
?>
<?php $googleApiUrl = 'https://www.google.com/recaptcha/api.js?render=' . h($MailGoogleRecaptchaConfig['site_key']); ?>
<script src="<?php echo $googleApiUrl; ?>"></script>
<script>
grecaptcha.ready(function() {
	grecaptcha.execute('<?php echo h($MailGoogleRecaptchaConfig['site_key']); ?>', {action: 'homepage'}).then(function(token) {
		var recaptchaResponse = document.getElementById('MailMessageMailGoogleRecaptchaToken');
		recaptchaResponse.value = token;
	});
});
</script>
<?php $this->Mailform->unlockField('MailMessage.mail_google_recaptcha_token'); ?>
<?php echo $this->Mailform->hidden('MailMessage.mail_google_recaptcha_token'); ?>
<?php echo $this->Mailform->error('MailMessage.mail_google_recaptcha_token'); ?>
