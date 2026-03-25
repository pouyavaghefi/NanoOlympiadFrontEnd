<!-- contact area -->
<div class="contact-area py-120">
    <div class="container">
        <div class="contact-content">
            @if($contacts)
            @foreach($contacts as $contactInfo)
            <div class="row">
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-map-location-dot"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Office Address</h5>
                            <p>{{ $contactInfo->office_address ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-phone-volume"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Call Us</h5>
                            <a href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $contactInfo->phone ?? '') }}" target="_blank" style="display: flex; align-items: center; gap: 8px;">
                                <img src="{{ asset('assets/img/socials/wa-png-Nazok.png') }}" alt="WhatsApp" style="height: 28px;">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-envelopes"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Email Us</h5>
                            <p>
                                <a href="mailto:{{ $contactInfo->email ?? '#' }}">
                                    {{ $contactInfo->email ?? 'Not provided' }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="contact-info">
                        <div class="contact-info-icon">
                            <i class="fal fa-alarm-clock"></i>
                        </div>
                        <div class="contact-info-content">
                            <h5>Open Time</h5>
                            <p>{{ $contactInfo->open_time ?? 'Not provided' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        @foreach($contacts as $contactInfo)
        @php
        $contactBoxImg = $contactInfo->box_image;
        $renderedBoxImg = env('URL_ADMIN') . "/contact/" . $contactBoxImg;
        @endphp
        <div class="contact-wrapper">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-img">
                        <img src="{{ !is_null($contactBoxImg) ? $renderedBoxImg : '/assets/img/contact/01.jpg' }}" alt="Contact Box Image">
                    </div>
                </div>
                <div class="col-lg-7 align-self-center">
                    <div class="contact-form">
                        <div class="contact-form-header">
                            <h2>
                                @if(!Session::has('messageSent'))
                                    Get In Touch
                                @else
                                    {{ Session::get('messageSent') }}
                                @endif
                            </h2>
                        </div>

                        @if($contactInfo->show_contact_form == 1)
                        @if(!Session::has('messageSent'))
                        <form id="contact-form" action="/submit/contact" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" placeholder="Your Subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <textarea name="message" cols="30" rows="5" class="form-control @error('message') is-invalid @enderror" placeholder="Write Your Message">{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Upload Field -->
                            <div class="form-group">
                                <label for="attachment">Upload File:</label>
                                <input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment">
                                @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>

                            <button type="submit" class="theme-btn">Send Message <i class="far fa-paper-plane"></i></button>

                            <div class="col-md-12 mt-3">
                                @if (session('messageNotSent'))
                                <div class="form-messege text-danger">{{ session('messageNotSent') }}</div>
                                @endif
                                @if ($errors->has('g-recaptcha-response'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('g-recaptcha-response') }}
                                </div>
                                @endif
                            </div>
                        </form>
                        @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- end contact area -->