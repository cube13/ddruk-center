<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Remont extends CI_Controller
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
            $this->data['header']='| Заправка и восстановления картриджей | Ремонт офисной техники | Обслуживание компьютеров и серверов';
            $this->load->view('header', $this->data);
            $this->load->view('remont/main', $this->data);
            $this->load->view('footer', $this->data);
        }
    }
    
    public function printer()
    {
        $this->data['header']=' | Ремонт офисной техники | Ремонт принтеров | Ремонт МФУ | Ремонт копиров копировальных аппаратов|';
        $this->load->view('header', $this->data);
        $this->load->view('remont/printer', $this->data);
        $this->load->view('footer', $this->data);    
    }
    public function computer()
    {
        if ($this->ion_auth->logged_in())
	{
            
	}
	else
	{
            $this->data['header']='| Ремонт компьютеров | Настройка компьютеров | Обслуживание компьютеров и серверов';
            $this->load->view('header', $this->data);
            $this->load->view('remont/computer', $this->data);
            $this->load->view('footer', $this->data);
        }    
    }
    public function monitor()
    {
        $this->data['header']='| Ремонт мониторов | Замена ремонт инвортера монитора | Ремонт блока питания монитора';
        $this->load->view('header', $this->data);
        $this->load->view('remont/monitor', $this->data);
        $this->load->view('footer', $this->data);    
    }
}
?>
