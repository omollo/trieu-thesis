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
* @property Van_don $van_don*/ 

class c_Van_don extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Van_don()
    {
         parent::Controller();
         $this->load->model('van_don');
         $this->load->model('VehicleDBUtils');

         $this->load->helper('form');
         $this->load->helper('object2array');
         $this->load->helper('url');
         $this->load->library('form_validation');
    }

    function index()
    {       
        $this->load->view('scaffolding_form/v_van_don');        
    }  

    function readVan_don($priKey)
    {
        if(isset ($priKey))
        {
                   $this->van_don->so_van_don = $priKey;
                                                                                                
            $rows = $this->van_don->read();
            foreach($rows as $row)
            {
                        echo $row->so_van_don."<br>";
                        echo $row->stt_khachhang."<br>";
                        echo $row->ngay_van_don."<br>";
                        echo $row->tong_khoi_luong."<br>";
                        echo $row->tong_cuoc."<br>";
                        echo $row->chuthich."<br>";
                        }
         }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->van_don->keyAutoComplete($field_name);
        else
         echo "";
    }

    function create()
    {
        if($this->van_don->create())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_van_don');
    }

    function read_json_format()
    {
        echo json_encode($this->van_don->readByPagination());
    }

    function update()
    {       
        if($this->van_don->update())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;        
    }

    function delete()
    {
        if($this->van_don->delete())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }


    
}
?>