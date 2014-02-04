<h2>Editing <span class='muted'>genre</span></h2>
<br>

<?php echo render('genre/_form'); ?>
<p>
	<?php echo Html::anchor('genre/view/'.$genre->id, 'View'); ?> |
	<?php echo Html::anchor('genre', 'Back'); ?></p>
