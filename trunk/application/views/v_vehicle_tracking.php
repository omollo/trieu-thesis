<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="http://localhost/vehicle/" />
        <title>Tracking Vehicle</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/jqGrid/themes/basic/grid.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/theme/ui.all.css"  />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/css/main-app.css"  />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/css/jquery.timepickr.css"  />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/css/jquery.utils.css"  />

        <style type="text/css">
            .toggler { width: 250px; height: 125px; }
            #drop { width: 240px; height: 105px; padding: 0.4em; }
            #drop .ui-widget-header { margin: 0; padding: 0.4em; text-align: center; }
            input[type='text'] {
                margin-top: 5px;
            }}
        </style>

        <script type="text/javascript" src="<?php echo base_url()?>resources/jquery-1.3.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/jqGrid/jquery.jqGrid.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/jquery.ui.all.js"></script>

        <!--  Utils for Page -->
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/inlinebox.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.validate.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.maskedinput-1.2.1.pack.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.form.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.field.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.json-1.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.utils.ui.min.js"></script>

        <?php if(base_url() == "http://localhost/vehicle/") { ?>
        <script src="http://maps.google.com/maps?file=api&v=2&amp;sensor=true&key=ABQIAAAARCn-s2Rb8Qeo5T853_i8KhRUVQb2docQPsZgy965zI7INwhRYhSwsYx6GPLkZew757LOTcZHMqJxrw" type="text/javascript"></script>
            <?php }else { ?>
        <script src="http://maps.google.com/maps?file=api&v=2&sensor=true&key=ABQIAAAARCn-s2Rb8Qeo5T853_i8KhRUVQb2docQPsZgy965zI7INwhRYhSwsYx6GPLkZew757LOTcZHMqJxrw" type="text/javascript"></script>
            <?php } ?>

    </head>

    <body>
        <div id="ajaxloader" style="display:none" >
             <img  src="<?php echo base_url()?>resources/css/img/ajax-loader.gif" />
        </div>
        <table border="0" cellspacing="1" cellpadding="1">
            <tbody>
                <tr>
                    <td VALIGN="top" width="40%">
                        <div id="mobile_location_tabs">
                            <ul>
                                <li><a href="#tabs-1">Quản lý hành trình của xe</a></li>
                                <li><a href="#tabs-2">Vị trí các xe</a></li>
                            </ul>
                            <div id="tabs-1">
                                <form action="#" onsubmit="return false;">
                                    <div>
                                        <span>Số đăng ký xe <span style="background-color: #FF6633; color: #FFFFFF; width: 20px; ">Điểm A</span> </span>
                                        <input type="text" name="receiverId" value="52-KA3775"  class="input-text xe_so_dang_ky_xe" id="receiverId"  />
                                        <input type="button" value="Định vị" onclick="currentVehicleLocation(jQuery('#receiverId').val());" />                                        
                                    </div>
                                    <div style="margin-top:5px;">
                                        Địa điểm bắt đầu hành trình:
                                        <span style="background-color: #FF6633; color: #FFFFFF; width: 20px; ">Điểm B</span>
                                        <input id="addressS" type="text" size="60" name="addressS" value="20 Ngô Đức Kế,  Bình Thạnh, Ho Chi Minh, Viet Nam" />
                                        <input  type="button" value="Tìm" onclick="showAddress('#addressS');" />
                                    </div>
                                    <div style="margin-top:5px;">
                                        Địa điểm kết thúc hành trình:
                                        <span style="background-color: #FF6633; color: #FFFFFF; width: 20px; ">Điểm C</span>
                                        <input id="addressE" type="text" size="60" name="addressE" value="F31, Phú Lâm B, District 6, Ho Chi Minh, Viet Nam" />
                                        <input  type="button" value="Tìm" onclick="showAddress('#addressE');" />
                                    </div>
                                    <div style="margin-top:5px;">
                                        <input type="button" value="Hành trình" onclick="makeDirectionsForVehicle();" />
                                    </div>
                                    <div style="margin-top:5px;">
                                        Nội dung:
                                        <input id="message_content" type="text" size="60" name="content" value="Chuyển hàng" />
                                    </div>
                                    <div style="margin-top:5px;">
                                        <input type="button" value="Gửi" onclick="sendMessageToPhone()"/>
                                    </div>
                                </form>
                                <div style="width: 100%;margin-top:15px;">
                                    <div id="accordion_vehicle_control_2">
                                        <h3><a href="#"><b>Danh sách thông điệp</b></a></h3>
                                        <div>
                                            <p>
                                            <div>
                                                <span>Cập nhật message box tự động:</span>
                                                <input type="checkbox" id="auto_check_message_box" checked="checked"/>
                                            </div>
                                            <div id="message_list" style="margin-top:5px; height: 270px; overflow: auto;">
                                            </div>
                                            <!--
                                            <iframe scrolling="auto" style="border: 0px none; width: 100%; max-height: 180px;" src="<?php echo site_url("c_message_handler") ?>"></iframe>
                                            -->
                                            </p>
                                        </div>
                                        <h3><a href="#">Thông tin đường đi</a></h3>
                                        <div>
                                            <p>
                                              <div id="directions" style="width: 100%"></div>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tabs-2">                                

                                <div class="">
                                    <b> Tìm thông tin vị trí</b>
                                    <hr/>

                                    <form method="post" action="">
                                        <div>
                                            <span>Số đăng ký xe</span>
                                            <input type="text" name="so_dang_ky_xe" value="52-KA3775" id="xe_so_dang_ky_xe" class="input-text xe_so_dang_ky_xe"  />
                                            <input type="button" value="Định vị" onclick="currentVehicleLocation(jQuery('#xe_so_dang_ky_xe').val());" />
                                        </div>
                                        <div style="margin-top:8px;">
                                            <span>Lịch trình hoạt động </span><br/>
                                            <span>Từ ngày </span>
                                            <input type="text" id="filter_from_date" class="input-text"  />
                                            <br/>
                                            <span>Giờ GMT</span>
                                            <input type="text" id="filter_from_time" class="input-text"  value="00:00" />
                                        </div>
                                        <div style="margin-top:8px;" >
                                            <span>Đến ngày </span>
                                            <input type="text" id="filter_to_date" class="input-text"  />
                                            <br/>
                                            <span>Giờ GMT</span>
                                            <input type="text" id="filter_to_time" class="input-text"  value="23:59" />
                                        </div>
                                        <br/>

                                        <div style="margin-top: 5px ">
                                            <input type="button" value="Hành trình của xe" onclick="searchObjectLocation();"/>
                                         </div>
                                       
                                        <div>
                                        <span>Theo dõi thời gian thực:</span>
                                        <input type="checkbox" name="real_time_tracking" id="real_time_tracking" />
                                        </div>
                                    </form>

                                    <div id="gps_msg_logs" style="background-color: gray;color:yellow" >
                                    </div>

                                    <div  style="background-color: gray;color:yellow" >
                                        Tổng số điểm GPS nhận: <strong><span id="total_gps_points_of_vehicle" >0</span></strong>
                                    </div>

                                    <fieldset>
                                        <legend><strong>Thông tin vị trí hiện tại:</strong></legend>
                                        <div  style="background-color: gray;color:yellow" >
                                            Latitude (Vĩ độ): <strong><span id="current_lat_of_vehicle" >0</span></strong>
                                        </div>
                                        <div  style="background-color: gray;color:yellow" >
                                            Longitude (Kinh độ): <strong><span id="current_lng_of_vehicle" >0</span></strong>
                                        </div>
                                        <div  style="background-color: gray;color:yellow" >
                                            Giờ GMT theo vệ tinh : <strong><span id="current_gpstime_of_vehicle" ></span></strong>
                                        </div>
                                        <div  style="background-color: gray;color:yellow" >
                                            Số Km đã đi: <strong><span id="current_totals_kms" >0</span></strong> Km
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td VALIGN="top" width="60%">
                        <div id="map_canvas" style="width: 690px; height: 1050px;"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
    
    <script type="text/javascript">
        jQuery(function() {
            jQuery("#mobile_location_tabs").tabs({
                select: function(event, ui) { initMap(); }
            });
            //jQuery("#accordion_vehicle_control").accordion();
            jQuery("img[src='http://www.000webhost.com/images/banners/other/banner11.gif'").remove();
        });
    </script>

    <script type="text/javascript">
        var xe = 1;
        var listPoint = [];
        var map = false;
        var point ;
        var rootPoint = new GLatLng(10.75340,106.62900);
        var marker = new GMarker(rootPoint, {draggable: true});
        var geocoder = null;

        function updateGPSData(){
            var sdkxe = jQuery("#xe_so_dang_ky_xe").val();
            var from_datetime = $("#filter_from_date").val()+ "time" + $("#filter_from_time").val();
            var to_datetime = $("#filter_to_date").val()+ "time" + $("#filter_to_time").val();
            
            if(jQuery.trim(sdkxe).length == 0){
                alert("Bạn cần nhập số đăng ký xe!");
                return;
            };
            
            var callback = function(msg){
                jQuery("#ajaxloader").hide();
                
                msg = msg.split("\r\n")[12];
                var b = msg.indexOf("[{");
                if(b < 0) {
                    alert("Chua co du lieu cua xe " + sdkxe);
                    return;
                }
                else {
                    var e = msg.indexOf("}]") + 2;
                    var gpsData = msg.substring(b, e);

                    listPoint = eval( gpsData );

                    var pps = toGoogleMapPoints(listPoint);
                    if(pps.length == 0){
                        alert("Dữ liệu GPS của số đăng ký xe " + sdkxe + " chưa có");
                        return;
                    }
                    marker = new GMarker(pps[0]);
                    map.addOverlay(marker);
                    map.panTo(pps[0]);

                    jQuery("#current_lat_of_vehicle").html(listPoint[0].lat);
                    jQuery("#current_lng_of_vehicle").html(listPoint[0].lng);
                    jQuery("#current_gpstime_of_vehicle").html(listPoint[0].gps_time);
                    jQuery("#current_totals_kms").html(drawPolyline(pps));

                    real_time_update();
                }
            };            
            jQuery("#ajaxloader").show();
            jQuery.ajax({type: "POST",
                url: "<?php echo base_url()?>index.php/c_vehicle_tracking/getGPSDATA/" + sdkxe + "/" + from_datetime + "/" + to_datetime,
                success: callback
            });
        };

        function real_time_update(){
            if(jQuery("#real_time_tracking").attr("checked")) {
                setTimeout("updateGPSData()", 9999);
            }
        }

        function getVehicleIcon(){
            var cIcon = new GIcon(G_DEFAULT_ICON);
            cIcon.image = "http://icons2.iconarchive.com/icons/icons-land/transport/256/TruckYellow-icon.png";
            cIcon.iconSize = new GSize(38, 50);
            cIcon.shadowSize = new GSize(37, 34);
            return cIcon;
        }

        var currentTrackId = false;
        function currentVehicleLocation(sdkxe){
            //if( sdkxe instanceof String )
            {
                if(jQuery.trim(sdkxe).length == 0){
                    alert("Bạn cần nhập số đăng ký xe!");
                    return;
                }                
            }
            currentTrackId = sdkxe;            

            var callback = function(msg){
                listPoint = eval( msg.split("\r\n")[12] );
                var pps = toGoogleMapPoints(listPoint);   
                marker = new GMarker(pps[0], getVehicleIcon(), false);
                
                rootPoint = pps[0];
                var img = "<img width='83'  src='<?php echo base_url()?>/resources/images/66e39872b7986a393e05f2fa629d4f48.jpg' />"
                var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'>" + currentTrackId + img +"</span>";
                text += ("<br> Vị trí hiện tại của xe");
                GEvent.addListener(marker, "click", function() {                     
                     map.openInfoWindowHtml(pps[0], text);
                });
                             
                map.addOverlay(marker);
                map.setCenter(pps[0] , 15);
                currentLatLng = pps[0];
                marker.openInfoWindowHtml(text);
            };
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url()?>index.php/c_vehicle_tracking/getLatestVehicleGPS/" + currentTrackId,
                success: callback
            });
        }

        function searchObjectLocation(){
            setTimeout("updateGPSData()", 2100);
            initForm();
        }

        var initForm = function(){
            $("#filter_from_date").datepicker({dateFormat:"yy-mm-dd"});
            $("#filter_to_date").datepicker({dateFormat:"yy-mm-dd"});

            $('#filter_from_time').timepickr({convention:24});
            $('#filter_from_time').mask('99:99');
            $('#filter_to_time').timepickr({convention:24});
            $('#filter_to_time').mask('99:99');

            jQuery("#real_time_tracking").click(real_time_update);

            $(".xe_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
                width: 200,
                max: 10,
                highlight: false,
                scroll: true,
                scrollHeight: 300,
                formatItem: function(data, i, n, value) {
                    return "<img width=90 height=60 src='" + value.split("$$")[1] + "'/> " +  value.split("$$")[0];
                },
                formatResult: function(data, value) {
                    return  value.split("$$")[0];
                }
            });

           initMap();
           initGDirections();
        }
        var initMap = function(){
            if (GBrowserIsCompatible()) {
                map = new GMap2(document.getElementById("map_canvas"));
                //                GEvent.bind(map, "click", this, function(overlay, latlng) {
                //                        alert(latlng);
                //                        if (latlng) {
                //                            this.map.addOverlay(new GMarker(latlng));
                //                        }
                //                });

                map.setCenter(rootPoint, 15, G_NORMAL_MAP);
                map.addControl(new GLargeMapControl());
                map.addControl(new GMapTypeControl());
                map.setMapType(G_NORMAL_MAP);
                //map.openInfoWindow(point, text);
                geocoder = new GClientGeocoder();
                return map;
            }
            return null;
        };

        jQuery("#main_form").ready(initForm);

        function logLatLon(){
            if( console != null ){
                //console.log( marker.getLatLng() );
            }
        }

        function updateVehicleMarker() {
            point = new GLatLng(10.75381,106.63014)
            marker = new GMarker(point);
            initForm();
        }

        function bounceInfoWindow() {
            $("#vehicle_marker").effect("bounce", { times: 3,distance:25 }, 400);
        }

        var testdata = [{"so_dang_ky_xe":"52-KA3775","lat":"10.8111","lng":"106.67619","gps_time":"11:33:51"},{"so_dang_ky_xe":"52-KA3775","lat":"10.8111","lng":"106.676193333","gps_time":"11:33:49"}];
        var times = {};
        function toGoogleMapPoints(list){
            if(list == null)
                return;

            var points = new Array();
            for(var i = 0 ; i< list.length; i++){
                var p = new GLatLng( list[i].lat , list[i].lng );
                points.push(p);
                var m = new GMarker(p);
                map.addOverlay(m);
                times[m.getLatLng()] = list[i].gps_time;
                GEvent.addListener(m,"click", function() {
                    showInfoBox(p);
                });                          
                // console.log(list[i].gps_time);
            }

            var p = new GLatLng(list[ 0 ].lat,list[ 0 ].lng );
            var m = new GMarker(p);
            map.addOverlay(m);
            m.openInfoWindowHtml("Hành trình của xe");

            jQuery("#total_gps_points_of_vehicle").html(points.length)
            return points;
        }

        function drawPolyline(pps){
            var polyOptions = {geodesic:true};
            var polyline = new GPolyline(pps, "#ff0000", 4, 1, polyOptions);
            map.addOverlay(polyline);
            var distance = (polyline.getLength()/1000 )+"";
            //console.log(distance);
            distance = distance.substring(0, distance.indexOf(".") +5 );
            return distance;
        }
       

        function drawGreatCircle(p1,p2){
            //(10.77578609275558, 106.69043576752301)
            var polyOptions = {geodesic:true};
            var polyline = new GPolyline([
                p1,
                p2
            ], "#ff0000", 4, 1, polyOptions);
            map.addOverlay(polyline);
        };

        function showInfoBox(p){
            var img = "<img width='83'  src='<?php echo base_url()?>/resources/images/66e39872b7986a393e05f2fa629d4f48.jpg' />"
            var text = "<span style='color:red;font-weight:bold'>" ;
            text += ( img );
            text += ( "<br> Hành trình của xe: " + $("#xe_so_dang_ky_xe").val() );
           // text += ( "<br> Thời gian ghi nhận: " + times[p]);
            text += ( "</span>" );
            map.openInfoWindowHtml(p, text);
        }
        //pps[0].distanceFrom(pps[1])

        var addressS = false, addressE = false, sendMessageFunction = false;
        var currentLatLng = false;
        function showAddress(id) {
            var address = jQuery(id).val();
            if (geocoder) {
                geocoder.getLatLng( address,
                function(point) {
                    if (!point) {
                        alert(address + " not found");
                    } else {
                        map.setCenter(point, 13);
                        var baseIcon = new GIcon(G_DEFAULT_ICON);
                        var marker;
                        var text = "";

                        if(id == "#addressS" ){                            
                            baseIcon.image = "http://www.google.com/mapfiles/markerS.png";
                            marker = new GMarker(point,baseIcon,false);
                            addressS = point;
                            text = "Điểm bắt đầu, địa chỉ: " + address;
                        }
                        if(id == "#addressE"){
                            baseIcon.image = "http://www.google.com/mapfiles/markerF.png";
                            marker = new GMarker(point,baseIcon,false);
                            addressE = point;
                            text = "Điểm kết thúc, địa chỉ: " + address;
                        }

                        map.addOverlay(marker);
                        marker.openInfoWindowHtml(text);
                        GEvent.addListener(marker, "click", function() {
                             map.openInfoWindowHtml(point, text);
                        });
                       
                        if(addressS != false && addressE != false){
                            drawGreatCircle(addressS, addressE);
                            if(sendMessageFunction instanceof Function){
                                sendMessageFunction.apply({}, []);
                            }                           
                        }                       
                    }
                }
            );
            }
        }

        function makeDirectionsForVehicle(){
             if(currentLatLng != false && addressS != false && addressE != false){
                var start = currentLatLng.lat() + "," + currentLatLng.lng();
                var from = addressS.lat() + "," + addressS.lng();
                var to = addressE.lat() + "," + addressE.lng();
                showDirectionForVehicle(start, from, to);
            }
        }

        var gdir = false;
        function initGDirections(){
            if( gdir == false ){
             gdir = new GDirections(map, document.getElementById("directions"));
             GEvent.addListener(gdir, "error", handleErrors);
            }
        }

        function showDirection(fromAddress, toAddress ){
            if(map && fromAddress.length > 0 && toAddress.length > 0){
                initGDirections();
                setDirections(fromAddress, toAddress, "en_US");
            }
            else {
                alert("Sorry, you enter invalid argurments!");
            }
        }

        function setDirections(fromAddress, toAddress, locale) {
            gdir.load("from: " + fromAddress + " to: " + toAddress,  { "locale": locale });
        }
        
        function showDirectionForVehicle(start, from, to ) {
            var wayPoints = [];
            wayPoints.push(start);
            wayPoints.push(from);
            wayPoints.push(to);
            initGDirections();
            gdir.loadFromWaypoints(wayPoints, { "locale": "en_US"} )            
        }

        function handleErrors(){
	   if (gdir.getStatus().code == G_GEO_UNKNOWN_ADDRESS)
                alert("No corresponding geographic location could be found for one of the specified addresses. This may be due to the fact that the address is relatively new, or it may be incorrect.\nError code: " + gdir.getStatus().code);
	   else if (gdir.getStatus().code == G_GEO_SERVER_ERROR)
                alert("A geocoding or directions request could not be successfully processed, yet the exact reason for the failure is not known.\n Error code: " + gdir.getStatus().code);

	   else if (gdir.getStatus().code == G_GEO_MISSING_QUERY)
                alert("The HTTP q parameter was either missing or had no value. For geocoder requests, this means that an empty address was specified as input. For directions requests, this means that no query was specified in the input.\n Error code: " + gdir.getStatus().code);

	   else if (gdir.getStatus().code == G_GEO_BAD_KEY)
                alert("The given key is either invalid or does not match the domain for which it was given. \n Error code: " + gdir.getStatus().code);

	   else if (gdir.getStatus().code == G_GEO_BAD_REQUEST)
                alert("A directions request could not be successfully parsed.\n Error code: " + gdir.getStatus().code);

	   else alert("An unknown error occurred.");
	}



        function sendMessageToPhone(){
            var f = function(){
                if(addressS != false && addressE != false){
                    var latS = addressS.lat();
                    var lngS = addressS.lng();
                    var latE = addressE.lat();
                    var lngE = addressE.lng();
                    var content = latS + "," + lngS + ";" + latE + "," + lngE;
                    content = content + ";" + jQuery("#message_content").val();
                   
                    var handler = function(rs){
                        alert("Nội dung đã gửi "+content);
                        alert(rs);
                    };
                    var url = "<?php echo site_url('c_message_handler/create')?>";
                    var data = {'status':1};
                    data['senderId'] = 'server1';
                    data['receiverId'] = jQuery("#receiverId").val();
                    data['content'] = content;
                    jQuery.post(url, data, handler);
                }
            };
            sendMessageFunction = f;
            showAddress('#addressS');
            showAddress('#addressE');

            return false;
        }

        function getMessageList(){
            if( jQuery("#auto_check_message_box").attr("checked") ) {
                var handler = function(rs){
                     jQuery("#message_list").html(rs);
                };
                var url = "<?php echo site_url('c_message_handler/getMessageList')?>";
                var data = {};
                jQuery.post(url, data, handler);
            }
        }
        setInterval(getMessageList, 9999);

    </script>

</html>