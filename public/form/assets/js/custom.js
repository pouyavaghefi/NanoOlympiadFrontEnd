// next prev
var divs = $('.show-section section');
var now = 0; // currently shown div
divs.hide().first().show(); // hide all divs except first

function next() {
    divs.eq(now).hide();
    now = (now + 1 < divs.length) ? now + 1 : 0;
    divs.eq(now).show(); // show next
    console.log(now);
}

$(".prevStep").on('click', function() {
    divs.eq(now).hide();
    now = (now > 0) ? now - 1 : divs.length - 1;
    divs.eq(now).show(); // show previous
    console.log(now);
});

function activeEmployee() {
    var activesrc = $('.carousel-item.active').find('img').attr('src');
    $('.step-img').attr('src', activesrc);
}

// calling active product
$('#trim-slider').on('slid.bs.carousel', activeEmployee);

$('.numberSingle input').on('click', function() {
    $(this).parent().removeClass('checked');
    $(this).parent().prevAll().removeClass('checked');
    $(this).parent().nextAll().removeClass('checked');
    $(this).parent().addClass('checked');
    $(this).parent().prevAll().addClass('checked');
});

// form validation
function formvalidate(stepnumber) {
    var inputvalue = $("#step" + stepnumber + " :input").not("button").map(function() {
        if (this.value.length > 0) {
            $(this).removeClass('invalid');
            return true;
        } else {
            if ($(this).prop('required')) {
                $(this).addClass('invalid');
                return false;
            } else {
                return true;
            }
        }
    }).get();

    return inputvalue.every(Boolean);
}

// Next buttons
$('.viewMore').on('click', function() {
    next();
});

$('#step1btn').on('click', function() {
    var inputschecked = formvalidate(1);

    if (inputschecked == false) {
        $('#error').append('<div class="reveal alert alert-danger">Choose an option!</div>');
        setTimeout(function() {
            $('#error .reveal').remove();
        }, 3000);
        $('html, body').scrollTop(0);
    } else {
        next();
    }
});

$('#step2btn').on('click', function() {
    var inputschecked = formvalidate(2);

    if (inputschecked == false) {
        $('#error').append('<div class="reveal alert alert-danger">Choose an option!</div>');
        setTimeout(function() {
            $('#error .reveal').remove();
        }, 3000);
        $('html, body').scrollTop(0);
    } else {
        next();
    }
});

// Submit button handler with AJAX to Laravel route
$('#sub').on('click', function(e) {
    e.preventDefault();

    var inputschecked = formvalidate(3);

    if (inputschecked == false) {
        $('#error').append('<div class="reveal alert alert-danger">Choose an option!</div>');
        setTimeout(function() {
            $('#error .reveal').remove();
        }, 3000);
        $('html, body').scrollTop(0);
        return;
    }

    var formData = new FormData(document.getElementById('Stepform'));

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: surveySubmitUrl,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data, status) {
            $('#sub').html("Sent!");
            window.location = 'thankyou.html';
        },
        error: function(xhr) {
            $('#sub').html("Error!");
            $('#error').html(''); // clear previous errors

            let res = xhr.responseJSON;

            if (res && res.errors) {
                // Laravel validation errors
                let messages = Object.values(res.errors).flat();
                let html = '<div class="reveal alert alert-danger">';
                messages.forEach(msg => {
                    html += `<div>${msg}</div>`;
                });
                html += '</div>';
                $('#error').html(html);
                $('html, body').scrollTop(0);
            } else if (res && res.message) {
                // Laravel exceptions (e.g., SQL, runtime errors)
                let html = `
            <div class="reveal alert alert-danger">
                <strong>Server Error:</strong>
                <div>${res.message}</div>
            </div>
        `;
                $('#error').html(html);
                $('html, body').scrollTop(0);
            } else {
                // Generic fallback
                $('#error').html('<div class="reveal alert alert-danger">An unknown error occurred.</div>');
            }

            console.error('AJAX error:', xhr.responseText);
        }
    });
});