<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 mufee-superblock" id="contact">
                <h1><?php echo $music_info[0]['title'];?></h1>
                <div class="text-center">
                <?php if($purchase_check===TRUE):?>
                    <form action="download" method="post">
                    <input type="hidden" name="musicid" value="<?php echo $music_info[0]['id'];?>">
                    <input type="submit" class="btn btn-xlarge btn-mufee-one" value="download">
                    </form>
                <?php else:?>
                <form action="charge" method="post">
                    <input type="hidden" name="id" value="<?php echo $music_info[0]['id'];?>">
                    <p><?php echo $music_info[0]['price'];?>円を支払う。</p>

<!-- 御自身のサーバにクレジットカード情報を送信すると、クレジットカード情報を適切に扱う義務が生じます。
     JavaScript を利用して webpay token を生成することで、クレジットカード情報を直接あつかわずに済みます。
     webpay-token という name を持つ input が自動的に追加されます。 -->
                <script src="https://checkout.webpay.jp/v1/" class="webpay-button"
                        data-text="カード情報を入力して支払う"
                        data-key="<?php print(PUBLIC_KEY); ?>"></script>
                </form>
                <?php endif;?>
                </div>
                </div>
            </div>
        </div>
    </div>