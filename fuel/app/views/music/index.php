
<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 tales-superblock margin-top-3">
                <div class="row">
                    <div class="col-md-12" id="jukemain">
                        <div class="row">
                            <div class="nowplay">
                                <a id='artist' href=''>
                                    <img alt='' src='' id='nowimg' class='nowimg'>
                                </a>
                                <ul class='mufee-list artinfo'>
                                    <h1>Now play</h1>
                                    <li><marquee bgcolor="#242b32" scrollamount="3" width="250px"><font color="#55a773" id='artistname'></font></marquee></li>
                                    <li><marquee bgcolor="#242b32" scrollamount="3" width="250px"><font color="#55a773" id='title'></font></marquee></li>
                                </ul>
                            </div>
                            <div class="nextplay">
                                <h2>Next play</h2>
                                <a class="jp-play" id="nextbtn" tabindex="1">
                                    <div id='nextcd'>
                                        <img src='' class='nextimg img-polaroid-cd' id='nextimg'>
                                        <img src='' class='cd'>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12 margin-top-3'>
                        <div class='row'>
                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div class="jp-audio">
                                <div class="jp-type-single">
                                    <div id="jp_interface_1" class="jp-interface">
                                        <ul class="jp-controls">
                                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                                            <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                                        </ul>
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                        <div class="jp-current-time"></div>
                                        <div class="jp-duration"></div>
                                        <div id="jp_playlist_1" class="jp-playlist">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 margin-top-3">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 margin-top-5">
                        <div class='row'>
                            <div style="margin:0px;padding:0px;" align="left">
                                <div class=" blog-teaser padding-1 margin-top-5" style="margin:0px;padding:0px;line-height:1.3;">
                                    <div class="body pre-scrollable" style="margin:0px;padding:30px;line-height:1.3;overflow:auto;border:2px groove #55a773;text-align:left;font-size:100%;height:50em;scrollbar-base-color:#55a773;">
                                        <h1 class="text-center">歌詞</h1>
                                        <p id="lyrics"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1 margin-top-5">
                        <div class='row'>
                            <?php if (!(empty($histdata))): ?>
                                <div class="col-md-6 col-md-offset-2 mufee-superblock">
                                    <a href="history">
                                        <h1 class="text-center">再生履歴</h1>
                                    </a>
                                    <div class="carousel slide" id="carousel-890493">
                                        <ol class="carousel-indicators">
                                            <li data-slide-to="0" data-target="#carousel-890493" class="active"></li>
                                            <?php for ($i = 1; count($histdata) > $i; $i++): ?>
                                                <li data-slide-to="<?php echo $i ?>" data-target="#carousel-890493"></li>
                                            <?php endfor; ?>
                                        </ol>
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <a href="/artist/view?id=<?php echo $histdata[0]["artistid"]; ?>" target='_brank'><img class='img-polaroid' alt="" src="/uploadthumbnail/<?php echo $histdata[0]["thumbnailname"] ?>"></a>
                                                <div class="carousel-caption">
                                                    <h3><?php echo $histdata[0]["username"]; ?></h3>
                                                    <h3><?php echo $histdata[0]["title"]; ?></h3>
                                                </div>
                                            </div>
                                            <?php for ($i = 1; count($histdata) > $i; $i++): ?>
                                                <div class="item">
                                                    <a href="/artist/view?id=<?php echo $histdata[$i]["artistid"]; ?>" target='_brank'><img class='img-polaroid' alt="" src="/uploadthumbnail/<?php echo $histdata[$i]["thumbnailname"] ?>"></a>
                                                    <div class="carousel-caption">
                                                        <h3><?php echo $histdata[$i]["username"]; ?></h3>
                                                        <h3><?php echo $histdata[$i]["title"]; ?></h3>
                                                    </div>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <a data-slide="prev" href="#carousel-890493" class="left carousel-control">‹</a> <a data-slide="next" href="#carousel-890493" class="right carousel-control">›</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<?php echo Asset::css('jplayer.green.monday.css'); ?>
<?php echo Asset::js('vendor/jquery/jquery-1.9.1.min.js'); ?>
<?php echo Asset::js('jquery.jplayer.min.js'); ?>
<?php echo Asset::js('mufee-jplayer.js'); ?>
<?php echo Asset::js('jquery.easing.1.3.js'); ?>
<?php echo Asset::js('jquery-css-transform.js') ?>
<?php echo Asset::js('jquery-animate-css-rotate-scale.js') ?>
<script type="text/javascript">
    var mdata = JSON.parse(JSON.stringify(<?php echo $mdata; ?>));
    $(loadJPlayer);
</script>