<main class="sidebar">
	<section class="left">
		<?=
		'<ul>';
		foreach ($cats as $category) {
			echo '<li><a href="/Users/Jobs?category_id=' . $category->id . '"> ' . $category->name . ' </a></li>';
		}
		'</ul>';
		?>
	</section>

	<section class="right">

		<h1>All Jobs</h1>

		<?php

		foreach ($job as $job) { ?>
			<ul>
				<li>
					<h2>Job Title: <?= $job->title ?> </h2>
					<h3>Salary: <?= $job->salary ?></h3>
					<h3>Job description:</h3>
					<p><?= $job->description ?></p>
					<h3>Closing Date: <?= $job->closingDate ?></h3>
					<h3>Location: <?= $job->location ?></h3>

					<a class="more" href="/Job/apply?id=<?= $job->id ?> ">Apply for this job</a>

					</div>
				</li>
			</ul>
		<?php } ?>
	</section>
</main>