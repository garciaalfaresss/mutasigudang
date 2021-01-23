<?php 
require 'function.php';

//Menambah akun baru
if(isset($_POST['register'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $addregist = mysqli_query($conn,"insert into loginn (email, password) values ('$email', '$password')");
    if($addregist){
        header('location:login.php');
    } else {
        echo 'Gagal';
        header('location:register.php');
    }
};

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@garcia.alfares - Register</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Register</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="example@google.com" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                            </div>
                                                <div>                                            
                                                    <footer class="py-4 bg-light mt-auto">
                                                        <div class="container-fluid">
                                                        <div class="d-flex align-items-center justify-content-between small">
                                                            <div>
                                                            <a href="login.php">Sudah punya akun? Masuk disini</a>
                                                            </div>
                                                        <button type="submit" class="btn btn-primary" name="register">Daftar</button>
                                                        </div>
                                                        </div>
                                                    </footer>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>