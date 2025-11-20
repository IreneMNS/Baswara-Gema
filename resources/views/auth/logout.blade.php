<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Logout - Admin</title>

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
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
                                    <h3 class="text-center font-weight-light my-4">Logout</h3>
                                </div>

                                <div class="card-body text-center">
                                    <p class="mb-4">
                                        Kamu yakin ingin keluar dari dashboard?
                                    </p>

                                    <a href="{{ route('login') }}" class="btn btn-danger w-100">
                                        Yes, Logout
                                    </a>
                                </div>

                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        <a href="{{ route('dashboard') }}">Cancel, go back to Dashboard</a>
                                    </div>
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
