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
                            <span>Giờ</span>
                            <input type="text" id="filter_from_time" class="input-text "  />
                        </div>
                        <div style="margin-top:5px;" >
                            <span>Đến ngày </span>
                            <input type="text" id="filter_to_date" class="input-text"  />
                            <span>Giờ</span>
                            <input type="text" id="filter_to_time" class="input-text "  />
                        </div>
                        <br>
                        <div >
                            <div class="box">
                                <h1> Xe </h1>
                                <hr>

                                <form method="POST" id="main_form" action="">
                                    <label>
                                        <span>Số đăng ký xe</span>
                                        <input type="text" name="so_dang_ky_xe" value="" id="xe_so_dang_ky_xe" class="input-text" onchange="Xe.setDataField(this.name,this.value);"  />
                                    </label>

                                </form>

                                <div id="gps_msg_logs" style="background-color: gray;color:yellow" >
                                </div>

                                <div class="spacer" id="form_control" >
                                    <input type="button" value="Tìm" onclick="test();"/>
                                </div>
                                <div id="ajaxloader" style="display:none" >
                                    <img  src="http://localhost/vehicle1/resources/css/img/ajax-loader.gif" />
                                </div>
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

        function updateGPSData(){
            var callback = function(msg){
                //var logs = msg.split("\r\n")[12];
                listPoint = eval( msg.split("\r\n")[12]  );
                $("#gps_msg_logs").html($.toJSON(listPoint[0]));

                var pps = toGoogleMapPoints(listPoint);
                marker = new GMarker(pps[0]);
                map.addOverlay(marker);
                map.setCenter(pps[0] , 14, G_HYBRID_MAP);
                markAllPoints(pps);
                drawPolyline(pps);

                console.log(listPoint);
                //  initForm();
                //setTimeout("updateGPSData()", 5088);
            };

            var sdkxe = $("#xe_so_dang_ky_xe").val();
            var from_datetime = $("#filter_from_date").val()+ "time" + $("#filter_from_time").val();
            var to_datetime = $("#filter_to_date").val()+ "time" + $("#filter_to_time").val();

            $.ajax({
                type: "GET",
                url: "http://localhost/vehicle1/index.php/c_Vehicle_Tracking/getGPSDATA/" + sdkxe + "/" + from_datetime + "/" + to_datetime,
                success: callback
            });
        }


        function test(){
            setTimeout("updateGPSData()", 5088);

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

        var map;
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

                if(xe == 1){
                    map.setCenter(new  GLatLng(10.7534,106.6290), 15, G_HYBRID_MAP);



                    map.addControl(new GScaleControl())


                    var img = "<img width='83'  src='http://localhost/vehicle/resources/images/80cd2fce08f6e4fccbd64c2f4bf1f4c9.jpg' />"
                    var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'> xe 1"+ img +"</span>";

                    GEvent.addListener(marker, "dragstart", function() {
                        logLatLon();
                    });

                    GEvent.addListener(marker, "dragend", function() {
                        logLatLon();
                    });

                    map.addOverlay(marker);
                    var polyline = new GPolyline([
                        new GLatLng(10.75340,106.62900),
                        new GLatLng(10.754811,106.6305971),
                        new GLatLng(10.753926,106.6344165802002),
                        new GLatLng(10.75253,106.632270),
                        new GLatLng(10.741656,106.619009),
                        new GLatLng(10.72909,106.608581)
                    ], "#FF0000", 10);
                    map.addOverlay(polyline);
                }
                else  if(xe == 2){
                    point = new  GLatLng(10.778337,106.686516);
                    marker = new GMarker(point, {draggable: true});
                    map.setCenter(point , 13, G_SATELLITE_MAP);


                    map.addControl(new GScaleControl())


                    var img = "<img width='83'  src='http://www.t-shn.com/images.php?type=3&f=xeCarrytruck1226561269.jpg' />"
                    var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'> xe 2"+ img +"</span>";

                    GEvent.addListener(marker, "dragstart", function() {
                        logLatLon();
                    });

                    GEvent.addListener(marker, "dragend", function() {
                        logLatLon();
                    });

                    map.addOverlay(marker);
                    var polyline = new GPolyline([
                        new  GLatLng(10.778337,106.686516),
                        new GLatLng(10.754811,106.6305971),
                        new GLatLng(10.753926,106.6344165802002),
                        new GLatLng(10.75253,106.632270),
                        new GLatLng(10.741656,106.619009),
                        new GLatLng(10.72909,106.608581)
                    ], "#FF0000", 10);
                    map.addOverlay(polyline);
                }
                else if(xe == 3){
                    point = new  GLatLng(10.778337,106.686516);
                    marker = new GMarker(point, {draggable: true});
                    map.setCenter(point , 13, G_SATELLITE_MAP);



                    map.addControl(new GScaleControl());


                    var img = "<img width='83'  src='http://localhost/vehicle/resources/images/images.jpg' />"
                    var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'> xe 3"+ img +"</span>";

                    GEvent.addListener(marker, "dragstart", function() {
                        logLatLon();
                    });

                    GEvent.addListener(marker, "dragend", function() {
                        logLatLon();
                    });

                    map.addOverlay(marker);
                }
                else if(xe == 4){
                    // point = new  GLatLng(10.759681,106.6728687);
                    // marker = new GMarker(point, {draggable: true});
                    console.log("xe 4");
                    map.setCenter(point , 16, G_SATELLITE_MAP);

                    map.addOverlay(marker);
                    var polyline = new GPolyline([
                        new  GLatLng(10.75675088,106.685400009),
                        new GLatLng(10.754811,106.6305971),
                        new GLatLng(10.76145183,106.6899061),
                        new GLatLng(10.764466298,106.692502)

                    ], "#FF0000", 10);
                    map.addOverlay(polyline);

                    map.addControl(new GScaleControl());


                    var img = "<img width='83'  src='http://localhost/vehicle1/resources/images/66e39872b7986a393e05f2fa629d4f48.jpg' />"
                    var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'> xe 4"+ img +"</span>";

                    GEvent.addListener(marker, "dragstart", function() {
                        logLatLon();
                    });

                    GEvent.addListener(marker, "dragend", function() {
                        logLatLon();
                    });

                    map.addOverlay(marker);
                };
                map.addControl(new GLargeMapControl());
                map.addControl(new GMapTypeControl());
                map.setMapType(G_HYBRID_MAP);

                map.openInfoWindow(point, text);
            }

        }
        jQuery("#main_form").ready(initForm);

        var point = new GLatLng(10.75340,106.62900);
        var marker = new GMarker(point, {draggable: true});

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

        function toGoogleMapPoints(list){
            var points = new Array();
            for(var i = 0 ; i< list.length; i++){
                points.push(new GLatLng(list[i].lat,list[i].lng));
            }
            return points;
        }

        function drawPolyline(pps){
            map.addOverlay(new GPolyline(pps, "#FF0000", 10));
        }

        function markAllPoints(pps){
            for(var i = 0 ; i< pps.length; i++){
                marker = new GMarker(pps[i]);


                GEvent.addListener(marker, "click", function() {
                    showInfoBox(this);
                });
                map.addOverlay(marker);
            }
        }

        function showInfoBox(p){
            var img = "<img width='83'  src='http://localhost/vehicle1/resources/images/66e39872b7986a393e05f2fa629d4f48.jpg' />"
            var text = "<span id='vehicle_marker' style='color:red;font-weight:bold'>" + $("#xe_so_dang_ky_xe").val() + "-" + img +"</span>";
            map.openInfoWindow(p, text);
        }


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