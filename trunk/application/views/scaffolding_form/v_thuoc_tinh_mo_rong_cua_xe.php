<html>
    <head>
        <base href="<?php echo base_url()?>/">
        <title>Thuoc_tinh_mo_rong_cua_xe</title>
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
            var Thuoc_tinh_mo_rong_cua_xe = {};

Thuoc_tinh_mo_rong_cua_xe.data = {};
Thuoc_tinh_mo_rong_cua_xe.setDataField = function(fieldName,fieldValue)
    {
Thuoc_tinh_mo_rong_cua_xe.data[fieldName] = fieldValue;
    }

Thuoc_tinh_mo_rong_cua_xe.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Thuoc_tinh_mo_rong_cua_xe.data[name] = value;
            $("#form_Thuoc_tinh_mo_rong_cua_xe input[name="+ name +"]").setValue(value);
        });
    }


Thuoc_tinh_mo_rong_cua_xe.getData = function()
    {
        var obj = {};
        $.each( $("#form_Thuoc_tinh_mo_rong_cua_xe").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Thuoc_tinh_mo_rong_cua_xe.data = obj;
        return Thuoc_tinh_mo_rong_cua_xe.data;
    }

    //create
Thuoc_tinh_mo_rong_cua_xe.Create = function()
    {
        if(!$("#form_Thuoc_tinh_mo_rong_cua_xe").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/create')?>", $("#form_Thuoc_tinh_mo_rong_cua_xe").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Thuoc_tinh_mo_rong_cua_xe " + message);
            }
        });
    }

    //refresh grid
Thuoc_tinh_mo_rong_cua_xe.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo base_url()?>/index.php/c_thuoc_tinh_mo_rong_cua_xe/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Thuoc_tinh_mo_rong_cua_xe.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Thuoc_tinh_mo_rong_cua_xe.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Thuoc_tinh_mo_rong_cua_xe.Update = function()
    {
        if(!$("#form_Thuoc_tinh_mo_rong_cua_xe").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/update')?>", $("#form_Thuoc_tinh_mo_rong_cua_xe").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Thuoc_tinh_mo_rong_cua_xe " + message);
        });
    }


    //delete
Thuoc_tinh_mo_rong_cua_xe.Delete = function()
    {
        if(!$("#form_Thuoc_tinh_mo_rong_cua_xe").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/delete')?>",$("#form_Thuoc_tinh_mo_rong_cua_xe").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Thuoc_tinh_mo_rong_cua_xe " + message);
        });
    }

Thuoc_tinh_mo_rong_cua_xe.currentRowID = null;

Thuoc_tinh_mo_rong_cua_xe.setSelectedRow = function(id)
    {
Thuoc_tinh_mo_rong_cua_xe.currentRowID = id;
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
                    <h1> Thuộc Tích Mở Rộng Của Xe </h1>
                    <hr>

                    <form method="POST" id="form_Thuoc_tinh_mo_rong_cua_xe" action="">
                                                                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="thuoc_tinh_mo_rong_cua_xe_so_dang_ky_xe" class="input-text " onchange="Thuoc_tinh_mo_rong_cua_xe.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten</span>
                            <input type="text" name="ten" value="" id="thuoc_tinh_mo_rong_cua_xe_ten" class="input-text " onchange="Thuoc_tinh_mo_rong_cua_xe.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>gia_tri</span>
                            <input type="text" name="gia_tri" value="" id="thuoc_tinh_mo_rong_cua_xe_gia_tri" class="input-text keyAutoComplete" onchange="Thuoc_tinh_mo_rong_cua_xe.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Thuoc_tinh_mo_rong_cua_xe.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Thuoc_tinh_mo_rong_cua_xe.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Thuoc_tinh_mo_rong_cua_xe.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Thuoc_tinh_mo_rong_cua_xe.Delete()" class="green"> Xoá </a>
                    </div>
                    <div id="ajaxloader" style="display:none" >
                        <img  src="<?php echo base_url()?>/index.php/resources/css/img/ajax-loader.gif" />
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

  
    colNamesT.push('ten');
    colModelT.push({name:'ten',index:'ten', editable: false});

  
    colNamesT.push('gia_tri');
    colModelT.push({name:'gia_tri',index:'gia_tri', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/read_json_format')?>',
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
            caption:"Thuộc tích mở rộng của xe",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Thuoc_tinh_mo_rong_cua_xe.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Thuoc_tinh_mo_rong_cua_xe").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Thuoc_tinh_mo_rong_cua_xe").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#thuoc_tinh_mo_rong_cua_xe_so_dang_ky_xe").autocomplete("<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/keyAutoComplete/so_dang_ky_xe')?>", {
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
    $("#thuoc_tinh_mo_rong_cua_xe_ten").autocomplete("<?php echo site_url('c_thuoc_tinh_mo_rong_cua_xe/keyAutoComplete/ten')?>", {
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