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
* @property Gps_markers $gps_markers*/ 

class c_Gps_markers extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Gps_markers()
    {
         parent::Controller();
         $this->load->model('gps_markers');
         $this->load->model('VehicleDBUtils');

         $this->load->helper('form');
         $this->load->helper('object2array');
         $this->load->helper('url');
         $this->load->library('form_validation');
    }

    function index()
    {       
        $this->load->view('scaffolding_form/v_gps_markers');        
    }  

    function readGps_markers($priKey)
    {
        if(isset ($priKey))
        {
                   $this->gps_markers->stt_diem = $priKey;
                                                                                                                                
            $rows = $this->gps_markers->read();
            foreach($rows as $row)
            {
                        echo $row->stt_diem."<br>";
                        echo $row->stt_nkht."<br>";
                        echo $row->so_dang_ky_xe."<br>";
                        echo $row->ngay_khoi_hanh."<br>";
                        echo $row->lat."<br>";
                        echo $row->lng."<br>";
                        echo $row->type."<br>";
                        echo $row->gps_time."<br>";
                        }
         }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->gps_markers->keyAutoComplete($field_name);
        else
         echo "";
    }

    function create()
    {
        if($this->gps_markers->create())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_gps_markers');
    }

    function read_json_format()
    {
        echo json_encode($this->gps_markers->readByPagination());
    }

    function update()
    {       
        if($this->gps_markers->update())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;        
    }

    function delete()
    {
        if($this->gps_markers->delete())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }


    
}
?>