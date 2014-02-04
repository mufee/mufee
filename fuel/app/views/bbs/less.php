<div class="margin-top-3 table-center">
    <h1 class='text-center'><?php echo $title; ?></h1>
    <ul class='nav less-nav'>
        <li>
            <p>
                <?php echo $content; ?>
            </p>
        </li>
    </ul>
    <div class="col-lg-10">
        <ul class='nav less-nav'>
            <?php foreach ($lessarray as $val):?>
            <li>
                <h2><?php echo $val["title"]; ?></h2>
                <p><?php echo $val["content"]; ?></p>
            </li>
            <?php endforeach;?>
        </ul>
    </div>

    <div class='newless'>
        <form action='newcomment' method='post'>
            <input type="hidden" name="id" value="<?php echo INPUT::get("id"); ?>">
            <table class="table table-striped">
                <br><br>
                <caption>スレッドへのコメント</caption>
                <tr>
                    <th>タイトル</th>
                    <td>
                        <input type="textbox" name='title' value='' maxlength="15">
                    </td>
                </tr>
                <tr>
                    <th>内容</th>
                    <td>
                        <textarea class="form-control" rows="10" name='content'></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan='2' class='text-right'><input type='submit'></td>
                </tr>
            </table>
        </form>
    </div>
</div>
