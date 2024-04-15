@extends('auth.layout.app')

@section('title', 'Student Login')

@section('main_content')

<body>
    <div id="container" class="container">
        <div class="row">

            <div class="col align-items-center flex-col sign-up">
                <div class="form-wrapper align-items-center">
                </div>
            </div>

            <div class="col align-items-center flex-col sign-in">
                <div class="form-wrapper align-items-center">
                    <div class="form sign-in">
                        <form action="{{ route('student_login_submit') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <i class='bx bxs-user'></i>
                                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                    autofocus>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if (session()->get('error'))
                                <div class="text-danger">{{ session()->get('error') }}</div>
                                @endif
                            </div>
                            <div class="input-group">
                                <i class='bx bxs-lock-alt'></i>
                                <input type="password" name="password" placeholder="Password">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button>
                                Sign in
                            </button>
                            <p><a href="{{ route('admin_login') }}">Admin Login</a></p>
                            <p><a href="">Marketing Manager Login</a></p>
                            <p><a href="{{ route('coordinator_login') }}">Marketing Coordinator Login</a></p>
                        </form>
                    </div>

                </div>
            </div>

        </div>
        <div class="row content-row">
            <div class="col align-items-center flex-col">
                <div class="text sign-in">
                    <h2>
                        Student Login
                    </h2>
                    <p>
                        Visit the school's website to come up with unique and
                        creative ideas to create a better future!
                    </p>
                </div>
            </div>
            <div class="col align-items-center flex-col">

            </div>
        </div>
    </div>
</body>

@endsection