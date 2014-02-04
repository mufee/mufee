<h2>Viewing <span class='muted'>#<?php echo $genre->id; ?></span></h2>

<p>
	<strong>Genreid:</strong>
	<?php echo $genre->genreid; ?></p>
<p>
	<strong>Genrename:</strong>
	<?php echo $genre->genrename; ?></p>

<?php echo Html::anchor('genre/edit/'.$genre->id, 'Edit'); ?> |
<?php echo Html::anchor('genre', 'Back'); ?>