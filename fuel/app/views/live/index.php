<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-10 col-md-offset-1 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="" id="create-comment">
                        <h2>
                            <i class="icon-microphone"></i> Live Add
                        </h2>
                        <form action="create" method="post" enctype="multipart/form-data">
                            <table class="table table-striped">
                                <tr>
                                    <th class="text-center">LIVE名</th>
                                    <td>
                                        <input name="livename" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">都道府県</th>
                                    <td><select class='form-control input-lg' name="prefecture">
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
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">開催日</th>
                                    <td>
                                        <select  class='input-sm3' name="year">
                                            <?php optionLoop('2013', '2020', '2013'); ?>
                                        </select>
                                        年
                                        <select class='input-sm3' name="month">
                                            <?php optionLoop('1', '12', '1'); ?>
                                        </select>
                                        月
                                        <select class='input-sm3' name="day">
                                            <?php optionLoop('1', '31', '1'); ?>
                                        </select>
                                        日

                                        <?php

                                        function optionLoop($start, $end, $value = null) {

                                            for ($i = $start; $i <= $end; $i++) {
                                                if (isset($value) && $value == $i) {
                                                    echo "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
                                                } else {
                                                    echo "<option value=\"{$i}\">{$i}</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">会場名</th>
                                    <td>
                                        <input name="venue" class="form-control input-lg">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">住所</th>
                                    <td>
                                        <input name="address" class="form-control input-lg">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">サイトURL</th>
                                    <td>
                                        <input name="url" class="form-control input-lg">
                                    </td>
                                </tr>
                            </table>
                            <div class="pull-right buttons clearfix">
                                <input type='button' onClick="location.href = '/artist/liveinfo'" class="btn btn-xlarge btn-mufee-two" value='Cansel'>
                                <button type="submit" class="btn btn-xlarge btn-mufee-one">Add</button>
                            </div>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="margin-top-4">
    <form action="create" method="post"style="text-align:center">

    </form>
</div>