<h1 class='text-center'>問い合わせ一覧</h1>
    <ul class='nav less-nav text-center margin-bottom-5'>
        <?php foreach ($inquiry as $val): ?>
        <?php mb_language('Japanese');?>
        <?php mb_internal_encoding('UTF-8');?>
            <li>
                <form action='content' method='post'>
                    <input type="hidden" name="id" value="<?php echo $val["id"];?>">
                    タイトル:<button class="linkstyle"><?php echo $val["title"];?></button><br/>
                    内容<button class="linkstyle"><?php echo  mb_substr($val["content"], 0, 20);?></button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
