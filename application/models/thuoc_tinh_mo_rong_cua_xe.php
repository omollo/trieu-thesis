<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Thuoc_tinh_mo_rong_cua_xe extends Model {

      //Type: String
    var $so_dang_ky_xe = '';

	  //Type: String
    var $ten = '';

	  //Type: String
    var $gia_tri = '';

	
    function Thuoc_tinh_mo_rong_cua_xe()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->thuoc_tinh_mo_rong_cua_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                $this->thuoc_tinh_mo_rong_cua_xe->ten = $this->input->xss_clean($this->input->post('ten'));
                $this->thuoc_tinh_mo_rong_cua_xe->gia_tri = $this->input->xss_clean($this->input->post('gia_tri'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Thuoc_tinh_mo_rong_cua_xe->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->so_dang_ky_xe)
        {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
        }
                if ($this->ten)
        {
            $this->db->where("ten", $this->ten);
        }
                if ($this->gia_tri)
        {
            $this->db->where("gia_tri", $this->gia_tri);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("thuoc_tinh_mo_rong_cua_xe");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("thuoc_tinh_mo_rong_cua_xe")->result_array();

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
        $count = $this->db->count_all('thuoc_tinh_mo_rong_cua_xe');

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

        $objects = $this->db->get("thuoc_tinh_mo_rong_cua_xe")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->so_dang_ky_xe);
                            array_push($cell, $obj->ten);
                            array_push($cell, $obj->gia_tri);
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
                    "ten" => $this->ten,
                    "gia_tri" => $this->gia_tri,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("thuoc_tinh_mo_rong_cua_xe","so_dang_ky_xe", $this->so_dang_ky_xe))
        {
            $this->db->trans_start();
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
            $this->db->update("thuoc_tinh_mo_rong_cua_xe", $db_array);
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
        if ($this->isUsedKey("thuoc_tinh_mo_rong_cua_xe","ten", $this->ten))
        {
            $this->db->trans_start();
            $this->db->where("ten", $this->ten);
            $this->db->update("thuoc_tinh_mo_rong_cua_xe", $db_array);
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
        $this->db->insert("thuoc_tinh_mo_rong_cua_xe", $db_array);
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
                 $this->thuoc_tinh_mo_rong_cua_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                    $this->thuoc_tinh_mo_rong_cua_xe->ten = $this->input->xss_clean($this->input->post('ten'));
                    $this->thuoc_tinh_mo_rong_cua_xe->gia_tri = $this->input->xss_clean($this->input->post('gia_tri'));
        
        return $this->save();
    }

    function update()
    {
            $this->thuoc_tinh_mo_rong_cua_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
            $this->thuoc_tinh_mo_rong_cua_xe->ten = $this->input->xss_clean($this->input->post('ten'));
            $this->thuoc_tinh_mo_rong_cua_xe->gia_tri = $this->input->xss_clean($this->input->post('gia_tri'));
    
        return $this->save();
    }

    function delete()
    {
                $this->thuoc_tinh_mo_rong_cua_xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
                    $this->thuoc_tinh_mo_rong_cua_xe->ten = $this->input->xss_clean($this->input->post('ten'));
                
        $saveSuccess = false;
         // As long as thuoc_tinh_mo_rong_cua_xe->so_dang_ky_xe was set in the controller, we will delete the record.
        if ($this->so_dang_ky_xe) {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
            $this->db->delete("thuoc_tinh_mo_rong_cua_xe");
            if($this->db->affected_rows() > 0) {
                $saveSuccess = true;
            }
            else {
                $saveSuccess = false;
            }
        }
          // As long as thuoc_tinh_mo_rong_cua_xe->ten was set in the controller, we will delete the record.
        if ($this->ten) {
            $this->db->where("ten", $this->ten);
            $this->db->delete("thuoc_tinh_mo_rong_cua_xe");
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