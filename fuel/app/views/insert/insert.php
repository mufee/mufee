<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
//var_dump($test); 
//exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h2>新規作成</h2>
            <form name="form1" method="post" action="">
            <table width="100%" border="1">
            <tr>
 <th align="right" scope="row">タイトル：</th>
 <td class="input"><?php echo Form::input('title', Input::post('title', isset($collection) ? $collection->title : ''), array('class' => 'span6')); ?>
&nbsp;</td>
 </tr>
<tr>
 <th align="right" scope="row">コンテンツ：</th>
 <td class="input"><?php echo Form::input('content', Input::post('content', isset($collection) ? $collection->title : ''), array('class' => 'span6')); ?>
&nbsp;</td>
 </tr>
            <tr>
            <th colspan="2" scope="row"><input type="submit" name="button" id="button" value="送信"></th>
            </tr>
            </table>
            </form>
    </body>
</html>
