<h1>Searched Result</h1>

<main class="sidebar">
	<section class="left">
		<?php
		'<ul>';
		foreach ($cats as $category) {
			echo '<li><a href="?category_id=' . $category->id . '"> ' . $category->name . ' </a></li>';
		}
		'</ul>';
		?>
	</section>

	<section class="right">

		<?php

		foreach ($job as $job) { ?>
			<ul>
				<li>

					<div class="details">
						<h2><?= $job->title ?></h2>
						<h3><?= $job->salary ?></h3>
						<p><?= $job->description ?></p>

						<a class="more" href="/Job/apply?id=<?= $job->id ?> ">Apply for this job</a>

					</div>
				</li>
			</ul>
		<?php } ?>
	</section>
</main>