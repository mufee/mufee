
<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 mufee-superblock" id="contact">
                <h2><i class='icon-wrench'></i> Price setting</h2>
                <h3 class="text-center"><?php echo $music_info[0]['title'];?></h3>
                
                <form action="priceset" method="post" accept-charset="utf-8" class="contact-form">
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="sell" id="optionsRadios1" value="true" checked>
                        売る
                    </label>
                    <label class="radio">
                        <input type="radio" name="sell" id="optionsRadios2" value="false">
                        売らない
                    </label>
                </div>
                    <!-- CSRF対策 -->
                    <input type="hidden" name="musicid" value="<?php echo $music_info[0]['id']; ?>">
                    <input type="text" name="price" id="contact-name" placeholder="Price" class="form-control input-lg text-right" value="<?php echo$music_info[0]['price'];?>">
                    <div class="buttons clearfix">
                        <input type="submit" class="btn btn-xlarge btn-mufee-one" value="Setting">
                        <input type='button' onClick="location.href = '/'" class="btn btn-xlarge btn-mufee-two" value='Cancel'>
                    </div>                
                </form>
            </div>
        </div>    
    </div>
</div>
