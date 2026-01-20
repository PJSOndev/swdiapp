<form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="text" name="otp_code" placeholder="Enter OTP" required>
    <button type="submit">Verify OTP</button>
</form>
