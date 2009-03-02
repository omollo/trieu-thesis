<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Gps_markers extends Model {

      //Type: Integer
    var $stt_diem = '';

	  //Type: Integer
    var $stt_nkht = '';

	  //Type: String
    var $so_dang_ky_xe = '';

	  //Type: 
    var $ngay_khoi_hanh = '';

	  //Type: Double
    var $lat = '';

	  //Type: Double
    var $lng = '';

	  //Type: String
    var $type = '';

	  //Type: Long
    var $gps_time = '';

	
    function Gps_markers()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->gps_markers->stt_diem = $this->input->xss_clean($this->input->post('stt_diem'));
                $this->gps_markers->stt_nkht = $this->input->xss_clean($this->input->post('stt_nkht'));
                $this->gps_markers->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                $this->gps_markers->ngay_khoi_hanh = $this->input->xss_clean($this->input->post('ngay_khoi_hanh'));
                $this->gps_markers->lat = $this->input->xss_clean($this->input->post('lat'));
                $this->gps_markers->lng = $this->input->xss_clean($this->input->post('lng'));
                $this->gps_markers->type = $this->input->xss_clean($this->input->post('type'));
                $this->gps_markers->gps_time = $this->input->xss_clean($this->input->post('gps_time'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Gps_markers->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->stt_diem)
        {
            $this->db->where("stt_diem", $this->stt_diem);
        }
                if ($this->stt_nkht)
        {
            $this->db->where("stt_nkht", $this->stt_nkht);
        }
                if ($this->so_dang_ky_xe)
        {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
        }
                if ($this->ngay_khoi_hanh)
        {
            $this->db->where("ngay_khoi_hanh", $this->ngay_khoi_hanh);
        }
                if ($this->lat)
        {
            $this->db->where("lat", $this->lat);
        }
                if ($this->lng)
        {
            $this->db->where("lng", $this->lng);
        }
                if ($this->type)
        {
            $this->db->where("type", $this->type);
        }
                if ($this->gps_time)
        {
            $this->db->where("gps_time", $this->gps_time);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("gps_markers");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  && $field_name != "stt_diem"   )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("gps_markers")->result_array();

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
        $count = $this->db->count_all('gps_markers');

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

        $objects = $this->db->get("gps_markers")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->stt_diem);
                            array_push($cell, $obj->stt_nkht);
                            array_push($cell, $obj->so_dang_ky_xe);
                            array_push($cell, $obj->ngay_khoi_hanh);
                            array_push($cell, $obj->lat);
                            array_push($cell, $obj->lng);
                            array_push($cell, $obj->type);
                            array_push($cell, $obj->gps_time);
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
                    "stt_nkht" => $this->stt_nkht,
                    "so_dang_ky_xe" => $this->so_dang_ky_xe,
                    "ngay_khoi_hanh" => $this->ngay_khoi_hanh,
                    "lat" => $this->lat,
                    "lng" => $this->lng,
                    "type" => $this->type,
                    "gps_time" => $this->gps_time,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->stt_diem)
        {
            $this->db->trans_start();
            $this->db->where("stt_diem", $this->stt_diem);
            $this->db->update("gps_markers", $db_array);
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
        if ($this->isUsedKey("gps_markers","stt_diem", $this->stt_diem))
        {
            $this->db->trans_start();
            $this->db->where("stt_diem", $this->stt_diem);
            $this->db->update("gps_markers", $db_array);
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
        $this->db->insert("gps_markers", $db_array);
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
                         $this->gps_markers->stt_nkht = $this->input->xss_clean($this->input->post('stt_nkht'));
                    $this->gps_markers->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                    $this->gps_markers->ngay_khoi_hanh = $this->input->xss_clean($this->input->post('ngay_khoi_hanh'));
                    $this->gps_markers->lat = $this->input->xss_clean($this->input->post('lat'));
                    $this->gps_markers->lng = $this->input->xss_clean($this->input->post('lng'));
                    $this->gps_markers->type = $this->input->xss_clean($this->input->post('type'));
                    $this->gps_markers->gps_time = $this->input->xss_clean($this->input->post('gps_time'));
        
        return $this->save();
    }

    function update()
    {
            $this->gps_markers->stt_diem = $this->input->xss_clean($this->input->post('stt_diem'));
            $this->gps_markers->stt_nkht = $this->input->xss_clean($this->input->post('stt_nkht'));
            $this->gps_markers->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
            $this->gps_markers->ngay_khoi_hanh = $this->input->xss_clean($this->input->post('ngay_khoi_hanh'));
            $this->gps_markers->lat = $this->input->xss_clean($this->input->post('lat'));
            $this->gps_markers->lng = $this->input->xss_clean($this->input->post('lng'));
            $this->gps_markers->type = $this->input->xss_clean($this->input->post('type'));
            $this->gps_markers->gps_time = $this->input->xss_clean($this->input->post('gps_time'));
    
        return $this->save();
    }

    function delete()
    {
                $this->gps_markers->stt_diem = $this->input->xss_clean($this->input->post('stt_diem'));
                                                                
        $saveSuccess = false;
         // As long as gps_markers->stt_diem was set in the controller, we will delete the record.
        if ($this->stt_diem) {
            $this->db->where("stt_diem", $this->stt_diem);
            $this->db->delete("gps_markers");
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