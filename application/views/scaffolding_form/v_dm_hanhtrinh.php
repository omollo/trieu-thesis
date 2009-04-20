<html>
    <head>
        <base href="<?php echo base_url()?>">
        <title>Dm_hanhtrinh</title>
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
            var Dm_hanhtrinh = {};

Dm_hanhtrinh.data = {};
Dm_hanhtrinh.setDataField = function(fieldName,fieldValue)
    {
Dm_hanhtrinh.data[fieldName] = fieldValue;
    }

Dm_hanhtrinh.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Dm_hanhtrinh.data[name] = value;
            $("#form_Dm_hanhtrinh input[name="+ name +"]").setValue(value);
        });
    }


Dm_hanhtrinh.getData = function()
    {
        var obj = {};
        $.each( $("#form_Dm_hanhtrinh").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Dm_hanhtrinh.data = obj;
        return Dm_hanhtrinh.data;
    }

    //create
Dm_hanhtrinh.Create = function()
    {
        if(!$("#form_Dm_hanhtrinh").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_dm_hanhtrinh/create')?>", $("#form_Dm_hanhtrinh").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Dm_hanhtrinh " + message);
            }
        });
    }

    //refresh grid
Dm_hanhtrinh.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_dm_hanhtrinh/read_json_format')?>", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Dm_hanhtrinh.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Dm_hanhtrinh.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Dm_hanhtrinh.Update = function()
    {
        if(!$("#form_Dm_hanhtrinh").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_dm_hanhtrinh/update')?>", $("#form_Dm_hanhtrinh").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Dm_hanhtrinh " + message);
        });
    }


    //delete
Dm_hanhtrinh.Delete = function()
    {
        if(!$("#form_Dm_hanhtrinh").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_dm_hanhtrinh/delete')?>",$("#form_Dm_hanhtrinh").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Dm_hanhtrinh " + message);
        });
    }

Dm_hanhtrinh.currentRowID = null;

Dm_hanhtrinh.setSelectedRow = function(id)
    {
Dm_hanhtrinh.currentRowID = id;
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
                    <h1> Dm_hanhtrinh </h1>
                    <hr>

                    <form method="POST" id="form_Dm_hanhtrinh" action="">
                                                                        <label>
                            <span>ms_hanhtrinh</span>
                            <input type="text" name="ms_hanhtrinh" value="" id="dm_hanhtrinh_ms_hanhtrinh" class="input-text " onchange="Dm_hanhtrinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten_hanh_trinh</span>
                            <input type="text" name="ten_hanh_trinh" value="" id="dm_hanhtrinh_ten_hanh_trinh" class="input-text keyAutoComplete" onchange="Dm_hanhtrinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>so_km</span>
                            <input type="text" name="so_km" value="" id="dm_hanhtrinh_so_km" class="input-text keyAutoComplete" onchange="Dm_hanhtrinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Dm_hanhtrinh.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Dm_hanhtrinh.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Dm_hanhtrinh.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Dm_hanhtrinh.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('ms_hanhtrinh');
    colModelT.push({name:'ms_hanhtrinh',index:'ms_hanhtrinh', editable: false});

  
    colNamesT.push('ten_hanh_trinh');
    colModelT.push({name:'ten_hanh_trinh',index:'ten_hanh_trinh', editable: false});

    colNamesT.push('so_km');
    colModelT.push({name:'so_km',index:'so_km', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_dm_hanhtrinh/read_json_format')?>',
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
            caption:"dm_hanhtrinh",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Dm_hanhtrinh.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Dm_hanhtrinh").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Dm_hanhtrinh").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        //FIXME
        $(".FIXME_keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_dm_hanhtrinh/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_dm_hanhtrinh/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#dm_hanhtrinh_ms_hanhtrinh").autocomplete("<?php echo site_url('c_dm_hanhtrinh/keyAutoComplete/ms_hanhtrinh')?>", {
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