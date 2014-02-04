<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <article class="blog-teaser">
                            <header>
                                <h3><i class='icon-user'></i> Pick Up Artist</h3>
                                <?php if (!empty($popartist)): ?>
                                    <div class="carousel-top">
                                        <div class="carousel slide" id="carousel-379517">
                                            <ol class="carousel-indicators">
                                                <li class="active" data-slide-to="0" data-target="#carousel-379517">
                                                </li>
                                                <?php for ($i = 1; count($popartist) > $i; $i++): ?>
                                                    <li data-slide-to="<?php echo $i ?>" data-target="#carousel-379517"></li>
                                                <?php endfor; ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <a href="/artist/view?id=<?php echo $popartist[0]["id"]; ?>" target='_brank'>
                                                        <img  alt="" src="/uploadthumbnail/<?php echo $popartist[0]["thumbnailname"] ?>" />
                                                    </a>
                                                    <div class="carousel-caption">
                                                        <h2><?php echo $popartist[0]["username"]; ?></h2>
                                                    </div>
                                                </div>
                                                <?php for ($i = 1; count($popartist) > $i; $i++): ?>
                                                    <div class="item">
                                                        <a href="/artist/view?id=<?php echo $popartist[$i]["id"]; ?>" target='_brank'>
                                                            <img  alt="" src="/uploadthumbnail/<?php echo $popartist[$i]["thumbnailname"] ?>" />
                                                        </a>
                                                        <div class="carousel-caption">
                                                            <h2><?php echo $popartist[$i]["username"]; ?></h2>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div> <a Onclick='backPopArt()' data-slide="prev" href="#carousel-379517" class="left carousel-control">‹</a> <a Onclick='nextPopArt()' data-slide="next" href="#carousel-379517" class="right carousel-control">›</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <hr>
                            </header>
                            <div class="body pre-scrollable" id='popArtistinfo'>
                                <?php echo nl2br($popartist[0]["artistinfo"]);?>
                            </div>
                            <div class="clearfix">
                                <a id='popArtistBt' href="/artist/view?id=<?php echo $popartist[0]["id"]?>" class="btn btn-mufee-one">And more</a>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <article class="blog-teaser">
                            <header>
                                <h3><i class='icon-user'></i> New Artist</h3>
                                <?php if (!empty($newartist)): ?>
                                    <div class="carousel-top">
                                        <div class="carousel slide" id="carousel-279517">
                                            <ol class="carousel-indicators">
                                                <li class="active" data-slide-to="0" data-target="#carousel-279517">
                                                </li>
                                                <?php for ($i = 1; count($newartist) > $i; $i++): ?>
                                                    <li data-slide-to="<?php echo $i ?>" data-target="#carousel-279517"></li>
                                                <?php endfor; ?>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <a href="/artist/view?id=<?php echo $newartist[0]["id"]; ?>" target='_brank'>
                                                        <img alt="" src="/uploadthumbnail/<?php echo $newartist[0]["thumbnailname"] ?>" />
                                                    </a>
                                                    <div class="carousel-caption">
                                                        <h2><?php echo $newartist[0]["username"]; ?></h2>
                                                    </div>
                                                </div>
                                                <?php for ($i = 1; count($newartist) > $i; $i++): ?>
                                                    <div class="item">
                                                        <a href="/artist/view?id=<?php echo $newartist[$i]["id"]; ?>" target='_brank'>
                                                            <img alt="" src="/uploadthumbnail/<?php echo $newartist[$i]["thumbnailname"] ?>" />
                                                        </a>
                                                        <div class="carousel-caption">
                                                            <h2><?php echo $newartist[$i]["username"]; ?></h2>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div> <a Onclick='backNewArt()' data-slide="prev" href="#carousel-279517" class="left carousel-control">‹</a> <a Onclick='nextNewArt()' data-slide="next" href="#carousel-279517" class="right carousel-control">›</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <hr>
                            </header>
                            <div class='body pre-scrollable' id='newArtistinfo'>
                                <?php echo nl2br($newartist[0]["artistinfo"]);?>
                            </div>
                            <div class="clearfix">
                                <a id='newArtistBt' href="/artist/view?id=<?php echo $newartist[0]["id"]?>" class="btn btn-mufee-one">And more</a>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-center strong">
                            <i class='icon-user'></i> New Artist
                        </h2>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>曲名</th>
                                    <th>アーティスト名</th>
                                    <th>ジャンル</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--新曲の表示（5つまで）-->
                                <?php foreach ($music as $val): ?>
                                    <tr data-href="/artist/view?id=<?php echo $val["id"] ?>">
                                        <td>
                                            <?php echo $val["title"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $val["username"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $val["genrename"]; ?>
                                        </td> 
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <h2 class="text-center strong">
                            <i class='icon-microphone'></i> New Live
                        </h2>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ライブ名</th>
                                    <th>会場</th>
                                    <th>都道府県</th>
                                    <th>日付</th>
                                    <th>アーティスト名</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($live as $val): ?>
                                    <tr data-href="/artist/view?id=<?php echo $val["id"]; ?>">
                                        <td><?php echo $val["livename"]; ?></td>
                                        <td><?php echo $val["venue"]; ?></td>
                                        <td><?php echo $val["prefecture"]; ?></td> 
                                        <td><?php echo $val["date"]; ?></td>
                                        <td><?php echo $val["username"]; ?></td> 
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <aside class="col-md-4 blog-aside">

                <div class="aside-widget">
                    <?php if (Auth::check()): ?>
                        <header>
                            <h3><i class='icon-star'></i> Favorites</h3>
                        </header>
                        <div class="body">
                            <ul class="mufee-list">
                                <?php if (!empty($news)): ?>
                                    <?php var_dump($news);?>
                                    <?php foreach ($news as $val): ?>
                                        <li>
                                            <a href="/artist/view?id=<?php echo $val['artistid'] ?>">
                                                <?php echo $val['username'] . "が" . $val['livename'] . "への出演予定" ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>
                                        情報はありません
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <!--                    <div class="paging">
                                            <a onClick="nextPaging('favorite','2')" class="newer"><i class="icon-long-arrow-left"></i> Newer</a>
                                            <span>&bull;</span>
                                            <a href="#" class="older">Older <i class="icon-long-arrow-right"></i></a> -->
                </div>

                <div class="aside-widget">
                    <header>
                        <h3><i class='icon-ok'></i> Notification</h3>
                    </header>
                    <div class="body">
                        <ul class="mufee-list">
                            <li><a href="/">登録アーティスト１０名突破！</a></li>
                            <li><a href="/">登録楽曲数が１００曲突破！</a></li>
                            <li><a href="/">本日1月21日夕方にメンテナンス</a></li>
                            <li><a href="/">最初のアーティストが参戦！</a></li>
                            <li><a href="/">Mufeeついに始動！！</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div id="mynews" class="nav">                 
        <?php if (!empty($newsid)): ?>
            <input type="button" value="☆新着情報あり！" onClick="mynews_view()"/>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    var newartistinfo = JSON.parse(JSON.stringify(<?php echo $newartistinfo; ?>));
    var popartistinfo = JSON.parse(JSON.stringify(<?php echo $popartistinfo; ?>));
    var newCount = 0;
    var popCount = 0;
    function nextNewArt() {
        newCount++;
        if(newCount >= 5){
            newCount = 0;
        }
        document.getElementById("newArtistinfo").innerText = newartistinfo[newCount]['artistinfo'];
        $('#newArtistBt').replaceWith("<a id='newArtistBt' href='/artist/view?id="+ newartistinfo[newCount]['artistid'] +"' class='btn btn-mufee-one'>And more</a>")
    }
    function backNewArt(){
        newCount = newCount - 1;
        if(newCount < 0){
            newCount = 4;
        }
        document.getElementById("newArtistinfo").innerText = newartistinfo[newCount]['artistinfo'];
        $('#newArtistBt').replaceWith("<a id='newArtistBt' href='/artist/view?id="+ newartistinfo[newCount]['artistid'] +"' class='btn btn-mufee-one'>And more</a>")
    }
    function nextPopArt() {
        popCount++;
        if(popCount >= 5){
            popCount = 0;
        }
        document.getElementById("popArtistinfo").innerText = popartistinfo[popCount]['artistinfo'];
        $('#popArtistBt').replaceWith("<a id='popArtistBt' href='/artist/view?id="+ popartistinfo[popCount]['artistid'] +"' class='btn btn-mufee-one'>And more</a>")
    }
    function backPopArt(){
        popCount = popCount - 1;
        if(popCount < 0){
            popCount = 4;
        }
        document.getElementById("popArtistinfo").innerText = popartistinfo[popCount]['artistinfo'];
        $('#popArtistBt').replaceWith("<a id='popArtistBt' href='/artist/view?id="+ popartistinfo[popCount]['artistid'] +"' class='btn btn-mufee-one'>And more</a>")
    }

    function nextPaging(name, page) {
        $.ajax({
            type: "POST",
            url: "/ajax/nextpaging",
            data: {"name": name, "page": page},
            success: function(data) {
                alert(data.keys('artistid'));
            },
            error: function() {
                alert("error");
            }
        });
    }
    function backPaging() {
        $.ajax({
            type: "POST",
            url: "/ajax/backpaging",
            data: {"name": name},
            success: function() {
            },
            error: function() {
            },
        });
    }

    //  新着情報ありの場合のメソッド
    function mynews_view() {

        document.getElementById("mynews").innerHTML = "<ul>";
<?php if (!empty($newsid)): ?>
    <?php foreach ($newsid as $val): ?>
                document.getElementById("mynews").innerHTML
                        += "<li><form action ='/artist/view' method='post'>"
                        + "<input type='hidden' name='artistid' value='<?php echo $val['artistid'] ?>'>"
                        + "<input type='hidden' name='newsid' value='<?php echo $val['id'] ?>'>"
                        + "<input class='btn-mufee-one' type='submit' value='<?php echo $val['username']; ?>:更新情報あり'></form></li>";
    <?php endforeach; ?>
<?php endif; ?>
        document.getElementById("mynews").innerHTML += "</ul>";
    }
</script>  
<?php echo Asset::js('mufee.js'); ?>
