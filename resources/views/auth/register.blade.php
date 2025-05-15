<form method="POST" action="{{route('register.store')}}">
    @csrf
    <input type="text" name="name" placeholder="name"/>
    <input type="email" name="email" placeholder="Email" />
    <input type="password" name="password" placeholder="Password" />
    <button type="submit">Submit</button>
    <div class="mt-4 text-center text-sm text-gray-600">
         Have an account?
        <a href="{{ route('login') }}">Login</a>
    </div>
</form>
