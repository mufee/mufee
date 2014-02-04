<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-11    artist-main">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <?php if (isset($thumbnail[0]['thumbnailname'])): ?>
                            <img  src="/uploadthumbnail/<?php echo $thumbnail[0]['thumbnailname'] ?>" class="img-polaroid col-md-12">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <blockquote>
                            <dl class="dl-horizontal">
                                <dt>Artist</dt>
                                <dd><p><?php echo $artistinfo[0]['username'] ?></p></dd>
                                <dt>Infomation</dt>
                                <dd>
                                    <div class='body pre-scrollable2'>
                                        <p><?php echo nl2br($artistinfo[0]['artistinfo']) ?></p>
                                    </div>
                                </dd>
                            </dl>
                        </blockquote>
                        <div class="pull-right col-md-3">
                            <input type="button" value="Artist Edit" class="btn btn-mufee-two btn-xlarge" onClick="location.href = 'artistinfo'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="col-md-10 col-md-offset-4 mufee-superblock">
                <div class="row">
                    <Input type="button" value="Access Counter" onClick="location.href = 'accessgraph'" class="btn btn-mufee-two btn-xlarge">
                </div>
            </div>
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
                        <div class="col-md-10 col-md-offset-1 mufee-superblock" id="contact">
                            <h2><i class='icon-music'></i> UPLOAD MUSIC</h2>
                            <table class="table table-striped table-hover">
                                <tr>
                                    <th>曲名</th><th></th><th></th><th></th><th></th>
                                </tr>
                                <?php if (!empty($musicinfo)) : ?>
                                    <?php foreach ($musicinfo as $val): ?>
                                        <tr>
                                            <th><a href="javascript:window.open('lyricsview.php?id=<?php echo $val['id'] ?>','歌詞', 'width=700, height=600, menubar=no, toolbar=no, scrollbars=yes')"><?php echo$val['title'] ?></a></th>
                                            <td>
                                                <form action='musicgraph' method='post'>
                                                    <button name='id' class='btn btn-mufee-two btn-large' value="<?php echo $val['id'] ?>">
                                                        再生回数
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action='lyrics' method='post'>
                                                    <button name='id' class='btn btn-mufee-two btn-large' value="<?php echo $val['id']; ?>">
                                                        歌詞追加
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action='priceset' method='get'>
                                                    <button name='id' class='btn btn-mufee-two btn-large' value="<?php echo $val['id']; ?>">
                                                        値段設定
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action='musicdelete' method='post'>
                                                    <button name='deleteid' class='btn btn-mufee-two btn-large' value="<?php echo $val['id']; ?>">
                                                        削除
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                            <div class="row">
                                <div class="span6 text-center margin-bottom-5">
                                    <Form>
                                        <Input type="button" value="Music Upload" onClick="location.href = 'music'" class="btn btn-mufee-two btn-xlarge">
                                    </Form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="CD">
                    <div id="cd_talbe">
                        <div class="col-md-8 col-md-offset-2 mufee-superblock" id="contact">
                            <h2><i class='icon-headphones'></i> CD INFOMATION</h2>
                            <table class="table table-striped">
                                <tr>
                                    <th>CD名</th><th>値段</th><th>情報</th><th></th>
                                </tr>
                                <?php if (!empty($cdinfo)): ?>
                                    <?php foreach ($cdinfo as $val): ?>
                                        <tr>
                                            <th>

                                        <li class="dropdown">
                                            <a class="dropdown-toggle"
                                               data-toggle="dropdown"
                                               href="/">
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
                                        </th>
                                        <th>
                                            <?php echo $val['price']; ?>
                                        </th>
                                        <th>
                                            <?php echo nl2br($val['cdinfo']); ?>
                                        </th>
                                        <td>
                                            <form action="cdinfodelete" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="deletecdid" value="<?php echo $val['id']; ?>">
                                                <input type="submit" class="btn btn-mufee-two btn-large" value="削除"/>
                                            </form>
                                        </td>
                                        <?php echo '</tr>'; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                            <div class="text-center margin-bottom-5">
                                <input type="button" value="CD Add" class="btn btn-mufee-two btn-xlarge" onClick="location.href = 'cdinfo'">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="LIVE">
                    <div id="live_talbe">
                        <div class="col-md-12 col-md-offset-0 mufee-superblock" id="contact">
                            <h2><i class='icon-microphone'></i> LIVE INFOMATION</h2>
                            <table class="table table-striped ">
                                <th>LIVE名</th><th>都道府県</th><th>日付</th><th>会場</th><th>住所</th><th>サイト</th><th></th>
                                <?php if (!empty($liveinfo)): ?>
                                    <?php foreach ($liveinfo as $value): ?>
                                        <tr>
                                            <td>
                                                <?php echo $value['livename']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['date']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['venue']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['prefecture']; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['address']; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $value['url']; ?>">
                                                    <img class="icon" src="/icon/link.png">
                                                </a>
                                            </td>
                                            <td>
                                                <form action="liveperformdelete" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="deleteliveid" value="<?php echo $value['id']; ?>">
                                                    <input type="submit" class="btn btn-mufee-two btn-group-width" value="削除"/>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                            <div class="text-center margin-bottom-5">
                                <Form>
                                    <Input type="button" value="Live Add" onClick="location.href = 'liveinfo'" class="btn btn-mufee-two btn-xlarge">
                                </Form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
