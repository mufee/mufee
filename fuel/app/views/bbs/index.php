    <h1 class='text-center'>アンケート用掲示板</h1>
    <ul class='nav less-nav'>
        <?php foreach ($less as $val): ?>
            <li>
                <h2><?php echo $val["title"];?></h2>
                <p>
                    <?php echo $val["head"];?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class='pager'>
        <div class='pagination'>
            <ul class='nav nav-pills'>
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>

    <div class='newless'>
        <form action='newthread' method='post'>
            <table class="table table-striped">
                <caption>新規スレッド</caption>
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
