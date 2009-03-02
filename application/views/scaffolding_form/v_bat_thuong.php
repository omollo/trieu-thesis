<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Bat_thuong</title>
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
            var Bat_thuong = {};

Bat_thuong.data = {};
Bat_thuong.setDataField = function(fieldName,fieldValue)
    {
Bat_thuong.data[fieldName] = fieldValue;
    }

Bat_thuong.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Bat_thuong.data[name] = value;
            $("#form_Bat_thuong input[name="+ name +"]").setValue(value);
        });
    }


Bat_thuong.getData = function()
    {
        var obj = {};
        $.each( $("#form_Bat_thuong").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Bat_thuong.data = obj;
        return Bat_thuong.data;
    }

    //create
Bat_thuong.Create = function()
    {
        if(!$("#form_Bat_thuong").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_bat_thuong/create')?>", $("#form_Bat_thuong").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Bat_thuong " + message);
            }
        });
    }

    //refresh grid
Bat_thuong.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_bat_thuong/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Bat_thuong.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Bat_thuong.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Bat_thuong.Update = function()
    {
        if(!$("#form_Bat_thuong").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_bat_thuong/update')?>", $("#form_Bat_thuong").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Bat_thuong " + message);
        });
    }


    //delete
Bat_thuong.Delete = function()
    {
        if(!$("#form_Bat_thuong").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_bat_thuong/delete')?>",$("#form_Bat_thuong").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Bat_thuong " + message);
        });
    }

Bat_thuong.currentRowID = null;

Bat_thuong.setSelectedRow = function(id)
    {
Bat_thuong.currentRowID = id;
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
                    <h1> Bat_thuong </h1>
                    <hr>

                    <form method="POST" id="form_Bat_thuong" action="">
                                                                        <label>
                            <span>stt_bt</span>
                            <input type="text" name="stt_bt" value="" id="bat_thuong_stt_bt" class="input-text " onchange="Bat_thuong.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="bat_thuong_so_dang_ky_xe" class="input-text keyAutoComplete" onchange="Bat_thuong.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>loai_bat_thuong</span>
                            <input type="text" name="loai_bat_thuong" value="" id="bat_thuong_loai_bat_thuong" class="input-text keyAutoComplete" onchange="Bat_thuong.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>mo_ta_bat_thuong</span>
                            <input type="text" name="mo_ta_bat_thuong" value="" id="bat_thuong_mo_ta_bat_thuong" class="input-text keyAutoComplete" onchange="Bat_thuong.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>speedometer</span>
                            <input type="text" name="speedometer" value="" id="bat_thuong_speedometer" class="input-text keyAutoComplete" onchange="Bat_thuong.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Bat_thuong.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Bat_thuong.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Bat_thuong.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Bat_thuong.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('stt_bt');
    colModelT.push({name:'stt_bt',index:'stt_bt', editable: false});

  
    colNamesT.push('so_dang_ky_xe');
    colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

    colNamesT.push('loai_bat_thuong');
    colModelT.push({name:'loai_bat_thuong',index:'loai_bat_thuong', editable: false});

    colNamesT.push('mo_ta_bat_thuong');
    colModelT.push({name:'mo_ta_bat_thuong',index:'mo_ta_bat_thuong', editable: false});

    colNamesT.push('speedometer');
    colModelT.push({name:'speedometer',index:'speedometer', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_bat_thuong/read_json_format')?>',
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
            caption:"bat_thuong",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Bat_thuong.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Bat_thuong").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Bat_thuong").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_bat_thuong/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_bat_thuong/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#bat_thuong_stt_bt").autocomplete("<?php echo site_url('c_bat_thuong/keyAutoComplete/stt_bt')?>", {
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