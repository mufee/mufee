<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title = "" ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Bootstrap styles -->
        <?php echo Asset::css('vendor/bootstrap/bootstrap.css'); ?>
        <?php echo Asset::css('vendor/bootstrap/bootstrap-theme.css'); ?>

        <!-- Font-Awesome -->
        <?php echo Asset::css('vendor/font-awesome/font-awesome.css'); ?>

        <!-- Google Webfonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600|PT+Serif:400,400' rel='stylesheet' type='text/css'>

        <!-- Styles -->
        <?php echo Asset::css('styles-bluegreen.css') ?>

        <!-- Mufee Styles -->
        <?php echo Asset::css('mufee.css') ?>

        <!--[if lt IE 9]>
            <link rel="stylesheet" href="css/ie8.css">        
            <script src="js/vendor/google/html5-3.6-respond-1.1.0.min.js"></script>
        <![endif]-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <?php echo Asset::js('vendor/jquery/jquery-1.9.1.min.js') ?>
        <?php echo Asset::js('vendor/bootstrap/bootstrap.min.js') ?>
        <?php echo Asset::js('vendor/modernizr/modernizr.js') ?>
    </head>

    <?php if (empty($breadcrumb)) : ?>
        <body>
            <header>
                <div class="widewrapper masthead">
                    <div class="container">
                        <a href="/" id="logo">
                            <?php echo Asset::img('logo.png'); ?>
                        </a>

                        <div id="mobile-nav-toggle" class="pull-right">
                            <a href="#" data-toggle="collapse" data-target=".mufee-nav .navbar-collapse">
                                <i class="icon-reorder"></i>
                            </a>
                        </div>

                        <nav class="pull-right mufee-nav">
                            <div class="collapse navbar-collapse">
                                <ul class="nav nav-pills navbar-nav">
                                    <li>
                                        <a href="inquiry/index">問い合わせ</a>
                                    </li>
                                    <?php if (Auth::check()) : ?>
                                        <?php
                                        switch (Auth::get_groups()):
                                            case 1:
                                                ?>
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle"
                                                       data-toggle="dropdown"
                                                       href="/">
                                                           <?php echo Auth::get_screen_name(); ?>
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="auth/update">会員情報修正</a></li>
                                                        <li><a href="mylist/index" target='_brank'>お気に入り一覧</a><li>
                                                        <li><a href="auth/logout">ログアウト</a></li>
                                                    </ul>
                                                </li>
                                                <?php break; ?>
                                            <?php case 2: ?>
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle"
                                                       data-toggle="dropdown"
                                                       href="/">
                                                           <?php echo Auth::get_screen_name(); ?>
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="artist/index">管理画面</a></li>
                                                        <li><a href="auth/update">会員情報修正</a></li>
                                                        <li><a href="auth/logout">ログアウト</a></li>
                                                    </ul>
                                                </li>
                                                <?php break; ?>
                                            <?php case 5: ?>
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle"
                                                       data-toggle="dropdown"
                                                       href="/">
                                                           <?php echo Auth::get_screen_name(); ?>
                                                        <b class="caret"></b>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="auth/logout">ログアウト</a></li>
                                                    </ul>
                                                </li>
                                        <?php endswitch; ?>
                                    <?php else : ?>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle"
                                               data-toggle="dropdown"
                                               href="/">
                                                会員登録 
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="auth/usercreate">ユーザ登録</a></li>
                                                <li><a href="auth/artistcreate">アーティスト登録</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="auth/login">ログイン</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <div class="mufee-searchbox">
                                <form action="search" method="post" accept-charset="utf-8">
                                    <button class="searchbutton" type="submit">
                                        <i class="icon-search"></i>
                                    </button>
                                    <input class="searchfield"  name="searchname" id="searchbox" type="text" placeholder="Artist search">
                                </form>
                            </div>
                        </nav>        

                    </div>
                </div>
                <div class="widewrapper genreheader">
                    <div class="container">
                        <form action="music/index" name='genreForm' method="get">
                            <div id='selectGenre'>
                            </div>
                            <div class='col-md-10 margin-top-2'>
                                <h2>Genre Select</h2>
                                <div class="btn-group alignment" data-toggle="buttons-radio">
                                    <button type="button" Onclick='addGenre(1)' value='1' class="btn btn-mufee-two btn-xlarge">POP</button>
                                    <button type="button" Onclick='addGenre(2)' value='2' class="btn btn-mufee-two btn-xlarge">BALLADE</button>
                                    <button type="button" Onclick='addGenre(3)' value='3' class="btn btn-mufee-two btn-xlarge">TECHNO</button>
                                    <button type="button" Onclick='addGenre(4)' value='4' class="btn btn-mufee-two btn-xlarge">ROCK</button>
                                    <button type="button" Onclick='addGenre(5)' value='5' class="btn btn-mufee-two btn-xlarge">REGGAE</button>
                                </div>
                            </div>
                            <div class='col-md-2 margin-top-2 margin-bottom-2'>
                                <div class="pulcl-right">
                                    <aside class="social-icons clearfix">
                                        <a href='#' Onclick='play()' class="social-icon color-one">
                                            <div class="inner-circle"></div> <i class="icon-play"></i>
                                        </a>
                                    </aside>
                                </div>
                            </div>


                            <!--                                    <ul class="nav nav-genre navbar-nav">
                                                                    <li>
                                                                        <label class="checkbox-inline">
                                                                            <input class="ckb-genre" type="checkbox" id="inlineCheckbox1" name="genrecb[]" value="1000">
                                                                            <p>POP</p>
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="checkbox-inline">
                                                                            <input class="ckb-genre" type="checkbox" id="inlineCheckbox1    " name="genrecb[]" value="2000">
                                                                            <p>BALLADE</p>
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="checkbox-inline">
                                                                            <input class="ckb-genre" type="checkbox" id="inlineCheckbox1" name="genrecb[]" value="3000">
                                                                            <p>TECHNO</p>
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="checkbox-inline">
                                                                            <input class="ckb-genre" type="checkbox" id="inlineCheckbox1" name="genrecb[]" value="4000">
                                                                            <p>ROCK</p>
                                                                        </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="checkbox-inline">
                                                                            <input class="ckb-genre" type="checkbox" id="inlineCheckbox1" name="genrecb[]" value="5000">
                                                                            <p>REGGAE</p>
                                                                        </label>
                                                                    </li>
                                                                </ul>-->
                        </form>
                    </div>
                </div>
            </header>
            <?php if (Session::get_flash('notice')): ?>
                <div class="notice"><p><?php echo implode('</p><p>', (array) Session::get_flash('notice')); ?></div></p>
        <?php endif; ?>
        <?php echo $content; ?>
    </body>
    <footer>
        <div class="widewrapper footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-widget">
                        <h3> <i class="icon-music"></i>Information</h3>


                        <div class="stats">
                            <div class="line">
                                <span class="counter"><?php echo Model_User::allusercount()?></span>
                                <span class="caption">User</span>
                            </div> 
                            <div class="line">
                                <span class="counter"><?php echo Model_User::artistcount()?></span>
                                <span class="caption">Artist</span>
                            </div>
                            <div class="line">
                                <span class="counter"><?php echo Model_Music::musicnum();?></span>
                                <span class="caption">Music</span>
                            </div>         
                        </div>
                    </div>

                    <div class="col-md-4 footer-widget">
                        <h3> <i class="icon-user"></i>MT2 Developer</h3>
                        <ul class="mufee-list">
                            <li><p>Norihumi Sakamoto</p></li>
                            <li><p>Yuta Ishida</p></li>
                            <li><p>Syudo Matsumoto</p></li>
                            <li><p>Daiki Ouchi</p></li>
                        </ul>
                    </div>

                    <div class="col-md-4 footer-widget">
                        <h3> <i class="icon-envelope"></i>Contact Me</h3>

                        <span>Osaka Information Computer Polytechnic</span>

                        <span class="email">
                            <a href="#">http://www.oic.ac.jp/</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </html>

