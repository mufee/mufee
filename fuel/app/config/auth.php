<?php


return array(
    # どのドライバーを使うか
    'driver' => 'Simpleauth',
    # マルチログインを許可するか
    'verify_multiple_logins' => false,
    # セキュリティソルトを設定  
    'salt' => 'asdfsahrtryjsfgh',
    # パスワードを暗号化する回数
    'iterations' => 10000,
);