<?php
//Controller is generated by MVC Schema Engine

/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
* @property VehicleDBUtils $VehicleDBUtils
* @property Xe $xe
* @property Gps_markers $gps_markers
 */

class c_vehicle_tracking extends Controller
{
    //message in vietnamese, TODO: add I18N later
    var $messageSuccess = "Thành công";
    var $messageFail    = "Thất bại";

    function c_vehicle_tracking()
    {
        parent::Controller();
        $this->load->model('xe');
        $this->load->model('gps_markers');
        $this->load->model('VehicleDBUtils');

        $this->load->helper('form');
        $this->load->helper('object2array');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    function index()
    {
        $this->load->view('v_vehicle_tracking');
    }

    function getGPSDATA($sdkxe,$from_datetime,$to_datetime){
        ini_set ('allow_url_fopen', '1');
        $url = "http://tantrieuf31.summerhost.info/getGPSByVehicle.php?so_dang_ky_xe=".$sdkxe;
        $url = $url."&from_datetime=".$from_datetime."&to_datetime=".$to_datetime;
       // echo $url;
        $str = $this->loadHtml(($url));
        echo $str;
    }

    function readXe($priKey)
    {
        if(isset($priKey) )
        {
            $this->xe->STT_XE = $priKey;
            $this->xe->SO_DANG_KY_XE = $priKey;

            $rows = $this->xe->read();
            foreach($rows as $row)
            {
                echo $row->STT_XE."<br>";
                echo $row->SO_DANG_KY_XE."<br>";
                echo $row->MS_MODEL_XE."<br>";
                echo $row->MS_THIET_BI."<br>";
                echo $row->THE_TICH_THAT."<br>";
                echo $row->NGAY_CAP_NHAT."<br>";
            }
        }
    }

    function create()
    {
        $this->xe->MS_MODEL_XE = $this->input->xss_clean($this->input->post('MS_MODEL_XE'));
        $this->xe->MS_THIET_BI = $this->input->xss_clean($this->input->post('MS_THIET_BI'));
        $this->xe->THE_TICH_THAT = $this->input->xss_clean($this->input->post('THE_TICH_THAT'));
        $this->xe->NGAY_CAP_NHAT = $this->input->xss_clean($this->input->post('NGAY_CAP_NHAT'));

        if($this->xe->save())
        echo $this->messageSuccess;
        else
        echo $this->messageFail;

    }

    function recordGPS($STT_NKHT,$LAT,$LON,$TYPE) {
        $this->gps_markers->STT_NKHT = $STT_NKHT;
        $this->gps_markers->LAT = $LAT;
        $this->gps_markers->LNG = $LON;
        $this->gps_markers->TYPE = $TYPE;
        $this->gps_markers->GPS_TIME = time();
        $this->gps_markers->save();
    }

    function simulationGPS() {
        $x1 = 106.629;
        $y1 = 10.7534;

        $x2 = 106.640553;
        $y2 = 10.7509747;

        $t1 = ($x2/$x1);
        $q1 = ($y2/$y1);

        // current time
        echo "t1 = ". $t1;
        echo "<br>";
        echo "q1 = ". $q1;
        echo "<br>";

        $LAT = $x1;
        $LON = $y1;

        for($i= 0; $i < 5; $i++){
            $LAT = $LAT * $t1;
            $LON = $LON * $q1;
            $this->recordGPS(1,$LAT,$LON,"test");

            echo "LAT = ". $LAT;
            echo "<br>";
            echo "LON = ". $LON;
            echo "<br>";

            // sleep(2);
        }

        // sleep for 2 seconds
        //sleep(2);

        // wake up !
        //echo date('h:i:s') . "\n";
    }

    function read()
    {
        //$data['objects'] = $this->xe->read();
        $data['form_view'] = $this->get_form_view();
        $this->load->view('v_xe',$data);
    }

    function read_json_format()
    {
        echo json_encode($this->xe->readByPagination());
    }

    function update()
    {
        $this->xe->STT_XE = $this->input->xss_clean($this->input->post('STT_XE'));
        $this->xe->SO_DANG_KY_XE = $this->input->xss_clean($this->input->post('SO_DANG_KY_XE'));
        $this->xe->MS_MODEL_XE = $this->input->xss_clean($this->input->post('MS_MODEL_XE'));
        $this->xe->MS_THIET_BI = $this->input->xss_clean($this->input->post('MS_THIET_BI'));
        $this->xe->THE_TICH_THAT = $this->input->xss_clean($this->input->post('THE_TICH_THAT'));
        $this->xe->NGAY_CAP_NHAT = $this->input->xss_clean($this->input->post('NGAY_CAP_NHAT'));

        if($this->xe->save())
        echo $this->messageSuccess;
        else
        echo $this->messageFail;

    }

    function delete()
    {
        $this->xe->STT_XE = $this->input->xss_clean($this->input->post('STT_XE'));
        $this->xe->SO_DANG_KY_XE = $this->input->xss_clean($this->input->post('SO_DANG_KY_XE'));

        if($this->xe->delete())
        echo $this->messageSuccess;
        else
        echo $this->messageFail;

    }


    /**
 * See http://www.bin-co.com/php/scripts/load/
 * Version : 2.00.A
 */
    function loadHtml($url,$options=array()) {
        $default_options = array(
        'method'        => 'get',
        'return_info'    => false,
        'return_body'    => true,
        'cache'            => false,
        'referer'        => '',
        'headers'        => array(),
        'session'        => false,
        'session_close'    => false,
        );
        // Sets the default options.
        foreach($default_options as $opt=>$value) {
            if(!isset($options[$opt])) $options[$opt] = $value;
        }

        $url_parts = parse_url($url);
        $ch = false;
        $info = array(//Currently only supported by curl.
        'http_code'    => 200
        );
        $response = '';

        $send_header = array(
        'Accept' => 'text/*',
        'User-Agent' => 'BinGet/1.00.A (http://www.bin-co.com/php/scripts/load/)'
        ) + $options['headers']; // Add custom headers provided by the user.

        if($options['cache']) {
            $cache_folder = '/tmp/php-load-function/';
            if(isset($options['cache_folder'])) $cache_folder = $options['cache_folder'];
            if(!file_exists($cache_folder)) {
                $old_umask = umask(0); // Or the folder will not get write permission for everybody.
                mkdir($cache_folder, 0777);
                umask($old_umask);
            }

            $cache_file_name = md5($url) . '.cache';
            $cache_file = joinPath($cache_folder, $cache_file_name); //Don't change the variable name - used at the end of the function.

            if(file_exists($cache_file)) { // Cached file exists - return that.
                $response = file_get_contents($cache_file);

                //Seperate header and content
                $separator_position = strpos($response,"\r\n\r\n");
                $header_text = substr($response,0,$separator_position);
                $body = substr($response,$separator_position+4);

                foreach(explode("\n",$header_text) as $line) {
                    $parts = explode(": ",$line);
                    if(count($parts) == 2) $headers[$parts[0]] = chop($parts[1]);
                }
                $headers['cached'] = true;

                if(!$options['return_info']) return $body;
                else return $body;//array('headers' => $headers, 'body' => $body, 'info' => array('cached'=>true));
            }
        }

        ///////////////////////////// Curl /////////////////////////////////////
        //If curl is available, use curl to get the data.
        if(function_exists("curl_init")
            and (!(isset($options['use']) and $options['use'] == 'fsocketopen'))) { //Don't use curl if it is specifically stated to use fsocketopen in the options

            if(isset($options['post_data'])) { //There is an option to specify some data to be posted.
                $page = $url;
                $options['method'] = 'post';

                if(is_array($options['post_data'])) { //The data is in array format.
                    $post_data = array();
                    foreach($options['post_data'] as $key=>$value) {
                        $post_data[] = "$key=" . urlencode($value);
                    }
                    $url_parts['query'] = implode('&', $post_data);

                } else { //Its a string
                    $url_parts['query'] = $options['post_data'];
                }
            } else {
                if(isset($options['method']) and $options['method'] == 'post') {
                    $page = $url_parts['scheme'] . '://' . $url_parts['host'] . $url_parts['path'];
                } else {
                    $page = $url;
                }
            }

            if($options['session'] and isset($GLOBALS['_binget_curl_session'])) $ch = $GLOBALS['_binget_curl_session']; //Session is stored in a global variable
            else $ch = curl_init($url_parts['host']);

            curl_setopt($ch, CURLOPT_URL, $page) or die("Invalid cURL Handle Resouce");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Just return the data - not print the whole thing.
            curl_setopt($ch, CURLOPT_HEADER, true); //We need the headers
            curl_setopt($ch, CURLOPT_NOBODY, !($options['return_body'])); //The content - if true, will not download the contents. There is a ! operation - don't remove it.
            if(isset($options['method']) and $options['method'] == 'post' and isset($url_parts['query'])) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $url_parts['query']);
            }
            //Set the headers our spiders sends
            curl_setopt($ch, CURLOPT_USERAGENT, $send_header['User-Agent']); //The Name of the UserAgent we will be using ;)
            $custom_headers = array("Accept: " . $send_header['Accept'] );
            if(isset($options['modified_since']))
            array_push($custom_headers,"If-Modified-Since: ".gmdate('D, d M Y H:i:s \G\M\T',strtotime($options['modified_since'])));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $custom_headers);
            if($options['referer']) curl_setopt($ch, CURLOPT_REFERER, $options['referer']);

            curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/binget-cookie.txt"); //If ever needed...
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            if(isset($url_parts['user']) and isset($url_parts['pass'])) {
                $custom_headers = array("Authorization: Basic ".base64_encode($url_parts['user'].':'.$url_parts['pass']));
                curl_setopt($ch, CURLOPT_HTTPHEADER, $custom_headers);
            }

            $response = curl_exec($ch);
            $info = curl_getinfo($ch); //Some information on the fetch

            if($options['session'] and !$options['session_close']) $GLOBALS['_binget_curl_session'] = $ch; //Dont close the curl session. We may need it later - save it to a global variable
            else curl_close($ch);  //If the session option is not set, close the session.

            //////////////////////////////////////////// FSockOpen //////////////////////////////
        } else { //If there is no curl, use fsocketopen - but keep in mind that most advanced features will be lost with this approch.
            if(isset($url_parts['query'])) {
                if(isset($options['method']) and $options['method'] == 'post')
                $page = $url_parts['path'];
                else
                $page = $url_parts['path'] . '?' . $url_parts['query'];
            } else {
                $page = $url_parts['path'];
            }

            if(!isset($url_parts['port'])) $url_parts['port'] = 80;
            $fp = fsockopen($url_parts['host'], $url_parts['port'], $errno, $errstr, 30);
            if ($fp) {
                $out = '';
                if(isset($options['method']) and $options['method'] == 'post' and isset($url_parts['query'])) {
                    $out .= "POST $page HTTP/1.1\r\n";
                } else {
                    $out .= "GET $page HTTP/1.0\r\n"; //HTTP/1.0 is much easier to handle than HTTP/1.1
                }
                $out .= "Host: $url_parts[host]\r\n";
                $out .= "Accept: $send_header[Accept]\r\n";
                $out .= "User-Agent: {$send_header['User-Agent']}\r\n";
                if(isset($options['modified_since']))
                $out .= "If-Modified-Since: ".gmdate('D, d M Y H:i:s \G\M\T',strtotime($options['modified_since'])) ."\r\n";

                $out .= "Connection: Close\r\n";

                //HTTP Basic Authorization support
                if(isset($url_parts['user']) and isset($url_parts['pass'])) {
                    $out .= "Authorization: Basic ".base64_encode($url_parts['user'].':'.$url_parts['pass']) . "\r\n";
                }

                //If the request is post - pass the data in a special way.
                if(isset($options['method']) and $options['method'] == 'post' and $url_parts['query']) {
                    $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
                    $out .= 'Content-Length: ' . strlen($url_parts['query']) . "\r\n";
                    $out .= "\r\n" . $url_parts['query'];
                }
                $out .= "\r\n";

                fwrite($fp, $out);
                while (!feof($fp)) {
                    $response .= fgets($fp, 128);
                }
                fclose($fp);
            }
        }

        //Get the headers in an associative array
        $headers = array();

        if($info['http_code'] == 404) {
            $body = "";
            $headers['Status'] = 404;
        } else {
            //Seperate header and content
            $info['header_size'] = '';
            //$header_text = substr($response, 0, $info['header_size']);
            $body = substr($response, $info['header_size']);

//            foreach(explode("\n",$header_text) as $line) {
//                $parts = explode(": ",$line);
//                if(count($parts) == 2) $headers[$parts[0]] = chop($parts[1]);
//            }
        }

        if(isset($cache_file)) { //Should we cache the URL?
            file_put_contents($cache_file, $response);
        }

        if($options['return_info']) return $body;//array('headers' => $headers, 'body' => $body, 'info' => $info, 'curl_handle'=>$ch);
        return $body;
    }


}


?>