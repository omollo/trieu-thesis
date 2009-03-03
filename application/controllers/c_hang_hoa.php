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
* @property Hang_hoa $hang_hoa*/ 

class c_Hang_hoa extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Hang_hoa()
    {
         parent::Controller();
         $this->load->model('hang_hoa');
         $this->load->model('VehicleDBUtils');

         $this->load->helper('form');
         $this->load->helper('object2array');
         $this->load->helper('url');
         $this->load->library('form_validation');
    }

    function index()
    {       
        $this->load->view('scaffolding_form/v_hang_hoa');        
    }  

    function readHang_hoa($priKey)
    {
        if(isset ($priKey))
        {
                   $this->hang_hoa->ms_hanghoa = $priKey;
                                                                                                
            $rows = $this->hang_hoa->read();
            foreach($rows as $row)
            {
                        echo $row->ms_hanghoa."<br>";
                        echo $row->stt_khachhang."<br>";
                        echo $row->ten_hanghoa."<br>";
                        echo $row->soluong."<br>";
                        echo $row->donvitinh."<br>";
                        echo $row->loaihang."<br>";
                        }
         }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->hang_hoa->keyAutoComplete($field_name);
        else
         echo "";
    }

    function create()
    {
        if($this->hang_hoa->create())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_hang_hoa');
    }

    function read_json_format()
    {
        echo json_encode($this->hang_hoa->readByPagination());
    }

    function update()
    {       
        if($this->hang_hoa->update())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;        
    }

    function delete()
    {
        if($this->hang_hoa->delete())
            echo $this->messageSuccess;
        else
            echo $this->messageFail;
    }


    
}
?>