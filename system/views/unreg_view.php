<?php
if (isset($data['login_error']))
{
  echo "<p class='error'>Password error.</p>";
}
?>
      <form class="form-signin" action="<?php echo conf::BASE_URL ?>login" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus<?php if (isset($data['login_error']['email'])) {echo ' value="'.$data['login_error']['email'].'"';} ?>>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <!--div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div-->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

<?php
if (isset($data['errors']))
{
    echo "<p>";
    foreach ($data['errors'] as $error)
    {
      echo $error."<br />";
    }
    echo "</p>";
}
