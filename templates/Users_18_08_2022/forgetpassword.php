<div class="container" style="background-color:white;">
    <div class="forms-container">        
        <img  src="<?php echo $this->Url->build('/img/tnphc_logo.png', ['fullBase' => true]); ?>" alt="Logo" style="float: right;margin: 1.1rem;">
	  <div class="signin-signup" >
             
              <?php echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data']); ?>
               
             <div class="input-field" >
                <i class="fas fa-user"></i>
			   <?php echo $this->Form->control('email',['type'=>'text','class'=>'fadeIn second','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Email','required']);?>
            </div>
			 <div>
			<input id="send-btn" type="submit" class="fadeIn fourth" value="Send OTP" style="margin: 20px;">
			</div>
			<div class="input-field otp_check">  
                <i class="fas fa-user"></i>
                <?php echo $this->Form->control('otp_check',['class'=>'fadeIn second','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'maxlength'=>6,'placeholder'=>'Enter OTP','required']);?>
            </div>  
						<div><?php echo $this->Html->link('<span class=""><i class="fa fa-sign-in"></i>&nbsp;Back to Login</span>', array('controller' => 'Users', 'action' => 'login'), array('escape' => false, 'class' => 'nav-link')); ?>
				</div>
            <?php //echo $this->Form->control('otp_check',['class'=>'fadeIn second','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'maxlength'=>6,'placeholder'=>'Enter OTP','required']);?>
                <input id="check-btn" type="submit" class="fadeIn fourth" value="Submit" style="margin: 20px;">
                <?php echo $this->Form->End();?>

                <!-- Back to login -->
                
          
        </div>
    </div>

    <div class="panels-container">
        <div class="left-panel">           
            <img src="<?php echo $this->Url->build('/img/tnphcbuilding.jpg', ['fullBase' => true]); ?>" width="700" height="600"   alt="" />
         
        </div>       
    </div>
</div>

<script>
$(document).ready(function() {
  
    $("#email").show();
    $("#send-btn").show();
    $("#otp-check").hide();
    $("#check-btn").hide();
    $(".otp_check").hide();

    // $("#send-btn").click(function() {
    //     // if (data == "Error") {
    //     Swal.fire({
    //         title: "OTP Sent!",
    //         text: "Please check your email!",
    //         icon: "Success",
    //         button: "ok",
    //     });
    //     $("#header-label").hide();
    //     $("#email").hide();
    //     $("#send-btn").hide();
    //     $("#otp-check").show();
    //     $("#check-btn").show();
    //     // } else {
    //     //     Swal.fire({
    //     //         title: "OTP Sent!",
    //     //         text: "Please check your email!",
    //     //         icon: "success",
    //     //         button: "ok",
    //     //     });
    //     //     $("#today_meet_card").hide();
    //     // }
    // });
});

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
        submitHandler: function(form) {
            // Swal.fire({
                // title: "OTP Sent!",
                // text: "Please check your email!",
                // icon: "Success",
                // button: "ok",
            // });
			alert('OTP Sent!,Please check your email!'); 
            //$("#header-label").hide();
            $("#email").prop('readonly',true);
            $("#send-btn").hide();
            $("#otp-check").show();
            $("#check-btn").show();
			 $(".otp_check").show();

            form.submit();
            $(".btn").prop('disabled', true);
        }
    });
});
</script>