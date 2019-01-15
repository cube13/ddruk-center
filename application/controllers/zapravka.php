<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Zapravka extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		
                $this->load->database();
                
                $this->lang->load('ion_auth', 'russian');
                
                $this->load->model('cartridge_model','cartridge');
        }
           
    public function index()
    {
        if ($this->ion_auth->logged_in())
	{
            
	}
	else
	{
            $this->data['menu_array']=$this->cartridge->get_brands();
            $this->data['brand']=$brand;
            $this->data['cartridges']=$this->cartridge->get_cart_price($id,'0');
            $this->data['header']='Заправка и восстановления картриджей | Ремонт картриджей | Заправка картриджей принтеров тонером';
            
            $this->load->view('header', $this->data);
            $this->load->view('zapravka/price_table', $this->data);
            $this->load->view('zapravka/menu', $this->data);
            $this->load->view('footer', $this->data);
        }
    }
    
    public function kartridgey($brand,$id,$type)
    {
        if ($this->ion_auth->logged_in())
	{
            
	}
	else
	{
            $this->data['menu_array']=$this->cartridge->get_brands();
            $this->data['brand']=$brand;
            $this->data['type']=$type;
            $this->data['cartridges']=$this->cartridge->get_cart_price($id,$type);
            $this->data['header']='Заправка и восстановление картриджей '.$brand;
            
            $this->load->view('header', $this->data);
            $this->load->view('zapravka/price_table', $this->data);
            $this->load->view('zapravka/menu', $this->data);
            $this->load->view('footer', $this->data);
        }
        
    }
    
   
}
?>