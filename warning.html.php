<section class="right"><strong>
        <h2>Username and Password doesn't match the record</h2>
    </strong>

    <p>Try Again! </p>
    <form action="/Users/login" method="POST">
        <label>Username: </label>
        <input type="text" name="name" required />
        <label>Password: </label>
        <input type="password" name="password" required />
        <input type="submit" name="submit" value="Log In" />
    </form>