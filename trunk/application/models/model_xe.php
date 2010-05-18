<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Model_xe extends Model {

      //Type: String
    var $ms_model_xe = '';

	  //Type: String
    var $loai_model = '';

	  //Type: String
    var $nhan_hieu = '';

	  //Type: String
    var $ms_thue = '';

	  //Type: String
    var $nhienlieu = '';

	  //Type: Double
    var $trongtai = '';

	  //Type: Float
    var $dientich_san = '';

	  //Type: String
    var $loaixe = '';

	
    function Model_xe()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->model_xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
                $this->model_xe->loai_model = $this->input->xss_clean($this->input->post('loai_model'));
                $this->model_xe->nhan_hieu = $this->input->xss_clean($this->input->post('nhan_hieu'));
                $this->model_xe->ms_thue = $this->input->xss_clean($this->input->post('ms_thue'));
                $this->model_xe->nhienlieu = $this->input->xss_clean($this->input->post('nhienlieu'));
                $this->model_xe->trongtai = $this->input->xss_clean($this->input->post('trongtai'));
                $this->model_xe->dientich_san = $this->input->xss_clean($this->input->post('dientich_san'));
                $this->model_xe->loaixe = $this->input->xss_clean($this->input->post('loaixe'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Model_xe->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->ms_model_xe)
        {
            $this->db->where("ms_model_xe", $this->ms_model_xe);
        }
                if ($this->loai_model)
        {
            $this->db->where("loai_model", $this->loai_model);
        }
                if ($this->nhan_hieu)
        {
            $this->db->where("nhan_hieu", $this->nhan_hieu);
        }
                if ($this->ms_thue)
        {
            $this->db->where("ms_thue", $this->ms_thue);
        }
                if ($this->nhienlieu)
        {
            $this->db->where("nhienlieu", $this->nhienlieu);
        }
                if ($this->trongtai)
        {
            $this->db->where("trongtai", $this->trongtai);
        }
                if ($this->dientich_san)
        {
            $this->db->where("dientich_san", $this->dientich_san);
        }
                if ($this->loaixe)
        {
            $this->db->where("loaixe", $this->loaixe);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("model_xe");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("model_xe")->result_array();

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
        $count = $this->db->count_all('model_xe');

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

        $objects = $this->db->get("model_xe")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->ms_model_xe);
                            array_push($cell, $obj->loai_model);
                            array_push($cell, $obj->nhan_hieu);
                            array_push($cell, $obj->ms_thue);
                            array_push($cell, $obj->nhienlieu);
                            array_push($cell, $obj->trongtai);
                            array_push($cell, $obj->dientich_san);
                            array_push($cell, $obj->loaixe);
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
                "ms_model_xe" => $this->ms_model_xe,
                    "loai_model" => $this->loai_model,
                    "nhan_hieu" => $this->nhan_hieu,
                    "ms_thue" => $this->ms_thue,
                    "nhienlieu" => $this->nhienlieu,
                    "trongtai" => $this->trongtai,
                    "dientich_san" => $this->dientich_san,
                    "loaixe" => $this->loaixe,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("model_xe","ms_model_xe", $this->ms_model_xe))
        {
            $this->db->trans_start();
            $this->db->where("ms_model_xe", $this->ms_model_xe);
            $this->db->update("model_xe", $db_array);
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
        $this->db->insert("model_xe", $db_array);
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
                 $this->model_xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
                    $this->model_xe->loai_model = $this->input->xss_clean($this->input->post('loai_model'));
                    $this->model_xe->nhan_hieu = $this->input->xss_clean($this->input->post('nhan_hieu'));
                    $this->model_xe->ms_thue = $this->input->xss_clean($this->input->post('ms_thue'));
                    $this->model_xe->nhienlieu = $this->input->xss_clean($this->input->post('nhienlieu'));
                    $this->model_xe->trongtai = $this->input->xss_clean($this->input->post('trongtai'));
                    $this->model_xe->dientich_san = $this->input->xss_clean($this->input->post('dientich_san'));
                    $this->model_xe->loaixe = $this->input->xss_clean($this->input->post('loaixe'));
        
        return $this->save();
    }

    function update()
    {
            $this->model_xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
            $this->model_xe->loai_model = $this->input->xss_clean($this->input->post('loai_model'));
            $this->model_xe->nhan_hieu = $this->input->xss_clean($this->input->post('nhan_hieu'));
            $this->model_xe->ms_thue = $this->input->xss_clean($this->input->post('ms_thue'));
            $this->model_xe->nhienlieu = $this->input->xss_clean($this->input->post('nhienlieu'));
            $this->model_xe->trongtai = $this->input->xss_clean($this->input->post('trongtai'));
            $this->model_xe->dientich_san = $this->input->xss_clean($this->input->post('dientich_san'));
            $this->model_xe->loaixe = $this->input->xss_clean($this->input->post('loaixe'));
    
        return $this->save();
    }

    function delete()
    {
                $this->model_xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
                                                                
        $saveSuccess = false;
         // As long as model_xe->ms_model_xe was set in the controller, we will delete the record.
        if ($this->ms_model_xe) {
            $this->db->where("ms_model_xe", $this->ms_model_xe);
            $this->db->delete("model_xe");
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