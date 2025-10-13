Hallo nama saya {{ Auth::user()->name }} <br>
Email saya adalah {{ Auth::user()->email }} <br>
Saya sudah terdaftar sejak {{ Auth::user()->created_at }} <br>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>