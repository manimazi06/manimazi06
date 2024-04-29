<?php
declare(strict_types=1);

namespace App\Controller;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Mailer;



class UsersController extends AppController
{ 
	
	public function login()
    {      
	    $this->viewBuilder()->setLayout('login_layout');

		$this->request->allowMethod(['get', 'post']);
		if ($this->request->is('post')) {
		$result = $this->Authentication->getResult();

		// regardless of POST or GET, redirect if user is logged in
		if ($result->isValid()) {
			// redirect to /articles after login success
			
			 $user = $this->request->getAttribute('identity');
			 
			 $role_id = $user->role_id;
			 
			if($role_id == 1){ 
			 
			$redirect = $this->request->getQuery('redirect', [
				'controller' => 'Users',
				'action' => 'index',
			]);

			return $this->redirect($redirect);
			}else{	

				$redirect = $this->request->getQuery('redirect', [
				'controller' => 'ProjectWorks',
				'action' => 'dashboard',
			]);

			return $this->redirect($redirect);
				
				
			}
		}
		// display error if user submitted and authentication failed
		if ($this->request->is('post') && !$result->isValid()) {
			$error = 'Invalid username or password';

			$this->Flash->error(__('Invalid username or password'));
		}
		}
		
		$this->set(compact('error'));
		
	}
   
   public function logout()
	{
		$result = $this->Authentication->getResult();
		// regardless of POST or GET, redirect if user is logged in
		if ($result->isValid()) {
			$this->Authentication->logout();
			return $this->redirect(['controller' => 'Users', 'action' => 'login']);
		}
	}
	
    public function index()
    {
         $this->viewBuilder()->setLayout('layout');
		 if ($this->request->is('post')) {
			$roleid = $this->request->getData('role_id'); 
			$users = $this->Users->find('all')->contain(['Roles'])->where(['Users.role_id'=>$roleid])->toArray();
		 }else{
			$users = $this->Users->find('all')->contain(['Roles'])->toArray();
		 }
        //print_r($LOGGED_NAME); exit();
		 $roles = $this->Users->Roles->find('list')->where(['Roles.is_active'=>1])->order(['name ASC'])->toArray();    
        $this->set(compact('users','roles'));
    }


