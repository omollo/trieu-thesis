<?php
//Model is generated by MVC Schema Engine

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class Xe extends Model {

    //Type: String
    var $so_dang_ky_xe = '';

    //Type: String
    var $ms_model_xe = '';

    //Type: Float
    var $the_tich_that = '';

    //Type: String
    var $url_image = '';

    //Type: String
    var $so_suon = '';

    //Type: Double
    var $speedometer = '';

    var $so_dien_thoai_tai_xe = '';


    function Xe() {
        parent::Model();
    }

    function setFilterField() {
        $this->xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
        $this->xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
        $this->xe->the_tich_that = $this->input->xss_clean($this->input->post('the_tich_that'));
        $this->xe->url_image = $this->input->xss_clean($this->input->post('url_image'));
        $this->xe->so_suon = $this->input->xss_clean($this->input->post('so_suon'));
        $this->xe->speedometer = $this->input->xss_clean($this->input->post('speedometer'));
        $this->xe->so_dien_thoai_tai_xe = $this->input->xss_clean($this->input->post('so_dien_thoai_tai_xe'));


        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Xe->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

        if ($this->so_dang_ky_xe) {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
        }
        if ($this->ms_model_xe) {
            $this->db->where("ms_model_xe", $this->ms_model_xe);
        }
        if ($this->the_tich_that) {
            $this->db->where("the_tich_that", $this->the_tich_that);
        }
        if ($this->url_image) {
            $this->db->where("url_image", $this->url_image);
        }
        if ($this->so_suon) {
            $this->db->where("so_suon", $this->so_suon);
        }
        if ($this->speedometer) {
            $this->db->where("speedometer", $this->speedometer);
        }
        if ($this->so_dien_thoai_tai_xe) {
            $this->db->where("so_dien_thoai_tai_xe", $this->so_dien_thoai_tai_xe);
        }

        // END FILTER CRITERIA CHECK
    }

    function read() {
        $this->setFilterField();

        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("xe");

        return $query->result();
    }

    //please remove this if you need more security
    function keyAutoComplete($field_name) {
        $term = $this->input->post("q");
        $limit = $this->input->post("limit");

        $this->db->limit($limit);

        $this->db->like($field_name, $term);

        $objects = $this->db->get("xe")->result_array();

        foreach($objects as $obj) {
            if($field_name == "so_dang_ky_xe")
                echo $obj['so_dang_ky_xe']."$$".$obj['url_image']. "\n";
            else
                echo $obj[$field_name]."\n";
        }
    }


    //TODO: check XSS and SQL injection here
    function readByPagination() {
        $limit = $this->input->post('rows');
        $page = $this->input->post('page');
        $sidx = $this->input->post('sidx');
        $sord = $this->input->post('sord');

        if(!$sidx) $sidx =1;
        $count = $this->db->count_all('xe');

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

        $objects = $this->db->get("xe")->result();
        $rows =  array();

        foreach($objects as $obj) {
            $cell = array();
            array_push($cell, $obj->so_dang_ky_xe);
            array_push($cell, $obj->ms_model_xe);
            array_push($cell, $obj->the_tich_that);
            array_push($cell, $obj->url_image);
            array_push($cell, $obj->so_suon);
            array_push($cell, $obj->speedometer);
            array_push($cell, $obj->so_dien_thoai_tai_xe);
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
        if($keyValue) {
            $this->db->where($keyName, $keyValue);
            $rows = $this->db->get($table)->result();
            return sizeof($rows)==1;
        }
        return false;
    }

    private function save() {
        // When we insert or update a record in CodeIgniter, we pass the results as an array:
        $db_array = array(
                "so_dang_ky_xe" => $this->so_dang_ky_xe,
                "ms_model_xe" => $this->ms_model_xe,
                "the_tich_that" => $this->the_tich_that,
                "url_image" => $this->url_image,
                "so_suon" => $this->so_suon,
                "speedometer" => $this->speedometer,
                "so_dien_thoai_tai_xe" => $this->so_dien_thoai_tai_xe
        );

        $saveSuccess = false;

        // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("xe","so_dang_ky_xe", $this->so_dang_ky_xe)) {
            $this->db->trans_start();
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
            $this->db->update("xe", $db_array);
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
        $this->db->insert("xe", $db_array);
        if($this->db->affected_rows() > 0) {
            $saveSuccess = true;
        }
        else {
            $saveSuccess = false;
        }
        $this->db->trans_complete();
        return $saveSuccess;
    }

    function create() {
        $this->xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
        $this->xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
        $this->xe->the_tich_that = $this->input->xss_clean($this->input->post('the_tich_that'));
        $this->xe->url_image = $this->input->xss_clean($this->input->post('url_image'));
        $this->xe->so_suon = $this->input->xss_clean($this->input->post('so_suon'));
        $this->xe->speedometer = $this->input->xss_clean($this->input->post('speedometer'));
        $this->xe->so_dien_thoai_tai_xe = $this->input->xss_clean($this->input->post('so_dien_thoai_tai_xe'));

        return $this->save();
    }

    function update() {
        $this->xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));
        $this->xe->ms_model_xe = $this->input->xss_clean($this->input->post('ms_model_xe'));
        $this->xe->the_tich_that = $this->input->xss_clean($this->input->post('the_tich_that'));
        $this->xe->url_image = $this->input->xss_clean($this->input->post('url_image'));
        $this->xe->so_suon = $this->input->xss_clean($this->input->post('so_suon'));
        $this->xe->speedometer = $this->input->xss_clean($this->input->post('speedometer'));
        $this->xe->so_dien_thoai_tai_xe = $this->input->xss_clean($this->input->post('so_dien_thoai_tai_xe'));

        return $this->save();
    }

    function delete() {
        $this->xe->so_dang_ky_xe = $this->input->xss_clean($this->input->post('so_dang_ky_xe'));

        $saveSuccess = false;
        // As long as xe->so_dang_ky_xe was set in the controller, we will delete the record.
        if ($this->so_dang_ky_xe) {
            $this->db->where("so_dang_ky_xe", $this->so_dang_ky_xe);
            $this->db->delete("xe");
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