<form action="{{ route('cla.register.do') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Full Name</label>
        <input type="text" class="form-control" placeholder="Your Name" name="name" required>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <input
                type="email"
                class="form-control"
                placeholder="Your Email"
                name="email"
                id="email"
                required>
        <small id="email-feedback" class="text-muted"></small>
    </div>

    <div class="form-group">
        <label>Telegram Mobile Number</label>
        <input type="tel" class="form-control" placeholder="Telegram Mobile (e.g. +989123456789)" name="telegram_mobile" required>
        <small class="form-text text-info mt-1">
            Ensure this number is connected to your Telegram account.
        </small>
    </div>

    <div class="form-group">
        <label>Mobile Number</label>
        <input type="tel" class="form-control" placeholder="Mobile Number (e.g. +989123456789)" name="mobile" required>
    </div>

    @include('layouts.includes.inputs.select-country')

    <div id="country-preview" style="display:none;" class="country-info mt-3">
        <img id="country-flag" src="" alt="Flag">
        <div>
            <div id="country-welcome"></div>
            <div id="country-code-preview" class="text-muted small"></div>
        </div>
    </div>

    <style>
        #country-flag {
            width: 80px;      /* wider width */
            height: 50px;     /* taller height */
            border-radius: 6px; /* optional rounded corners */
            box-shadow: 0 2px 5px rgba(0,0,0,0.15); /* subtle shadow for depth */
            object-fit: cover;  /* ensures the flag fills the box nicely */
        }
    </style>


    <div class="form-group">
        <label>Gender</label>
        <select name="gender" class="form-control" required>
            <option value="">Select your gender</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
        </select>
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

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" placeholder="Your Password" name="password" id="password" required>
        <div class="progress mt-2" style="height: 5px;">
            <div id="password-strength" class="progress-bar" role="progressbar" style="width: 0%;"></div>
        </div>
        <small id="password-strength-text" class="text-muted"></small>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm Your Password" name="password_confirmation" id="password_confirmation" required>
        <small id="password-mismatch-feedback" class="text-muted"></small>
    </div>

    <div class="form-group">
        {!! NoCaptcha::renderJs() !!}
        {!! NoCaptcha::display() !!}
    </div>

    <script>
        $(document).ready(function () {
            const passwordField = $('#password');
            const confirmPasswordField = $('#password_confirmation');
            const passwordStrengthBar = $('#password-strength');
            const passwordStrengthText = $('#password-strength-text');
            const mismatchFeedback = $('#password-mismatch-feedback');

            confirmPasswordField.on('input', function () {
                const password = passwordField.val();
                const confirmPassword = confirmPasswordField.val();

                mismatchFeedback.text('');
                mismatchFeedback.removeClass('text-danger text-success');

                if (password !== confirmPassword) {
                    mismatchFeedback.text('Passwords do not match.').addClass('text-danger');
                } else {
                    mismatchFeedback.text('Passwords match.').addClass('text-success');
                }
            });

            passwordField.on('input', function () {
                const password = passwordField.val();
                let strength = 0;

                if (password.length >= 6) strength += 1;
                if (password.length >= 8) strength += 1;
                if (/[A-Z]/.test(password)) strength += 1;
                if (/[0-9]/.test(password)) strength += 1;
                if (/[^A-Za-z0-9]/.test(password)) strength += 1;

                const strengthPercent = (strength / 5) * 100;
                passwordStrengthBar.css('width', strengthPercent + '%');

                if (strengthPercent === 0) {
                    passwordStrengthText.text('Weak').removeClass('text-muted text-success text-danger').addClass('text-danger');
                } else if (strengthPercent <= 60) {
                    passwordStrengthText.text('Moderate').removeClass('text-muted text-success text-danger').addClass('text-warning');
                } else {
                    passwordStrengthText.text('Strong').removeClass('text-muted text-warning text-danger').addClass('text-success');
                }
            });
        });
    </script>

    <div class="form-check form-group">
        <input class="form-check-input" type="checkbox" value="1" id="agree" name="agree" required>
        <label class="form-check-label" for="agree">
            I agree with the <a href="#" id="terms-link">Terms Of Service</a>.
        </label>
    </div>

    <script>
        document.getElementById('terms-link').addEventListener('click', function(event) {
            event.preventDefault();

            const termsContent = `
           <h3>Nano International Olympiad</h3>
        <p>By using this e-learning platform, you agree to the following terms and conditions. Please read them carefully before proceeding.</p>

        <h4>1. User Registration and Identity</h4>
        <p>Users are required to provide accurate and truthful information when creating an account. You agree to keep your information up-to-date and understand that providing false or misleading details may result in the suspension or termination of your account.</p>

        <h4>2. Privacy and Data Use</h4>
        <p>All personal information provided, including identity documents, is stored securely and used only for verification and service provision purposes.</p>

        <h4>3. Access to Courses</h4>
        <p>Upon registration, you may access free or paid courses depending on your account type. You agree not to share course materials or access credentials with others. Unauthorized sharing or distribution is strictly prohibited and may lead to account suspension or legal action.</p>

        <h4>4. User Dashboard</h4>
        <p>Your personal dashboard gives you access to your enrolled courses, progress tracking, and account settings. You are solely responsible for maintaining the confidentiality of your account and dashboard access.</p>

        <h4>5. Payment and Refunds</h4>
        <p>For paid courses, all payments are final unless otherwise specified in our refund policy. Please review course content and prerequisites before purchase.</p>

        <h4>6. Code of Conduct</h4>
        <p>Users must behave respectfully and professionally when participating in discussions, submitting assignments, or interacting with instructors or peers. Harassment or abuse of any kind will not be tolerated.</p>

        <h4>7. Modifications</h4>
        <p>We reserve the right to modify or update these terms at any time. Continued use of the platform after such changes constitutes your acceptance of the revised terms.</p>

        <h4>8. Contact</h4>
        <p>If you have questions or concerns about these terms, please contact our support team at <a href="mailto:info@nanolympiad.org">info@nanolympiad.org</a>.</p>
        `;

            Swal.fire({
                title: 'Terms of Service',
                html: termsContent,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'I Agree',
                cancelButtonText: 'Cancel',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('agree').checked = true;
                }
            });
        });
    </script>

    <div class="d-flex align-items-center">
        <button type="submit" class="theme-btn"><i class="far fa-paper-plane"></i> Register</button>
    </div>
</form>

<script>
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('password-strength-text');

    passwordInput.addEventListener('input', () => {
        const password = passwordInput.value;
        let strength = 0;

        if (password.length >= 8) strength += 1;
        if (/[A-Z]/.test(password)) strength += 1;
        if (/[a-z]/.test(password)) strength += 1;
        if (/[0-9]/.test(password)) strength += 1;
        if (/[\W]/.test(password)) strength += 1;

        const strengthPercent = (strength / 5) * 100;
        strengthBar.style.width = `${strengthPercent}%`;

        if (strengthPercent <= 40) {
            strengthBar.className = "progress-bar bg-danger";
            strengthText.innerText = "Weak";
        } else if (strengthPercent <= 70) {
            strengthBar.className = "progress-bar bg-warning";
            strengthText.innerText = "Medium";
        } else {
            strengthBar.className = "progress-bar bg-success";
            strengthText.innerText = "Strong";
        }
    });
</script>