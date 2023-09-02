<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <!-- Add Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin/login.css') }}">
</head>

<body>

    <div class="container mt-5">
        <div class="card mt-5">
            <div class="user-profile">
                <img src="{{ asset('assets/global-img/user.png') }}" alt="User Profile" />
            </div>
            <div class="user-title text-center">Admin Login</div>
            <form action="{{ route('admin.create-login') }}" method="POST">
                @csrf
                <div class="mb-3"> <!-- Center-align the label -->
                    <label for="email" class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" placeholder="Enter email" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @enderror
                </div>
                <div class="mb-3"> <!-- Center-align the label -->
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Enter password">
                    </div>
                    @error('password')
                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-outline-success btn-block">Login</button>
            </form>
            <div class="mt-3 text-center">
                <a href="{{ route('user.register') }}"> Forget password? </a>.
            </div>
        </div>
    </div>

    <!-- Add Bootstrap and Popper.js scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
