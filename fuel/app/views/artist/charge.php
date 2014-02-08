<div class="widewrapper main">
    <div class="container">
        <div class="row">

            <div class="tab-pane">
                <div >
                    <div class="col-md-8 col-md-offset-2 mufee-superblock" id="contact">
                    <h2><i class='icon-music'></i> お支払いありがとうございました</h2>
                    <table class="table table-striped">
                        <tr>
                            <th>お支払い金額: <?php print($result->amount); ?></th>
                        </tr>
                        <tr>
                            <th>カード名義: <?php print($result->card->name); ?></th>
                        </tr>
                        <tr>
                            <th>カード番号: ****-****-****-<?php print($result->card->last4); ?></th>
                        </tr>
                        <tr>
                            <form action="download" method="post">
                                <input type="hidden" name="musicid" value='<?php echo $musicid;?>'>
                            <th><input type="submit" class="btn btn-xlarge btn-mufee-one" value="Download"></th>
                            </form>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>