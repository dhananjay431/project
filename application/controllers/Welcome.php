<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
        {
                parent::__construct();

				$this->load->model('restaurant_model');
				$this->load->model('restaurant_holidays_model');
				$this->load->model('restaurant_timings_model');
				$this->load->model('restaurant_cuisines_model');
                $this->load->model('token_model');
                $this->load->helper('cookie');
                $this->load->helper('url_helper');
                
        }
		public function getTime($id)
		{
			return $this->restaurant_timings_model->get($id);
		}
		public function getById($id)
		{
			return $this->restaurant_cuisines_model->getById($id);
		}
        public function getall()
        {
        	//if($this->checktoken()){
			$arr = 	$this->restaurant_model->getAll();
			foreach ($arr as $value) {
				$value->timings=$this->getTime($value->id);
				$value->cuisines=$this->getById($value->id)[0];
				//return print_r($value->id); 
			}
$this->resp($arr);
				//$this->resp($this->restaurant_model->getAll());
        	/*}
			else
				echo "not valid";*/
        }        
        public function info()
        {
        		$header = $this->input->request_headers();
				$ip  = $this->input->ip_address();
				$header['ip']=$ip;
				return $header;
				//$this->resp($header);
        	//$arr = array('req'=>$req,'res'=>$this->restaurant_model->getAll(),"post"=>$this->input->post());
                
        }
        public function resp($data){

        	$this->output
        	->set_content_type('application/json')
        	->set_output(json_encode($data));

        }

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function token(){ 
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
		$Caracteres = 'abcdefghijklmopqrstuvxwyzABCDEFGHIJKLMOPQRSTUVXWYZ0123456789[]{}~!@#$%^&*()_+-'; 
		$QuantidadeCaracteres = strlen($Caracteres); 
		$QuantidadeCaracteres--; 
		$Hash=NULL; 
   		 for($x=1;$x<=100;$x++){ 
        	$Posicao = rand(0,$QuantidadeCaracteres); 
        	$Hash .= substr($Caracteres,$Posicao,1); 
    		}
    		$this->token_model->token($this->info(),$Hash);
    		echo $Hash;
	//$this->resp(array('df'=>$this->token_model->token( $this->info(),$Hash )));
		} 
		public function checktoken(){ 
    		$arr = $this->token_model->checktoken($this->info());
    		if(count($arr) == 1)
    			return true;
    		else
    			return false;
			//$this->resp($arr);
		}
		public function email()
		{
$config = Array(
'protocol' => 'smtp',
'smtp_host' => 'ssl://smtp.gmail.com',
'smtp_port' => 465,
'smtp_user' => '',
'smtp_pass' => '',
'mailtype'  => 'html', 
'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");

// Set to, from, message, etc.
			$this->email->from('');
			$this->email->to('');
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');

			$this->email->subject('Email Test');
			$this->email->message('hi hjkhgk');

			$result = $this->email->send();
			echo $this->resp($result);
		} 
}
