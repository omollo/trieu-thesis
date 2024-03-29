<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Bao_duong_xe extends Model {

      //Type: Long
    var $stt_kmbd = '';

	  //Type: String
    var $so_dang_ky_xe = '';

	  //Type: String
    var $khoang_muc_bao_duong = '';

	  //Type: 
    var $thoi_gian = '';

	  //Type: Double
    var $speedometer = '';

	
    function Bao_duong_xe()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->bao_duong_xe->stt_kmbd = $this->input->xss_clean($this->input->post('stt_kmbd'));
                $this->bao_duong_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                $this->bao_duong_xe->khoang_muc_bao_duong = $this->input->xss_clean($this->input->post('khoang_muc_bao_duong'));
                $this->bao_duong_xe->thoi_gian = $this->input->xss_clean($this->input->post('thoi_gian'));
                $this->bao_duong_xe->speedometer = $this->input->xss_clean($this->input->post('speedometer'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Bao_duong_xe->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->stt_kmbd)
        {
            $this->db->where("stt_kmbd", $this->stt_kmbd);
        }
                if ($this->so_dang_ky_xe)
        {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
        }
                if ($this->khoang_muc_bao_duong)
        {
            $this->db->where("khoang_muc_bao_duong", $this->khoang_muc_bao_duong);
        }
                if ($this->thoi_gian)
        {
            $this->db->where("thoi_gian", $this->thoi_gian);
        }
                if ($this->speedometer)
        {
            $this->db->where("speedometer", $this->speedometer);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("bao_duong_xe");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  && $field_name != "stt_kmbd"   )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("bao_duong_xe")->result_array();

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
        $count = $this->db->count_all('bao_duong_xe');

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

        $objects = $this->db->get("bao_duong_xe")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->stt_kmbd);
                            array_push($cell, $obj->so_dang_ky_xe);
                            array_push($cell, $obj->khoang_muc_bao_duong);
                            array_push($cell, $obj->thoi_gian);
                            array_push($cell, $obj->speedometer);
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
                    "khoang_muc_bao_duong" => $this->khoang_muc_bao_duong,
                    "thoi_gian" => $this->thoi_gian,
                    "speedometer" => $this->speedometer,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->stt_kmbd)
        {
            $this->db->trans_start();
            $this->db->where("stt_kmbd", $this->stt_kmbd);
            $this->db->update("bao_duong_xe", $db_array);
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
        if ($this->isUsedKey("bao_duong_xe","stt_kmbd", $this->stt_kmbd))
        {
            $this->db->trans_start();
            $this->db->where("stt_kmbd", $this->stt_kmbd);
            $this->db->update("bao_duong_xe", $db_array);
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
        $this->db->insert("bao_duong_xe", $db_array);
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
                         $this->bao_duong_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                    $this->bao_duong_xe->khoang_muc_bao_duong = $this->input->xss_clean($this->input->post('khoang_muc_bao_duong'));
                    $this->bao_duong_xe->thoi_gian = $this->input->xss_clean($this->input->post('thoi_gian'));
                    $this->bao_duong_xe->speedometer = $this->input->xss_clean($this->input->post('speedometer'));
        
        return $this->save();
    }

    function update()
    {
            $this->bao_duong_xe->stt_kmbd = $this->input->xss_clean($this->input->post('stt_kmbd'));
            $this->bao_duong_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
            $this->bao_duong_xe->khoang_muc_bao_duong = $this->input->xss_clean($this->input->post('khoang_muc_bao_duong'));
            $this->bao_duong_xe->thoi_gian = $this->input->xss_clean($this->input->post('thoi_gian'));
            $this->bao_duong_xe->speedometer = $this->input->xss_clean($this->input->post('speedometer'));
    
        return $this->save();
    }

    function delete()
    {
                $this->bao_duong_xe->stt_kmbd = $this->input->xss_clean($this->input->post('stt_kmbd'));
                                        
        $saveSuccess = false;
         // As long as bao_duong_xe->stt_kmbd was set in the controller, we will delete the record.
        if ($this->stt_kmbd) {
            $this->db->where("stt_kmbd", $this->stt_kmbd);
            $this->db->delete("bao_duong_xe");
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