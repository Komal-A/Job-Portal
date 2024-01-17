<?php
require '../templates/adminNav.html.php'; ?>

<h1>Completed Enquiries</h1>
<a class="new" href="/Enquiry/enquiries">Click here to Go Back to Incomplete Enquiries</a>

<table>
	<thead>
		<tr>
			<th>ID</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			<th>Name</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			<th>Email</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			<th>Phone Number</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			<th>Enquiry</th>
			<th style="width: 5%">&nbsp;</th>
			<th style="width: 5%">&nbsp;</th>
			<th>Responded by</th>
		</tr>

		<?php
		foreach ($enquiry as $enquiry) { ?>
			<blockquote>
				<p>
					<tr>
						<td><?= $enquiry->id ?></td>
						<th style="width: 5%">&nbsp;</th>
						<th style="width: 5%">&nbsp;</th>
						<td><?= $enquiry->name ?></td>
						<th style="width: 5%">&nbsp;</th>
						<th style="width: 5%">&nbsp;</th>
						<td><?= $enquiry->email ?></td>
						<th style="width: 5%">&nbsp;</th>
						<th style="width: 5%">&nbsp;</th>
						<td><?= $enquiry->phone_number ?></td>
						<th style="width: 5%">&nbsp;</th>
						<th style="width: 5%">&nbsp;</th>
						<td><?= $enquiry->enquiry ?></td>
						<th style="width: 5%">&nbsp;</th>
						<th style="width: 5%">&nbsp;</th>
						<td><em> <?= $enquiry->getUser($_SESSION['loggedin'])->name ?></em></td>

						</form>
						</td>
				</p>
			</blockquote>
			<?php
			if ($enquiry->response == 1) { ?>
				<td>
					<form method="POST" action="response">
						<input type="hidden" name="enquiry_id" value="<?= $enquiry->id ?>" />
						<input type="hidden" name="mode" value="no" />

					</form>
				</td>
			<?php
			} else if ($enquiry->response == 0) { ?>
				<td>
					<form method="POST" action="response">
						<input type="hidden" name="enquiry_id" value="<?= $enquiry->id ?>" />
						<input type="hidden" name="mode" value="yes" />
						<input type="submit" name="response" value="Done" />
					</form>
				</td>
			<?php } ?>
			</tr>
		<?php } ?>

	</thead>
</table>
</section>
</main>