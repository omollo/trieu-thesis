<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <base href="<?php echo base_url()?>" />

        <title></title>
        <script type="text/javascript" src="resources/jquery-1.3.1.js"></script>
        <script type="text/javascript" src="resources/utils/superfish.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="resources/css/jquery.emenu.css"  />
    </head>
    <body>
        <ul class="sf-menu">
            <li class="current">
                <a href="javascript:void(0)">Danh mục quản lý chung</a>
                <ul>
                    <li>
                        <a href="javascript:Menu.open('c_khach_hang')">Khách Hàng</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_loaihang')">Loại Hàng</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_dm_hanhtrinh')">Hành trình chuyến xe</a>
                    </li>
                    <hr>
                    <li >
                        <a href="javascript:Menu.open('c_thiet_bi')">Thiết bị</a>
                        <ul>
                            <li><a href="javascript:Menu.open('c_thiet_bi')">Nhập thiết bị</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_bat_thuong')">Bất thường của xe</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_bao_duong_xe')">Bảo dưỡng xe</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_model_xe')">Model xe</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_chi_nhanh')">Chi nhánh và các trạm xe</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_xe')">Xe</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_van_don')">Vận đơn</a>
                        <ul>
                            <li>
                                <a href="javascript:Menu.open('c_Item_Tracking')">Hành trình hàng hoá</a>
                            </li>
                            <li>
                                <a href="javascript:Menu.open('c_van_don')">Chi tiết vận đơn</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)">Quản lý các quy trình</a>
                <ul>
                    
                    <li>
                        <a href="javascript:Menu.open('c_van_chuyen')">Vận chuyển hàng</a>
                    </li>
                    <li>
                        <a href="javascript:Menu.open('c_vehicle_tracking')">Sử dụng xe</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <div >
            <iframe scrolling="auto" id="main_content" style="border: 0px none; width: 100%; height: 950px;" src="">
            </iframe>
        </div>
    </body>
    <script type="text/javascript">
        // initialise plugins
        jQuery(function(){
            jQuery('ul.sf-menu').superfish();
        });

        Menu = {};
        Menu.open = function(cmd){
            var url = "<?php echo base_url()?>/index.php/" + cmd;
            $("#main_content").attr("src", url);
        };

    </script>
</html>
