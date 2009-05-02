<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Chi_tiet_van_don extends Model {

    //Type: Long
    var $so_van_don = '';

    //Type: Long
    var $ms_hanghoa = '';

    //Type: String
    var $ma_chuyen = '';

    //Type: Long
    var $ms_loaihang = '';

    //Type: String
    var $ten_hang = '';

    //Type: Integer
    var $so_luong = '';

    //Type: Double
    var $khoi_luong = '';

    //Type:
    var $quy_cach_dong_goi = '';

    //Type:
    var $trangthai_hanghoa = '';

    //Type: String
    var $nguoinhan = '';

    //Type: String
    var $diachi_nhan = '';

    //Type: Double
    var $cuoc = '';


    function Chi_tiet_van_don()
    {
        parent::Model();
    }

    function setFilterField()
    {
        $this->chi_tiet_van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
        $this->chi_tiet_van_don->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
        $this->chi_tiet_van_don->ma_chuyen = $this->input->xss_clean($this->input->post('ma_chuyen'));
        $this->chi_tiet_van_don->ms_loaihang = $this->input->xss_clean($this->input->post('ms_loaihang'));
        $this->chi_tiet_van_don->ten_hang = $this->input->xss_clean($this->input->post('ten_hang'));
        $this->chi_tiet_van_don->so_luong = $this->input->xss_clean($this->input->post('so_luong'));
        $this->chi_tiet_van_don->khoi_luong = $this->input->xss_clean($this->input->post('khoi_luong'));
        $this->chi_tiet_van_don->quy_cach_dong_goi = $this->input->xss_clean($this->input->post('quy_cach_dong_goi'));
        $this->chi_tiet_van_don->trangthai_hanghoa = $this->input->xss_clean($this->input->post('trangthai_hanghoa'));
        $this->chi_tiet_van_don->nguoinhan = $this->input->xss_clean($this->input->post('nguoinhan'));
        $this->chi_tiet_van_don->diachi_nhan = $this->input->xss_clean($this->input->post('diachi_nhan'));
        $this->chi_tiet_van_don->cuoc = $this->input->xss_clean($this->input->post('cuoc'));


        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Chi_tiet_van_don->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

        if ($this->so_van_don)
        {
            $this->db->where("so_van_don", $this->so_van_don);
        }
        if ($this->ms_hanghoa)
        {
            $this->db->where("ms_hanghoa", $this->ms_hanghoa);
        }
        if ($this->ma_chuyen)
        {
            $this->db->where("ma_chuyen", $this->ma_chuyen);
        }
        if ($this->ms_loaihang)
        {
            $this->db->where("ms_loaihang", $this->ms_loaihang);
        }
        if ($this->ten_hang)
        {
            $this->db->where("ten_hang", $this->ten_hang);
        }
        if ($this->so_luong)
        {
            $this->db->where("so_luong", $this->so_luong);
        }
        if ($this->khoi_luong)
        {
            $this->db->where("khoi_luong", $this->khoi_luong);
        }
        if ($this->quy_cach_dong_goi)
        {
            $this->db->where("quy_cach_dong_goi", $this->quy_cach_dong_goi);
        }
        if ($this->trangthai_hanghoa)
        {
            $this->db->where("trangthai_hanghoa", $this->trangthai_hanghoa);
        }
        if ($this->nguoinhan)
        {
            $this->db->where("nguoinhan", $this->nguoinhan);
        }
        if ($this->diachi_nhan)
        {
            $this->db->where("diachi_nhan", $this->diachi_nhan);
        }
        if ($this->cuoc)
        {
            $this->db->where("cuoc", $this->cuoc);
        }

        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.

        $query = $this->db->get("chi_tiet_van_don");

        $this->load->library('table');
        $tmpl = array ( 'table_open'  => '<table border="1" cellpadding="2" cellspacing="1" class="mytable">' );
        $this->table->set_template($tmpl);
        echo $this->table->generate($query);

        // return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  )
        $this->db->like($field_name, $term);

        $objects = $this->db->get("chi_tiet_van_don")->result_array();

        foreach($objects as $obj)
        {
            echo $obj[$field_name]."\n";
        }
    }


    //TODO: check XSS and SQL injection here
    function readByPagination()
    {
        $limit = $this->input->post('rows');
        $page = $this->input->post('page');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        if(!$sidx) $sidx =1;
        $count = $this->db->count_all('chi_tiet_van_don');

        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
        $page=$total_pages;
        $start = $limit * $page - $limit;

        $this->db->limit($limit, $start);
        $this->db->order_by("$sidx", "$sord");
        $this->setFilterField();

        $objects = $this->db->get("chi_tiet_van_don")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
            array_push($cell, $obj->so_van_don);
            array_push($cell, $obj->ms_hanghoa);
            array_push($cell, $obj->ma_chuyen);
            array_push($cell, $obj->ms_loaihang);
            array_push($cell, $obj->ten_hang);
            array_push($cell, $obj->so_luong);
            array_push($cell, $obj->khoi_luong);
            array_push($cell, $obj->quy_cach_dong_goi);
            array_push($cell, $obj->trangthai_hanghoa);
            array_push($cell, $obj->nguoinhan);
            array_push($cell, $obj->diachi_nhan);
            array_push($cell, $obj->cuoc);
            $row = new stdClass();
            $row->id = $cell[0];
            $row->cell = $cell;
            array_push($rows, $row);
        }

        $jsonObject = new stdClass();
        $jsonObject->page =  $page;
        $jsonObject->total = $total_pages;
        $jsonObject->records = $count;
        $jsonObject->rows = $rows;

        return $jsonObject;
    }

    private function isUsedKey($table,$keyName, $keyValue) {
        if($keyValue)  {
            $this->db->where($keyName, $keyValue);
            $rows = $this->db->get($table)->result();
            return sizeof($rows)==1;
        }
        return false;
    }

    private function save()
    {
        // When we insert or update a record in CodeIgniter, we pass the results as an array:
        $db_array = array(
                "so_van_don" => $this->so_van_don,
                    "ms_hanghoa" => $this->ms_hanghoa,
                    "ma_chuyen" => $this->ma_chuyen,
                    "ms_loaihang" => $this->ms_loaihang,
                    "ten_hang" => $this->ten_hang,
                    "so_luong" => $this->so_luong,
                    "khoi_luong" => $this->khoi_luong,
                    "quy_cach_dong_goi" => $this->quy_cach_dong_goi,
                    "trangthai_hanghoa" => $this->trangthai_hanghoa,
                    "nguoinhan" => $this->nguoinhan,
                    "diachi_nhan" => $this->diachi_nhan,
                    "cuoc" => $this->cuoc,
        );

        $saveSuccess = false;

        // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("chi_tiet_van_don","so_van_don", $this->so_van_don))
        {
            $this->db->trans_start();
            $this->db->where("so_van_don", $this->so_van_don);
            $this->db->update("chi_tiet_van_don", $db_array);
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
            $this->db->trans_complete();
            return $saveSuccess;
        }
        // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("chi_tiet_van_don","ms_hanghoa", $this->ms_hanghoa))
        {
            $this->db->trans_start();
            $this->db->where("ms_hanghoa", $this->ms_hanghoa);
            $this->db->update("chi_tiet_van_don", $db_array);
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
            $this->db->trans_complete();
            return $saveSuccess;
        }

        // If key was not set in the controller, then we will insert a new record.
        $this->db->trans_start();
        $this->db->insert("chi_tiet_van_don", $db_array);
        if($this->db->affected_rows() > 0) {
            $saveSuccess = true;
        }
        else {
            $saveSuccess = false;
        }
        $this->db->trans_complete();
        return $saveSuccess;
    }

    function create()
    {
        $this->chi_tiet_van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
        $this->chi_tiet_van_don->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
        $this->chi_tiet_van_don->ma_chuyen = $this->input->xss_clean($this->input->post('ma_chuyen'));
        $this->chi_tiet_van_don->ms_loaihang = $this->input->xss_clean($this->input->post('ms_loaihang'));
        $this->chi_tiet_van_don->ten_hang = $this->input->xss_clean($this->input->post('ten_hang'));
        $this->chi_tiet_van_don->so_luong = $this->input->xss_clean($this->input->post('so_luong'));
        $this->chi_tiet_van_don->khoi_luong = $this->input->xss_clean($this->input->post('khoi_luong'));
        $this->chi_tiet_van_don->quy_cach_dong_goi = $this->input->xss_clean($this->input->post('quy_cach_dong_goi'));
        $this->chi_tiet_van_don->trangthai_hanghoa = $this->input->xss_clean($this->input->post('trangthai_hanghoa'));
        $this->chi_tiet_van_don->nguoinhan = $this->input->xss_clean($this->input->post('nguoinhan'));
        $this->chi_tiet_van_don->diachi_nhan = $this->input->xss_clean($this->input->post('diachi_nhan'));
        $this->chi_tiet_van_don->cuoc = $this->input->xss_clean($this->input->post('cuoc'));

        return $this->save();
    }

    function update()
    {
        $this->chi_tiet_van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
        $this->chi_tiet_van_don->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
        $this->chi_tiet_van_don->ma_chuyen = $this->input->xss_clean($this->input->post('ma_chuyen'));
        $this->chi_tiet_van_don->ms_loaihang = $this->input->xss_clean($this->input->post('ms_loaihang'));
        $this->chi_tiet_van_don->ten_hang = $this->input->xss_clean($this->input->post('ten_hang'));
        $this->chi_tiet_van_don->so_luong = $this->input->xss_clean($this->input->post('so_luong'));
        $this->chi_tiet_van_don->khoi_luong = $this->input->xss_clean($this->input->post('khoi_luong'));
        $this->chi_tiet_van_don->quy_cach_dong_goi = $this->input->xss_clean($this->input->post('quy_cach_dong_goi'));
        $this->chi_tiet_van_don->trangthai_hanghoa = $this->input->xss_clean($this->input->post('trangthai_hanghoa'));
        $this->chi_tiet_van_don->nguoinhan = $this->input->xss_clean($this->input->post('nguoinhan'));
        $this->chi_tiet_van_don->diachi_nhan = $this->input->xss_clean($this->input->post('diachi_nhan'));
        $this->chi_tiet_van_don->cuoc = $this->input->xss_clean($this->input->post('cuoc'));

        return $this->save();
    }

    function delete()
    {
        $this->chi_tiet_van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
        $this->chi_tiet_van_don->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));

        $saveSuccess = false;
        // As long as chi_tiet_van_don->so_van_don was set in the controller, we will delete the record.
        if ($this->so_van_don) {
            $this->db->where("so_van_don", $this->so_van_don);
            $this->db->delete("chi_tiet_van_don");
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
        }
        // As long as chi_tiet_van_don->ms_hanghoa was set in the controller, we will delete the record.
        if ($this->ms_hanghoa) {
            $this->db->where("ms_hanghoa", $this->ms_hanghoa);
            $this->db->delete("chi_tiet_van_don");
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
        }
        return $saveSuccess;
    }
}

?>