<section>
    <div class="container">
        <div class="step-inner">
            <div class="row">
                <div class="col-md-5 tab-none">
                    <img class="step-img" src="/form/assets/images/avatar1.png" alt="step-image">
                </div>
                <div class="col-md-7 tab-100">
                    <fieldset id="step1">
                        <div class="inputField">
                            <label class="inputLabel">Upload Personal Photo</label>
                            <input type="file" class="textInput" name="personal_photo" accept="image/*" required>
                            <label class="inputLabel text-muted small">(Max size: 2MB, formats: JPEG, PNG, JPG)</label>
                        </div>

                        <div class="inputField">
                            <label class="inputLabel">Upload Identification Document Passport</label>
                            <label class="inputLabel">(Passport or National ID Card of Your Country)</label>
                            <input type="file" class="textInput" name="identification_document" accept=".jpg,.jpeg,.png,.pdf">
                            <label class="inputLabel text-muted small">(Max size: 2MB, formats: JPEG, PNG, JPG, PDF)</label>
                        </div>

                        <!-- break -->
                        <div class="bottomLine"></div>

                        <div class="nextPrev">
                            <button type="button" class="nextStep" id="step1btn"><span>next step</span></button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</section>