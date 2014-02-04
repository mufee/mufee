<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-10 col-md-offset-1 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-music"></i> Upload Thumbnail
                        </h2>
                        <form action="thumbnailupload" method="post" enctype="multipart/form-data">
                            <table class="table table-striped">
                                <tr>
                                    <th>ファイル</th>
                                    <td><input class='input-lg' type="file" name="upload_file"></td>
                                </tr>
                            </table>
                            <div class="buttons clearfix">
                                <button type="submit" class="btn btn-xlarge btn-mufee-one">Upload</button>
                                <input type='button' onClick="location.href = '/artist/'" class="btn btn-xlarge btn-mufee-two" value='Cansel'>
                            </div>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<div>
    <?php if (isset($html_error)): ?>
        <?php echo $html_error; ?>
    <?php endif; ?>
    <div class="blog-teaser register-span table-center">
        <form action="thumbnailupload" method="post" enctype="multipart/form-data">
            <table class="table table-striped">
                <caption>サムネイル登録</caption>
                <tr>
                    <th>ファイル</th>
                    <td><input type="file" name="upload_file"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="text-center">
                            <input type="submit" class="btn btn-mufee-two btn-width" value="登録"/>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>