$(document).ready(function() {
    hideshow('loading', 0);
    hideshow('error', 0);
    $('#submitForm').submit(function(e) {
        contact("submitForm","valid_submit.php");
		$('#img_preview').attr('src', '');
        e.preventDefault();
    });
	$('#contactForm').submit(function(e) {
        contact("contactForm","valid_contact.php");
        e.preventDefault();
    });
});

function contact(form_id, validation_page) {
    hideshow('loading', 1);
    error(0);
	var formData = new FormData($('form')[0]);
    $.ajax({
        type: "POST",
        url: "http://worldofalcohols.com/"+ validation_page,
        data: formData,
		processData: false,
		contentType: false,
        dataType: "json",
        success: function(msg) {
            if (parseInt(msg.status) == 1) { /*window.location=msg.txt;*/
				if(form_id=="submitForm") {
					$('#'+form_id).get(0).reset(); // reset form
					$('#submitForm').html('<div id="error" class="ink-alert basic error"></div>');
					$('#submit_heading').html('');
					success(1, msg.txt);
				}
				else
				{
					success(1, msg.txt);
					$('#'+form_id).get(0).reset(); // reset form
				}
            } else if (parseInt(msg.status) == 0) {
                error(1, msg.txt);
            }
            hideshow('loading', 0);
        }
    });
}

function hideshow(el, act) {
    if (act) $('#' + el).css('visibility', 'visible');
    else $('#' + el).css('visibility', 'hidden');
    if ($('#' + el).is(":hidden")) $('#' + el).fadeIn("slow");
}

function error(act, txt) {
    hideshow('error', act);
    if (txt) {
        $('#error').removeClass('success');
        $('#error').addClass('error');
        $('#error').html(txt);
    }
}

function success(act, txt) {
    hideshow('error', act);
    if (txt) {
        $('#error').removeClass('error');
        $('#error').addClass('success');
        $('#error').html(txt);
    }
}