<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div>
        <label for="email">Adresse Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div>
        <label for="password">Nouveau Mot de Passe</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password-confirm">Confirmer le Mot de Passe</label>
        <input id="password-confirm" type="password" name="password_confirmation" required>
    </div>

    <div>
        <button type="submit">Réinitialiser le Mot de Passe</button>
    </div>
</form>
