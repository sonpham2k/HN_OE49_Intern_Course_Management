@extends('Login.layout')

@include('Login.head')
<div class="container padding-bottom-3x mb-2 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="forgot">
                <h2>Forgot your password?</h2>
            </div>
            <form class="card mt-4">
                <div class="card-body">
                    <div class="form-group"> <label for="email-for-pass">Enter your email address</label> <input class="form-control" type="text" id="email-for-pass" required=""> </div>
                </div>
                <div class="card-footer"> <button class="btn btn-success" type="submit">Get New Password</button> <a class="btn btn-danger" href="{{ route('login') }}">Back to Login</a> </div>
            </form>
        </div>
    </div>
</div>