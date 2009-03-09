<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Xe</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/jqGrid/themes/basic/grid.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/theme/ui.all.css"  />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url()?>resources/css/main-app.css"  />
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

        <script  type="text/javascript">
            var Xe = {};

            Xe.data = {};
            Xe.setDataField = function(fieldName,fieldValue)
            {
                Xe.data[fieldName] = fieldValue;
            }

            Xe.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Xe.data[name] = value;
                    $("#form_Xe input[name="+ name +"]").setValue(value);
                    if(name == "url_image"){
                        Xe.setImageVehicle(value);
                    }
                });

            }


            Xe.getData = function()
            {
                var obj = {};
                $.each( $("#form_Xe").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Xe.data = obj;
                return Xe.data;
            }

            //create
            Xe.Create = function()
            {
                if(!$("#form_Xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_xe/create')?>", $("#form_Xe").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Xe " + message);
                    }
                });
            }

            //refresh grid
            Xe.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("http://localhost/vehicle1/index.php/c_xe/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Xe.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Xe.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Xe.Update = function()
            {
                if(!$("#form_Xe").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_xe/update')?>", $("#form_Xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Xe " + message);
                });
            }


            //delete
            Xe.Delete = function()
            {
                if(!$("#form_Xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_xe/delete')?>",$("#form_Xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Xe " + message);
                });
            }

            Xe.currentRowID = null;

            Xe.setSelectedRow = function(id)
            {
                Xe.currentRowID = id;
            }

            Xe.setImageVehicle = function(src){
                $("#xe_url_image").setValue(src);
                $("#IMAGE_VEHICLE").attr("src", src);
            }



        </script>
    </head>

    <body>
        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>Thông tin chung</span></a></li>
            </ul>
            <div id="fragment-1" style="width: 930px;">
                <div>
                    <table id="list2" class="scroll" style="margin-top:8px;" cellpadding="0" cellspacing="0"></table>
                    <div id="pager2" class="scroll" style="text-align:center;"></div>
                </div>

                <hr>

                <div class="box">
                    <h1> Xe </h1>
                    <hr>

                    <form method="POST" id="form_Xe" action="">
                        <label>
                            <span>Số đăng ký xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="xe_so_dang_ky_xe" class="input-text " onchange="Xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>MS Model xe</span>
                            <input type="text" name="ms_model_xe" value="" id="xe_ms_model_xe" class="input-text " onchange="Xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>Thể tích thật</span>
                            <input type="text" name="the_tich_that" value="" id="xe_the_tich_that" class="input-text keyAutoComplete" onchange="Xe.setDataField(this.name,this.value);"  />
                        </label>

                        <label>
                            <span>Hình ảnh xe</span>
                            <input type="hidden" name="url_image" value="" id="xe_url_image"/>
                            <img id="IMAGE_VEHICLE" class="img_with_max" src="http://localhost/vehicle1/resources/images/no-image.jpg" />
                            <iframe name='image_vehicle_iframe' id='image_vehicle_iframe' scrolling="auto" style="border: 0px none; width: 400px; height: 60px;" src="http://localhost/vehicle1/index.php/upload/"></iframe>
                        </label>
                        <label>
                            <span>Số sườn</span>
                            <input type="text" name="so_suon" value="" id="xe_so_suon" class="input-text keyAutoComplete" onchange="Xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>Speedometer</span>
                            <input type="text" name="speedometer" value="" id="xe_speedometer" class="input-text keyAutoComplete" onchange="Xe.setDataField(this.name,this.value);"  />
                        </label>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Xe.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Xe.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Xe.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Xe.Delete()" class="green"> Xoá </a>
                    </div>
                    <div id="ajaxloader" style="display:none" >
                        <img  src="http://localhost/vehicle1/resources/css/img/ajax-loader.gif" />
                    </div>
                </div>

            </div>
        </div>
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
    </body>

    <script type="text/javascript">
        var jGrid = null;
        var colNamesT = new Array();
        var colModelT = new Array();
        var gridimgpath = '<?php echo base_url()?>resources/jqGrid/themes/basic/images';

        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});


        colNamesT.push('ms_model_xe');
        colModelT.push({name:'ms_model_xe',index:'ms_model_xe', editable: false});

        colNamesT.push('the_tich_that');
        colModelT.push({name:'the_tich_that',index:'the_tich_that', editable: false});

        colNamesT.push('url_image');
        colModelT.push({name:'url_image',index:'url_image', editable: false});

        colNamesT.push('so_suon');
        colModelT.push({name:'so_suon',index:'so_suon', editable: false});

        colNamesT.push('speedometer');
        colModelT.push({name:'speedometer',index:'speedometer', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_xe/read_json_format')?>',
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
                caption:"Xe",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Xe.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Xe").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Xe").ready(initForm);




        var inputDate = {};
        $( function() {
            //init input mask
            $("#xe_so_dang_ky_xe").mask("**-**9999");
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_xe/keyAutoComplete')?>", {
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
            $(e).focus(function()   {
                var id = $(this).attr('id');
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_xe/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

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

        $("#xe_ms_model_xe").autocomplete("<?php echo site_url('c_model_xe/keyAutoComplete/ms_model_xe')?>", {
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

    </script>

</html>