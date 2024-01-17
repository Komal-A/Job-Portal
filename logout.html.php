<section class="right"><strong>
        <h2>You are successfully logged out</h2>
    </strong>
    <p>To get login please enter your email & password below:</p>

    <form action="/Users/login" method="POST">
        <label>Username: </label>
        <input type="text" name="name" required />
        <label>Password: </label>
        <input type="password" name="password" required />
        <input type="submit" name="submit" value="Log In" />
    </form>