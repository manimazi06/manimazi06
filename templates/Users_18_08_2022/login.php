<!--

<div class="container" style="background-color:white;">
    <div class="forms-container">        
        <img  src="<?php echo $this->Url->build('/img/tnphc_logo.png', ['fullBase' => true]); ?>" alt="Logo" style="float: right;margin: 1.1rem;">
	  <div class="signin-signup" >
             
            <?php echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data','class'=>'sign-in-form']); ?>
            <h3 class="title">Employee Login</h3>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <?php echo $this->Form->control('username',['class'=>'','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Username','required']);?>
            </div>
            <div class="input-field">
                <i class="fas fa-eye" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();"></i>
                <?php echo $this->Form->control('password',['class'=>'','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'minlength'=>8,'maxlength'=>16,'placeholder'=>'Password','required']);?>

            </div>
			<div><?php echo $this->Html->link('<span class=""><i class="fa fa-user"></i>&nbsp;forget password</span>', array('controller' => 'Users', 'action' => 'forgetpassword'), array('escape' => false, 'class' => 'nav-link')); ?>
</div>
			
			 <div> <?= $this->Flash->render() ?>
			 </div>
            <input type="submit" value="Login" class="btn solid"  style="background-color:#5995fd"/>
          
            <?php echo $this->Form->End();?>
        </div>
    </div>

    <div class="panels-container">
        <div class="left-panel">           
            <img src="<?php echo $this->Url->build('/img/tnphcbuilding.jpg', ['fullBase' => true]); ?>" width="700" height="600"   alt="" />
         
        </div>       
    </div>
</div>
-->
<div class="body_wrapper frm-vh-md-100">
        <div class="formify_body">
            <div class="f_content">
                <div class="container-fluid custom_container">
                    <div class="row align-item">
                        <div class="col-lg-3 p-0">
                            <div class="formify_content_left text-center">
                                <div class="formify_logo_wrapper">
                                    <a href="index.html"><img src="<?php echo $this->Url->build('/img/tnphc_logo.png'); ?>" alt=""></a>
                                    <h2 class="title-login">Welcome to <br><span>Tamil Nadu Police Housing Corporation</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 formify_content_right">
                            <div class="formify_box">
<!--
                            <div class="formify_logo_wrapper">
                                <a href="index.html"><img src="<?php echo $this->Url->build('/img/tnphc_logo.png'); ?>" alt=""></a>
                            </div>
-->
                                <h4 class="form_title">Sign in to your account</h4>
                                <?php echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data','class'=>'signup_form']); ?>
                                    <div class="form-group">
                                        <label class="input_title" for="inputEmail">Email</label>
                                        <?php echo $this->Form->control('username',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Email Address','required']);?>
                                    </div>
                                    <div class="form-group">
                                        <label class="input_title" for="inputPassword">Password</label>
                                        <?php echo $this->Form->control('password',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'minlength'=>8,'maxlength'=>16,'placeholder'=>'*******','required']);?>
                                    </div>
                                    <?= $this->Flash->render() ?>
                                    <div class="form-group">
                                        <button type="submit" class="btn action_btn thm_btn">Sign in</button>
                                    </div>
                                    <?php echo $this->Form->End();?>
                                    <p class="form_footer_text">Forgot your password <a href="#">click here to reset</a>
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Login 15 start -->
<!--
<div class="login-15" class="fxt-template-animation fxt-template-layout34" data-bg-image="<?php echo $this->Url->build('/img/bg1.png'); ?>">
    <div class="fxt-shape">
        <div class="fxt-transformX-L-50 fxt-transition-delay-1">
            <img src="<?php echo $this->Url->build('/img/shape1.png'); ?>" alt="Shape">
        </div>
    </div>
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-6 pad-0">
                <div class="form-section align-self-center">
                    <div class="logo">
                        <a href="login-15.html">
                            <img src="<?php echo $this->Url->build('/img/tnphc_logo.png', ['fullBase' => true]); ?>" alt="logo">
                        </a>
                    </div>
                    <?php echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data','class'=>'sign-in-form']); ?>
                    <h3>Employee Login</h3>
                    <div class="clearfix"></div>
                    <form action="#" method="GET">
                        <div class="form-group">
                            <?php echo $this->Form->control('username',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Email Address','required']);?>
                        </div>
                        <div class="form-group clearfix">
                            <?php echo $this->Form->control('password',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'minlength'=>8,'maxlength'=>16,'placeholder'=>'Password','required']);?>
                        </div>
                        <?= $this->Flash->render() ?>
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-lg btn-primary btn-theme"><span>Login</span></button>

                            <?php echo $this->Form->End();?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 align-self-center pad-0 bg-img">
                <div class="info clearfix">
                    <div class="logo-2">
                        <a href="login-15.html">
                            <img src="<?php echo $this->Url->build('/img/tnphc_logo.png', ['fullBase' => true]); ?>" alt="logo">
                        </a>
                    </div>
                    <h3>Welcome to TNPHC</h3>
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- Login 15 end -->

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