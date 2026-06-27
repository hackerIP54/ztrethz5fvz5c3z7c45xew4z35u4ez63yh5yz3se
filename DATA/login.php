<?php
session_start();

if($_POST){
    if($_POST["user"]==="fritz2992" && $_POST["pass"]==="admin"){
        $_SESSION["auth"]=true;
        header("Location: dashboard.html");
        exit;
    }
}
?>

<form method="POST">
<h2>Login</h2>
<input name="user">
<input name="pass" type="password">
<button>Login</button>
</form>
