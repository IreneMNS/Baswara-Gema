<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Admin</title>

    <link href="<?php echo e(asset('css/styles.css')); ?>" rel="stylesheet" />
</head>
<body class="bg-primary">

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="<?php echo e(route('login.process')); ?>">
                                        <?php echo csrf_field(); ?>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" type="email" required />
                                            <label>Email Address</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" type="password" required />
                                            <label>Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="<?php echo e(route('password')); ?>">Forgot Password?</a>
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small">No Register Page</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
<?php /**PATH C:\laragon\www\admusik\resources\views/auth/login.blade.php ENDPATH**/ ?>