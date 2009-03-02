<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Chuyenhang extends Model {

      //Type: String
    var $so_dang_ky_xe = '';

	  //Type: String
    var $ms_hanghoa = '';

	  //Type: 
    var $ngay_nhanhang = '';

	  //Type: String
    var $diachi_nhanhang = '';

	  //Type: String
    var $diachi_trahang = '';

	  //Type: Integer
    var $soluong = '';

	  //Type: 
    var $trang_thai = '';

	
    function Chuyenhang()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->chuyenhang->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                $this->chuyenhang->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
                $this->chuyenhang->ngay_nhanhang = $this->input->xss_clean($this->input->post('ngay_nhanhang'));
                $this->chuyenhang->diachi_nhanhang = $this->input->xss_clean($this->input->post('diachi_nhanhang'));
                $this->chuyenhang->diachi_trahang = $this->input->xss_clean($this->input->post('diachi_trahang'));
                $this->chuyenhang->soluong = $this->input->xss_clean($this->input->post('soluong'));
                $this->chuyenhang->trang_thai = $this->input->xss_clean($this->input->post('trang_thai'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Chuyenhang->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->so_dang_ky_xe)
        {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
        }
                if ($this->ms_hanghoa)
        {
            $this->db->where("ms_hanghoa", $this->ms_hanghoa);
        }
                if ($this->ngay_nhanhang)
        {
            $this->db->where("ngay_nhanhang", $this->ngay_nhanhang);
        }
                if ($this->diachi_nhanhang)
        {
            $this->db->where("diachi_nhanhang", $this->diachi_nhanhang);
        }
                if ($this->diachi_trahang)
        {
            $this->db->where("diachi_trahang", $this->diachi_trahang);
        }
                if ($this->soluong)
        {
            $this->db->where("soluong", $this->soluong);
        }
                if ($this->trang_thai)
        {
            $this->db->where("trang_thai", $this->trang_thai);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("chuyenhang");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("chuyenhang")->result_array();

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
        $count = $this->db->count_all('chuyenhang');

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

        $objects = $this->db->get("chuyenhang")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->so_dang_ky_xe);
                            array_push($cell, $obj->ms_hanghoa);
                            array_push($cell, $obj->ngay_nhanhang);
                            array_push($cell, $obj->diachi_nhanhang);
                            array_push($cell, $obj->diachi_trahang);
                            array_push($cell, $obj->soluong);
                            array_push($cell, $obj->trang_thai);
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
                "so_dang_ky_xe" => $this->so_dang_ky_xe,
                    "ms_hanghoa" => $this->ms_hanghoa,
                    "ngay_nhanhang" => $this->ngay_nhanhang,
                    "diachi_nhanhang" => $this->diachi_nhanhang,
                    "diachi_trahang" => $this->diachi_trahang,
                    "soluong" => $this->soluong,
                    "trang_thai" => $this->trang_thai,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("chuyenhang","so_dang_ky_xe", $this->so_dang_ky_xe))
        {
            $this->db->trans_start();
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
            $this->db->update("chuyenhang", $db_array);
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
        if ($this->isUsedKey("chuyenhang","ms_hanghoa", $this->ms_hanghoa))
        {
            $this->db->trans_start();
            $this->db->where("ms_hanghoa", $this->ms_hanghoa);
            $this->db->update("chuyenhang", $db_array);
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
        if ($this->isUsedKey("chuyenhang","ngay_nhanhang", $this->ngay_nhanhang))
        {
            $this->db->trans_start();
            $this->db->where("ngay_nhanhang", $this->ngay_nhanhang);
            $this->db->update("chuyenhang", $db_array);
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
        $this->db->insert("chuyenhang", $db_array);
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
                 $this->chuyenhang->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                    $this->chuyenhang->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
                    $this->chuyenhang->ngay_nhanhang = $this->input->xss_clean($this->input->post('ngay_nhanhang'));
                    $this->chuyenhang->diachi_nhanhang = $this->input->xss_clean($this->input->post('diachi_nhanhang'));
                    $this->chuyenhang->diachi_trahang = $this->input->xss_clean($this->input->post('diachi_trahang'));
                    $this->chuyenhang->soluong = $this->input->xss_clean($this->input->post('soluong'));
                    $this->chuyenhang->trang_thai = $this->input->xss_clean($this->input->post('trang_thai'));
        
        return $this->save();
    }

    function update()
    {
            $this->chuyenhang->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
            $this->chuyenhang->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
            $this->chuyenhang->ngay_nhanhang = $this->input->xss_clean($this->input->post('ngay_nhanhang'));
            $this->chuyenhang->diachi_nhanhang = $this->input->xss_clean($this->input->post('diachi_nhanhang'));
            $this->chuyenhang->diachi_trahang = $this->input->xss_clean($this->input->post('diachi_trahang'));
            $this->chuyenhang->soluong = $this->input->xss_clean($this->input->post('soluong'));
            $this->chuyenhang->trang_thai = $this->input->xss_clean($this->input->post('trang_thai'));
    
        return $this->save();
    }

    function delete()
    {
                $this->chuyenhang->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                    $this->chuyenhang->ms_hanghoa = $this->input->xss_clean($this->input->post('ms_hanghoa'));
                    $this->chuyenhang->ngay_nhanhang = $this->input->xss_clean($this->input->post('ngay_nhanhang'));
                                        
        $saveSuccess = false;
         // As long as chuyenhang->so_dang_ky_xe was set in the controller, we will delete the record.
        if ($this->so_dang_ky_xe) {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
            $this->db->delete("chuyenhang");
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
        }
          // As long as chuyenhang->ms_hanghoa was set in the controller, we will delete the record.
        if ($this->ms_hanghoa) {
            $this->db->where("ms_hanghoa", $this->ms_hanghoa);
            $this->db->delete("chuyenhang");
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
        }
          // As long as chuyenhang->ngay_nhanhang was set in the controller, we will delete the record.
        if ($this->ngay_nhanhang) {
            $this->db->where("ngay_nhanhang", $this->ngay_nhanhang);
            $this->db->delete("chuyenhang");
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