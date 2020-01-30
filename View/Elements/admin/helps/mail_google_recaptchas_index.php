<?php
/**
 * [ADMIN] Help
 *
 * @link http://www.materializing.net/
 * @author arata
 * @package MailGoogleRecaptcha
 * @license MIT
 */
?>
<p>メールフォーム別にGoogle reCAPTCHA利用を指定できます。</p>
<ul>
	<li>灰色は非公開状態のメールフォームです。</li>
	<li>利用状態: Google reCAPTCHAを有効にします。</li>
	<li>reCAPTCHAバッジの表示
		<ul>
			<li>「表示する」・・・フォーム画面右下にreCAPTCHAのバッジが表示されます。</li>
			<li>「テキスト表示」・・・フォームの送信ボタン下部にreCAPTCHAブランドのテキストが表示されます。</li>
			<li>「何も表示しない（自身でテキストを掲載する）」・・・reCAPTCHAブランドのテキストを自身でフォーム内に掲載する場合に利用してください。
				<br>※参考: <a href="https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed" target="_blank">https://developers.google.com/recaptcha/docs/faq#id-like-to-hide-the-recaptcha-badge.-what-is-allowed</a>
			</li>
		</ul>
	</li>
	<li>判定スコア閾値: Google reCAPTCHA側で判定・取得されるスコアです。
		<ul>
			<li>0.0～1.0 が算出され、 0 に近いほどボットの可能性が高いとみなされ、1に近いほど人間による自然な操作の可能性が高いとみなされます。</li>
			<li>判定・取得されたスコアと設定値を比較し、設定値より低いスコアの場合、ボットとみなして送信動作エラーとします。</li>
		</ul>
	</li>
</ul>
