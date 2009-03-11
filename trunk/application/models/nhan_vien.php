<?php
//Model is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Input $input
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/ 

class Nhan_vien extends Model {

      //Type: Long
    var $stt_nhanvien = '';

	  //Type: String
    var $ho_ten = '';

	  //Type: String
    var $tendangnhap = '';

	  //Type: String
    var $matkhau = '';

	  //Type: 
    var $nhom = '';

	  //Type: String
    var $cong_viec = '';

	
    function Nhan_vien()
    {
        parent::Model();
    }

    function setFilterField()
    {
                $this->nhan_vien->stt_nhanvien = $this->input->xss_clean($this->input->post('stt_nhanvien'));
                $this->nhan_vien->ho_ten = $this->input->xss_clean($this->input->post('ho_ten'));
                $this->nhan_vien->tendangnhap = $this->input->xss_clean($this->input->post('tendangnhap'));
                $this->nhan_vien->matkhau = $this->input->xss_clean($this->input->post('matkhau'));
                $this->nhan_vien->nhom = $this->input->xss_clean($this->input->post('nhom'));
                $this->nhan_vien->cong_viec = $this->input->xss_clean($this->input->post('cong_viec'));
        

        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Nhan_vien->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

                if ($this->stt_nhanvien)
        {
            $this->db->where("stt_nhanvien", $this->stt_nhanvien);
        }
                if ($this->ho_ten)
        {
            $this->db->where("ho_ten", $this->ho_ten);
        }
                if ($this->tendangnhap)
        {
            $this->db->where("tendangnhap", $this->tendangnhap);
        }
                if ($this->matkhau)
        {
            $this->db->where("matkhau", $this->matkhau);
        }
                if ($this->nhom)
        {
            $this->db->where("nhom", $this->nhom);
        }
                if ($this->cong_viec)
        {
            $this->db->where("cong_viec", $this->cong_viec);
        }
        
        // END FILTER CRITERIA CHECK
    }

    function read()
    {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("nhan_vien");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);



        if(true  && $field_name != "stt_nhanvien"   )
          $this->db->like($field_name, $term);     

        $objects = $this->db->get("nhan_vien")->result_array();

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
        $count = $this->db->count_all('nhan_vien');

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

        $objects = $this->db->get("nhan_vien")->result();
        $rows =  array();

        foreach($objects as $obj)
        {
            $cell = array();
                            array_push($cell, $obj->stt_nhanvien);
                            array_push($cell, $obj->ho_ten);
                            array_push($cell, $obj->tendangnhap);
                            array_push($cell, $obj->matkhau);
                            array_push($cell, $obj->nhom);
                            array_push($cell, $obj->cong_viec);
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
                    "ho_ten" => $this->ho_ten,
                    "tendangnhap" => $this->tendangnhap,
                    "matkhau" => $this->matkhau,
                    "nhom" => $this->nhom,
                    "cong_viec" => $this->cong_viec,
          );

      $saveSuccess = false;

         // If key was set in the controller, then we will update an existing record.
        if ($this->stt_nhanvien)
        {
            $this->db->trans_start();
            $this->db->where("stt_nhanvien", $this->stt_nhanvien);
            $this->db->update("nhan_vien", $db_array);
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
        if ($this->isUsedKey("nhan_vien","stt_nhanvien", $this->stt_nhanvien))
        {
            $this->db->trans_start();
            $this->db->where("stt_nhanvien", $this->stt_nhanvien);
            $this->db->update("nhan_vien", $db_array);
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
        $this->db->insert("nhan_vien", $db_array);
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
                         $this->nhan_vien->ho_ten = $this->input->xss_clean($this->input->post('ho_ten'));
                    $this->nhan_vien->tendangnhap = $this->input->xss_clean($this->input->post('tendangnhap'));
                    $this->nhan_vien->matkhau = $this->input->xss_clean($this->input->post('matkhau'));
                    $this->nhan_vien->nhom = $this->input->xss_clean($this->input->post('nhom'));
                    $this->nhan_vien->cong_viec = $this->input->xss_clean($this->input->post('cong_viec'));
        
        return $this->save();
    }

    function update()
    {
            $this->nhan_vien->stt_nhanvien = $this->input->xss_clean($this->input->post('stt_nhanvien'));
            $this->nhan_vien->ho_ten = $this->input->xss_clean($this->input->post('ho_ten'));
            $this->nhan_vien->tendangnhap = $this->input->xss_clean($this->input->post('tendangnhap'));
            $this->nhan_vien->matkhau = $this->input->xss_clean($this->input->post('matkhau'));
            $this->nhan_vien->nhom = $this->input->xss_clean($this->input->post('nhom'));
            $this->nhan_vien->cong_viec = $this->input->xss_clean($this->input->post('cong_viec'));
    
        return $this->save();
    }

    function delete()
    {
                $this->nhan_vien->stt_nhanvien = $this->input->xss_clean($this->input->post('stt_nhanvien'));
                                                
        $saveSuccess = false;
         // As long as nhan_vien->stt_nhanvien was set in the controller, we will delete the record.
        if ($this->stt_nhanvien) {
            $this->db->where("stt_nhanvien", $this->stt_nhanvien);
            $this->db->delete("nhan_vien");
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