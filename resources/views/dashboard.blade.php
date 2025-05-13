

<h1>Welcome {{Auth::user()->name}} to the private</h1>
<form method="POST" action="{{ route('logout')}}">
    @csrf
    <button type="submit">Logout</button>
</form>
