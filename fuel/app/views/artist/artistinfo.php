<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-12 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-wrench"></i> Artist Edit
                        </h2>
                        <div class='col-lg-6'>
                            <?php if (isset($thumbnail)): ?>
                                <img  src="/uploadthumbnail/<?php echo $thumbnail[0]['thumbnailname'] ?>" class="">
                            <?php endif; ?>
                        </div>
                        <div class='col-md-6'>
                            <form action="artistinfo" method="post" accept-charset="utf-8">
                                <textarea rows="17" name="artistinfo" id="comment-body"
                                          placeholder="Artist Introduction..." class="form-control input-lg">
                                              <?php if (!empty($artistinfo)): ?>
                                                  <?php foreach ($artistinfo as $val): ?>
                                                      <?php echo $val['artistinfo']; ?>
                                                  <?php endforeach; ?>
                                              <?php endif; ?>
                                </textarea>
                                <div class="buttons clearfix">
                                    <button type="submit" class="btn btn-xlarge btn-mufee-one">Submit Text</button>
                                    <input type='button' onClick="location.href='thumbnail'" class="btn btn-xlarge btn-mufee-two" value='Edit Thumbnail'>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>