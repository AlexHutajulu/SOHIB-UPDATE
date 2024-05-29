
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Banjarbaru Juara</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="image/Banjarbaru.png" class="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <div class="row mb-4 px-3">
                        <P style ="color:darkgreen;"><H2><B>SOHIB BANJARBARU<B></H2></P>
                        </div>
                        <div class="row mb-4 px-3">      
                        </div>
                        <div class="row px-3 mb-4">
                           
                        </div>
                        <form action="{{ route('postlogin')}}" method="POST">
                            @csrf
                            @if (Session('error'))
                            <div class="alert alert-danger">
                                {{Session('error')}}
                            </div>
                            @endif
                            <div class="row px-3">
                                <label class="mb-1"><h6 class="mb-0 text-sm">Email</h6></label>
                                <input class="mb-4" type="email" name="email" placeholder="Masukkan Email Anda">
                            </div>
                            <div class="row px-3">
                                <label class="mb-1"><h6 class="mb-0 text-sm">Password</h6></label>
                                <input type="password" name="password" placeholder="Masukkan Password Anda">
                            </div>
                            <div class="row px-3 mb-4">
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn-submit">Login</button>
                            </div>              
                        </form>
                        <div class="row mb-4 px-3">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3">
                    <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2023. Diskominfo.</small>
                    <div class="social-contact ml-4 ml-sm-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </body>
    </html>