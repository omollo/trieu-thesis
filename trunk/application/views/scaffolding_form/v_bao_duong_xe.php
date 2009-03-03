<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Bao_duong_xe</title>
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
            var Bao_duong_xe = {};

            Bao_duong_xe.data = {};
            Bao_duong_xe.setDataField = function(fieldName,fieldValue)
            {
                Bao_duong_xe.data[fieldName] = fieldValue;
            }

            Bao_duong_xe.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Bao_duong_xe.data[name] = value;
                    $("#form_Bao_duong_xe input[name="+ name +"]").setValue(value);
                });
            }


            Bao_duong_xe.getData = function()
            {
                var obj = {};
                $.each( $("#form_Bao_duong_xe").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Bao_duong_xe.data = obj;
                return Bao_duong_xe.data;
            }

            //create
            Bao_duong_xe.Create = function()
            {
                if(!$("#form_Bao_duong_xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_bao_duong_xe/create')?>", $("#form_Bao_duong_xe").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Bao_duong_xe " + message);
                    }
                });
            }

            //refresh grid
            Bao_duong_xe.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("http://localhost/vehicle1/index.php/c_bao_duong_xe/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Bao_duong_xe.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Bao_duong_xe.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Bao_duong_xe.Update = function()
            {
                if(!$("#form_Bao_duong_xe").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_bao_duong_xe/update')?>", $("#form_Bao_duong_xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Bao_duong_xe " + message);
                });
            }


            //delete
            Bao_duong_xe.Delete = function()
            {
                if(!$("#form_Bao_duong_xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_bao_duong_xe/delete')?>",$("#form_Bao_duong_xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Bao_duong_xe " + message);
                });
            }

            Bao_duong_xe.currentRowID = null;

            Bao_duong_xe.setSelectedRow = function(id)
            {
                Bao_duong_xe.currentRowID = id;
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
                    <h1> Bảo Dưỡng Xe </h1>
                    <hr>

                    <form method="POST" id="form_Bao_duong_xe" action="">
                        <label>
                            <span>stt_kmbd</span>
                            <input type="text" name="stt_kmbd" value="" id="bao_duong_xe_stt_kmbd" class="input-text " onchange="Bao_duong_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="bao_duong_xe_so_dang_ky_xe" class="input-text " onchange="Bao_duong_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>khoang_muc_bao_duong</span>
                            <input type="text" name="khoang_muc_bao_duong" value="" id="bao_duong_xe_khoang_muc_bao_duong" class="input-text keyAutoComplete" onchange="Bao_duong_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>thoi_gian</span>
                            <input type="text" name="thoi_gian" value="" id="bao_duong_xe_thoi_gian" class="input-text keyAutoComplete" onchange="Bao_duong_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>speedometer</span>
                            <input type="text" name="speedometer" value="" id="bao_duong_xe_speedometer" class="input-text keyAutoComplete" onchange="Bao_duong_xe.setDataField(this.name,this.value);"  />
                        </label>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Bao_duong_xe.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Bao_duong_xe.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Bao_duong_xe.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Bao_duong_xe.Delete()" class="green"> Xoá </a>
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

        colNamesT.push('stt_kmbd');
        colModelT.push({name:'stt_kmbd',index:'stt_kmbd', editable: false});


        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

        colNamesT.push('khoang_muc_bao_duong');
        colModelT.push({name:'khoang_muc_bao_duong',index:'khoang_muc_bao_duong', editable: false});

        colNamesT.push('thoi_gian');
        colModelT.push({name:'thoi_gian',index:'thoi_gian', editable: false});

        colNamesT.push('speedometer');
        colModelT.push({name:'speedometer',index:'speedometer', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_bao_duong_xe/read_json_format')?>',
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
                caption:"Bảo dưỡng xe",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Bao_duong_xe.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Bao_duong_xe").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Bao_duong_xe").ready(initForm);




        var inputDate = {};
        $( function() {
            inputDate['bao_duong_xe_thoi_gian'] = $("#bao_duong_xe_thoi_gian").datepicker({dateFormat:"yy/mm/dd"});
            $('#bao_duong_xe_thoi_gian').mask('9999/99/99');
            $('#bao_duong_xe_thoi_gian').validate({rules:{ require: true, date: true}});
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_bao_duong_xe/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_bao_duong_xe/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

        $("#bao_duong_xe_stt_kmbd").autocomplete("<?php echo site_url('c_bao_duong_xe/keyAutoComplete/stt_kmbd')?>", {
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
        $("#bao_duong_xe_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
            width: 200,
            max: 4,
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

    </script>

</html>