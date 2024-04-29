<!-- <?php //echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data']); ?> -->
<!--div class="container" style="background-color:#cacfd4;"-->
<div class="container" style="background-color:white;">
    <div class="forms-container">
        <span>
            <?php /*$error = $this->Session->flash(); ?>
            <?php if($error != ''){?>
            <div class="col-lg-12">
                <div class="message"> <?php echo $error;?> </div>
            </div>
            <?php }*/?>
        </span>
        <img src="http://localhost/tnphc/webroot/img/tnphc_logo.png" alt="Logo" style="float: right;margin: 1.1rem;">
        <div class="signin-signup" >

            <?php echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data','class'=>'sign-in-form']); ?>
            <h3 class="title">Employee Login</h3>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <?php echo $this->Form->control('username',['class'=>'','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Username','required']);?>
                <!-- <input type="text" placeholder="Username" /> -->
            </div>
            <div class="input-field">
                <i class="fas fa-eye" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();"></i>
                <?php echo $this->Form->control('password',['class'=>'','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'minlength'=>8,'maxlength'=>16,'placeholder'=>'Password','required']);?>

                <!-- <input type="password" placeholder="Password" /> -->
            </div>
            <input type="submit" value="Login" class="btn solid"  style="background-color:#5995fd"/>
            <!-- <p class="social-text">Or Sign in with social platforms</p>
                <div class="social-media">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="#" class="social-icon">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div> -->
            <?php echo $this->Form->End();?>
        </div>
    </div>

    <div class="panels-container">
        <div class="left-panel">
            <!--div class="content">
                <h3>New Employee ?</h3>
                <p>
                    Muthu Soft Labs has traversed an enriching journey has emerged as one of the best IT Infrastructure
                    Solution provider!
                </p>
              
                <a href="userregistration">
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </a>
            </div-->
            <!--img src="http://localhost/my_project/webroot/img/svg/emp-login2.svg" class="image" alt="" /-->
            <img src="http://localhost/tnphc/webroot/img/tnphcbuilding.jpg" width="700" height="600"   alt="" />
           
        </div>
        <!-- <div class="panel right-panel">
            <div class="content">
                <h3>One of us ?</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.
                </p>
                <button class="btn transparent" id="sign-in-btn">
                    Sign in
                </button>
            </div>
            <img src="img/register.svg" class="image" alt="" />
        </div> -->
    </div>
</div>

<script>
function mouseoverPass(obj) {
    var obj = document.getElementById('password');
    obj.type = "text";
}

function mouseoutPass(obj) {
    var obj = document.getElementById('password');
    obj.type = "password";
}
</script>