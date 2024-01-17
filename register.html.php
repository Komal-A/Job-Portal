<form action="/Users/register" method="POST">
    <strong>
        <p>Enter your details to register:</p>
    </strong>
    <input type="hidden" name="user[id]" value="<?= $user['id'] ?? '' ?>" />
    <label>Username:</label> <input type="text" name="user[name]" required value="<?= $user['name'] ?? '' ?>" />
    <label>Email:</label> <input type="text" name="user[email]" required value="<?= $user['email'] ?? '' ?>" />
    <label>Password: </label><input type="password" name="user[password]" required value="<?= $user['password'] ?? '' ?>" />
    <label>Account type: </label><input type="account_type" name="user[account_type]" value="<?= $user['account_type'] ?? '' ?>" />   
    <input type="submit" name="submit" value="submit" />
</form>