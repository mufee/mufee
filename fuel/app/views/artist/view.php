<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-11 artist-main">
                <div class="row">
                    <?php if ((Model_Mylist::check($u_id[1], $a_id)->as_array())): ?>
                        <h2><i class='icon-star'>お気に入り登録中</i></h2>
                    <?php endif; ?>
                    <div class="col-md-6 col-sm-6">
                        <?php if (isset($thumbnail[0]['thumbnailname'])): ?>
                            <img  src="/uploadthumbnail/<?php echo $thumbnail[0]['thumbnailname'] ?>" class="img-polaroid col-md-12">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-sm-6 margin-top-2">
                        <blockquote>
                            <dl class="dl-horizontal">
                                <dt>Artist</dt>
                                <dd><p><?php echo $artistinfo[0]['username'] ?></p></dd>
                                <dt>Infomation</dt>
                                <dd>
                                    <div class='body pre-scrollable'>
                                        <p><?php echo nl2br($artistinfo[0]['artistinfo']) ?></p>
                                    </div>
                                </dd>
                            </dl>
                        </blockquote>
                    </div>
                </div>
            </div>
            <?php if (Auth::check()): ?>
                <div class="col-md-10 mufee-superblock">
                    <div class="row">
                        <?php if (!(Model_Mylist::check($u_id[1], $a_id)->as_array())): ?>
                            <div class='popbox'>
                                <input id="addMylist_button" type="button" class='btn btn-xlarge btn-mufee-two' value="お気に入りに登録">
                                <div class='collapse_pop'>  
                                    <div class='box'>
                                        <div class='arrow'></div>
                                        <div class='arrow-border'></div>
                                        登録しました
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class='popbox'>
                                <input id="deleteMylist_button" type="button" class="btn btn-xlarge btn-mufee-two" value="お気に入りに解除">
                                <div class='collapse_pop'>  
                                    <div class='box'>
                                        <div class='arrow'></div>
                                        <div class='arrow-border'></div>
                                        解除しました
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <!--                        <li><a href="#MEMBER" data-toggle="tab">MEMBER</a></li>-->
                <li class="active"><a href="#MUSIC" data-toggle="tab">MUSIC</a></li>
                <li><a href="#CD" data-toggle="tab">CD</a></li>
                <li><a href="#LIVE" data-toggle="tab">LIVE</a></li>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <!--                        <div class="tab-pane active" id="MEMBER">
                                            <div class="col-md-9 col-md-offset-2 mufee-superblock" id="contact">
                                                <h2>MEMBER</h2>
                                                <div class="col-md-6 col-sm-6">
                <?php if (isset($thumbnail[0]['thumbnailname'])): ?>
                                                                                        <img  src="/uploadthumbnail/<?php echo $thumbnail[0]['thumbnailname'] ?>" class="img-polaroid col-md-12">
                <?php endif; ?>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <blockquote>
                                                        <dl class="dl-horizontal">
                                                            <dt>Name</dt>
                                                            <dd><p>sizimi</p></dd>
                                                            <dt>Charge</dt>
                                                            <dd><p>Guiter</p></dd>
                                                        </dl>
                                                    </blockquote>
                                                </div>
                                            </div>
                                        </div>-->
                <div class="tab-pane active" id="MUSIC">
                    <div id="music_talbe">
                        <div class="col-md-6 col-md-offset-3 mufee-superblock" id="contact">
                            <h2>UPLOAD MUSIC</h2>
                            <table class="table table-striped">
                                <?php if (isset($musicinfo)): ?>
                                    <?php foreach ($musicinfo as $val): ?>
                                        <tr>
                                            <th>
                                                <a href="javascript:window.open('lyricsview.php?id=<?php echo $val['id'] ?>','歌詞', 'width=700, height=600, menubar=no, toolbar=no, scrollbars=yes')"><?php echo$val['title'] ?></a>
                                                <a href="purchase.php?id=<?php echo $val['id'] ?>"><i class='icon-shopping-cart'></i></a>
                                            </th>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="CD">
                    <div id="cd_talbe">
                        <div class="col-md-8 col-md-offset-2 mufee-superblock" id="contact">
                            <h2>CD INFOMATION</h2>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th>CD名</th><th>値段</th><th>情報</th>
                                </tr>
                                <?php if (isset($cdinfo)): ?>
                                    <?php foreach ($cdinfo as $val): ?>
                                        <tr>
                                            <td>
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="/">
                                                        <?php echo $val['cdname']; ?>
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <?php $temp = explode(",", $val['musicname']); ?>
                                                            <li>
                                                                収録曲一覧
                                                            </li>    
                                                        <?php for ($i = 0; $i < count($temp); $i++): ?>
                                                            <li>
                                                                <?php echo $i + 1 . "曲目 : " . $temp[$i]; ?>
                                                            </li>
                                                        <?php endfor; ?>
                                                    </ul>
                                                </li>
                                            </td>
                                        <td>
                                            <?php echo $val['price']; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($val['cdinfo'])): ?>
                                                <?php echo nl2br($val['cdinfo']); ?>
                                            <?php else: ?>
                                                情報なし
                                            <?php endif; ?>
                                        </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="LIVE">
                    <div id="live_talbe">
                        <div class="col-md-11 col-md-offset-1 mufee-superblock" id="contact">
                            <h2>LIVE INFOMATION</h2>
                            <table class="table table-striped table-bordered">
                                <th>LIVE名</th><th>都道府県</th><th>日付</th><th>会場</th><th>住所</th><th>サイト</th>
                                <?php if (isset($liveinfo)): ?>
                                    <?php foreach ($liveinfo as $value): ?>
                                        <tr>
                                            <td>
                                                <?php echo $value['livename']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['prefecture']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['venue']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['address']; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $value['url']; ?>">
                                                    <img class="icon" src="/icon/link.png">
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php if (Auth::check()): ?>

    <link href="http://localhost/assets/css/popbox.css" type="text/css" rel="stylesheet">
    <script src="http://localhost/assets/js/popbox.js" type="text/javascript"></script>
    <input type="hidden" value="<?php echo $u_id[1]; ?>" name="u_id">
    <input type="hidden" value="<?php echo $a_id; ?>" name="a_id">
    <?php if (!(Model_Mylist::check($u_id[1], $a_id)->as_array())): ?>
        <script type='text/javascript'>
            $(document).ready(function() {

                $('.popbox').popbox({
                    'open': '.open',
                    'box': '.box',
                    'arrow': '.arrow',
                    'arrow-border': '.arrow-border',
                    'close': '.close'
                }
                );

                $('#addMylist_button').click(function() {
                    $.ajax({
                        type: "POST",
                        url: "/ajax/addmylist",
                        data: {"u_id": <?php echo $u_id[1] ?>,
                            "a_id": <?php echo $a_id ?>},
                        success: function()
                        {

                        },
                        error: function() {
                        }
                    });
                    location.href = "";
                    //  $('#addMylist_button').replaceWith('');        


                });

            });
        </script>
    <?php else: ?>
        <script type='text/javascript'>
            $(document).ready(function() {

                $('.popbox').popbox({
                    'open': '.open',
                    'box': '.box',
                    'arrow': '.arrow',
                    'arrow-border': '.arrow-border',
                    'close': '.close'
                }
                );

                $('#deleteMylist_button').click(function() {

                    $.ajax({
                        type: "POST",
                        url: "/ajax/deletemylist",
                        data: {"u_id": <?php echo $u_id[1] ?>,
                            "a_id": <?php echo $a_id ?>},
                        success: function()
                        {

                        },
                        error: function() {

                        }
                    });
                    location.href = "";
                    //  $('#deleteMylist_button').replaceWith("");        


                });

            });
        </script>

    <?php endif; ?>
<?php endif; ?>
</div>
</body>
