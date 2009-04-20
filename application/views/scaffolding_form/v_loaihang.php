<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Loaihang</title>
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
            var Loaihang = {};

Loaihang.data = {};
Loaihang.setDataField = function(fieldName,fieldValue)
    {
Loaihang.data[fieldName] = fieldValue;
    }

Loaihang.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Loaihang.data[name] = value;
            $("#form_Loaihang input[name="+ name +"]").setValue(value);
        });
    }


Loaihang.getData = function()
    {
        var obj = {};
        $.each( $("#form_Loaihang").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Loaihang.data = obj;
        return Loaihang.data;
    }

    //create
Loaihang.Create = function()
    {
        if(!$("#form_Loaihang").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_loaihang/create')?>", $("#form_Loaihang").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Loaihang " + message);
            }
        });
    }

    //refresh grid
Loaihang.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_loaihang/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Loaihang.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Loaihang.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Loaihang.Update = function()
    {
        if(!$("#form_Loaihang").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_loaihang/update')?>", $("#form_Loaihang").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Loaihang " + message);
        });
    }


    //delete
Loaihang.Delete = function()
    {
        if(!$("#form_Loaihang").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_loaihang/delete')?>",$("#form_Loaihang").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Loaihang " + message);
        });
    }

Loaihang.currentRowID = null;

Loaihang.setSelectedRow = function(id)
    {
Loaihang.currentRowID = id;
    }



        </script>
    </head>

    <body>
        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>Thông tin chung</span></a></li>
            </ul>
            <div id="fragment-1" style="width: 1124px;">
                <div>
                    <table id="list2" class="scroll" style="margin-top:8px;" cellpadding="0" cellspacing="0"></table>
                    <div id="pager2" class="scroll" style="text-align:center;"></div>
                </div>

                <hr>

                <div class="box">
                    <h1> Loaihang </h1>
                    <hr>

                    <form method="POST" id="form_Loaihang" action="">
                                                                        <label>
                            <span>ms_loaihang</span>
                            <input type="text" name="ms_loaihang" value="" id="loaihang_ms_loaihang" class="input-text " onchange="Loaihang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten_loaihang</span>
                            <input type="text" name="ten_loaihang" value="" id="loaihang_ten_loaihang" class="input-text keyAutoComplete" onchange="Loaihang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>dac_tinh</span>
                            <input type="text" name="dac_tinh" value="" id="loaihang_dac_tinh" class="input-text keyAutoComplete" onchange="Loaihang.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Loaihang.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Loaihang.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Loaihang.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Loaihang.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('ms_loaihang');
    colModelT.push({name:'ms_loaihang',index:'ms_loaihang', editable: false});

  
    colNamesT.push('ten_loaihang');
    colModelT.push({name:'ten_loaihang',index:'ten_loaihang', editable: false});

    colNamesT.push('dac_tinh');
    colModelT.push({name:'dac_tinh',index:'dac_tinh', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_loaihang/read_json_format')?>',
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
            caption:"loaihang",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Loaihang.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Loaihang").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Loaihang").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_loaihang/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_loaihang/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#loaihang_ms_loaihang").autocomplete("<?php echo site_url('c_loaihang/keyAutoComplete/ms_loaihang')?>", {
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