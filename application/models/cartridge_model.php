<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Функции обменна данными с БД для картриджей
 *
 * @author cube
 */
class Cartridge_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get_cart_price($brand,$type)
    {
        /*
         * select printers.id,
    printers.name as printer,
    cartridge.id,
    cartridge.name as name,
    cartridge.cena_zapravki,
    cartridge.cena_vostanovlenia,
    cartridge.is_chip,
    cartridge.html_title, 
    printers.html_title,
    cartridge.cena_novogo,
    cartridge.cena_novogo_bn,
    cartridge.color
from print_join_cart
join cartridge on print_join_cart.cartridge_id=cartridge.id
join printers on print_join_cart.printer_id=printers.id
where cartridge.brand='3'
and cartridge.type='1'
and printers.publish='1'
and cartridge.publish='1'
and print_join_cart.enable='1';
         */
        $this->db->select('printers.id,
    printers.name as printer,
    cartridge.id,
    cartridge.name as name,
    cartridge.cena_zapravki,
    cartridge.cena_vostanovlenia,
    cartridge.is_chip,
    cartridge.html_title, 
    printers.html_title,
    cartridge.cena_novogo,
    cartridge.cena_novogo_bn,
    cartridge.color')
                ->from('print_join_cart')
                ->join('cartridge','print_join_cart.cartridge_id=cartridge.id')
                ->join('printers','print_join_cart.printer_id=printers.id')
                ->where('cartridge.brand',$brand)
                ->where('cartridge.type',$type)
                ->where('printers.publish','1')
                ->where('cartridge.publish','1')
                ->where('print_join_cart.enable','1');
                $this->db->order_by('cartridge.sort','desc');
        if($type)
        {
            
            $this->db->order_by('printers.name','asc');
            $this->db->order_by('cartridge.name','asc');
            
        }
         if(!$type)
        {
              $this->db->order_by('printers.name','desc');
            $this->db->order_by('cartridge.name','asc');
           
        }
                
                
        return $this->db->get();
        
    }
    
    public function get_brands()
    {
        $this->db->select('id,name')
                ->from('brands')
                ->order_by('id','asc');
        return $this->db->get();
    }
    
    public function get_cartridge($cart_id)
    {
        $this->db->select('
cartridge.id,
cartridge.name,
cartridge.cena_zapravki,
cartridge.cena_vostanovlenia,
cartridge.cena_novogo,
cartridge.cena_pokupki_bu,
cartridge.color,
cartridge.type,
cartridge.is_chip,
cartridge.resurs,
cartridge.html_title,
cartridge.page_title,
cartridge.page_content,
cartridge.m_kwords,
cartridge.m_desc,
cartridge.picture,
brands.name as brand_name')
                ->from('cartridge')
                ->join('brands','cartridge.brand=brands.id')
                ->where('cartridge.id',$cart_id)
                ->where('cartridge.publish','1');
        return $this->db->get();
    }
    
    public function with_printer($cartridge_id)
    {
        $this->db->select('printer_id, printers.name')
                ->from('print_join_cart')
                ->join('printers','printers.id = printer_id')
                ->where('cartridge_id',$cartridge_id);
        return $this->db->get;
    }
    
}

?>