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
* @property Nhan_vien $nhan_vien*/ 

class c_Nhan_vien extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Nhan_vien()
    {
         parent::Controller();
         $this->load->model('nhan_vien');
         $this->load->model('VehicleDBUtils');

         $this->load->helper('form');
         $this->load->helper('object2array');
         $this->load->helper('url');
         $this->load->library('form_validation');
    }

    function index()
    {       
        $this->load->view('scaffolding_form/v_nhan_vien');        
    }  

    function readNhan_vien($priKey)
    {
        if(isset ($priKey))
        {
                   $this->nhan_vien->stt_nhanvien = $priKey;
                                                                                                
            $rows = $this->nhan_vien->read();
            foreach($rows as $row)
            {
                        echo $row->stt_nhanvien."<br>";
                        echo $row->ho_ten."<br>";
                        echo $row->tendangnhap."<br>";
                        echo $row->matkhau."<br>";
                        echo $row->nhom."<br>";
                        echo $row->cong_viec."<br>";
                        }
         }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->nhan_vien->keyAutoComplete($field_name);
        else
         echo "";
    }

    function create()
    {
        if($this->nhan_vien->create())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_nhan_vien');
    }

    function read_json_format()
    {
        echo json_encode($this->nhan_vien->readByPagination());
    }

    function update()
    {       
        if($this->nhan_vien->update())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;        
    }

    function delete()
    {
        if($this->nhan_vien->delete())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }


    
}
?>