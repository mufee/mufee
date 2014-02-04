<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-12 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-headphones"></i> CD Add
                        </h2>
                        <form action="cdinfo" method="post" accept-charset="utf-8">
                            <div class='col-lg-6'>
                                <input type="text" name="cdname" id="contact-name" placeholder="CD Name" class="form-control input-lg">
                                <input type="text" name="price" id="contact-name" placeholder="Price" class="form-control input-lg">
                                <textarea rows="12" name="musicname" id="comment-body"
                                          placeholder="複数曲の場合はMusic1,Music2,Music3の様にカンマで区切ってください。" class="form-control input-lg"></textarea>
                            </div>
                            <div class='col-md-6'>
                                <textarea rows="14" name="cdinfo" id="comment-body"
                                          placeholder="その他情報" class="form-control input-lg"></textarea>
                                <div class="buttons clearfix">
                                    <button type="submit" class="btn btn-xlarge btn-mufee-one">Submit</button>
                                    <input type='button' onClick="location.href = '/artist/'" class="btn btn-xlarge btn-mufee-two" value='Cancel'>
                                </div>

                            </div>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>