<?php
class Secure_area extends CI_Controller 
{
	/*
	Controllers that are considered secure extend Secure_area, optionally a $module_id can
	be set to also check if a user can access a particular module in the system.
	*/
	function __construct($module_id=null)
	{
		parent::__construct();	
		$this->load->model('Employee');
		if(!$this->Employee->is_logged_in())
		{
			redirect('login');
		}
		
		if($module_id != 'invetories_compare' && $module_id != 'share_inventories' && $module_id != 'no_access'){
			if(!$this->Employee->has_permission($module_id,$this->Employee->get_logged_in_employee_info()->person_id))
			{
				redirect('no_access/'.$module_id);
			}else{
        		if ($this->Employee->isAdmin()){
        			$this->load->model('reports/Inventory_compare');
		            $model = $this->Inventory_compare;
		            if (!$model->exist_inventory()){ redirect('inventories_compare'); }
		        }
			}
		}
		//Modelos a utilizar
		$this->load->model('reports/Inventory_low');
		$this->load->model('Transfers');
		$this->load->model('reports/Detailed_receivings');
		$this->Receiving->con=$this->Detailed_receivings->stabledb($this->session->userdata('dblocation'),true);
		$this->Receiving->create_receivings_items_temp_table();

		//load up global data
		$logged_in_employee_info=$this->Employee->get_logged_in_employee_info();
		$data['allowed_modules']=$this->Module->get_allowed_modules($logged_in_employee_info->person_id);
		$data['user_info']=$logged_in_employee_info;

		//Notificaciones
		$data['notifications']['inventory_low']['url']= 'reports/inventory_low/0/';
		$data['notifications']['inventory_low']['title']= 'Products with low stock!';
		$data['notifications']['inventory_low']['data']= $this->Inventory_low->getData(array());
		if ($this->Transfers->available()) {
			$data['notifications']['shippings']['url'] = 'reports/shippings';
			$data['notifications']['shippings']['title'] = 'Delivery to receive';
			$data['notifications']['shippings']['data'] = $this->Transfers->get_my_reception();
		}
		$data['notifications']['accounts_payable']['url']= 'reports/accounts_payable/0/';
		$data['notifications']['accounts_payable']['title']= $this->lang->line('reports_accounts_payable');
		$data['notifications']['accounts_payable']['data']= array_merge($this->Detailed_receivings->getData(array(),true), $this->Transfers->transfers_receivable());
		$data['notifications']['accounts_receivable']['url']= 'reports/accounts_receivable/0/';
		$data['notifications']['accounts_receivable']['title']= $this->lang->line('reports_accounts_receivable');
		$data['notifications']['accounts_receivable']['data']= $this->Transfers->transfers_receivable('sender');
		//Carga de variables
		$this->load->vars($data);
	}
}
?>