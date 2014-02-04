<h2>Viewing <span class='muted'>#<?php echo $live->id; ?></span></h2>

<p>
	<strong>Livename:</strong>
	<?php echo $live->livename; ?></p>
<p>
	<strong>Prefecture:</strong>
	<?php echo $live->prefecture; ?></p>
<p>
	<strong>Date:</strong>
	<?php echo $live->date; ?></p>
<p>
	<strong>Venue:</strong>
	<?php echo $live->venue; ?></p>
<p>
	<strong>Address:</strong>
	<?php echo $live->address; ?></p>

<?php echo Html::anchor('live/edit/'.$live->id, 'Edit'); ?> |
<?php echo Html::anchor('live', 'Back'); ?>