  public function view($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $id=base64_decode($id);
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Districts','Divisions'],
        ]);
    //  print_r($user);exit();
        $this->set(compact('user'));
    }


     public function add()
    {
        $this->viewBuilder()->setLayout('layout');
        // $id = base64_decode($id);
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
          // echo '<pre>'; print_r($this->request->getData()); exit();
            //$user                    = $this->Users->patchEntity($user, $this->request->getData());
            $hasher                  = new DefaultPasswordHasher();
            $password                = $hasher->hash($this->request->getData('password1'));
            $user->username          = $this->request->getData('username1');
            $user->role_id           = $this->request->getData('role_id');
            $user->district_id       = ($this->request->getData('district_id') != '')?$this->request->getData('district_id'):0;
            $user->division_id       = ($this->request->getData('division_id') != '')?$this->request->getData('division_id'):0;
            $user->circle_id         = ($this->request->getData('circle_id') != '')?$this->request->getData('circle_id'):0;
            $user->email             = $this->request->getData('email');
            $user->password          = $password;
            $user->name              = $this->request->getData('name');
            $user->mobile_no         = $this->request->getData('mobile_no');
            $user->address           = $this->request->getData('address');
            // $username =              = $this->request->getData('username1');
            //  print_r($user);exit();
            $username = $this->Users->find('all')->where(['Users.username' => $this->request->getData('username1')])->count();
            //  print_r ($username);exit();
            $mobile_no = $this->Users->find('all')->where(['Users.mobile_no' => $this->request->getData('mobile_no')])->count();
            $email  = $this->Users->find('all')->where(['Users.email' => $this->request->getData('email')])->count();
            if ($username > 0) {
                $this->Flash->error(__('Name is already exits'));
                // return $this->redirect(['action' => 'index']);
            } elseif ($mobile_no > 0) {
                $this->Flash->error(__('mobile no is already exits'));
            } elseif ($email) {
                $this->Flash->error(__('Email is already exits'));
            } else {
                // echo '<pre>';  print_r($user);exit();
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->all();
		 $this->loadModel('Divisions');
		 $this->loadModel('Circles');
        $districts = $this->Users->Districts->find('list')->toArray();
        $divisions = $this->Divisions->find('list')->toArray();
        $circles = $this->Circles->find('list')->toArray();
        // print_r($districts);exit();
        $this->set(compact('user', 'districts', 'roles','divisions','circles'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('layout');
        $id=base64_decode($id);
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //$user = $this->Users->patchEntity($user, $this->request->getData());
            $user->username          = $this->request->getData('username1');
            $user->role_id           = $this->request->getData('role_id');
            $user->district_id       = ($this->request->getData('district_id') != '')?$this->request->getData('district_id'):0;
            $user->division_id       = ($this->request->getData('division_id') != '')?$this->request->getData('division_id'):0;
            $user->circle_id         = ($this->request->getData('circle_id') != '')?$this->request->getData('circle_id'):0;
            
            $user->email             = $this->request->getData('email');
            $user->name              = $this->request->getData('name');
            $user->mobile_no         = $this->request->getData('mobile_no');
            $user->address           = $this->request->getData('address');
            $username = $this->Users->find('all')->where(['Users.username' => $this->request->getData('username1'),'Users.id !=' => $id])->count();
            //  print_r ($username);exit();
            $mobile_no = $this->Users->find('all')->where(['Users.mobile_no' => $this->request->getData('mobile_no'),'Users.id !=' => $id])->count();
            $email  = $this->Users->find('all')->where(['Users.email' => $this->request->getData('email'),'Users.id !=' => $id])->count();
            if ($username > 0) {
                $this->Flash->error(__('Name is already exits'));
                // return $this->redirect(['action' => 'index']);
            } elseif ($mobile_no > 0) {
                $this->Flash->error(__('mobile no is already exits'));
            } elseif ($email) {
                $this->Flash->error(__('Email is already exits'));
            }else{
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
           
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200])->all();
        $districts = $this->Users->Districts->find('list', ['limit' => 200])->all();
		$this->loadModel('Divisions');
		$this->loadModel('Circles');
        $divisions = $this->Divisions->find('list')->where(['Divisions.id'=>$user->division_id])->toArray();
		$circles = $this->Circles->find('list')->toArray();

		
		//print_r($divisions); exit();
        $this->set(compact('user', 'roles', 'districts','divisions','circles'));
    }
	
	   public function ajaxdivisions($id)
    {
        $this->loadModel('Districts');
        $this->loadModel('Divisions');
        $dists    = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id])->first();
       // $divs     = $this->Divisions->find('all')->contain(['Circles'])->where(['Divisions.id' => $dists['division']['id']])->first();

        // $division = array(
            // 'division_id' => $dists['division']['id'],
            // 'division_name' => $dists['division']['name']
        // );
		
		$division_id = $dists['division']['id'];
		
		echo $division_id;
        exit();
        //print_r($division);  exit();
        $this->set(compact('division'));
    }
	
	
	 public function ajaxcircles($type,$id)
    {
        $this->loadModel('Districts');		
        $this->loadModel('Divisions');		
		if($type == 1){
          $dists    = $this->Districts->find('all')->contain(['Divisions'])->where(['Districts.id' => $id])->first();
          $divs     = $this->Divisions->find('all')->contain(['Circles'])->where(['Divisions.id' => $dists['division']['id']])->first();
        }else  if($type == 2){
		
		$divs     = $this->Divisions->find('all')->contain(['Circles'])->where(['Divisions.id' => $id])->first();
        }
        $circle = array(
            'circle_id'   => $divs['circle']['id'],
            'circle_name' => $divs['circle']['name']
        );

       // print_r($circle);  exit();
        $this->set(compact('circle'));
    }

  
 	public function changepassword()
	{  
		$user = $this->request->getAttribute('identity');
		$this->viewBuilder()->setLayout('layout');
		if ($this->request->is(['patch', 'post', 'put'])) { //echo "<pre>"; print_r($this->request->getData()); exit();
			 $users   = $this->Users->find('all')->where(['Users.id' => $user->id])->first();		
			 $hasher  = new DefaultPasswordHasher();
			 $PPP     = $hasher->check($this->request->getData('oldpassword'), $users['password']);
			 
			if ($this->request->getData('newpassword') != $this->request->getData('confirmpassword')) {
				$this->Flash->error(__('New password and Confirm password does not match.'));
			}

			if ($this->request->getData('newpassword') == $this->request->getData('oldpassword')) {

				$this->Flash->error(__('New password should not be same as OLD password!'));
			}else if ($PPP) {
				    $passWord = $hasher->hash($this->request->getData('newpassword'));
				    $userTable = TableRegistry::get('Users');			
					$userentry = $userTable->find('all')->where(['Users.id'=>$user->id])->first();
					$userentry->password = $passWord;
					if ($userTable->save($userentry)) {
						$this->Flash->success(__('New password has been updated!'));
						//$this->Authentication->logout();
				    return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
					}	
			}else {
				$this->Flash->error(__('Wrong Current password!'));
			}
		}
	}
	
	
	public function forgetpassword()
	{
		$user = $this->request->getAttribute('identity');
		$this->viewBuilder()->setLayout('login_layout');

		if ($this->request->is('post')) {
			$old_user = $this->Users->find('all')->where(['Users.email' => $this->request->getData('email')])->first();
			$userId   = $old_user['id'];
			// print_r($userId); exit();
			$arrcount = count($old_user);
			if ($arrcount > 0) {
				$sendforgototp = $this->emailverfication($userId);
				$this->Flash->success(__('OTP has been sent to your registered email!'));
				return $this->redirect(['action' => 'emailverfication', $old_user['id']]);
				//return $this->redirect(['action' => 'login']);
			} else {

				$this->Flash->error(__('Invalid User Details.'));
			}
		}
	}

	public function emailverfication($user_id)
	{
		//$this->viewBuilder()->layout('layout');
		$this->viewBuilder()->setLayout('');
		$old_user = $this->Users->find('all')->where(['Users.id' => $user_id])->first();
		//echo '<pre>'; print_r($old_user); exit();
		if ($old_user) {
			 $output['otp'] =  rand(100000, 999999);
			
			
			//$output['otp']  = $this->randomstrings(6);
			
			//print_r($output); exit();
			
			$mailer = new Mailer('default');
            $mailer->setFrom(['vickyelix01@gmail.com' => 'vicky'])
                ->setTo('vignesh@mslabs.in')
                ->setSubject('Forget Password -OTP')
                ->deliver('Password is');
			// $hasher         = new DefaultPasswordHasher();
			// $pwd 			= $hasher->hash($output['otp']);
			// TableRegistry::get('AdminUsers')
				// ->query()
				// ->update()
				// ->set(['mail' => $old_user[0]['email'], 'otp' => $output['otp'], 'is_verified' => 1, 'created_on' => date('Y-m-d')])
				// ->execute();
			//$send_emailmsg = $this->sendForgotPassword($old_user[0]['id'], $old_user[0]['name'], $old_user[0]['email'], $output['otp']);
			return $this->redirect(['action' => 'resetpassword']);
		}
		$this->set(compact('old_user'));
		
		exit();
	}

	// public function forgetsuccess(){
	// 	$this->viewBuilder()->layout('layout');

	// }

	/*public function sendForgotPassword($userId, $name, $useremail, $userotp)
	{
		$this->viewBuilder()->setLayout('');
		$user             = $this->AdminUsers->find('all')->where(['id' => $userId])->toArray();
		$user['id']       = $userId;
		$user['name']     = $name;
		$user['email']    = $useremail;
		$useremailOTP     = $userotp;
		$sentemial_otp['message']  = $this->getMailer('User')->send('sendforgotemail', [$user, $useremailOTP]);
		//print_r($sentemial_otp['message']);exit;
		echo "success";
		return;
		// $this->set('user_dtls',$user_dtls);	

	}*/

	/*public function resetpassword()
	{  
		//$this->viewBuilder()->layout('login_layout');
		$this->viewBuilder()->setLayout('login_layout');
		if ($this->request->is(['patch', 'post', 'put'])) {
			//print_r($this->request->data); exit();
			$id          = $this->Users->find('all')->where(['Users.id' => $old_user[0]['id']])->first();
			$hasher      = new DefaultPasswordHasher();
			$passWord    = $hasher->hash($this->request->data['password']);
			TableRegistry::get('AdminUsers')
				->query()
				->update()
				->set(['password' => $passWord])
				->where(['id' => $id])
				->execute();
			$this->Flash->success(__('New password has been updated.'));
			return $this->redirect(['controller' => 'AdminUsers', 'action' => 'login']);
		} else {
			$this->Flash->error(__('Wrong Old password.'));
		}
	}*/
	
	
	public function resetpassword($id = null){
        // echo "<pre>";print_r($id);exit();
        $user = $this->request->getAttribute('identity');
        $hasher  = new DefaultPasswordHasher();
    
        $this->viewBuilder()->setLayout('layout');
    
        // $id=base64_decode($id);
            $user = $this->Users->get($id, [
                'contain' => [],
            ]);
                //$user_id = $this->Users->get($id);
                $resetpassword="tnphc@123";
                    // echo "<pre>";print_r($resetpassword);exit();
    
                $password = $hasher->hash($resetpassword);
                $userTable = TableRegistry::get('Users');           
                $userentry = $userTable->find('all')->where(['Users.id'=>$id])->first();
                $userentry->password = $password;   
                    // echo "<pre>";print_r($userentry);exit(); 
                if ($userTable->save($userentry)) {
                    $this->Flash->success(__('password has been successfully updated for '.$user['name']));
                    //$this->Authentication->logout();
                      return $this->redirect(['controller' => 'Users', 'action' => 'index']);
                }else{
                    $this->Flash->error(__('Reset password has been updated!'));
    
                }   
          
            // echo "<pre>";print_r($id);exit();
    
       }
}
