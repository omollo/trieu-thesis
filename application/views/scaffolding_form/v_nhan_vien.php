<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Nhan_vien</title>
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
            var Nhan_vien = {};

Nhan_vien.data = {};
Nhan_vien.setDataField = function(fieldName,fieldValue)
    {
Nhan_vien.data[fieldName] = fieldValue;
    }

Nhan_vien.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Nhan_vien.data[name] = value;
            $("#form_Nhan_vien input[name="+ name +"]").setValue(value);
        });
    }


Nhan_vien.getData = function()
    {
        var obj = {};
        $.each( $("#form_Nhan_vien").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Nhan_vien.data = obj;
        return Nhan_vien.data;
    }

    //create
Nhan_vien.Create = function()
    {
        if(!$("#form_Nhan_vien").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_nhan_vien/create')?>", $("#form_Nhan_vien").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Nhan_vien " + message);
            }
        });
    }

    //refresh grid
Nhan_vien.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_nhan_vien/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Nhan_vien.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Nhan_vien.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Nhan_vien.Update = function()
    {
        if(!$("#form_Nhan_vien").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_nhan_vien/update')?>", $("#form_Nhan_vien").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Nhan_vien " + message);
        });
    }


    //delete
Nhan_vien.Delete = function()
    {
        if(!$("#form_Nhan_vien").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_nhan_vien/delete')?>",$("#form_Nhan_vien").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Nhan_vien " + message);
        });
    }

Nhan_vien.currentRowID = null;

Nhan_vien.setSelectedRow = function(id)
    {
Nhan_vien.currentRowID = id;
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
                    <h1> Nhan_vien </h1>
                    <hr>

                    <form method="POST" id="form_Nhan_vien" action="">
                                                                        <label>
                            <span>stt_nhanvien</span>
                            <input type="text" name="stt_nhanvien" value="" id="nhan_vien_stt_nhanvien" class="input-text " onchange="Nhan_vien.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ho_ten</span>
                            <input type="text" name="ho_ten" value="" id="nhan_vien_ho_ten" class="input-text keyAutoComplete" onchange="Nhan_vien.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>tendangnhap</span>
                            <input type="text" name="tendangnhap" value="" id="nhan_vien_tendangnhap" class="input-text keyAutoComplete" onchange="Nhan_vien.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>matkhau</span>
                            <input type="text" name="matkhau" value="" id="nhan_vien_matkhau" class="input-text keyAutoComplete" onchange="Nhan_vien.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>nhom</span>
                            <input type="text" name="nhom" value="" id="nhan_vien_nhom" class="input-text keyAutoComplete" onchange="Nhan_vien.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>cong_viec</span>
                            <input type="text" name="cong_viec" value="" id="nhan_vien_cong_viec" class="input-text keyAutoComplete" onchange="Nhan_vien.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Nhan_vien.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Nhan_vien.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Nhan_vien.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Nhan_vien.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('stt_nhanvien');
    colModelT.push({name:'stt_nhanvien',index:'stt_nhanvien', editable: false});

  
    colNamesT.push('ho_ten');
    colModelT.push({name:'ho_ten',index:'ho_ten', editable: false});

    colNamesT.push('tendangnhap');
    colModelT.push({name:'tendangnhap',index:'tendangnhap', editable: false});

    colNamesT.push('matkhau');
    colModelT.push({name:'matkhau',index:'matkhau', editable: false});

    colNamesT.push('nhom');
    colModelT.push({name:'nhom',index:'nhom', editable: false});

    colNamesT.push('cong_viec');
    colModelT.push({name:'cong_viec',index:'cong_viec', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_nhan_vien/read_json_format')?>',
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
            caption:"nhan_vien",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Nhan_vien.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Nhan_vien").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Nhan_vien").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_nhan_vien/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_nhan_vien/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#nhan_vien_stt_nhanvien").autocomplete("<?php echo site_url('c_nhan_vien/keyAutoComplete/stt_nhanvien')?>", {
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