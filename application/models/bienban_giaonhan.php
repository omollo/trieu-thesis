<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Bienban_giaonhan extends Model {

      //Type: Long
    var $so_bienban = '';

	  //Type: Long
    var $so_van_don = '';

	  //Type: 
    var $ngay_bienban = '';

	  //Type: String
    var $ten_nguoi_nhan = '';

	
    function Bienban_giaonhan()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->bienban_giaonhan->so_bienban = $this->input->xss_clean($this->input->post('so_bienban'));
                $this->bienban_giaonhan->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
                $this->bienban_giaonhan->ngay_bienban = $this->input->xss_clean($this->input->post('ngay_bienban'));
                $this->bienban_giaonhan->ten_nguoi_nhan = $this->input->xss_clean($this->input->post('ten_nguoi_nhan'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Bienban_giaonhan->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->so_bienban)
        {
            $this->db->where("so_bienban", $this->so_bienban);
        }
                if ($this->so_van_don)
        {
            $this->db->where("so_van_don", $this->so_van_don);
        }
                if ($this->ngay_bienban)
        {
            $this->db->where("ngay_bienban", $this->ngay_bienban);
        }
                if ($this->ten_nguoi_nhan)
        {
            $this->db->where("ten_nguoi_nhan", $this->ten_nguoi_nhan);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("bienban_giaonhan");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  && $field_name != "so_bienban"   )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("bienban_giaonhan")->result_array();

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
        $count = $this->db->count_all('bienban_giaonhan');

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

        $objects = $this->db->get("bienban_giaonhan")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->so_bienban);
                            array_push($cell, $obj->so_van_don);
                            array_push($cell, $obj->ngay_bienban);
                            array_push($cell, $obj->ten_nguoi_nhan);
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
                    "ngay_bienban" => $this->ngay_bienban,
                    "ten_nguoi_nhan" => $this->ten_nguoi_nhan,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->so_bienban)
        {
            $this->db->trans_start();
            $this->db->where("so_bienban", $this->so_bienban);
            $this->db->update("bienban_giaonhan", $db_array);
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
        if ($this->isUsedKey("bienban_giaonhan","so_bienban", $this->so_bienban))
        {
            $this->db->trans_start();
            $this->db->where("so_bienban", $this->so_bienban);
            $this->db->update("bienban_giaonhan", $db_array);
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
        if ($this->isUsedKey("bienban_giaonhan","so_van_don", $this->so_van_don))
        {
            $this->db->trans_start();
            $this->db->where("so_van_don", $this->so_van_don);
            $this->db->update("bienban_giaonhan", $db_array);
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
        $this->db->insert("bienban_giaonhan", $db_array);
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
                         $this->bienban_giaonhan->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
                    $this->bienban_giaonhan->ngay_bienban = $this->input->xss_clean($this->input->post('ngay_bienban'));
                    $this->bienban_giaonhan->ten_nguoi_nhan = $this->input->xss_clean($this->input->post('ten_nguoi_nhan'));
        
        return $this->save();
    }

    function update()
    {
            $this->bienban_giaonhan->so_bienban = $this->input->xss_clean($this->input->post('so_bienban'));
            $this->bienban_giaonhan->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
            $this->bienban_giaonhan->ngay_bienban = $this->input->xss_clean($this->input->post('ngay_bienban'));
            $this->bienban_giaonhan->ten_nguoi_nhan = $this->input->xss_clean($this->input->post('ten_nguoi_nhan'));
    
        return $this->save();
    }

    function delete()
    {
                $this->bienban_giaonhan->so_bienban = $this->input->xss_clean($this->input->post('so_bienban'));
                    $this->bienban_giaonhan->so_van_don = $this->input->xss_clean($this->input->post('so_van_don'));
                        
        $saveSuccess = false;
         // As long as bienban_giaonhan->so_bienban was set in the controller, we will delete the record.
        if ($this->so_bienban) {
            $this->db->where("so_bienban", $this->so_bienban);
            $this->db->delete("bienban_giaonhan");
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
        }
          // As long as bienban_giaonhan->so_van_don was set in the controller, we will delete the record.
        if ($this->so_van_don) {
            $this->db->where("so_van_don", $this->so_van_don);
            $this->db->delete("bienban_giaonhan");
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