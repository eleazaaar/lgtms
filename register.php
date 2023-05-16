<?php    
    session_start();
    include './app/classes/Page.class.php';
    
    // Check weather the user is already login
    if(isset($_SESSION['user_token'])){
        Page::route('/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=<?php echo Page::asset("/public/plugins/fontawesome-free/css/all.min.css");?>>        
    <!-- Theme style -->
    <link rel="stylesheet" href=<?php echo Page::asset("/public/dist/css/adminlte.min.css");?>>
    <link href="public/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="login-page" style="min-height: 496.781px;">
    <section id="hero" class="hero d-flex align-items-center ">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="login-box">
                        <div class="login-logo">
                            <a href="index.php"><b>Pro</b>Tech</a>
                            </div>
                            <!-- /.login-logo -->
                            <div class="card"  >
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg">Register a new Account</p>

                                    <form action="./app/includes/auth/register.inc.php" method="POST">

                                        <div class="input-group mb-3">
                                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" name="confirm_password" class="form-control"
                                                placeholder="Confirm Password">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-6 hero-img d-flex justify-content-between">
                    <img src="public/assets/img/undraw_Visionary_technology.svg" class="img-fluid" alt="">
                </div>
        </div>
    </section>
    <script src=<?php echo Page::asset('/public/plugins/jquery/jquery.min.js')?>></script>
    <script src=<?php echo Page::asset('/public/plugins/bootstrap/js/bootstrap.bundle.min.js')?>></script>
    <script src=<?php echo Page::asset('/public/dist/js/adminlte.js')?>></script>
</body>

</html>