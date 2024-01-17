<?php
require '../templates/adminNav.html.php'; ?>

<h1>Archived Jobs</h1>
<a class="sidebar" href="/Job/Job">Click here to Go Back to the main List</a>

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 10%">Salary</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 10%">closing Date</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 10%">Location</th>
            <th style="width: 5%">&nbsp;</th>
        </tr>
        <?php
        foreach ($jobs as $job) { ?>
            <tr>
                <td><?= $job->title ?></td>
                <th style="width: 5%">&nbsp;</th>
                <th style="width: 5%">&nbsp;</th>
                <td><?= $job->salary ?></td>
                <th style="width: 5%">&nbsp;</th>
                <td><?= $job->closingDate ?></td>
                <th style="width: 5%">&nbsp;</th>
                <td><?= $job->location ?></td>
                <th style="width: 5%">&nbsp;</th>
                <th style="width: 5%">&nbsp;</th>

                </form>
                </td>
                <?php
                if ($job->archive == 1) { ?>
                    <td>
                        <form method="POST" action="archiveJob">
                            <input type="hidden" name="job_id" value=" <?= $job->id ?>" />
                            <input type="hidden" name="mode" value="no" />
                            <input type="submit" name="archive_job" value="Restore" />
                        </form>
                    </td>

                <?php
                } else if ($job->archive == 0) { ?>
                    <td>
                        <form method="POST" action="archiveJob">
                            <input type="hidden" name="job_id" value=" <?= $job->id ?>" />
                            <input type="hidden" name="mode" value="yes" />
                            <input type="submit" name="archive_job" value="Archive" />
                        </form>
                    </td>

                <?php } ?>
            </tr>
        <?php  } ?>
    </thead>
</table>
</section>
</main>