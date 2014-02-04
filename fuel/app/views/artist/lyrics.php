<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-12 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-wrench"></i> Lyrics Edit
                        </h2>
                        <div class='col-md-8 col-md-offset-2'>
                            <form action="lyrics" method="post" accept-charset="utf-8">
                                <input type='hidden' name='id' value='<?php echo $music[0]['id'];?>'>
                                <h3>Music : <?php echo $music[0]['title']; ?></h3>
                                <textarea rows="17" name="lyrics" id="comment-body"
                                          placeholder="Artist Introduction..." class="form-control input-lg">
                                              <?php echo $music[0]['lyrics']; ?>
                                </textarea>
                                <div class="buttons clearfix">
                                    <button type="submit" class="btn btn-xlarge btn-mufee-one">Submit</button>
                                    <input type='button' onClick="location.href = '/artist/'" class="btn btn-xlarge btn-mufee-two" value='Cansel'>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>