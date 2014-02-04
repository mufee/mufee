<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 mufee-superblock" id="contact">
                <div class="text-center">
                    <?php if(isset($error)):?>
                        <p class="String-red"><?php echo $error;?></p>
                    <?php endif;?>
                </div>
                <h2>
                    <i class="icon-envelope"></i> Inquiry  
                </h2>
                <form action="create" method="post" accept-charset="utf-8" class="contact-form">
                    <!-- CSRF対策 -->
                    <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key'); ?>" value="<?php echo \Security::fetch_token(); ?>" />
                    <input type="text" name="address" id="contact-name" placeholder="Address" class="form-control input-lg">
                    <input type="text" name="title" id="contact-email" placeholder="Title" class="form-control input-lg">
                    <textarea rows="10" name="content" id="contact-body" placeholder="Your thoughts..." class="form-control input-lg"></textarea>
                    <div class="buttons clearfix">
                        <button type="submit" class="btn btn-xlarge btn-mufee-one">Send</button>
                        <input type='button' onClick="location.href = '/'" class="btn btn-xlarge btn-mufee-two" value='Cansel'>
                    </div>                
                </form>
            </div>
        </div>    
    </div>
</div>