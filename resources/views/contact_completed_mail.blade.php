（このメールはお問い合わせ確認用に自動的に送信されています）

{{ $contact['name'] }}様

この度は、弊社{{ $company['name'] }}にお問い合わせいただきまして、誠にありがとうございます。
このメールは、お問い合わせフォームからの送信が正しく完了したことをお知らせするものです。

以下の内容で受付いたしました。

------------------------------------------

お名前：{{ $contact['name'] }}
メールアドレス：{{ $contact['email'] }}
電話番号：{{ $contact['tel'] }}
お問合せ用件：{{ $contact['requirement'] }}
お問合せ内容：{{ $contact['contents'] }}

------------------------------------------

担当者より順次ご連絡させていただきますので、よろしくお願いいたします。


□━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━□

{{ $company['name'] }}
〒{{ $company['zip_code'] }}　{{ $company['address'] }}
TEL：{{ $company['tel'] }}

HP:{{ env('APP_URL') }}

□━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━□
