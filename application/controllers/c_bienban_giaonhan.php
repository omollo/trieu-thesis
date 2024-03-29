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
* @property Bienban_giaonhan $bienban_giaonhan*/ 

class c_Bienban_giaonhan extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Bienban_giaonhan()
    {
         parent::Controller();
         $this->load->model('bienban_giaonhan');
         $this->load->model('VehicleDBUtils');

         $this->load->helper('form');
         $this->load->helper('object2array');
         $this->load->helper('url');
         $this->load->library('form_validation');
    }

    function index()
    {       
        $this->load->view('scaffolding_form/v_bienban_giaonhan');        
    }  

    function readBienban_giaonhan($priKey)
    {
        if(isset ($priKey))
        {
                   $this->bienban_giaonhan->so_bienban = $priKey;
                           $this->bienban_giaonhan->so_van_don = $priKey;
                                                
            $rows = $this->bienban_giaonhan->read();
            foreach($rows as $row)
            {
                        echo $row->so_bienban."<br>";
                        echo $row->so_van_don."<br>";
                        echo $row->ngay_bienban."<br>";
                        echo $row->ten_nguoi_nhan."<br>";
                        }
         }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->bienban_giaonhan->keyAutoComplete($field_name);
        else
         echo "";
    }

    function create()
    {
        if($this->bienban_giaonhan->create())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_bienban_giaonhan');
    }

    function read_json_format()
    {
        echo json_encode($this->bienban_giaonhan->readByPagination());
    }

    function update()
    {       
        if($this->bienban_giaonhan->update())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;        
    }

    function delete()
    {
        if($this->bienban_giaonhan->delete())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }


    
}
?>