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
* @property Chuyenhang $chuyenhang*/ 

class c_Chuyenhang extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_Chuyenhang()
    {
        parent::Controller();
        $this->load->model('chuyenhang');
        $this->load->model('VehicleDBUtils');

        $this->load->helper('form');
        $this->load->helper('object2array');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    function index()
    {
        $this->load->view('scaffolding_form/v_chuyenhang');
    }

    function readChuyenhang($priKey)
    {
        if(isset ($priKey))
        {
            $this->chuyenhang->so_dang_ky_xe = $priKey;
            $this->chuyenhang->ms_hanghoa = $priKey;
            $this->chuyenhang->ngay_nhanhang = $priKey;

            $rows = $this->chuyenhang->read();
            foreach($rows as $row)
            {
                echo $row->so_dang_ky_xe."<br>";
                echo $row->ms_hanghoa."<br>";
                echo $row->ngay_nhanhang."<br>";
                echo $row->diachi_nhanhang."<br>";
                echo $row->diachi_trahang."<br>";
                echo $row->soluong."<br>";
                echo $row->trang_thai."<br>";
            }
        }
    }

    function findChuyenhangByXe($sodkxe)
    {
        if(isset ($sodkxe))
        {
            $this->chuyenhang->so_dang_ky_xe = $sodkxe;   

            $rows = $this->chuyenhang->read();
            foreach($rows as $row)
            {
                echo $row->so_dang_ky_xe."<br>";
                echo $row->ms_hanghoa."<br>";
                echo $row->ngay_nhanhang."<br>";
                echo $row->diachi_nhanhang."<br>";
                echo $row->diachi_trahang."<br>";
                echo $row->soluong."<br>";
                echo $row->trang_thai."<br>";
            }
        }
    }

    function keyAutoComplete($field_name = "")
    {
        if($field_name != "")
        $this->chuyenhang->keyAutoComplete($field_name);
        else
        echo "";
    }

    function create()
    {
        if($this->chuyenhang->create())
        echo $this->messageSuccess;
        else
        echo $this->messageFail;
    }

    function read()
    {
        $this->load->view('v_chuyenhang');
    }

    function read_json_format()
    {
        echo json_encode($this->chuyenhang->readByPagination());
    }

    function update()
    {
        if($this->chuyenhang->update())
        echo $this->messageSuccess;
        else
        echo $this->messageFail;
    }

    function delete()
    {
        if($this->chuyenhang->delete())
        echo $this->messageSuccess;
        else
        echo $this->messageFail;
    }



}
?>