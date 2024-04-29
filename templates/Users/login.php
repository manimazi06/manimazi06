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

<style>

.form-section {
    background-image: url(/img/bg-cover-01.png);
    background-position: center;
    background-size: cover;
    width: 100%;
    height: 60vh;
}

.login-form-head img{
    border-radius: 25px;
    margin: 10px;
	
}
.logo-center{
	display: flex;
    justify-content: center;
    align-items: center;
}
.login-form-head h2{
       font-size: 25px;
    color: #fff;
    padding: 5px;
    letter-spacing: 1.5px;
    text-align: center;
}
.login-form-head h1{
    font-weight: bold;
    text-transform: uppercase;
    color: #fff;
    font-size: 22px;
    text-align: center;
}
.form-group-center{
    display: flex;
    justify-content: center;
    align-items: center;
	margin-bottom: 25px;
}
.form-content-center{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 75%;
    margin-left: 65px;
    margin-bottom: 25px;
}
.form-gruop {
    width: 50%;
    outline: none;
    padding: 10px;
    bottom: 100px;
    background: #ffffff;
    box-shadow: 0px 0px 3px 3px rgb(0 0 0 / 8%);
    border-radius: 15px;
}
.form-gruop h2{
    font-size: 28px;
    font-weight: bold;
    letter-spacing: 0.5px;
    padding: 10px;
    text-align: center;
}
.form-gruop .form-label {
    margin-bottom: 0;
    font-size: 16px;
    margin-left: 4px;
    font-weight: lighter;
}
.form-gruop  .form-control {
    display: block;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.9;
    color: #212529;
    background-color: #F5F6F7;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    transition: border-color .15s ease-in-out,
     box-shadow .15s ease-in-out;
}
.form-gruop .form-control:focus {
    outline: 0;
    box-shadow: none; 
}
.form-gruop  .btn-primary{
    width: 100%;
    padding: 10px;
    font-size: 18px;
}
.form-gruop  .btn-primary:hover{
    box-shadow: 1px 7px 6px 2px rgb(211 153 153 / 50%);
    transition: all .3s ease; 
    transform: translateY(-3px);
}
@media (min-width: 320px) and (max-width: 480px) {
    .login-form-head img {
        border-radius: 10px;
        margin-top: 10px;
        width: 50px;
    }
    .form-gruop {
        width: 100%;
    }
    .login-form-head h2 {
        font-size: 15px;
        padding: 0px;
    }
    .login-form-head h1 {
        font-size: 14px;
    }
    .form-gruop h2 {
        font-size: 18px;
        padding: 5px;
    }
    .form-gruop .form-control {
        width: 100%;
    }
    .form-gruop .btn-primary {
        width: 100%;
    }
    .form-content-center {
        width: 100%;
        margin-left: 0;
        margin-bottom: 0;
    }
    
  }
</style>


	<section class="form-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="login-form-head">
						<div class="logo-center">
							<img src="/img/tnphc_logo.png"  alt="log">
						</div>
						<h2>Welcome to</h2>
						<h1>TAMIL NADU POLICE HOUSING CORPORATION</h1> 
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group-center">
						<div class="form-gruop">
						<span style="text-align:center;">
							<?php //$error = $this->Flash->render(); ?>
							<?php if($error != ''){?>
							<div class="col-lg-12">
								<div class="message error"> <b><?php echo $error;?></b> </div>
							</div>
							<?php } ?>
						</span>
							<!--h2>Sign in to your account</h2-->
							<h2>Sign In</h2>
							<div class="form-content-center">
							   <?php echo $this->Form->create($user,['id'=>'FormID',"autocomplete"=>"off",'enctype'=>'multipart/form-data','class'=>'sign-in-form']); ?>

								<div class="row g-3">
									<!--div class="col-md-12">
										<label for="inputEmail4" class="form-label">Roll</label>
										<select class="form-select form-select-lg form-control" aria-label=".form-select-lg example">
											<option selected>Select..</option>
											<option value="1">One</option>
											<option value="2">Two</option>
											<option value="3">Three</option>
										</select>
									</div-->
									<div class="col-md-12">
										<label for="inputEmail4" class="form-label">User Name</label>
										<!--input type="username" class="form-control" id="inputEmail4"-->
										 <?php echo $this->Form->control('username',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'placeholder'=>'Username','required']);?>

									</div>
									<div class="col-md-12">
										<label for="inputPassword4" class="form-label">Password</label>
										<!--input type="password" class="form-control" id="inputPassword4"-->
										                <?php echo $this->Form->control('password',['class'=>'form-control','templates' => ['inputContainer' => '{{content}}'],'label'=>false,'error'=>false,'minlength'=>8,'maxlength'=>16,'placeholder'=>'Password','required']);?>

									</div>
									<div class="col-12">
										<button type="submit" class="btn btn-primary">Sign in</button>
									</div>
								</div>
								<?php echo $this->Form->End();?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		

	<!--div class="body_wrapper frm-vh-md-100">
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



                            <div class="formify_logo_wrapper">
                                <a href="index.html"><img src="<?php echo $this->Url->build('/img/tnphc_logo.png'); ?>" alt=""></a>
                            </div>

  
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
    </div-->
	



<!-- Login 15 start -->

<!--div class="login-15" class="fxt-template-animation fxt-template-layout34" data-bg-image="<?php echo $this->Url->build('/img/bg1.png'); ?>">
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
</div-->

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