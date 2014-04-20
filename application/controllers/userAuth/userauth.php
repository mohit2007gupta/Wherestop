<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userauth extends WS_Controller {
	
	public function Userauth(){
		parent::__construct();
	}

	public function index()
	{
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
        public function forgotpassword()
	{
            $this->load->view('template/blank_header');
            $this->load->view('userauth/forgotpassword');
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
        	$signUpParameters = $this->userauthmodel->validateSignupParameters($postDataArray);

        	if ($signUpParameters['status']) {
	        	$insertResult = $this->userModel->insertUserLogin($postDataArray, 1);
	        	$userLoginId = $insertResult['userLoginId'];
				unset($insertResult['userLoginId']);
				
       			if ($insertResult['status']) {
       				try {
       					$this->implementSignUpProcess($postDataArray, $userLoginId);
       					$data['postResult'] = array('status'=>true, 'message'=>'A Mail has been send to your email for verification, Please Verify.');
       				} catch (Exception $e) {
       					$this->userModel->removeUserRegistration($postDataArray['email']);
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
	
	public function implementSignUpProcess($postDataArray, $userLoginId){
		$activationData = $this->getActivationLink($postDataArray['email'], 'userauth/activation');
		$insertUserRegistrationResult = $this->userModel->insertUserRegistration($activationData['activationCode'],
				$userLoginId, $activationData['activationLink']);
		
		$mailContent = "Click on the below link to activate your account \n"
				.$activationData['activationLink'];
		$this->send_mail('dpak005@gmail.com', $postDataArray['email'], 'Wherestop User Activation', $mailContent);
		//$this->redirectPage(array('name'=>$postDataArray['name'], 'email'=>$postDataArray['email']), "userauth/success");
	}

	public function redirectPage($redirectData, $redirectURI){
		$this->session->set_flashdata('redirectData', $redirectData);
		redirect(base_url($redirectURI));
	}
	
	function getActivationLink($userEmail, $activationURI){
		// generating activation code
		$activationCode = md5(uniqid(rand(), true));
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
		$this->email->subject('User Registration.');
		$this->email->message($mailContent);
		
		if($this->email->send()) {
			log_message('info', 'Email sent successfully to '.$mailRecipient);
		} else {
			show_error($this->email->print_debugger());
		}
	}
	
	function success() {
		$data = $this->session->flashdata('redirectData');
		
		if (!isset($data)) {
			redirect(base_url("/"));
		}
		
		$this->load->view('template/header', $this->headerData);
		$this->load->view('userauth/success', $data);
		$this->load->view('template/footer');
	}
	
	function error(){
		$data = $this->session->flashdata('redirectData');
		
		if (!isset($data)) {
			redirect(base_url("/"));
		}
		
		$this->load->view('template/header', $this->headerData);
		$this->load->view('userauth/error', $data);
		$this->load->view('template/footer');
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
					
				if ($this->checkExpiry($email, $activationCode, $startExpiryTimeStamp)) {
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
	
	function checkExpiry($userEmail, $activationCode, $expiryStartTimeStamp){
		$dbTime = strtotime($expiryStartTimeStamp);
		$now = getDate();
		$nowTime = $now[0];
		$difference = $nowTime-$dbTime;
		
		// maximum allowed time to activate = 3 hrs
		$allowedDiff = 3*60*60;
		
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
	
}