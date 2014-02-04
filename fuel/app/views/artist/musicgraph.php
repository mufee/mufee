<div class="widewrapper main">
    <div class="container">
        <div class="row">
            <div class='col-md-10 margin-top-2'>
                <div class='row'>
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#yaer" data-toggle="tab">yaer</a></li>
                            <li><a href="#month" data-toggle="tab">month</a></li>
                        </ul>
                        <div id="my-tab-content" class="tab-content">
                            <div class="tab-pane active" id="yaer">
                                <div>
                                    <div id="yaer_talbe">
                                        <table id="yaergraph" >
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <?php if (isset($yaergraph)) { ?>
                                                        <?php foreach ($yaergraph as $value): ?>
                                                            <th><?php echo $value['date']; ?></th>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php if (isset($yaergraph)) { ?>
                                                        <?php foreach ($yaergraph as $value): ?>
                                                            <td><?php echo $value['cnt']; ?></td>
                                                            <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div class="tab-pane" id="month">
                                <div id="month_talbe">
                                    <table id="monthgraph">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <?php if (isset($mongraph)) { ?>
                                                    <?php foreach ($mongraph as $value): ?>
                                                        <th><?php echo $value['date']; ?></th>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php if (isset($mongraph)) { ?>
                                                    <?php foreach ($mongraph as $value): ?>
                                                        <td><?php echo $value['cnt']; ?></td>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<?php echo Asset::js('jquery.gvChart-1.1.min.js'); ?>
<script type="text/javascript">
    gvChartInit();
    $(document).ready(function() {
        $('#yaergraph').gvChart({
            chartType: 'AreaChart',
//その他に AreaChart、LineChart、BarChart、ColumnChart、PieChartがあります。
            gvSettings: {
                fontSize: 16,
                vAxis: {title: '回数'}, //縦軸タイトル
                hAxis: {title: '年'}, //横軸タイトル
                width: 1280, //幅
                height: 620, //高さ
            }
        });
        $('#monthgraph').gvChart({
            chartType: 'AreaChart',
//その他に AreaChart、LineChart、BarChart、ColumnChart、PieChartがあります。
            gvSettings: {
                fontSize: 16,
                vAxis: {title: '回数'}, //縦軸タイトル
                hAxis: {title: '月'}, //横軸タイトル
                width: 1280, //幅
                height: 620, //高さ
            }
        });
    });
</script>