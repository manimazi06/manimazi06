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