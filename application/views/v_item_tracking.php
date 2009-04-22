<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="http://localhost/vehicle/">
        <title>Theo dõi hàng hoá</title>
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
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>resources/utils/jquery.utils.ui.min.js"></script>

        <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAARCn-s2Rb8Qeo5T853_i8KhTOZcpRi3x4ZlxAD9RZHN-OsRMWtxSQpid_-Bah1NKhpWC5zY29rrD77g"
                type="text/javascript"></script>
        <script  type="text/javascript">

        </script>
    </head>

    <body>

        <table border="0" cellspacing="1" cellpadding="1">
            <tr>
                <td VALIGN="top" width="40%">
                    <div style="display:none">
                        <span>Thời gian từ ngày </span>
                        <input type="text" id="filter_from_date" class="input-text"  />
                        <span>Giờ GMT</span>
                        <input type="text" id="filter_from_time" class="input-text "  />
                    </div>
                    <div style="margin-top:5px;display:none" >
                        <span>Đến ngày </span>
                        <input type="text" id="filter_to_date" class="input-text"  />
                        <span>Giờ GMT</span>
                        <input type="text" id="filter_to_time" class="input-text "  />
                    </div>
                    <br>
                    <div >
                        <div class="box" style="width:460px">
                            <h1> Thông tin hàng hoá </h1>
                            <hr>

                            <form method="POST" id="main_form" action="">
                                <label>
                                    <span>Số vận đơn</span>
                                    <input type="text" name="van_don_so_van_don" value="" id="van_don_so_van_don" class="input-text"  />
                                    <div class="spacer" id="form_control" >
                                        <input type="button" value="Tìm" style="width:70px; font: 14px bold"  onclick="test();"/>
                                    </div>
                                    <div id="ajaxloader" style="display:none" >
                                        <img  src="<?php echo base_url()?>resources/css/img/ajax-loader.gif" />
                                    </div>
                                </label>
                                <label>
                                    <span>Theo dõi thời gian thực:</span>
                                    <input type="checkbox" name="real_time_tracking" id="real_time_tracking" />
                                </label>
                            </form>

                            <div id="gps_msg_logs" style="background-color: gray;color:yellow" >
                            </div>

                            <div  style="overflow: auto; width: 455px; height: 390px;" >
                                <table id="list2" class="scroll" style="margin-top:8px;" cellpadding="0" cellspacing="0"></table>
                                <div id="pager2" class="scroll" style="text-align:center;"></div>
                            </div>

                            <fieldset>
                                <legend><strong>Thông tin vị trí hiện tại:</strong></legend>
                                <div  style="background-color: gray;color:yellow" >
                                    Danh sách chuyến xe <strong><span id="c" >0</span></strong>
                                </div>

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
        </table>



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

                listPoint = eval( msg.split("\r\n")[12] );

                console.log(msg.split("\r\n")[12]);

                var pps = toGoogleMapPoints(listPoint);
                marker = new GMarker(pps[0]);
                map.addOverlay(marker);
                map.setCenter(pps[0] , 15);
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
                map.setMapType(G_NORMAL_MAP);
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
            if(list == null)
                return;

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
            //$("#total_gps_points_of_vehicle").html(points.length)
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

        $("#van_don_so_van_don").autocomplete("<?php echo site_url('c_van_don/keyAutoComplete/so_van_don')?>", {
            width: 200,
            max: 5,
            highlight: false,
            scroll: true,
            scrollHeight: 300,
            formatItem: function(data, i, n, value) {
                return value;
            },
            formatResult: function(data, value) {
                return  value;
            }
        });

        var jGrid = null;
        var colNamesT = new Array();
        var colModelT = new Array();
        var gridimgpath = '<?php echo base_url()?>resources/jqGrid/themes/basic/images';

        colNamesT.push('ma_chuyen');
        colModelT.push({name:'ma_chuyen',index:'ma_chuyen', editable: false});

        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

        colNamesT.push('ms_hanhtrinh');
        colModelT.push({name:'ms_hanhtrinh',index:'ms_hanhtrinh', editable: false});

        colNamesT.push('ngay_khoi_hanh');
        colModelT.push({name:'ngay_khoi_hanh',index:'ngay_khoi_hanh', editable: false});

        colNamesT.push('ngay_ket_thuc_dukien');
        colModelT.push({name:'ngay_ket_thuc_dukien',index:'ngay_ket_thuc_dukien', editable: false});

        colNamesT.push('ngay_ket_thuc_thucte');
        colModelT.push({name:'ngay_ket_thuc_thucte',index:'ngay_ket_thuc_thucte', editable: false});

        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_van_chuyen/read_json_format')?>',
                mtype : "POST",
                datatype: "json",
                colNames: colNamesT ,
                colModel: colModelT ,
                rowNum:10,
                height: 270,
                rowList:[10,20,30],
                imgpath: gridimgpath,
                pager: jQuery('#pager2'),
                sortname: colNamesT[0],
                viewrecords: true,
                caption:"van_chuyen",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Van_chuyen.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);
    </script>

</html>