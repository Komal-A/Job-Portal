<h2>Apply for <?= $job[0]->title?></h2>

			<form action="/Job/apply" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="applicants[id]" value="<?= $applicants->id ?? '' ?>" />
				<label>Your name</label>
				<input type="text" name="applicants[name]" required value="<?= $applicants->name ?? '' ?>"/>

				<label>E-mail address</label>
				<input type="text" name="applicants[email]"  required value="<?= $applicants->email ?? '' ?>"/>

				<label>Cover letter</label>
				<textarea name="applicants[details]"  value="<?= $applicants->details ?? '' ?>"/></textarea>

				<label>CV</label>
				<input type="file" name="cv"/> 

				<input type="hidden" name="applicants[jobId]" required value="<?= $job[0]->id?>" />

				<input type="submit" name="submit" value="Apply" />

			</form>