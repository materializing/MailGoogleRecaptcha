<?php
/**
 * [PUBLISH] reCaptcha Text
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
/**
 * Frequently Asked Questions  |  reCAPTCHA  |  Google Developers
 * @link https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed
 */
?>
<?php $this->BcBaser->css('MailGoogleRecaptcha.mail_google_recaptcha', array('inline' => false)); ?>
<?php if ($MailGoogleRecaptcha['position'] === 'inline'): ?>
<div class="mail-google-recaptcha-text">
<p>
	This site is protected by reCAPTCHA and the Google
	<a href="https://policies.google.com/privacy">Privacy Policy</a> and
	<a href="https://policies.google.com/terms">Terms of Service</a> apply.
</p>
</div>
<?php endif; ?>
