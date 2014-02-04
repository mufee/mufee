
  <body>
    <h1>お支払いありがとうございました</h1>
    <ul>
      <li>お支払い金額: <?php print($result->amount); ?></li>
      <li>カード名義: <?php print($result->card->name); ?></li>
      <li>カード番号: ****-****-****-<?php print($result->card->last4); ?></li>
    </ul>
  </body>