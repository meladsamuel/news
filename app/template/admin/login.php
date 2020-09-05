<?php

use app\models\Users;

if (isset($_POST['signIn'])) {
    $user = Users::getByPK($_POST['username']);
    if ($user && ($user->password === $_POST['password']))
        $session->admin = $user;
    else
        $error = "<div class='alert alert-danger'>username or password incorrect</div>";
}
?>
<form class="form-signin" method="post">
    <?php echo isset($error) ? $error : '' ?>
    <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
    <label for="username" class="sr-only">Username</label>
    <input name="username" type="text" id="username" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="signIn">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2010-<?php echo date('Y') ?></p>
</form>