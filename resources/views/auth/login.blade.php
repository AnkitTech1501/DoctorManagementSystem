<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>

</div>