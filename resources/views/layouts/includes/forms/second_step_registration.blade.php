<form action="{{ route('cla.register.finish') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="user_id" value="{{ $associatedUser->id }}">

    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" placeholder="First Name" name="first_name"
               value="{{ old('first_name', $associatedUser->fname ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" placeholder="Last Name" name="last_name"
               value="{{ old('last_name', $associatedUser->lname ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Passport Number</label>
        <input type="text" class="form-control" placeholder="Passport Number" name="passport_number"
               value="{{ old('passport_number') }}" required>
    </div>

    <div class="form-group">
        <label>Select Country</label>
        @include('layouts.includes.inputs.select-country')
    </div>

    <!-- Country Info Display -->
    <div id="country-info-container" class="country-info mt-3" style="display: none;">
        <img id="country-flag" src="" alt="Country Flag">
        <p id="welcome-message"></p>
    </div>

    <div class="form-group">
        <label>Agent Name</label>
        <input type="text" class="form-control" placeholder="Agent Name" name="agent_name"
               value="{{ old('agent_name') }}">
    </div>

    <div class="form-group">
        <label>Agent Code</label>
        <input type="text" class="form-control" placeholder="Agent Code" name="agent_code"
               value="{{ old('agent_code') }}">
    </div>

    <div class="form-group">
        <label>Upload Photo</label>
        <input type="file" class="form-control" name="photo" id="photo-input" accept="image/*" required>
        <div id="photo-preview-container" style="display: none; margin-top: 10px;">
            <img id="photo-preview" src="" alt="Selected Photo" style="max-width: 200px; border-radius: 8px; border: 2px solid #ddd; padding: 5px;">
            <button type="button" id="remove-photo" class="btn btn-danger btn-sm mt-2">Change Photo</button>
        </div>
    </div>

    <div class="form-group">
        <label>Upload Passport Photo</label>
        <input type="file" class="form-control" name="passport_photo" id="passport-photo-input" accept="image/*" required>
        <div id="passport-photo-preview-container" style="display: none; margin-top: 10px;">
            <img id="passport-photo-preview" src="" alt="Selected Passport Photo" style="max-width: 200px; border-radius: 8px; border: 2px solid #ddd; padding: 5px;">
            <button type="button" id="remove-passport-photo" class="btn btn-danger btn-sm mt-2">Change Passport Photo</button>
        </div>
    </div>

    <div class="d-flex align-items-center">
        <button type="submit" class="theme-btn">
            @if(Session::has('emailVerified'))
                <i class="fas fa-user-check"></i>
            @else
                <i class="fas fa-check-circle"></i>
            @endif
            @if(Session::has('emailVerified'))
                Finish Setting Up
            @else
                Join Now
            @endif
        </button>
    </div>
</form>