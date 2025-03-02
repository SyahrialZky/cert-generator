@extends('auth.app')

@section('title', 'Login')

@section('content')
    <div class="bg-white rounded-lg shadow-lg flex flex-col md:flex-row max-w-4xl w-full">
        <div class="hidden md:flex md:w-1/2 bg-orange-500 rounded-l-lg p-8 items-center justify-center relative">
            <img alt="Two women, one holding a megaphone, standing in front of an orange background with building silhouettes"
                 class="absolute inset-0 w-full h-full object-cover rounded-l-lg"
                 height="800" src="{{ asset('images/auth.webp') }}" width="600"/>
        </div>

        <div class="w-full md:w-1/2 p-8">
            <div class="flex justify-center mb-6">
                <img alt="Company Logo" height="50" src="{{ asset('images/radnet-logo.webp') }}" width="100"/>
            </div>

            <h2 class="text-3xl font-bold mb-2 text-center md:text-left">Welcome Back</h2>
            <p class="text-gray-600 mb-6 text-center md:text-left">Welcome Back, please enter your details</p>

            <form action="" method="post">
                @csrf

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('fail'))
                    <div class="alert alert-danger text-red-500 font-bold mb-4">
                        {{ Session::get('fail') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-gray-700" for="email">Email</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                           id="email" placeholder="example@gmail.com" type="email" name="email"/>
                    <span class="text-red-500 font-bold">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="mb-4 relative">
                    <label class="block text-gray-700" for="password">Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                           id="password" placeholder="enter your password" type="password" name="password"/>
                    <i class="fas fa-eye absolute right-3 top-10 text-gray-500 cursor-pointer"></i>
                    <span class="text-red-500 font-bold">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input class="form-checkbox text-orange-500" type="checkbox"/>
                        <span class="ml-2 text-gray-700">Remember me</span>
                    </label>
                    <a class="text-orange-500" href="#">Forgot Password?</a>
                </div>

                <button class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition duration-200" type="submit">
                    Login
                </button>
            </form>

            <p class="text-center text-gray-500 mt-6">
                Dont have an account?
                <a class="text-orange-500" href="#">Sign Up</a>
            </p>
        </div>
    </div>
@endsection