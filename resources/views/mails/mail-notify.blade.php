<div>
    <h2>{{ $data['type'] }}</h2>
    <p>Name: <b>{{ $data['name'] }}</b></p>
    <p>Code: <b>{{ $data['password'] }}</b></p>
    <p>{{ $data['content'] }}:</p>
    <a href="{{ route('view.reset.forgot.password') }}">Reset password</a>
</div>