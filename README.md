# MailGoogleRecaptcha プラグイン

MailGoogleRecaptcha プラグインは、メールフォームにGoogle reCAPTCHA（v3）を設定できるbaserCMS専用のプラグインです。  
・Google reCAPTCHA: https://www.google.com/recaptcha/


## Installation

1. 圧縮ファイルを解凍後、BASERCMS/app/Plugin/MailGoogleRecaptcha に配置します。
2. 管理システムのプラグイン管理に入って、表示されている MailGoogleRecaptcha プラグイン を有効化して下さい。
3. プラグインの有効化後、「利用設定」よりGoogle reCAPTCHAより発行されたキーを設定してください。
4. キーの設定後、「フォーム別設定」よりreCAPTCHAを利用するフォームを設定してください。
5. 利用状態が有効な公開側フォーム画面に、Google reCAPTCHAが表示されます。


## Uses Config

- MailGoogleRecaptcha設定画面では、以下の設定を行う事ができます。
    - Google reCAPTCHAのサイトキー、シークレットキーの設定
- MailGoogleRecaptchaフォーム別設定画面では、以下の設定を行うことができます。
    - reCAPTCHAを有効化するフォームの指定
    - reCAPTCHAバッジの表示方法の指定
- 設定値は DB内 mysite_site_configs テーブルの以下nameのvalue値に保存されます。
    - mail_google_recaptcha_configs: Google reCAPTCHAのキーをシリアライズ化した値
    - mail_google_recaptchas: フォーム別設定をjson形式とした値
- reCAPTCHA側の認証が何らかの理由により通らなかった場合は、ログを記録してます。
    - 保存パス: TMP/logs/log_mail_google_recaptcha.log

### Google reCAPTCHAのキーについて

- キーは[Google reCAPTCHA](https://www.google.com/recaptcha/)にて取得してください。
- キー設定が未完了の場合、フォーム別設定画面にアラートが表示されます。

### 留意点

- Google reCAPTCHA側の設定で、タイプは「v3」を選択してください。
- Google reCAPTCHA側の設定で、利用するドメインの指定を行ってください。
- 導入サイトのドメインとGoogleドメインのJavaScript実行を許可してください。


## Thanks

- [http://basercms.net/](http://basercms.net/)
- [http://wiki.basercms.net/](http://wiki.basercms.net/)
- [http://cakephp.jp](http://cakephp.jp)
- [Semantic Versioning 2.0.0](http://semver.org/lang/ja/)
- [Google reCAPTCHA](https://www.google.com/recaptcha/)
