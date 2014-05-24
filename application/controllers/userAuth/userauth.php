<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userauth extends WS_Controller {
	
	public function Userauth(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('template/blank_header',$this->headerData);
		$this->load->view('userauth/login');
		$this->load->view('template/footer');
	}
	
	public function login(){
		$this->load->helper('url');
		$this->load->model('userauth/Userauth_model','userauthmodel');
		$data = array();
		if($this->userauthmodel->isloggedIn()){
			redirect("/");
		}
		if($this->input->post()){
			$postDataArray = $this->input->post();
			$getUserAuthReturnArray = $this->userauthmodel->validateUserLogin($postDataArray['email'],  $postDataArray['password']);
			$data['postResult']=$getUserAuthReturnArray;
			if($getUserAuthReturnArray['status']){
				redirect("/");
			}
		}
		$this->load->view('template/header',$this->headerData);
		$this->load->view('userauth/login',$data);
		$this->load->view('template/footer');
	}
    
    public function password_reset() {
    	$this->load->model('userauth/userauth_model','userauthmodel');
    	$this->load->model('user/user_model', 'userModel');
    	
    	$data = array();
    	
    	if ($this->input->post()) {
    		$postDataArray = $this->input->post();
    		$userEmail = $postDataArray['email'];
    		
    		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $userEmail)) {
    			$userLoginRecord = $this->userauthmodel->fetchUserLogin($userEmail);
    			
    			if (isset($userLoginRecord)) {
    				log_message('info', 'userLoginRecord is set');
    				
    				try {
    					$activationData = $this->getActivationLink($userEmail, 'userauth/verify_link');
    					$newPasswordObject = array(
    							'user_login_id'		=>	$userLoginRecord->id,
		    					'activation_code'	=>	$activationData['activationCode'],
    							'activation_link'	=>	$activationData['activationLink']
    					);
    					
    					$addUpdateResult = $this->userModel->addUpdateNewPasswordRecord($userLoginRecord->id, $newPasswordObject);
    					
    					if (isset($addUpdateResult)) {
    						$mailContent = "Click on the below link to change your password \n".$activationData['activationLink'];
    						$this->send_mail('dpak005@gmail.com', $userEmail, 'Password Reset', $mailContent);
    							
    						$data['postResult'] = array('status'=>true,
    								'message'=>'A Mail has been send to your email, Kindly visit the link provided.');
    					} else {
    						$data['postResult'] = array('status'=>false, 
    								'message'=>'Something went wrong. Please contact admin: admin@wherestop.com');
    					}
    				}catch (Exception $e){
    					log_message('info', 'exception occurred: '.$e->getMessage()."\n");
    					$this->userModel->removeNewPasswordRecord($userEmail);
    					$data['postResult'] = array('status'=>false, 'message'=>$e->getMessage());
    				}
    			} else {
    				$data['postResult'] = array('status'=>false, 'message'=>'Invalid Email Address');
    			}
    		}
    	}
    	
    	$this->load->view('template/header',$this->headerData);
    	$this->load->view('userauth/password_reset',$data);
    	$this->load->view('template/footer');
	}
	
	public function verify_link(){
		$redirectData = array('status'=>false,
				'message'=>'Please recheck the link or contact the administrator: admin@wherestop.com.'
		);
		
		if ($this->input->get()) {
			$this->load->model('user/user_model', 'userModel');
			$getParameters = $this->input->get();
			
			
			if ($this->verifyGetParameters($getParameters)) {
				$newPasswordRecordObject = $this->userModel->fetchNewPasswordRecord($getParameters['email'], $getParameters['key']);
				
				if (isset($newPasswordRecordObject)) {
					$expiryStartTimeStamp = $newPasswordRecordObject->expiry_start_timestamp;

					if ($this->checkExpiry($userEmail, $activationCode, $expiryStartTimeStamp, 1)) {
						$redirectData = array(
								'userEmail' => $getParameters['email'],
								'activationCode' => $getParameters['key']
						);
						$this->redirectPage($redirectData, "userauth/reset");
					} else {
						$link = array();
						$link['href']=base_url("userauth/password_reset");
						$link['label']="Click Here";
						$link['title']="Click Here";
						
						$redirectData = array(
								'status' => false,
								'message' => "Sorry, Link has expired, Please request a new one, ",
								'link' => $link
						);
						$this->redirectPage($redirectData, "userauth/error");
					}
				} else {
					$this->redirectPage($redirectData, "userauth/error");
				}
			}			
		} else {
			$this->redirectPage($redirectData, "userauth/error");
		}
	}

	public function verifyGetParameters($getParameters){
		if (isset($getParameters['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
				$getParameters['email'])) {
			$email = $getParameters['email'];
		}
	
		if (isset($getParameters['key']) && (strlen($getParameters['key']) == 32)) {
			// the activation key will always have length=32 since it it MD5 hash
			$activationCode = $getParameters['key'];
		}
	
		if (isset($email) && isset($activationCode)) {
			// TODO check for expiry of the link
			return true;
		}
	
		return false;
	}
	
	public function reset(){
		$data = $this->session->flashdata('redirectData'); 
		
		if ($this->input->post()) {
			$postParameters = $this->input->post();
			
			if (!($this->isNullOrEmptyString($postParameters['password']) || $this->isNullOrEmptyString($postParameters['userEmail']) 
				|| $this->isNullOrEmptyString($postParameters['activationCode'])) 
				&& preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $postParameters['userEmail']) ){
				
				$this->load->model('user/user_model', 'userModel');
				$this->userModel->updateUserLoginPassword($postParameters['userEmail'], $postParameters['password']);
				$this->userModel->archiveNewPasswordByActivationCode($postParameters['activationCode']);
				
				$this->redirectPage(array('postResult' =>array('status'=>true, 
						'message'=>'password changed succesfully, Enjoy the world of wherestop.')), "userauth/login");
				
			} else {
				$this->redirectPage(array('status'=>false, 'message'=>"Please recheck the link or contact the administrator: admin@wherestop.com."),
						"userauth/error");
			}
		}
		
		$this->load->view('template/header',$this->headerData);
		$this->load->view('userauth/reset', $data);
		$this->load->view('template/footer');
	}
	

    public function logout(){
        $this->load->model('userauth/Userauth_model','userauthmodel');
        $data = array();
        $this->userauthmodel->logoutSession();
    }
    
	public function signup(){	    	
        $this->load->model('userauth/Userauth_model','userauthmodel');
        $this->load->model('user/user_model', 'userModel');
        $data = array();
        	
        if($this->input->post()){
        	$postDataArray = $this->input->post();
        	$signUpParameters = $this->validateSignUpParameters($postDataArray);

        	if ($signUpParameters['status']) {
	        	$insertResult = $this->userModel->insertUserLogin($postDataArray, 1);
	        	$userLoginId = $insertResult['userLoginId'];
				unset($insertResult['userLoginId']);
				
       			if ($insertResult['status']) {
       				try {
       					$this->implementSignUpProcess($postDataArray, $userLoginId);
       					$data['postResult'] = array('status'=>true, 
       							'message'=>'A Mail has been send to your email for verification, Please Verify.');
       				} catch (Exception $e) {
       					log_message('info', "exception message : ".$e->getMessage()."\n");
       					
       					$this->userModel->removeUserLogin($postDataArray['email']);
       					$this->redirectPage(array('message'=>'There was some error in registration, please try again later.'), "userauth/error");
       				}
       			} else {
       				$data['postResult'] = $insertResult;
       			}
        	} else {
       			$data['postResult'] = $signUpParameters;
       		}
       	}
       	
       	$this->load->view('template/header',$this->headerData);
        $this->load->view('userauth/signup', $data);
        $this->load->view('template/footer');
	}

	function validateSignUpParameters($postParameters){
		$this->load->model('userauth/Userauth_model','userauthmodel');
		$validateResult = array('status'=> true, 'message'=>'parameters validated.');
		 
		$name = $postParameters['name'];
		$email = $postParameters['email'];
		$password = $postParameters['password'];
		 
		// check for blank or null value
		if ($this->isNullOrEmptyString($name) || $this->isNullOrEmptyString($email)
		|| $this->isNullOrEmptyString($password)) {
			$validateResult['status'] = false;
			$validateResult['message'] = 'Blank values are not allowed.';
			 
			return $validateResult;
		}
		 
		// validate email address expression and already existing check
		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)) {
			if (($this->userauthmodel->fetchUserLogin($email)) == null) {
				$validateResult['status'] = true;
				$validateResult['message'] = 'Email address valid.';
			} else {
				$validateResult['status'] = false;
				$validateResult['message'] = 'User already exists.';
			}
		} else {
			$validateResult['status'] = false;
			$validateResult['message'] = 'Invalid email address.';
		}
		 
		return $validateResult;
	
	}
	
	public function implementSignUpProcess($postDataArray, $userLoginId){
		$activationData = $this->getActivationLink($postDataArray['email'], 'userauth/activation');
		$insertUserRegistrationResult = $this->userModel->insertUserRegistration($activationData['activationCode'],
				$userLoginId, $activationData['activationLink']);
		
		$mailContent = "Click on the below link to activate your account \n"
				.$activationData['activationLink'];
		$this->send_mail('dpak005@gmail.com', $postDataArray['email'], 'Wherestop User Activation', $mailContent);
	}

	public function redirectPage($redirectData, $redirectURI){
		$this->session->set_flashdata('redirectData', $redirectData);
		redirect(base_url($redirectURI));
	}
	
	function getActivationLink($userEmail, $activationURI){
		// generating activation code
		$activationCode = md5(time().uniqid(rand(), true));
		log_message('info', 'activationCode='.$activationCode);
		
		//generating activation link
		$activationLink = base_url($activationURI).'?email='.urlencode($userEmail).'&key='.$activationCode;
		log_message('info', 'activationLink='.$activationLink);
		
		return array('activationCode'=>$activationCode, 'activationLink'=>$activationLink);		
	}
	
	function send_mail($mailFrom, $mailRecipient, $mailSubject, $mailContent){
		$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'dpak005@gmail.com',
				'smtp_pass' => 'dpak@005',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from($mailFrom); 
		$this->email->to($mailRecipient);
		$this->email->subject($mailSubject);
		$this->email->message($mailContent);
		
		if($this->email->send()) {
			log_message('info', 'Email sent successfully to '.$mailRecipient);
		} else {
			show_error($this->email->print_debugger());
		}
	}
	
	function error(){
		$data = $this->session->flashdata('redirectData');
		
		if ($data) {
			$this->load->view('template/header', $this->headerData);
			$this->load->view('userauth/error', $data);
			$this->load->view('template/footer');
		} else {
			redirect(base_url("/"));
		}
	}
	
	function activation(){
		$redirectData = array(
				'status'=>false,
				'message'=>'Oops! yor account cannot be activated, Please recheck the link or contact the administrator.'
		);
		
		if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $_GET['email'])) {
			$email = $_GET['email'];
		}
		
		if (isset($_GET['key']) && (strlen($_GET['key']) == 32)) {
			// the activation key will always have length=32 since it it MD5 hash
			$activationCode = $_GET['key'];
		}
		
		if (isset($email) && isset($activationCode)) {
			$this->load->model('user/user_model', 'userModel');
			$userRegistrationEntry = $this->userModel->fetchUserRegistrationDetails($email, $activationCode);
			
			if (isset($userRegistrationEntry) && $userRegistrationEntry!="") {
				log_message('info', 'userRegistration entry is valid.');
				$startExpiryTimeStamp = $userRegistrationEntry['expiry_start_timestamp'];
					
				if ($this->checkExpiry($email, $activationCode, $startExpiryTimeStamp, 3)) {
					$updateResult = $this->userModel->activateUser($email, $activationCode);
					if ($updateResult['status']) {
						$this->session->set_flashdata('redirectData', $updateResult);
						redirect(base_url("userauth/login"));
					}
				} else {
					$redirectData['message'] = "Your activation link has expired.";
				}				
			} else {
				$redirectData['message'] = 'User already Registered';
			}
		}
		
		$this->session->set_flashdata('redirectData', $redirectData);
		redirect(base_url("userauth/error"));
	}
	
	function checkExpiry($userEmail, $activationCode, $expiryStartTimeStamp, $expiryHours){
		$dbTime = strtotime($expiryStartTimeStamp);
		$now = getDate();
		$nowTime = $now[0];
		$difference = $nowTime-$dbTime;
		
		$allowedDiff = $expiryHours*60*60;
		
		log_message('info', 'dbTime= '.$dbTime.' nowTime= '.$nowTime.' difference= '.$difference.' allowedDiff= '.$allowedDiff);
		
		if ($difference>$allowedDiff) {
			log_message('info', 'Time exceeded');
			echo "Time exceeded";
		} elseif ($difference<0) {
			log_message('info', 'time difference is negative');
			echo "Invalid unknown error";	
		} else {
			log_message('info', 'Minutes = '.floor($difference/60));
			echo "Mins: ".floor($difference/60);
			return true;
		}

		return false;
	}
	
	// fn to check null or empty string
	function isNullOrEmptyString($stringInstance) {
		return (!isset($stringInstance) || trim($stringInstance)==='');
	}
	
}