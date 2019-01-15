<?php defined('BASEPATH') OR exit('No direct script access allowed');
class About extends CI_Controller
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
            $this->load->view('header', $this->data);
            $this->load->view('about/main', $this->data);
            $this->load->view('footer', $this->data);
        }
    }
    
    public function contact()
    {
        $this->load->view('header', $this->data);
        $this->load->view('about/contact', $this->data);
        $this->load->view('footer', $this->data);    
    }
        
    public function form()
    {
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
    
}
?>
