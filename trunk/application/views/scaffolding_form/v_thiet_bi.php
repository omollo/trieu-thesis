<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Thiet_bi</title>
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
            var Thiet_bi = {};

            Thiet_bi.data = {};
            Thiet_bi.setDataField = function(fieldName,fieldValue)
            {
                Thiet_bi.data[fieldName] = fieldValue;
            }

            Thiet_bi.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Thiet_bi.data[name] = value;
                    $("#form_Thiet_bi input[name="+ name +"]").setValue(value);
                });
            }


            Thiet_bi.getData = function()
            {
                var obj = {};
                $.each( $("#form_Thiet_bi").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Thiet_bi.data = obj;
                return Thiet_bi.data;
            }

            //create
            Thiet_bi.Create = function()
            {
                if(!$("#form_Thiet_bi").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_thiet_bi/create')?>", $("#form_Thiet_bi").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Thiet_bi " + message);
                    }
                });
            }

            //refresh grid
            Thiet_bi.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("http://localhost/vehicle1/index.php/c_thiet_bi/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Thiet_bi.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Thiet_bi.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Thiet_bi.Update = function()
            {
                if(!$("#form_Thiet_bi").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_thiet_bi/update')?>", $("#form_Thiet_bi").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Thiet_bi " + message);
                });
            }


            //delete
            Thiet_bi.Delete = function()
            {
                if(!$("#form_Thiet_bi").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_thiet_bi/delete')?>",$("#form_Thiet_bi").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Thiet_bi " + message);
                });
            }

            Thiet_bi.currentRowID = null;

            Thiet_bi.setSelectedRow = function(id)
            {
                Thiet_bi.currentRowID = id;
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
                    <h1> Thiết Bị </h1>
                    <hr>

                    <form method="POST" id="form_Thiet_bi" action="">
                        <label>
                            <span>stt_thiet_bi</span>
                            <input type="text" name="stt_thiet_bi" value="" id="thiet_bi_stt_thiet_bi" class="input-text " onchange="Thiet_bi.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="thiet_bi_so_dang_ky_xe" class="input-text " onchange="Thiet_bi.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ten_thiet_bi</span>
                            <input type="text" name="ten_thiet_bi" value="" id="thiet_bi_ten_thiet_bi" class="input-text keyAutoComplete" onchange="Thiet_bi.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>loai_thiet_bi</span>
                            <input type="text" name="loai_thiet_bi" value="" id="thiet_bi_loai_thiet_bi" class="input-text keyAutoComplete" onchange="Thiet_bi.setDataField(this.name,this.value);"  />
                        </label>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Thiet_bi.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Thiet_bi.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Thiet_bi.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Thiet_bi.Delete()" class="green"> Xoá </a>
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

        colNamesT.push('stt_thiet_bi');
        colModelT.push({name:'stt_thiet_bi',index:'stt_thiet_bi', editable: false});


        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

        colNamesT.push('ten_thiet_bi');
        colModelT.push({name:'ten_thiet_bi',index:'ten_thiet_bi', editable: false});

        colNamesT.push('loai_thiet_bi');
        colModelT.push({name:'loai_thiet_bi',index:'loai_thiet_bi', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_thiet_bi/read_json_format')?>',
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
                caption:"Thiết bị",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Thiet_bi.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Thiet_bi").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Thiet_bi").ready(initForm);




        var inputDate = {};
        $( function() {
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_thiet_bi/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_thiet_bi/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

        $("#thiet_bi_stt_thiet_bi").autocomplete("<?php echo site_url('c_thiet_bi/keyAutoComplete/stt_thiet_bi')?>", {
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
        $("#thiet_bi_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
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