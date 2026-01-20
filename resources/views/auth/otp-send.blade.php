<form method="POST" action="{{ route('otp.send') }}">
    @csrf
    <input type="email" name="email" placeholder="Enter your email" required>
    <button type="submit">Send OTP</button>
</form>
