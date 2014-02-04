<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="control-group">
			<?php echo Form::label('Livename', 'livename', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::textarea('livename', Input::post('livename', isset($live) ? $live->livename : ''), array('class' => 'span8', 'rows' => 8, 'placeholder'=>'Livename')); ?>

			</div>
		</div>
		<div class="control-group">
			<?php echo Form::label('Prefecture', 'prefecture', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::input('prefecture', Input::post('prefecture', isset($live) ? $live->prefecture : ''), array('class' => 'span4', 'placeholder'=>'Prefecture')); ?>

			</div>
		</div>
		<div class="control-group">
			<?php echo Form::label('Date', 'date', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::input('date', Input::post('date', isset($live) ? $live->date : ''), array('class' => 'span4', 'placeholder'=>'Date')); ?>

			</div>
		</div>
		<div class="control-group">
			<?php echo Form::label('Venue', 'venue', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::textarea('venue', Input::post('venue', isset($live) ? $live->venue : ''), array('class' => 'span8', 'rows' => 8, 'placeholder'=>'Venue')); ?>

			</div>
		</div>
		<div class="control-group">
			<?php echo Form::label('Address', 'address', array('class'=>'control-label')); ?>

			<div class="controls">
				<?php echo Form::textarea('address', Input::post('address', isset($live) ? $live->address : ''), array('class' => 'span8', 'rows' => 8, 'placeholder'=>'Address')); ?>

			</div>
		</div>
		<div class="control-group">
			<label class='control-label'>&nbsp;</label>
			<div class='controls'>
				<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>			</div>
		</div>
	</fieldset>
<?php echo Form::close(); ?>