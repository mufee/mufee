<h2>Editing <span class='muted'>Musictable</span></h2>
<br>

<?php echo render('musictable/_form'); ?>
<p>
	<?php echo Html::anchor('musictable/view/'.$musictable->id, 'View'); ?> |
	<?php echo Html::anchor('musictable', 'Back'); ?></p>
