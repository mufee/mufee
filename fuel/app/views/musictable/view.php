<h2>Viewing <span class='muted'>#<?php echo $musictable->id; ?></span></h2>

<p>
	<strong>Title:</strong>
	<?php echo $musictable->title; ?></p>
<p>
	<strong>Path:</strong>
	<?php echo $musictable->path; ?></p>
<p>
	<strong>Genre:</strong>
	<?php echo $musictable->genre; ?></p>

<?php echo Html::anchor('musictable/edit/'.$musictable->id, 'Edit'); ?> |
<?php echo Html::anchor('musictable', 'Back'); ?>