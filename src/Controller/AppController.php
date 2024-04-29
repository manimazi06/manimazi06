<?php
declare(strict_types=1);


namespace App\Controller;

use Cake\Controller\Controller;
// use Cake\Event\Event;
// use Cake\Controller\Component\AuthComponent;


class AppController extends Controller
{
 
    public function initialize(): void
    {
        parent::initialize();

        // $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');	
		$this->loadComponent('Authentication.Authentication');	
        $this->Departments = $this->fetchTable('Departments');
        $this->Divisions = $this->fetchTable('Divisions');
        $this->FinancialYears = $this->fetchTable('FinancialYears');
        $this->Notifications = $this->fetchTable('Notifications');
        $this->ProjectMonitoringDetails = $this->fetchTable('ProjectMonitoringDetails');
     // $this->loadComponent('Auth', [
        // 'authenticate' => [
            // 'Form' => [
                // 'finder' => 'auth'
            // ]
        // ],
    // ]);		
		        
    }


	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
        parent::beforeFilter($event);
		$user = $this->request->getAttribute('identity');
		
		$this->set("LOGGED_ID", $user->id);
		$this->set("LOGGED_NAME", $user->name);
		$this->set("LOGGED_ROLE", $user->role_id);
        
		parent::beforeFilter($event);
		// for all controllers in our application, make index and view
		// actions public, skipping the authentication check
		$this->Authentication->addUnauthenticatedActions(['login', 'forgetpassword','resetpassword','emailverfication']);
	}
}