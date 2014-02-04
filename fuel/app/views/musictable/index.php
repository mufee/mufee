<?php include('breadcrumb-h.php')?>
<header>
        <div class="widewrapper masthead">
            <div class="container">
                <a href="/" id="logo">
                    <?php echo Asset::img('logo.png');?>
                </a>
                <div id="mobile-nav-toggle" class="pull-right">
                    <a href="#" data-toggle="collapse" data-target=".mufee-nav .navbar-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                </div>
            </div>
        </div>

        
    
        <div class="widewrapper subheader">
            <div class="container">
                <div id="mobile-nav-toggle" class="pull-right">
                    <a href="#" data-toggle="collapse" data-target=".mufee-nav .navbar-collapse">
                        <i class="icon-reorder"></i>
                    </a>
                </div>
                <div class="mufee-breadcrumb">
                    <a href="/">ホーム</a>
                    <span class="separator">&#x2F;</span>
                    <a>ユーザー登録</a>
                    <span class="separator">&#x2F;</span>
                    <a>登録画面</a>
                </div>
            </div>
        </div>
    </header>
<body>
    <div class="container">
		<div class="row">
                    <div class="blog-teaser register-span table-center">
                        <form action="confirm" method="post">
                            <table class="table table-striped">
                                <caption>ユーザー登録</caption>
                                <tr>
                                    <th>ジャンル</th>
                                    <td>
                                    <select name="genre">
                                    <option>選択してください</option>
                                    <option value="1000">pops</option>
                                    <option value="2000">rock</option>
                                    <option value="3000">punk</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ファイル</th>
                                    <td><input type="file" name="upload_file"></td>
                                </tr>
                                <tr>
                                    <th>タイトル</th>
                                    <td><input name="title"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="btn-group-c">
                                            <input type="submit" class="btn btn-mufee-two btn-group-width" value="登録"/>
                                            <button class="btn btn-mufee-two btn-group-width">キャンセル</button>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
		</div>
		<hr/>
		<footer>
                        <p>© 2013 dvlpyeti.</p>
		</footer>
</body>
</html>
