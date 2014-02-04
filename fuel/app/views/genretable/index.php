<h2>Listing <span class='muted'>genre</span></h2>
<br>
<?php if ($genre): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Genreid</th>
			<th>Genrename</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($genre as $genre): ?>		<tr>

			<td><?php echo $genre->genreid; ?></td>
			<td><?php echo $genre->genrename; ?></td>
			<td>
				<?php echo Html::anchor('genre/view/'.$genre->id, '<i class="icon-eye-open" title="View"></i>'); ?> |
				<?php echo Html::anchor('genre/edit/'.$genre->id, '<i class="icon-wrench" title="Edit"></i>'); ?> |
				<?php echo Html::anchor('genre/delete/'.$genre->id, '<i class="icon-trash" title="Delete"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No genre.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('genre/create', 'Add new genre', array('class' => 'btn btn-success')); ?>

</p>
