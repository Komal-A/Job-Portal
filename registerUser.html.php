<?php
require '../templates/adminNav.html.php'; ?>
<h2>Registered Users</h2>
<a class="right" href="/Users/register">Add new User</a>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
            <th>Email</th>
            <th style="width: 5%">&nbsp;</th>
            <th style="width: 5%">&nbsp;</th>
            <th>Account Type</th>
        </tr>

        <?php
        foreach ($users as $user) { ?>
            <tr>
                <td><?= $user->name ?></td>
                <th style="width: 5%">&nbsp;</th>
                <th style="width: 5%">&nbsp;</th>
                <td><?= $user->email ?></td>
                <th style="width: 5%">&nbsp;</th>
                <th style="width: 5%">&nbsp;</th>
                <td><?= $user->account_type ?></td>
                <td>
                    <form method="post" action="deleteuser">
                        <input type="hidden" name="id" value=" <?= $user->id ?>" />
                        <input type="submit" name="submit" value="Remove" />
                    </form>
                </td>
            </tr>
        <?php } ?>
    </thead>
</table>
</section>
</main>