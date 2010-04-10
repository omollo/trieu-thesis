<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Hệ thống theo dõi hành trình hàng hoá</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/style.css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url()?>/resources/jquery-1.3.1.js"></script>

        <!-- BEGIN Grey box resources -->
        <script type="text/javascript">
            var GB_ROOT_DIR = "<?php echo base_url()?>resources/greybox/";
        </script>
        <script type="text/javascript" src="<?php echo base_url()?>/resources/greybox/AJS.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>/resources/greybox/AJS_fx.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>/resources/greybox/gb_scripts.js"></script>
        <link href="<?php echo base_url()?>/resources/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
        <!-- END Grey box resources -->

        <script type="text/javascript">

            Menu = {};
            Menu.open = function(cmd){
                var url = "<?php echo base_url()?>index.php/" + cmd;

                 $("#intro_content").hide();
                if(cmd == "c_Item_Tracking"){
                    $("#left").css("width","0%");
                    $("#right").css("width","98%");
                    GB_showPage('Hành trình hàng hoá', "<?php echo site_url("c_Item_Tracking") ?>" );
                }
                else if(cmd == "home"){
                    window.location = "<?php echo site_url("home") ?>";
                    $("#main_content").hide();
                    $("#intro_content").show();
                }
                else if(cmd == "admin"){
                    GB_showPage('Quản trị thông tin', "<?php echo site_url("admin") ?>" );
                }
                else {
                    $("#left").css("width","20%");
                    $("#right").css("width","76%");
                    $("#main_content").attr("src", url);
                }
            };


        </script>
    </head>
    <body>
        <div id="header">
            <h1>Hệ thống theo dõi hành trình hàng hoá</h1>
            <div id="menu">
                <ul id="nav">
                    <li><a href="javascript:Menu.open('welcome/login')" title="Dang nhap"><span>Đăng nhập</span></a></li>
                    <li><a href="javascript:Menu.open('home')" title="Trang chu"><span>Trang chủ</span></a></li>
                    <li><a href="javascript:Menu.open('welcome/login')" title="San pham - Dich vu"><span>Sản phẩm</span></a></li>
                    <li><a href="javascript:Menu.open('c_Item_Tracking')" title="Hang hoa"><span>Hàng hoá</span></a></li>
                    <li><a href="javascript:Menu.open('admin')" title="Quan tri he thong"><span>Quản trị thông tin</span></a></li>
                    <li><a href="javascript:Menu.open('contact')" title="Thong tin lien he"><span>Liên hệ</span></a></li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div id="right">
                <div id="intro_content">
					<img src="http://localhost/vehicle1/bear.jpg" />
                    <h3>1. Giới thiệu:</h3>
                    Giới thiệu các chức năng chính
                    <br>
                    <h3> 2. Các chức năng chính: </h3>                    
                    <ul>
                        <li>- Sử dụng GPS để quản lý lịch trình, hành trình xe chạy.</li>
                        <li>- Lên kế hoạch cho các chuyến hành trình của xe.</li>
                        <li>- Sử dụng dịch vụ bản đồ số Google Map vào việc quản lý hành trình của xe.</li>
                        <li>- Theo dõi hành trình hoá theo số vận đơn.</li>
                    </ul>
                </div>
                <iframe scrolling="auto" id="main_content" style="border: 0px none; width: 100%; height: 950px;" src="" frameborder="0" >
                </iframe>
            </div>


            <div id="left">
                <div class="box">
                    <h2>Thông tin chung :</h2>
                    <p>Version Alpha 1.</p>
                </div>

                <div class="box">
                    <h2>Links :</h2>
                    <ul>
                        <li><a href="#">Web Design Directory</a></li>
                        <li><a href="#">History Timelines</a></li>
                        <li><a href="#">Free templates</a></li>
                    </ul>
                </div>

                <div class="box" style="display:none">
                    <div style="font-size: 0.8em;">Design by <a href="http://www.minimalistic-design.net">Trieu</a></div>
                </div>
            </div>
        </div>
    </body>
</html>