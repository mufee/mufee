<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-10 col-md-offset-1 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-music"></i> Upload Music
                        </h2>
                        <form action="musicupload" method="post" enctype="multipart/form-data">
                            <table class="table table-striped">
                                    <tr>
                                    <th>ジャンル</th>
                                    <td>
                                        <select class="form-control input-lg" name="genre">
                                            <option>選択してください</option>
                                            <option value="1000">ポップ</option>
                                            <option value="2000">バラード</option>
                                            <option value="3000">テクノ</option>
                                            <option value="4000">ロック</option>
                                            <option value="5000">レゲエ</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ファイル</th>
                                    <td>
                                        <input class='input-lg' type="file" name="upload_file">
                                    </td>
                                </tr>
                                <tr>
                                    <th>タイトル</th>
                                    <td><input type="text" name="title" id="contact-name" placeholder="Title" class="form-control input-lg"></td>
                                </tr>
                            </table>
                            <div class="buttons clearfix">
                                <button type="submit" class="btn btn-xlarge btn-mufee-one">Upload</button>
                                <input type='button' onClick="location.href='/artist/'" class="btn btn-xlarge btn-mufee-two" value='Cansel'>
                            </div>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
