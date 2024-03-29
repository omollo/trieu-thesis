<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Van_don extends Model {

      //Type: Long
    var $so_van_don = '';

	  //Type: Integer
    var $stt_khachhang = '';

	  //Type: 
    var $ngay_van_don = '';

	  //Type: Double
    var $tong_khoi_luong = '';

	  //Type: Double
    var $tong_cuoc = '';

	  //Type: String
    var $chuthich = '';

	
    function Van_don()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
                $this->van_don->stt_khachhang = $this->input->xss_clean($this->input->post('stt_khachhang'));
                $this->van_don->ngay_van_don = $this->input->xss_clean($this->input->post('ngay_van_don'));
                $this->van_don->tong_khoi_luong = $this->input->xss_clean($this->input->post('tong_khoi_luong'));
                $this->van_don->tong_cuoc = $this->input->xss_clean($this->input->post('tong_cuoc'));
                $this->van_don->chuthich = $this->input->xss_clean($this->input->post('chuthich'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Van_don->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->so_van_don)
        {
            $this->db->where("so_van_don", $this->so_van_don);
        }
                if ($this->stt_khachhang)
        {
            $this->db->where("stt_khachhang", $this->stt_khachhang);
        }
                if ($this->ngay_van_don)
        {
            $this->db->where("ngay_van_don", $this->ngay_van_don);
        }
                if ($this->tong_khoi_luong)
        {
            $this->db->where("tong_khoi_luong", $this->tong_khoi_luong);
        }
                if ($this->tong_cuoc)
        {
            $this->db->where("tong_cuoc", $this->tong_cuoc);
        }
                if ($this->chuthich)
        {
            $this->db->where("chuthich", $this->chuthich);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("van_don");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("van_don")->result_array();

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
        $count = $this->db->count_all('van_don');

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

        $objects = $this->db->get("van_don")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->so_van_don);
                            array_push($cell, $obj->stt_khachhang);
                            array_push($cell, $obj->ngay_van_don);
                            array_push($cell, $obj->tong_khoi_luong);
                            array_push($cell, $obj->tong_cuoc);
                            array_push($cell, $obj->chuthich);
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
                    "stt_khachhang" => $this->stt_khachhang,
                    "ngay_van_don" => $this->ngay_van_don,
                    "tong_khoi_luong" => $this->tong_khoi_luong,
                    "tong_cuoc" => $this->tong_cuoc,
                    "chuthich" => $this->chuthich,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("van_don","so_van_don", $this->so_van_don))
        {
            $this->db->trans_start();
            $this->db->where("so_van_don", $this->so_van_don);
            $this->db->update("van_don", $db_array);
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
        $this->db->insert("van_don", $db_array);
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
                 $this->van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
                    $this->van_don->stt_khachhang = $this->input->xss_clean($this->input->post('stt_khachhang'));
                    $this->van_don->ngay_van_don = $this->input->xss_clean($this->input->post('ngay_van_don'));
                    $this->van_don->tong_khoi_luong = $this->input->xss_clean($this->input->post('tong_khoi_luong'));
                    $this->van_don->tong_cuoc = $this->input->xss_clean($this->input->post('tong_cuoc'));
                    $this->van_don->chuthich = $this->input->xss_clean($this->input->post('chuthich'));
        
        return $this->save();
    }

    function update()
    {
            $this->van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
            $this->van_don->stt_khachhang = $this->input->xss_clean($this->input->post('stt_khachhang'));
            $this->van_don->ngay_van_don = $this->input->xss_clean($this->input->post('ngay_van_don'));
            $this->van_don->tong_khoi_luong = $this->input->xss_clean($this->input->post('tong_khoi_luong'));
            $this->van_don->tong_cuoc = $this->input->xss_clean($this->input->post('tong_cuoc'));
            $this->van_don->chuthich = $this->input->xss_clean($this->input->post('chuthich'));
    
        return $this->save();
    }

    function delete()
    {
                $this->van_don->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
                                                
        $saveSuccess = false;
         // As long as van_don->so_van_don was set in the controller, we will delete the record.
        if ($this->so_van_don) {
            $this->db->where("so_van_don", $this->so_van_don);
            $this->db->delete("van_don");
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