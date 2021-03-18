<?php defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        
        // echo substr(current_url(), strlen(base_url()));die;
        // print_r(current_url());die;
            // print_r($this->session->userdata('module_page'));die;
    	if (!$this->session->userdata('logged_in')) {
    		redirect('login');
    	}

        if ($this->session->userdata('module_page') && $this->router->fetch_class() != 'dashboard') {
            $arr = explode('/', $this->session->userdata('module_page'));
            if ($arr[0] != $this->router->fetch_module()) {
                redirect('dashboard');
            }
        }
    	if ($this->router->fetch_class() == 'dashboard') {
    		$this->session->unset_userdata('module_id');
    	}

    	if (!$this->session->userdata('module_id') && $this->router->fetch_class() != 'dashboard') {
    		redirect('dashboard');
    	}

            // print_r($this->session->userdata('module_id'));die;
    	if ($this->session->userdata('module_id')) {

	    	$arrNavbar     = navBarFromAPI($this->session->userdata('module_id'));
            
            $module = json_decode($this->session->userdata('list_module'));
            // var_dump(checkAccess($arrNavbar, false, $module, $this->router->fetch_module()));die;
            if (!checkAccess($arrNavbar, false, $module, $this->router->fetch_module())) {
                redirect('dashboard');
            }
            $navbar = getNavBar($arrNavbar);
		    $this->data['navbar'] = $navbar;
    	}

    }
}
?>