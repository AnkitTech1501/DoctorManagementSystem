<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="name" required placeholder="Name">
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <input type="password" name="password_confirmation" required placeholder="Confirm Password">
        <select name="role">
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
        </select>
        <button type="submit">Register</button>
    </form>

</div>