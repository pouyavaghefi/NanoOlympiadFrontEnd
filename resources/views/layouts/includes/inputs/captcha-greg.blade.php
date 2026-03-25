<div class="mb-3">
    <label for="captcha" class="form-label">Captcha</label>
    <div class="captcha-image">
        <img id="captcha-image" src="{{ url('captcha') }}" alt="Captcha Image">
    </div>
    <button type="button" class="btn btn-link" id="refresh-captcha">Refresh CAPTCHA</button>
    <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" id="captcha" placeholder="Enter CAPTCHA" required>
    @error('captcha')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<br>

<script>
    document.getElementById('refresh-captcha').addEventListener('click', function() {
        // Reload the CAPTCHA image by changing the src attribute
        var captchaImage = document.getElementById('captcha-image');
        captchaImage.src = "{{ url('captcha') }}?" + new Date().getTime(); // Adding a timestamp to avoid cache

        // Clear the current captcha input field
        document.getElementById('captcha').value = '';
    });
</script>
