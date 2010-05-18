<?php
//Model is generated by MVC Schema Engine

/**
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_DB_active_record $db
 */

class m_message extends Model {

    //Type: Integer
    var $id = 0;

    //Type: String
    var $senderId = '';

    //Type: String
    var $receiverId = '';

    //Type: String
    var $content = '';

    //Type: Integer
    var $status = 1;

    var $isCurrent = 0;


    function m_message() {
        parent::Model();
    }

    protected function readDataFromHTTPRequest() {
        $this->id = $this->input->xss_clean($this->input->post('id'));
        $this->senderId = $this->input->xss_clean($this->input->post('senderId'));
        $this->receiverId = $this->input->xss_clean($this->input->post('receiverId'));
        $this->content = $this->input->xss_clean($this->input->post('content'));
        $this->status = $this->input->xss_clean($this->input->post('status'));
        $this->isCurrent = $this->input->xss_clean($this->input->post('isCurrent'));
    }

    function setFilterField() {
        $this->readDataFromHTTPRequest();
        // BEGIN FILTER CRITERIA CHECK
        // If any of the following properties are set before Chi_nhanh->get() is called from the controller then we will include
        // a where statement for each of the properties that have been set.

        if ($this->id) {
            $this->db->where("id", $this->id);
        }
        if ($this->senderId) {
            $this->db->where("senderId", $this->senderId);
        }
        if ($this->receiverId) {
            $this->db->where("receiverId", $this->receiverId);
        }
        if ($this->content) {
            $this->db->where("content", $this->content);
        }
        if ($this->status) {
            $this->db->where("status", $this->status);
        }
        if ($this->isCurrent) {
            $this->db->where("isCurrent", $this->isCurrent);
        }

        // END FILTER CRITERIA CHECK
    }

    function read() {
        $this->setFilterField();
        // This will execute the query and collect the results and other properties of the query into an object.
        $query = $this->db->get("message_box");        
        return $query->result();
    }

   function getMessageByReceiverID($receiverId) {
        $this->db->where("receiverId", $receiverId);
        $query = $this->db->get("message_box");
        return $query->result();
    }

       function getCurrentMessageByReceiverID($receiverId) {
        $this->db->where("receiverId", $receiverId);
        $query = $this->db->get("message_box");
        return $query->result();
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
                "id" => $this->id,
                "senderId" => $this->senderId,
                "receiverId" => $this->receiverId,
                "content" => $this->content,
                "status" => $this->status ,
                "isCurrent" => $this->isCurrent 
        );
        $saveSuccess = false;

        // If key was set in the controller, then we will update an existing record.
        if ($this->isUsedKey("message_box","id", $this->id)) {
            $this->db->trans_start();
            $this->db->where("id", $this->id);
            $this->db->update("message_box", $db_array);
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
        $this->db->insert("message_box", $db_array);
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
        $this->readDataFromHTTPRequest();
        return $this->save();
    }

    function update() {
        $this->readDataFromHTTPRequest();
        return $this->save();
    }

    function updateMessageStatus() {
        $this->id = trim( $this->input->xss_clean($this->input->post('id')) );
        $this->status = trim( $this->input->xss_clean( $this->input->post('status')) );
        $db_array = array(
                "id" => $this->id,
                "status" => $this->status
        );
        $this->db->where("id", $this->id);
        $this->db->update("message_box", $db_array);
        if($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    function resetMessagePriorityForReceiver($receiverId) {
        $db_array = array(                
                "isCurrent" => 0
        );
        $this->db->where("receiverId", $receiverId);
        $this->db->update("message_box", $db_array);
        echo $this->db->last_query();
        if($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    function updateMessagePriorityForReceiver() {
        $this->id = trim( $this->input->xss_clean($this->input->post('id')) );
        $this->isCurrent = trim( $this->input->xss_clean( $this->input->post('isCurrent')) );
        $receiverId = trim( $this->input->xss_clean( $this->input->post('receiverId')) );
        $this->resetMessagePriorityForReceiver($receiverId);

        $db_array = array(
              "isCurrent" => $this->isCurrent
        );
        $this->db->where("id", $this->id);
        $this->db->update("message_box", $db_array);
        echo $this->db->last_query();
        if($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    function delete() {
        $this->id = $this->input->xss_clean($this->input->post('id'));

        $saveSuccess = false;
        // As long as chi_nhanh->ms_chi_nhanh was set in the controller, we will delete the record.
        if ($this->id) {
            $this->db->where("id", $this->id);
            $this->db->delete("message_box");
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