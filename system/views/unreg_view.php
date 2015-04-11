<?php
if (isset($data['login_error']))
{
  echo "<p class='error'>Неверный пароль!</p>";
}
?>
      <h2 class="form-signin-heading"></h2>
      <form class="form-signin" action="login" method="POST">
          <select class="form-control" autofocus name="fio">
            
          </select>
          <input type="password" class="form-control" placeholder="Пароль" name="password">
          <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
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
?>