<?php
include_once('includes/myFunctions.php');
session_start();
if(isset($_SESSION['name']) && isset($_SESSION['mobile']))
{
    echo location('main_page/dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apna Store Register Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body {
            background-image: linear-gradient(#805db8, #bc99c4, #d19bbf, #de1d98);
            height: 100vh;
        }
        #login .container #login-row #login-column .login-box {
            margin-top: 120px;
            max-width: 600px;
            height: auto;
            border: 1px solid #9C9C9C;
            background-image: linear-gradient(to bottom, #aec1c3, #a9b5b7, #bcc5c6, #cfd5d5, #e3e5e5);
        }
        #login .container #login-row #login-column .login-box #login-form {
            padding: 20px;
        }
        #login .container #login-row #login-column .login-box #login-form #register-link {
            margin-top: -85px;
        }
    </style>
</head>
<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="login-box col-md-12">
                    <form id="login-form" class="form" action="includes/log_reg_process.php" method="post">
                        <h3 class="text-center text-info">Register</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Name:</label><br>
                            <input type="text" name="name" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="text-info">Mobile:</label><br>
                            <input type="text" name="mobile" id="mobile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="text" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="role1" class="text-info">Admin:
                            <input type="radio" checked name="role" id="role1" value="admin" class="form-control">
                            </label>
                            <label for="role2" class="text-info">Operator:
                            <input type="radio" name="role" id="role2" value="operator" class="form-control">
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" class="btn btn-info btn-md" value="register">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>