<?php else: ?>

    <header>
        <div class="widewrapper masthead">
            <div class="container">
                <a href="/" id="logo">
                    <?php echo Asset::img('logo.png'); ?>
                </a>
            </div>
        </div>
        <div class="widewrapper subheader">
            <div class="container">
                <div class="mufee-breadcrumb">
                    <span class="separator">&#x2F;</span>
                    <a href="/">TOP</a>
                    <?php foreach ($breadcrumb as $val): ?>
                        <span class="separator">&#x2F;</span>
                        <a href="<?php echo $val["url"] ?>"><?php echo $val["name"]; ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </header>
    <body>
        <?php if (Session::get_flash('notice')): ?>
            <div class="notice"><p><?php echo implode('</p><p>', (array) Session::get_flash('notice')); ?></div></p>
    <?php endif; ?>

    <?php echo $content; ?>
    </body>
    <footer>
        <div class="widewrapper footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-widget">
                        <h3> <i class="icon-music"></i>Information</h3>


                        <div class="stats">
                            <div class="line">
                                <span class="counter"><?php echo Model_User::allusercount()?></span>
                                <span class="caption">User</span>
                            </div> 
                            <div class="line">
                                <span class="counter"><?php echo Model_User::artistcount()?></span>
                                <span class="caption">Artist</span>
                            </div>
                            <div class="line">
                                <span class="counter"><?php echo Model_Music::musicnum();?></span>
                                <span class="caption">Music</span>
                            </div>         
                        </div>
                    </div>

                    <div class="col-md-4 footer-widget">
                        <h3> <i class="icon-user"></i>MT2 Developer</h3>
                        <ul class="mufee-list">
                            <li><p>Norihumi Sakamoto</p></li>
                            <li><p>Yuta Ishida</p></li>
                            <li><p>Syudo Matsumoto</p></li>
                            <li><p>Daiki Ouchi</p></li>
                        </ul>
                    </div>

                    <div class="col-md-4 footer-widget">
                        <h3> <i class="icon-envelope"></i>Contact Me</h3>

                        <span>Osaka Information Computer Polytechnic</span>

                        <span class="email">
                            <a href="#">http://www.oic.ac.jp/</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </html>
<?php endif; ?>
    