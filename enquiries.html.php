<?php
require '../templates/adminNav.html.php'; ?>

<h1>All Enquiries</h1>

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
        </tr>

        <?php
        foreach ($enquiry as $enquiry) { ?>

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
                </form>
                </td>

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
                            <input type="submit" name="response" value="Complete" />
                        </form>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>

    </thead>
</table>
</section>
</main>