<html>
    <head>
        <base href="<?php echo base_url()?>">
        <title>Gps_markers</title>
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
            var Gps_markers = {};

            Gps_markers.data = {};
            Gps_markers.setDataField = function(fieldName,fieldValue)
            {
                Gps_markers.data[fieldName] = fieldValue;
            }

            Gps_markers.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Gps_markers.data[name] = value;
                    $("#form_Gps_markers input[name="+ name +"]").setValue(value);
                });
            }


            Gps_markers.getData = function()
            {
                var obj = {};
                $.each( $("#form_Gps_markers").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Gps_markers.data = obj;
                return Gps_markers.data;
            }

            //create
            Gps_markers.Create = function()
            {
                if(!$("#form_Gps_markers").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_gps_markers/create')?>", $("#form_Gps_markers").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Gps_markers " + message);
                    }
                });
            }

            //refresh grid
            Gps_markers.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo base_url()?>index.php/c_gps_markers/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Gps_markers.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Gps_markers.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Gps_markers.Update = function()
            {
                if(!$("#form_Gps_markers").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_gps_markers/update')?>", $("#form_Gps_markers").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Gps_markers " + message);
                });
            }


            //delete
            Gps_markers.Delete = function()
            {
                if(!$("#form_Gps_markers").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_gps_markers/delete')?>",$("#form_Gps_markers").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Gps_markers " + message);
                });
            }

            Gps_markers.currentRowID = null;

            Gps_markers.setSelectedRow = function(id)
            {
                Gps_markers.currentRowID = id;
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
                    <h1> Gps_markers </h1>
                    <hr>

                    <form method="POST" id="form_Gps_markers" action="">
                        <label>
                            <span>stt_diem</span>
                            <input type="text" name="stt_diem" value="" id="gps_markers_stt_diem" class="input-text " onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>stt_nkht</span>
                            <input type="text" name="stt_nkht" value="" id="gps_markers_stt_nkht" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="gps_markers_so_dang_ky_xe" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ngay_khoi_hanh</span>
                            <input type="text" name="ngay_khoi_hanh" value="" id="gps_markers_ngay_khoi_hanh" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>lat</span>
                            <input type="text" name="lat" value="" id="gps_markers_lat" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>lng</span>
                            <input type="text" name="lng" value="" id="gps_markers_lng" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>type</span>
                            <input type="text" name="type" value="" id="gps_markers_type" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>gps_time</span>
                            <input type="text" name="gps_time" value="" id="gps_markers_gps_time" class="input-text keyAutoComplete" onchange="Gps_markers.setDataField(this.name,this.value);"  />
                        </label>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Gps_markers.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Gps_markers.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Gps_markers.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Gps_markers.Delete()" class="green"> Xoá </a>
                    </div>
                    <div id="ajaxloader" style="display:none" >
                        <img  src="<?php echo base_url()?>resources/css/img/ajax-loader.gif" />
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

        colNamesT.push('stt_diem');
        colModelT.push({name:'stt_diem',index:'stt_diem', editable: false});


        colNamesT.push('stt_nkht');
        colModelT.push({name:'stt_nkht',index:'stt_nkht', editable: false});

        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

        colNamesT.push('ngay_khoi_hanh');
        colModelT.push({name:'ngay_khoi_hanh',index:'ngay_khoi_hanh', editable: false});

        colNamesT.push('lat');
        colModelT.push({name:'lat',index:'lat', editable: false});

        colNamesT.push('lng');
        colModelT.push({name:'lng',index:'lng', editable: false});

        colNamesT.push('type');
        colModelT.push({name:'type',index:'type', editable: false});

        colNamesT.push('gps_time');
        colModelT.push({name:'gps_time',index:'gps_time', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_gps_markers/read_json_format')?>',
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
                caption:"gps_markers",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Gps_markers.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Gps_markers").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Gps_markers").ready(initForm);




        var inputDate = {};
        $( function() {
            inputDate['gps_markers_ngay_khoi_hanh'] = $("#gps_markers_ngay_khoi_hanh").datepicker({dateFormat:"yy/mm/dd"});
            $('#gps_markers_ngay_khoi_hanh').mask('9999/99/99');
            $('#gps_markers_ngay_khoi_hanh').validate({rules:{ require: true, date: true}});
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_gps_markers/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_gps_markers/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

        $("#gps_markers_stt_diem").autocomplete("<?php echo site_url('c_gps_markers/keyAutoComplete/stt_diem')?>", {
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