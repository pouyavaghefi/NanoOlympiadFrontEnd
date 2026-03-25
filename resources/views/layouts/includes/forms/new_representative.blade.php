<div id="repForm" class="mt-3">
    @if(\Session::has('newRepAdded'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            You're request has been sent, we'll inform you later. Keep in touch at: <strong>{{ \Session::get('newRepAdded') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        @if(!\Auth::check())
            <form method="POST" action="{{ route('frt.new.rep') }}" enctype="multipart/form-data" style="margin-bottom:70px">
                @csrf

                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="firstname" value="{{ old('first_name') }}" placeholder="Enter first name" required>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="lastname" value="{{ old('last_name') }}" placeholder="Enter last name" required>
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="passportNumber" class="form-label">Passport Number</label>
                    <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" id="passportNumber" value="{{ old('passport_number') }}" placeholder="Enter passport number" required>
                    @error('passport_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="passportImage" class="form-label">Passport Image</label>
                    <input type="file" name="passportImage" class="form-control @error('passportImage') is-invalid @enderror" id="passportImage" accept="image/*" required onchange="previewPassportImage(event)">
                    @error('passportImage')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Enter email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small id="email-feedback" class="text-muted"></small>
                </div>

                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#email').on('blur', function () {
                            const email = $(this).val();
                            const feedback = $('#email-feedback');

                            feedback.text('');

                            if (email) {
                                $.ajax({
                                    url: "{{ route('api.email.check') }}",
                                    method: "GET",
                                    data: { email: email },
                                    success: function (response) {
                                        if (response.exists) {
                                            feedback.text('Email already exists.').addClass('text-danger').removeClass('text-muted');
                                        } else {
                                            feedback.text('Email is available.').addClass('text-success').removeClass('text-muted');
                                        }
                                    },
                                    error: function () {
                                        feedback.text('Unable to check email at this moment.').addClass('text-danger').removeClass('text-muted');
                                    }
                                });
                            } else {
                                feedback.text('Please enter a valid email.').addClass('text-danger').removeClass('text-muted');
                            }
                        });
                    });
                </script>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    @include('layouts.includes.inputs.select-country')

                    @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Country Info Display -->
                <div id="country-info-container" class="country-info mt-3" style="display: none;">
                    <img id="country-flag" src="" alt="Country Flag">
                    <p id="welcome-message"></p><br>
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <div class="input-group">
                        <span class="input-group-text" id="country-code">+__</span>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                               id="mobile" value="{{ old('mobile') }}" placeholder="Enter mobile number" required>
                    </div>
                    @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const countrySelect = document.getElementById('country');
                        const codeSpan = document.getElementById('country-code');

                        function updateCode() {
                            const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                            const code = selectedOption.getAttribute('data-code');
                            codeSpan.textContent = code ? `+${code}` : '+__';
                        }

                        countrySelect.addEventListener('change', updateCode);

                        // Run once on page load to show code if old input exists
                        updateCode();
                    });
                </script>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password" required>
                    <div id="password-strength" class="form-text mt-1"></div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" required>
                    <div id="password-match" class="form-text mt-1"></div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const password = document.getElementById('password');
                        const confirmPassword = document.getElementById('password_confirmation');
                        const matchText = document.getElementById('password-match');
                        const strengthText = document.getElementById('password-strength');

                        const getStrength = (pwd) => {
                            let strength = 0;
                            if (pwd.length >= 8) strength++;
                            if (/[A-Z]/.test(pwd)) strength++;
                            if (/[0-9]/.test(pwd)) strength++;
                            if (/[\W_]/.test(pwd)) strength++;

                            switch (strength) {
                                case 0:
                                case 1:
                                    return { text: "Weak", color: "text-danger" };
                                case 2:
                                    return { text: "Moderate", color: "text-warning" };
                                case 3:
                                case 4:
                                    return { text: "Strong", color: "text-success" };
                            }
                        };

                        password.addEventListener('input', function () {
                            const { text, color } = getStrength(password.value);
                            strengthText.textContent = `Strength: ${text}`;
                            strengthText.className = `form-text mt-1 ${color}`;
                        });

                        confirmPassword.addEventListener('input', function () {
                            if (confirmPassword.value === password.value) {
                                matchText.textContent = "Passwords match";
                                matchText.className = "form-text mt-1 text-success";
                            } else {
                                matchText.textContent = "Passwords do not match";
                                matchText.className = "form-text mt-1 text-danger";
                            }
                        });
                    });
                </script>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" placeholder="Enter address" required>{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="Enter phone number" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="linkedIn" class="form-label">LinkedIn</label>
                    <input type="url" name="linkedIn" class="form-control @error('linkedIn') is-invalid @enderror" id="linkedIn" value="{{ old('linkedIn') }}" placeholder="Enter LinkedIn URL" required>
                    @error('linkedIn')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @include('layouts.includes.inputs.captcha-greg')

                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        @else
            <form method="POST" action="{{ route('frt.new.rep') }}" enctype="multipart/form-data" style="margin-bottom:50px">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Registered Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ auth()->user()->email }}" placeholder="Enter email" required disabled="disabled">
                </div>

                <div class="mb-3">
                    <label for="passportNumber" class="form-label">Passport Number</label>
                    <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" id="passportNumber" value="{{ old('passport_number') }}" placeholder="Enter passport number" required>
                    @error('passport_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="passportImage" class="form-label">Passport Image</label>
                    <input type="file" name="passportImage" class="form-control @error('passportImage') is-invalid @enderror" id="passportImage" accept="image/*" required onchange="previewPassportImage(event)">
                    @error('passportImage')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    @include('layouts.includes.inputs.select-country')

                    @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Country Info Display -->
                <div id="country-info-container" class="country-info mt-3" style="display: none;">
                    <img id="country-flag" src="" alt="Country Flag">
                    <p id="welcome-message"></p><br>
                </div>

                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <div class="input-group">
                        <span class="input-group-text" id="country-code">+__</span>
                        <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror"
                               id="mobile" value="{{ old('mobile') }}" placeholder="Enter mobile number" required>
                    </div>
                    @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const countrySelect = document.getElementById('country');
                        const codeSpan = document.getElementById('country-code');

                        function updateCode() {
                            const selectedOption = countrySelect.options[countrySelect.selectedIndex];
                            const code = selectedOption.getAttribute('data-code');
                            codeSpan.textContent = code ? `+${code}` : '+__';
                        }

                        countrySelect.addEventListener('change', updateCode);

                        // Run once on page load to show code if old input exists
                        updateCode();
                    });
                </script>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" placeholder="Enter address" required>{{ old('address') }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="Enter phone number" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="linkedIn" class="form-label">LinkedIn</label>
                    <input type="url" name="linkedIn" class="form-control @error('linkedIn') is-invalid @enderror" id="linkedIn" value="{{ old('linkedIn') }}" placeholder="Enter LinkedIn URL" required>
                    @error('linkedIn')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @include('layouts.includes.inputs.captcha-greg')

                <button type="submit" class="btn btn-success sbutton">Submit</button>
            </form>
        @endif
    @endif
</div>
