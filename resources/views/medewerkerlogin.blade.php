<!DOCTYPE html>
<html>
<head><title>Medewerker Login</title></head>
<body>
<h2>Medewerker Login</h2>
@if($errors->any())
  <p style="color:red;">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('medewerker.login') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required><br>
    <label>Wachtwoord:</label>
    <input type="password" name="wachtwoord" required><br>
    <button type="submit">Inloggen</button>
</form>

</body>
</html>
