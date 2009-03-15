<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="http://localhost/vehicle/">
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


        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAARCn-s2Rb8Qeo5T853_i8KhTOZcpRi3x4ZlxAD9RZHN-OsRMWtxSQpid_-Bah1NKhpWC5zY29rrD77g"
                type="text/javascript"></script>
        <script  type="text/javascript">

        </script>
    </head>

    <body>

        <table border="0" cellspacing="1" cellpadding="1">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td VALIGN="top" width="40%">
                        <div>
                            <span>Thời gian từ ngày </span>
                            <input type="text" id="filter_from_date" class="input-text"  />
                            <span>Giờ GMT</span>
                            <input type="text" id="filter_from_time" class="input-text "  />
                        </div>
                        <div style="margin-top:5px;" >
                            <span>Đến ngày </span>
                            <input type="text" id="filter_to_date" class="input-text"  />
                            <span>Giờ GMT</span>
                            <input type="text" id="filter_to_time" class="input-text "  />
                        </div>
                        <br>
                        <div >
                            <div class="box">
                                <h1> Thông tin GPS của Xe </h1>
                                <hr>

                                <form method="POST" id="main_form" action="">
                                    <label>
                                        <span>Số đăng ký xe</span>
                                        <input type="text" name="so_dang_ky_xe" value="" id="xe_so_dang_ky_xe" class="input-text"  />
                                        <div class="spacer" id="form_control" >
                                            <input type="button" value="Tìm" style="width:70px; font: 14px bold"  onclick="test();"/>
                                        </div>
                                        <div id="ajaxloader" style="display:none" >
                                            <img  src="<?php echo base_url()?>resources/css/img/ajax-loader.gif" />
                                        </div>
                                    </label>
                                    <label>
                                        <span>Theo dõi thời gian thực:</span>
                                        <input type="checkbox" name="real_time_tracking" id="real_time_tracking" checked="false" />
                                    </label>

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
                            <hr>
                        </div>

                    </td>
                    <td VALIGN="top" width="60%">
                        <div id="map_canvas" style="width: 690px; height: 550px;">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>





        <div id="map_container" style="width: 60%; display:inline;"  >
            <table border="0">
                <tbody>
                    <tr>
                        <td width="50%" >

                        </td>
                        <td VALIGN="top" width="50%">

                            <div id="hanghoa" >
                                <div id="map_details1" style="width: 40%; height: 550px; display:none">
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Mã hãng</th>
                                                <th>Loai hang</th>
                                                <th>Tinh trang</th>
                                                <th>So luong</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>H001-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H002-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H002-BD1</td>
                                                <td>Buu pham</td>
                                                <td>Da chuyen xong</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="map_details2" style="width: 40%; height: 550px; display:none">
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Mã hãng</th>
                                                <th>Loai hang</th>
                                                <th>Tinh trang</th>
                                                <th>So luong</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>H078-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H006-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H004-BD1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="map_details3" style="width: 40%; height: 550px; display:none">
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Mã hãng</th>
                                                <th>Loai hang</th>
                                                <th>Tinh trang</th>
                                                <th>So luong</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>H001-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H002-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H002-BD1</td>
                                                <td>Buu pham</td>
                                                <td>Da chuyen xong</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="map_details4" style="width: 40%; height: 550px; display:none">
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Mã hãng</th>
                                                <th>Loai hang</th>
                                                <th>Tinh trang</th>
                                                <th>So luong</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>H001-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H002-SG1</td>
                                                <td>Buu pham</td>
                                                <td>Dang chuyen</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>H002-BD1</td>
                                                <td>Buu pham</td>
                                                <td>Da chuyen xong</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>



        </div>

        <br>


        <input type="button" value="tt" id="calendar1_alert" />

    </body>

    <script type="text/javascript">
        var xe = 1;
        var listPoint ;
        var map;
        var point ;
        var rootPoint = new GLatLng(10.75340,106.62900);
        var marker = new GMarker(rootPoint, {draggable: true});


        function updateGPSData(){
            var callback = function(msg){
                $("#ajaxloader").hide();

                initForm();

                listPoint = eval( msg.split("\r\n")[12]  );

                var pps = toGoogleMapPoints(listPoint);
                marker = new GMarker(pps[0]);
                map.addOverlay(marker);
                map.setCenter(pps[0] , 17, G_HYBRID_MAP);
                markAllPoints(pps);

                //                 $("#gps_msg_logs").html($.toJSON(listPoint[0]));
                $("#current_lat_of_vehicle").html(listPoint[0].lat);
                $("#current_lng_of_vehicle").html(listPoint[0].lng);
                $("#current_gpstime_of_vehicle").html(listPoint[0].gps_time);
                $("#current_totals_kms").html(drawPolyline(pps));

                //console.log(listPoint);

                if($("#real_time_tracking").attr("checked"))
                    setTimeout("updateGPSData()", 9999);
            };

            var sdkxe = $("#xe_so_dang_ky_xe").val();
            var from_datetime = $("#filter_from_date").val()+ "time" + $("#filter_from_time").val();
            var to_datetime = $("#filter_to_date").val()+ "time" + $("#filter_to_time").val();
            $("#ajaxloader").show();
            $.ajax({
                type: "GET",
                url: "http://localhost/vehicle1/index.php/c_Vehicle_Tracking/getGPSDATA/" + sdkxe + "/" + from_datetime + "/" + to_datetime,
                success: callback
            });
        }


        function test(){
            setTimeout("updateGPSData()", 1088);

            if($("#xe_so_dang_ky_xe").val() == "51-K12167"){
                xe = 1;

                $("#map_details1").show();
                $("#map_details2").hide();
                $("#map_details3").hide();
                $("#map_details4").hide();
            }
            else if($("#xe_so_dang_ky_xe").val() == "55-M18818"){
                xe = 2;
                $("#map_details2").show();
                $("#map_details1").hide();
                $("#map_details3").hide();
                $("#map_details4").hide();
            }
            else if($("#xe_so_dang_ky_xe").val() == "51-K18142"){
                xe = 3;
                $("#map_details3").show();
                $("#map_details1").hide();
                $("#map_details2").hide();
                $("#map_details4").hide();
            }
            else if($("#xe_so_dang_ky_xe").val() == "52-KA3775"){
                xe = 4;
                $("#map_details4").show();
                $("#map_details2").hide();
                $("#map_details3").hide();
                $("#map_details1").hide();
            }
            initForm();
        }


        var initForm = function(){
            $("#filter_from_date").datepicker({dateFormat:"yy-mm-dd"});
            $("#filter_to_date").datepicker({dateFormat:"yy-mm-dd"});

            $('#filter_from_time').timepickr({convention:24});
            $('#filter_from_time').mask('99:99');
            $('#filter_to_time').timepickr({convention:24});
            $('#filter_to_time').mask('99:99');

            $("#xe_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
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

            //init input mask

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
                map.setMapType(G_HYBRID_MAP);
                //map.openInfoWindow(point, text);
            }

        }
        jQuery("#main_form").ready(initForm);

        function logLatLon(){
            if( console != null )
                console.log( marker.getLatLng() );
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
            var points = new Array();
            for(var i = 0 ; i< list.length; i++){
                points.push(new GLatLng(list[i].lat,list[i].lng));
                marker = new GMarker(new GLatLng(list[i].lat,list[i].lng));
                times[marker.getLatLng()] = list[i].gps_time;
                GEvent.addListener(marker,"click", function() {
                    showInfoBox(this.getLatLng());
                });
                map.addOverlay(marker);
                // console.log(list[i].gps_time);
            }
            $("#total_gps_points_of_vehicle").html(points.length)
            return points;
        }

        function drawPolyline(pps){
            var polyline = new GPolyline(pps, "#FF0000", 10);
            map.addOverlay(polyline);
            var distance = (polyline.getLength()/1000 )+"";
            console.log(distance);
            distance = distance.substring(0, distance.indexOf(".") +5 );


            return distance;
        }

        function markAllPoints(pps){
            for(var i = 0 ; i< pps.length; i++){

            }
        }

        function drawGreatCircle(p1,p2){
            //(10.77578609275558, 106.69043576752301)
        };

        function showInfoBox(p,time){
            var img = "<img width='83'  src='http://localhost/vehicle1/resources/images/66e39872b7986a393e05f2fa629d4f48.jpg' />"
            var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'>" + $("#xe_so_dang_ky_xe").val() +  times[p] + "-" + img +"</span>";
            map.openInfoWindowHtml(p, text);
        }
        //pps[0].distanceFrom(pps[1])


    </script>

    <div class="info-box" id="info-box" style="display:none">
        <div class="toggler">
            <div id="drop" class="ui-widget-content ui-corner-all">
                <h3 class="ui-widget-header ui-corner-all" id="info-box-header">info box</h3>
                <p>
                    <div id="info-box-msg" align="center" style="font-size:13px;font-weight: bold;"> content </div>
                </p>
                <center>
                    <input type="button" value="Đóng" id="inform-box-close" onclick="$('.info-box').toggle('drop')" />
                </center>
            </div>
        </div>
    </div>
</html>