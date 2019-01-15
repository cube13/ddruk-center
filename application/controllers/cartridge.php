<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Cartridge extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		
                $this->load->library('ion_auth');
		$this->load->library('session');
		$this->load->library('form_validation');
		
                $this->load->helper('url');
                $this->load->helper('html');
		
		
                $this->load->database();
                
                $this->load->model('systema_model');
                $this->load->model('cartridge_model','cartridge');
                $this->load->model('store_model','store');
                $this->load->model('messages_model','messages');
                
                $this->lang->load('ion_auth', 'russian');
                
                $this->lang->load('systema', 'russian');
                
                $this->load->helper('language');
                $this->load->helper('date');
                $this->load->helper('text');
                
                //$this->load->model('cartridge_model','cartridge');
                
	}
           
    public function index()
    {
        if ($this->ion_auth->logged_in())
	{
            
	}
	else
	{
            $this->load->view('header', $this->data);
            $this->load->view('cartridge/main', $this->data);
            $this->load->view('footer', $this->data);
        }
    }
    
    public function reffil($name,$id)
    {
        if ($this->ion_auth->logged_in())
	{
            
	}
	else
	{
            $this->data['cartridge']=$this->cartridge->get_cartridge($id);
            $this->data['with_printer']=$this->cartridge->with_printer($id);
            
            $this->data['header']='Заправка картриджа '.$this->data['cartridge']->row()->brand_name.' '.$this->data['cartridge']->row()->name.' | ';
            $this->data['header'].='Восстановление картриджа '.$this->data['cartridge']->row()->brand_name.' '.$this->data['cartridge']->row()->name;
            $this->load->view('header', $this->data);
            $this->load->view('cartridge/reffil', $this->data);
            $this->load->view('footer', $this->data);
        }
    }
}
?>