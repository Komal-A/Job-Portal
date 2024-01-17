<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="/styles.css" />
	<title><?= $title ?></title>
</head>

<body>
	<header>
		<section>
			<aside>
				<h3>Office Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: Closed</p>
			</aside>
			<h1>Jo's Jobs</h1>
		</section>
	</header>

	<nav>
		<ul>
			<li><a href="/Site/home">Home</a></li>
			<li><a href="/Job/Jobs">All Jobs</a></li>
			<li>Jobs Categories
				<ul>
					<?php
					require '../database.php';
					$CategoryTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id');
					$controllers['Category'] = new \Ijdb\Controllers\Category($CategoryTable);
					$this->CategoryTable = $CategoryTable;
					$category = $this->CategoryTable->findAll();

					foreach ($category as $category) {
						echo '<li><a href="/Users/Jobs?category_id=' . $category->id . '"> ' . $category->name . ' </a></li>';
					} ?>
				</ul>
			</li>
			<?php

			?>
			<li><a href="/Site/about">About Us</a></li>
			<li><a href="/Site/FAQ">FAQ's</a></li>
			<li><a href="/Enquiry/contact">Contact us</a></li>
			<?php
			if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
				echo '<li><a href="/Job/Job">Manage</a></li>
				<li><a href="/Users/logout">Logout</a></li>';
			else
				echo '<li><a href="/Users/login"> Admin Login</a></li>';
			?>


			<li>
				<form action="/Job/Jobs">
					<input type="text" name="search" placeholder="Search by Location" />
					<button type="submit" name="submit">Search</button>
				</form>
			</li>
		</ul>

	</nav>
	<img src="/images/randombanner.php" />

	<main>
		<?= $output ?>
	</main>

	<footer>
		&copy; Jo's Jobs 2023
	</footer>
</body>

</html>