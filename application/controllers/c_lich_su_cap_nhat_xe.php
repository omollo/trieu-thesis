<?php
//Controller is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
* @property VehicleDBUtils $VehicleDBUtils
* @property Lich_su_cap_nhat_xe $lich_su_cap_nhat_xe*/ 

class c_Lich_su_cap_nhat_xe extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Lich_su_cap_nhat_xe()
    {
         parent::Controller();
         $this->load->model('lich_su_cap_nhat_xe');
         $this->load->model('VehicleDBUtils');

         $this->load->helper('form');
         $this->load->helper('object2array');
         $this->load->helper('url');
         $this->load->library('form_validation');
    }

    function index()
    {       
        $this->load->view('scaffolding_form/v_lich_su_cap_nhat_xe');        
    }  

    function readLich_su_cap_nhat_xe($priKey)
    {
        if(isset ($priKey))
        {
                   $this->lich_su_cap_nhat_xe->stt_cap_nhat = $priKey;
                                                                                
            $rows = $this->lich_su_cap_nhat_xe->read();
            foreach($rows as $row)
            {
                        echo $row->stt_cap_nhat."<br>";
                        echo $row->so_dang_ky_xe."<br>";
                        echo $row->ngay_cap_nhat."<br>";
                        echo $row->ten."<br>";
                        echo $row->gia_tri."<br>";
                        }
         }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->lich_su_cap_nhat_xe->keyAutoComplete($field_name);
        else
         echo "";
    }

    function create()
    {
        if($this->lich_su_cap_nhat_xe->create())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_lich_su_cap_nhat_xe');
    }

    function read_json_format()
    {
        echo json_encode($this->lich_su_cap_nhat_xe->readByPagination());
    }

    function update()
    {       
        if($this->lich_su_cap_nhat_xe->update())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;        
    }

    function delete()
    {
        if($this->lich_su_cap_nhat_xe->delete())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }


    
}
?>