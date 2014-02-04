<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-12 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="create-comment" id="create-comment">
                        <h2>
                            <i class="icon-microphone"></i> Live Infomation
                        </h2>
                        <div class='col-md-12'>
                            <div class='row'>
                                <form name="search" method="post" action="liveinfo">
                                    <div class='col-lg-7 margin-top-2 col-lg-offset-2'>
                                        <select class='form-control input-lg' name="prefecture">
                                            <option value="" selected="selected">都道府県をお選びください</option>
                                            <optgroup label="北海道・東北">
                                                <option value="北海道">北海道</option>
                                                <option value="青森県">青森県</option>
                                                <option value="岩手県">岩手県</option>
                                                <option value="宮城県">宮城県</option>
                                                <option value="秋田県">秋田県</option>
                                                <option value="山形県">山形県</option>
                                                <option value="福島県">福島県</option>
                                            </optgroup>
                                            <optgroup label="関東">
                                                <option value="茨城県">茨城県</option>
                                                <option value="栃木県">栃木県</option>
                                                <option value="群馬県">群馬県</option>
                                                <option value="埼玉県">埼玉県</option>
                                                <option value="千葉県">千葉県</option>
                                                <option value="東京都">東京都</option>
                                                <option value="神奈川県">神奈川県</option>
                                            </optgroup>
                                            <optgroup label="甲信越・北陸">
                                                <option value="新潟県">新潟県</option>
                                                <option value="富山県">富山県</option>
                                                <option value="石川県">石川県</option>
                                                <option value="福井県">福井県</option>
                                                <option value="山梨県">山梨県</option>
                                                <option value="長野県">長野県</option>
                                            </optgroup>
                                            <optgroup label="東海">
                                                <option value="岐阜県">岐阜県</option>
                                                <option value="静岡県">静岡県</option>
                                                <option value="愛知県">愛知県</option>
                                                <option value="三重県">三重県</option>
                                            </optgroup>
                                            <optgroup label="関西">
                                                <option value="滋賀県">滋賀県</option>
                                                <option value="京都府">京都府</option>
                                                <option value="大阪府">大阪府</option>
                                                <option value="兵庫県">兵庫県</option>
                                                <option value="奈良県">奈良県</option>
                                                <option value="和歌山県">和歌山県</option>
                                            </optgroup>
                                            <optgroup label="中国">
                                                <option value="鳥取県">鳥取県</option>
                                                <option value="島根県">島根県</option>
                                                <option value="岡山県">岡山県</option>
                                                <option value="広島県">広島県</option>
                                                <option value="山口県">山口県</option>
                                            </optgroup>
                                            <optgroup label="四国">
                                                <option value="徳島県">徳島県</option>
                                                <option value="香川県">香川県</option>
                                                <option value="愛媛県">愛媛県</option>
                                                <option value="高知県">高知県</option>
                                            </optgroup>
                                            <optgroup label="九州・沖縄">
                                                <option value="福岡県">福岡県</option>
                                                <option value="佐賀県">佐賀県</option>
                                                <option value="長崎県">長崎県</option>
                                                <option value="熊本県">熊本県</option>
                                                <option value="大分県">大分県</option>
                                                <option value="宮崎県">宮崎県</option>
                                                <option value="鹿児島県">鹿児島県</option>
                                                <option value="沖縄県">沖縄県</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class='col-md-8 col-md-offset-2'>
                                        <button type="submit" name='Submit' class="btn btn-xlarge btn-mufee-two">Search</button>
                                    </div>
                                </form>
                            </div>
                            <div class='col-md-12 margin-top-5'>
                                <div class='row'>
                                    <table class="table table-striped table-bordered">
                                        <?php if (!empty($liveinfo)): ?>
                                        <tr>
                                            <th class="text-center">LIVE名</th><th class="text-center">日付</th><th class="text-center">会場</th><th class="text-center">都道府県</th><th class="text-center">住所</th><th class="text-center">サイト</th><th><img class="icon img-center"  src="/icon/mic.png"></th>
                                        </tr>
                                            <?php foreach ($liveinfo as $value): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $value['livename']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['date']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['venue']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['prefecture']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['address']; ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($value['url'] === ''): ?>
                                                        <?php else : ?>
                                                            <a href="<?php echo $value['url']; ?>"><img class="icon img-center" src="/icon/link.png"></a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <form action="liveperform" method="post" enctype="m<ultipart/form-data">
                                                            <input type="hidden" name="liveid" value="<?php echo $value['id']; ?>">
                                                            <input type="submit" class="btn btn-mufee-two btn-group-width" value="出演"/>
                                                        </form>
                                                        <form action="/live/edit" method="post" enctype="m<ultipart/form-data">
                                                            <input type="hidden" name="liveid" value="<?php echo $value['id']; ?>">
                                                            <input type="submit" class="btn btn-mufee-two btn-group-width" value="変更"/>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </table>
                                    <div class="text-center">
                                        <?php if (empty($liveinfo)): ?>
                                            <?php echo 'LIVEデータがありません。'; ?>
                                        <?php endif; ?>
                                        <div class="buttons clearfix">
                                            <input type='button' onClick="location.href = '/live/'" class="btn btn-xlarge btn-mufee-two" value='Live Add'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>