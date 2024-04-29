<style>
.parent {
    display: flex;
}

.item {
    width: 50%;
    padding: 2rem;
    color: #ffffff;
    background: #eeeeee;
    min-height: 710px;
}

a:hover {
    color: #141619 !important;
}

.text-gray-400 {
    color: #b5b5c3 !important;
}

.fw-bold {
    font-weight: 500 !important;
}

.fs-4 {
    font-size: 1rem !important;
}

input[type=submit] {
    padding: 15px 40px !important;
}

.checkpass {
    font-size: 13px;
    display: inline-block;
    padding: 5px;
}

.far {
    color: #000000;
}
</style>

<div class="parent">
    <!-- Icon -->
    <span class="login100-form-logo" style="padding-left: 5%;">
        <img src="<?php echo $this->Url->build('/', true)?>logo-msl.png" alt="User Icon" />
    </span>
    <div class="item"
        style="background: url(/msl_portal/img/reset-password.png) center center no-repeat; background-size: 400px;margin-left: -110px;opacity: 90%;">
    </div>

    <div class="item last">
        <div class="fadeInDown">
            <div id="formContent" style="margin-top: 15%">
                <br>
                <!-- Tabs Titles -->
                <h3 class="fadeIn active">Reset Password</h3>
                <br>
                <div class="text-gray-400 fw-bold fs-4">Enter your new password.</div>
                <br>
                <!-- <h2 class="inactive underlineHover">Sign Up </h2> -->
                <!-- Login Form -->
                <?php echo $this->Form->create('',['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data']); ?>
                <?php echo $this->Form->control('password',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'minlength'=>8,'maxlength'=>16,'placeholder'=>'New Password','onmouseover'=>'mouseoverPass();', 'onmouseout'=>'mouseoutPass();']);?>
                <?php echo $this->Form->control('confirm_password',['for'=>'password','class'=>'form-control','type'=>'password','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Confirm Password','onmouseover'=>'mouseoverPass2();', 'onmouseout'=>'mouseoutPass2();']);?>
                <span class="checkpass" id='message'></span><br>
                <input type="submit" class="fadeIn fourth" value="Submit" style="margin: 20px;">
                <?php echo $this->Form->End();?>
            </div>
        </div>
    </div>

</div>

<script>
$('#password').passtrength({
    minChars: 8,
    passwordToggle: false
});

$('#password, #confirm-password').on('keyup', function() {
    $("#message").show();
    if ($('#password').val() != '' && $('#confirm-password').val() != '') {
        if ($('#password').val() != $('#confirm-password').val()) {
            $('#message').html("<i class='fa fa-exclamation-circle'></i>&nbsp;Password not matching!").css(
                'color',
                '#ed5249');
        } else {
            $("#message").hide();
        }

    }
});

function mouseoverPass(obj) {
    var obj = document.getElementById('password');
    obj.type = "text";
}

function mouseoutPass(obj) {
    var obj = document.getElementById('password');
    obj.type = "password";
}

function mouseoverPass2(obj) {
    var obj = document.getElementById('confirm-password');
    obj.type = "text";
}

function mouseoutPass2(obj) {
    var obj = document.getElementById('confirm-password');
    obj.type = "password";
}

$(document).ready(function() {
    $("#message").hide();
});


function visibility3() {
    var x = document.getElementById('password');
    if (x.type === 'password') {
        x.type = "text";
        $('#eyeShow').show();
        $('#eyeSlash').hide();
    } else {
        x.type = "password";
        $('#eyeShow').hide();
        $('#eyeSlash').show();
    }
}

function visibility1() {
    var x = document.getElementById('confirm-password');
    if (x.type === 'password') {
        x.type = "text";
        $('#eyeShow').show();
        $('#eyeSlash').hide();
    } else {
        x.type = "password";
        $('#eyeShow').hide();
        $('#eyeSlash').show();
    }
}

$(function() {
    $("#FormID").validate({
        rules: {
            'email': {
                required: true
            }
        },
        messages: {
            email: {
                required: "Enter your Email"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
});
</script>