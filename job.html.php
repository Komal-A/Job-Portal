<main class="sidebar">
    <?php

    use Ijdb\Controllers\Applicant;

    require '../templates/adminNav.html.php'; ?>

    <section class="right">

        <h2>Jobs</h2>

        <a class="new" href="/Job/edit">Add new job</a>
        <p><a class="new" href="/Job/Job">Click here to go back</a></p>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th style="width: 15%">Salary</th>
                    <th style="width: 15%">Category</th>
                    <th style="width: 5%">&nbsp;</th>
                    <th style="width: 15%">&nbsp;</th>
                    <th style="width: 5%">&nbsp;</th>
                    <th style="width: 5%">&nbsp;</th>
                </tr>

                <?php
                foreach ($job as $job) { ?>

                    <tr>
                        <td><?= $job->title ?></td>
                        <td><?= $job->salary ?></td>
                        <?php

                        foreach ($cats as $category) {

                            if ($job->categoryId == $category->id) {
                                echo ' <td><a href="/Job/Job?category_id=' . $category->id . '"> ' . $category->name . ' </td>';
                            }
                        }
                        ?>
                        <td><a style="float: right" href="/Job/edit?id=<?= $job->id ?> ">Edit</a></td>
                        <?php
                        $count = 0;
                        foreach ($applicants as $applicant) {
                            if ($job->id == $applicant->jobId) {
                                $count++;
                            }
                        }
                        ?>
                        <td><a style="float: right" href="/Applicant/applicants?id=<?= $job->id ?>">View applicants (<?= $count ?>)</a></td>
                        <td>
                            <form method="post" action="deletejob">
                                <input type="hidden" name="id" value="<?= $job->id ?>" />
                                <input type="submit" name="submit" value="Delete" />
                            </form>
                        </td>


                        <?php if ($job->archive == 1) { ?>
                            <td>
                                <form method="POST" action="archiveJob">
                                    <input type="hidden" name="job_id" value="<?= $job->id ?>" />
                                    <input type="hidden" name="mode" value="no" />
                                    <input type="submit" name="archive_job" value="Restore" />
                                </form>
                            </td>
                        <?php  } else if ($job->archive == 0) { ?>
                            <td>
                                <form method="POST" action="archiveJob">
                                    <input type="hidden" name="job_id" value="<?= $job->id ?>" />
                                    <input type="hidden" name="mode" value="yes" />
                                    <input type="submit" name="archive_job" value="Archive" />
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </thead>
        </table>
    </section>
</main>