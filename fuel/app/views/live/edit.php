<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-10 col-md-offset-1 margin-top-2 mufee-superblock'>
                <div class='row'>
                    <aside class="" id="create-comment">
                        <h2>
                            <i class="icon-microphone"></i> Live Edit
                            </h2>
                            <form action="liveupdate" method="post" enctype="multipart/form-data">
                                <table class="table table-striped">
                                    <th>LIVE名</th>
                                    <td>
                                        <input class="form-control input-lg" name="livename" value="<?php echo $liveinfo[0]['livename']; ?>">
                                    </td>
                                    </tr>
                                    <tr>
                                        <th>都道府県</th>
                                        <td>
                                            <input class="form-control input-lg" name="prefecture" value="<?php echo $liveinfo[0]['prefecture']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>開催日</th>
                                        <td>
                                            <select class='input-sm3' name="year">
                                                <?php $date = explode("-", $liveinfo[0]['date']); ?>
                                                <?php optionLoop('2013', '2020', $date[0]); ?>
                                            </select>
                                            年
                                            <select class='input-sm3' name="month">
                                                <?php optionLoop('1', '12', $date[1]); ?>
                                            </select>
                                            月
                                            <select class='input-sm3' name="day">
                                                <?php optionLoop('1', '31', $date[2]); ?>
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
                                        <th>会場名</th>
                                        <td>
                                            <input class="form-control input-lg" name="venue" value="<?php echo $liveinfo[0]['venue']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>住所</th>
                                        <td>
                                            <input class="form-control input-lg" name="address" value="<?php echo $liveinfo[0]['address']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>サイトURL</th>
                                        <td>
                                            <input class="form-control input-lg" name="url" value="<?php echo $liveinfo[0]['url']; ?>">
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

