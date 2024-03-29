<html>
    <head>
        <base href="<?php echo base_url()?>">
        <title>Bienban_giaonhan</title>
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
            var Bienban_giaonhan = {};

Bienban_giaonhan.data = {};
Bienban_giaonhan.setDataField = function(fieldName,fieldValue)
    {
Bienban_giaonhan.data[fieldName] = fieldValue;
    }

Bienban_giaonhan.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Bienban_giaonhan.data[name] = value;
            $("#form_Bienban_giaonhan input[name="+ name +"]").setValue(value);
        });
    }


Bienban_giaonhan.getData = function()
    {
        var obj = {};
        $.each( $("#form_Bienban_giaonhan").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Bienban_giaonhan.data = obj;
        return Bienban_giaonhan.data;
    }

    //create
Bienban_giaonhan.Create = function()
    {
        if(!$("#form_Bienban_giaonhan").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_bienban_giaonhan/create')?>", $("#form_Bienban_giaonhan").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Bienban_giaonhan " + message);
            }
        });
    }

    //refresh grid
Bienban_giaonhan.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo base_url()?>index.php/c_bienban_giaonhan/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Bienban_giaonhan.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Bienban_giaonhan.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Bienban_giaonhan.Update = function()
    {
        if(!$("#form_Bienban_giaonhan").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_bienban_giaonhan/update')?>", $("#form_Bienban_giaonhan").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Bienban_giaonhan " + message);
        });
    }


    //delete
Bienban_giaonhan.Delete = function()
    {
        if(!$("#form_Bienban_giaonhan").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_bienban_giaonhan/delete')?>",$("#form_Bienban_giaonhan").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Bienban_giaonhan " + message);
        });
    }

Bienban_giaonhan.currentRowID = null;

Bienban_giaonhan.setSelectedRow = function(id)
    {
Bienban_giaonhan.currentRowID = id;
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
                    <h1> Bienban_giaonhan </h1>
                    <hr>

                    <form method="POST" id="form_Bienban_giaonhan" action="">
                                                                        <label>
                            <span>so_bienban</span>
                            <input type="text" name="so_bienban" value="" id="bienban_giaonhan_so_bienban" class="input-text " onchange="Bienban_giaonhan.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>so_van_don</span>
                            <input type="text" name="so_van_don" value="" id="bienban_giaonhan_so_van_don" class="input-text " onchange="Bienban_giaonhan.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ngay_bienban</span>
                            <input type="text" name="ngay_bienban" value="" id="bienban_giaonhan_ngay_bienban" class="input-text keyAutoComplete" onchange="Bienban_giaonhan.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten_nguoi_nhan</span>
                            <input type="text" name="ten_nguoi_nhan" value="" id="bienban_giaonhan_ten_nguoi_nhan" class="input-text keyAutoComplete" onchange="Bienban_giaonhan.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Bienban_giaonhan.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Bienban_giaonhan.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Bienban_giaonhan.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Bienban_giaonhan.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('so_bienban');
    colModelT.push({name:'so_bienban',index:'so_bienban', editable: false});

  
    colNamesT.push('so_van_don');
    colModelT.push({name:'so_van_don',index:'so_van_don', editable: false});

  
    colNamesT.push('ngay_bienban');
    colModelT.push({name:'ngay_bienban',index:'ngay_bienban', editable: false});

    colNamesT.push('ten_nguoi_nhan');
    colModelT.push({name:'ten_nguoi_nhan',index:'ten_nguoi_nhan', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_bienban_giaonhan/read_json_format')?>',
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
            caption:"bienban_giaonhan",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Bienban_giaonhan.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Bienban_giaonhan").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Bienban_giaonhan").ready(initForm);




    var inputDate = {};
    $( function() {
        inputDate['bienban_giaonhan_ngay_bienban'] = $("#bienban_giaonhan_ngay_bienban").datepicker({dateFormat:"yy/mm/dd"});
        $('#bienban_giaonhan_ngay_bienban').mask('9999/99/99');
        $('#bienban_giaonhan_ngay_bienban').validate({rules:{ require: true, date: true}});
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_bienban_giaonhan/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_bienban_giaonhan/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#bienban_giaonhan_so_bienban").autocomplete("<?php echo site_url('c_bienban_giaonhan/keyAutoComplete/so_bienban')?>", {
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
    $("#bienban_giaonhan_so_van_don").autocomplete("<?php echo site_url('c_van_don/keyAutoComplete/so_van_don')?>", {
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