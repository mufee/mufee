<div class="margin-bottom-5">
<h1 class='text-center'>問い合わせ内容</h1>

<h2 class='text-center'>タイトル:<?php echo $inquiry[0]['title'];?></h2>
<h2 class='text-center'>内容</h2>
<div class="col-xs-12">
<p>
    <?php echo nl2br($inquiry[0]['content']);?>
</p>
</div>
<h2>メールアドレス:<?php echo $inquiry[0]['address'];?></h2>
<form action="delete" method="post">
    <input type="hidden" name="id" value="<?php echo $inquiry[0]['id'];?>">
    <input type="submit" class="btn btn-mufee-two btn-width btn-large " value="削除">
</form>
</div>