<!- 作成者　石田  ->
<meta charset="utf-8">
<?php
     $id = Auth::get_user_id();
     // 　ユーザID      ：　$id[1]
     $mylist = Model_Mylist::getMylistview($id[1])->as_array();
     //　アーティストID　：　$mylist[0]["id"]
     //　アーティスト名  ：  $mylist[0]["username"]
?>
<body>
    <div class="blog-teaser register-span table-center">
        <table class="table table-striped" style="text-align:center">
            <caption>お気に入りアーティスト一覧</caption>
            <?php if (isset($mylist)):?>
            <?php foreach ($mylist as $val): ?>
             <tr>
                 <th><a href="/artist/view?id=<?php echo $val["id"]; ?>"><?php echo$val['username']?></a></th>
             </tr>
            <?php endforeach;?>
            <?php endif; ?>
        </table>
    </div>
    
</body>    


    




