<div><?php echo $errmsg ?></div>
<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 mufee-superblock" id="contact">
                <h2><i class='icon-user'></i> Create Artist</h2>
                <form action="artistcreated" method="post" accept-charset="utf-8" class="contact-form">
                    <!-- CSRF対策 -->
                    <input type="hidden" name="<?php echo \Config::get('security.csrf_token_key'); ?>" value="<?php echo \Security::fetch_token(); ?>" />
                    <input type="text" name="username" id="contact-name" placeholder="Name" class="form-control input-lg">
                    <input type="text" name="email" id="contact-name" placeholder="Email" class="form-control input-lg">
                    <input type="password" name="password" id="contact-email" placeholder="Password" class="form-control input-lg">
                    <div class="buttons clearfix">
                        <button type="submit" class="btn btn-xlarge btn-mufee-one">Login</button>
                        <input type='button' onClick="location.href = '/'" class="btn btn-xlarge btn-mufee-two" value='Cancel'>
                    </div>               
                </form>
            </div>
        </div>    
    </div>
</div>