<section class="right">
	<?php if (isset($job->mode) && $job->mode == 'edit')
		echo '<h2>Edit Job</h2>';
	else
		echo '<h2>Add Job</h2>'; ?>
	<form action="/Job/edit" method="POST">
		<input type="hidden" name="job[id]" value="<?= $job->id ?? '' ?>" />
		<label>Title</label><input type="text" name="job[title]" value="<?= $job->title ?? '' ?>" />
		<?php if (isset($job->description))
			echo '<label>Description</label><textarea name="job[description]">' . $job->description . '</textarea>';
		else
			echo '<label>Description</label><textarea name="job[description]"> </textarea>';
		?>
		<label>Salary</label><input type="text" name="job[salary]" value="<?= $job->salary ?? '' ?>" />
		<label>Location</label><input type="text" name="job[location]" value="<?= $job->location ?? '' ?>" />
		<label>Category</label><select name="job[categoryId]">
			<?php
			foreach ($cats as $category) {
				if ($job->categoryId == $category->id)
					echo '<option selected="selected" value="' . $category->id . '">' . $category->name . '</option>';
				else
					echo '<option value="' . $category->id . '">' . $category->name . '</option>';
			}
			?>
		</select>
		<label>Closing Date</label><input type="date" name="job[closingDate]" value="<?= $job->closingDate ?? '' ?>" />

		<?php

		if (isset($job->mode) && $job->mode == 'edit')
			echo '<input type="submit" name="submit" value="Edit job" />';
		else
			echo '<input type="submit" name="submit" value="Add Job" />';
		?>
	</form>