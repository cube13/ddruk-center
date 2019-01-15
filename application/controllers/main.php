<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		//load languages
                $this->lang->load('ion_auth', 'russian');
                $this->lang->load('systema', 'russian');
                
                
                $this->load->library('ion_auth');
		$this->load->library('session');
		//$this->load->library('form_validation');
		$this->load->helper('url');
		// Load MongoDB library instead of native db driver if required
		$this->load->database();
                
                $this->load->helper('language');
                $this->load->helper('date');
                
	}
           
    public function index()
    {
        if ($this->ion_auth->logged_in())
	{
            
	}
	else
	{
            $this->data['header']='Заправка картриджей | Ремонт оргтехники, ремонт принтеров, ремонт МФУ| Обслуживание компьютеров и серверов |';
            $this->load->view('header', $this->data);
            $this->load->view('carousel', $this->data);
            $this->load->view('main', $this->data);
            $this->load->view('footer', $this->data);
        }
    }
    
/*    function login()
    {
        //validate form input
	$this->form_validation->set_rules('login', 'Логин', 'required');
	$this->form_validation->set_rules('password', 'Пароль', 'required');
	if ($this->form_validation->run() == true)
	{ //check to see if the user is logging in
	//check for "remember me"
            $remember = (bool) $this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('login'), $this->input->post('password'), $remember))
            { //if the login is successful
            	//redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect($this->config->item('main'), 'refresh');
            }
            else
            { //if the login was un-successful
			//redirect them back to the login page
		$this->session->set_flashdata('message', $this->ion_auth->errors());
		redirect('main/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
	else
	{  //the user is not logging in so display the login page
		//set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['login'] = array('name' => 'login',
			'id' => 'identity',
			'type' => 'text',
			'value' => $this->form_validation->set_value('login'),
			);
            $this->data['password'] = array('name' => 'password',
			'id' => 'password',
			'type' => 'password',
                	);

            $this->data['title']=lang('global_login');
            $this->load->view('header', $this->data);
            $this->load->view('login', $this->data);
            $this->load->view('bottom', $this->data);
	}
    }

	//log the user out
	function logout()
	{
		$this->data['title'] = "Выход";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('main', 'refresh');
	}
 * 
 */
}
?>
