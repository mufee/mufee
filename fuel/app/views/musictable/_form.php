<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="control-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::input('title', Input::post('title', isset($musictable) ? $musictable->title : ''), array('class' => 'span4', 'placeholder'=>'Title')); ?>

			</div>
		</div>
		<div class="control-group">
			<?php echo Form::label('Path', 'path', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::input('path', Input::post('path', isset($musictable) ? $musictable->path : ''), array('class' => 'span4', 'placeholder'=>'Path')); ?>

			</div>
		</div>
		<div class="control-group">
			<?php echo Form::label('Genre', 'genre', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::input('genre', Input::post('genre', isset($musictable) ? $musictable->genre : ''), array('class' => 'span4', 'placeholder'=>'Genre')); ?>

			</div>
		</div>
		<div class="control-group">
			<label class='control-label'>&nbsp;</label>
			<div class='controls'>
				<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>			</div>
		</div>
	</fieldset>
<?php echo Form::close(); ?>