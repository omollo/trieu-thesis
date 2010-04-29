<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Hệ thống quản lý xe và hành trình hàng hoá</title>
        <meta name="description" content="Web Application" />
        <meta name="keywords" content="web, application" />

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
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/system/application/views/css/main.css" media="screen" />

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
                    GB_showPage('Hệ thống quản lý xe và hành trình hàng hoá', "<?php echo site_url("admin") ?>" );
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
            <h1><a href="#">Hệ thống quản lý xe và hành trình hàng hoá</a></h1>
            <ul id="menu">
                <li class="active" ><a href="javascript:Menu.open('home')" title="Trang chu"><span>Trang chủ</span></a></li>
                <li><a href="javascript:Menu.open('c_Item_Tracking')" title="Hang hoa"><span>Hàng hoá</span></a></li>
                <li><a href="javascript:Menu.open('admin')" title="Quan tri he thong"><span>Quản lý hệ thống</span></a></li>
                <li><a href="javascript:Menu.open('contact')" title="Thong tin lien he"><span>Liên hệ</span></a></li>
            </ul>
        </div>

        <div id="teaser">
            <div class="wrap">
                <div id="image"></div>
                <div class="box">
                    <div id="intro_content">
                        <h3> Các chức năng chính: </h3>
                        <ul>
                            <li>Sử dụng hệ thống định vị toàn cầu GPS để quản lý lịch trình, hành trình xe chạy.</li>
                            <li>Lên kế hoạch cho các chuyến hành trình của xe.</li>
                            <li>Sử dụng dịch vụ bản đồ số Google Map vào việc quản lý hành trình của xe.</li>
                            <li>Theo dõi hành trình hoá theo số vận đơn.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="bar">
            <div class="wrap">
                <span class="step"><a>1</a> Thu thập dữ liệu</span>
                <span class="step"><a>2</a> Quản lý thông tin</span>
                <span class="step"><a>3</a> Tối ưu quy trình </span>
            </div>
        </div>

        <div class="wrap">
            <div class="col">
                <h3>Thu thập dữ liệu </h3>
                <p>Hệ thống tự động thu thập dữ liệu GPS của xe</p>
            </div>
            <div class="col">
                <h3>Quản lý thông tin <span class="red">GPS</span> của xe</h3>
                <p>Thông tin về hành trình và chuyến đí được quản lý tập trung tại trạm điều hành</p>
            </div>
            <div class="col last">
                <h3>Tối ưu quy trình <span class="red">vận chuyển</span></h3>
                <p>Các xe sẽ được thông báo và liên lạc nhau về đường đi.
                    Các dữ liệu đường đi được phân tích ở trạm và gửi về xe theo thời gian thật.
                </p>
                <p class="info">Phiên bản Demo</p>
            </div>
        </div>

        <iframe scrolling="auto" id="main_content" style="display: none; border: 0px none; width: 100%; height: 950px;" src="" frameborder="0" ></iframe>

        <div id="footer">
            <p class="right">Design: <a title="" href="#">Trieu Nguyen</a></p>
            <p>&copy; Copyright 2010
			Lead Deveveloper    <a href="mailto: tantrieuf31@gmail.com">Trieu Nguyen</a>
            </p>
        </div>
    </body>
</html>