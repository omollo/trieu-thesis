<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Chi_tiet_van_don</title>
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
            var Chi_tiet_van_don = {};

Chi_tiet_van_don.data = {};
Chi_tiet_van_don.setDataField = function(fieldName,fieldValue)
    {
Chi_tiet_van_don.data[fieldName] = fieldValue;
    }

Chi_tiet_van_don.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Chi_tiet_van_don.data[name] = value;
            $("#form_Chi_tiet_van_don input[name="+ name +"]").setValue(value);
        });
    }


Chi_tiet_van_don.getData = function()
    {
        var obj = {};
        $.each( $("#form_Chi_tiet_van_don").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Chi_tiet_van_don.data = obj;
        return Chi_tiet_van_don.data;
    }

    //create
Chi_tiet_van_don.Create = function()
    {
        if(!$("#form_Chi_tiet_van_don").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chi_tiet_van_don/create')?>", $("#form_Chi_tiet_van_don").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Chi_tiet_van_don " + message);
            }
        });
    }

    //refresh grid
Chi_tiet_van_don.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_chi_tiet_van_don/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Chi_tiet_van_don.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Chi_tiet_van_don.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Chi_tiet_van_don.Update = function()
    {
        if(!$("#form_Chi_tiet_van_don").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chi_tiet_van_don/update')?>", $("#form_Chi_tiet_van_don").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Chi_tiet_van_don " + message);
        });
    }


    //delete
Chi_tiet_van_don.Delete = function()
    {
        if(!$("#form_Chi_tiet_van_don").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chi_tiet_van_don/delete')?>",$("#form_Chi_tiet_van_don").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Chi_tiet_van_don " + message);
        });
    }

Chi_tiet_van_don.currentRowID = null;

Chi_tiet_van_don.setSelectedRow = function(id)
    {
Chi_tiet_van_don.currentRowID = id;
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
                    <h1> Chi_tiet_van_don </h1>
                    <hr>

                    <form method="POST" id="form_Chi_tiet_van_don" action="">
                                                                        <label>
                            <span>so_van_don</span>
                            <input type="text" name="so_van_don" value="" id="chi_tiet_van_don_so_van_don" class="input-text " onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ms_hanghoa</span>
                            <input type="text" name="ms_hanghoa" value="" id="chi_tiet_van_don_ms_hanghoa" class="input-text " onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ma_chuyen</span>
                            <input type="text" name="ma_chuyen" value="" id="chi_tiet_van_don_ma_chuyen" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ms_loaihang</span>
                            <input type="text" name="ms_loaihang" value="" id="chi_tiet_van_don_ms_loaihang" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten_hang</span>
                            <input type="text" name="ten_hang" value="" id="chi_tiet_van_don_ten_hang" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>so_luong</span>
                            <input type="text" name="so_luong" value="" id="chi_tiet_van_don_so_luong" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>khoi_luong</span>
                            <input type="text" name="khoi_luong" value="" id="chi_tiet_van_don_khoi_luong" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>quy_cach_dong_goi</span>
                            <input type="text" name="quy_cach_dong_goi" value="" id="chi_tiet_van_don_quy_cach_dong_goi" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>trangthai_hanghoa</span>
                            <input type="text" name="trangthai_hanghoa" value="" id="chi_tiet_van_don_trangthai_hanghoa" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>nguoinhan</span>
                            <input type="text" name="nguoinhan" value="" id="chi_tiet_van_don_nguoinhan" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>diachi_nhan</span>
                            <input type="text" name="diachi_nhan" value="" id="chi_tiet_van_don_diachi_nhan" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>cuoc</span>
                            <input type="text" name="cuoc" value="" id="chi_tiet_van_don_cuoc" class="input-text keyAutoComplete" onchange="Chi_tiet_van_don.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Chi_tiet_van_don.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Chi_tiet_van_don.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Chi_tiet_van_don.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Chi_tiet_van_don.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('so_van_don');
    colModelT.push({name:'so_van_don',index:'so_van_don', editable: false});

  
    colNamesT.push('ms_hanghoa');
    colModelT.push({name:'ms_hanghoa',index:'ms_hanghoa', editable: false});

  
    colNamesT.push('ma_chuyen');
    colModelT.push({name:'ma_chuyen',index:'ma_chuyen', editable: false});

    colNamesT.push('ms_loaihang');
    colModelT.push({name:'ms_loaihang',index:'ms_loaihang', editable: false});

    colNamesT.push('ten_hang');
    colModelT.push({name:'ten_hang',index:'ten_hang', editable: false});

    colNamesT.push('so_luong');
    colModelT.push({name:'so_luong',index:'so_luong', editable: false});

    colNamesT.push('khoi_luong');
    colModelT.push({name:'khoi_luong',index:'khoi_luong', editable: false});

    colNamesT.push('quy_cach_dong_goi');
    colModelT.push({name:'quy_cach_dong_goi',index:'quy_cach_dong_goi', editable: false});

    colNamesT.push('trangthai_hanghoa');
    colModelT.push({name:'trangthai_hanghoa',index:'trangthai_hanghoa', editable: false});

    colNamesT.push('nguoinhan');
    colModelT.push({name:'nguoinhan',index:'nguoinhan', editable: false});

    colNamesT.push('diachi_nhan');
    colModelT.push({name:'diachi_nhan',index:'diachi_nhan', editable: false});

    colNamesT.push('cuoc');
    colModelT.push({name:'cuoc',index:'cuoc', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_chi_tiet_van_don/read_json_format')?>',
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
            caption:"chi_tiet_van_don",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Chi_tiet_van_don.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Chi_tiet_van_don").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Chi_tiet_van_don").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_chi_tiet_van_don/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_chi_tiet_van_don/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#chi_tiet_van_don_so_van_don").autocomplete("<?php echo site_url('c_chi_tiet_van_don/keyAutoComplete/so_van_don')?>", {
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
    $("#chi_tiet_van_don_ms_hanghoa").autocomplete("<?php echo site_url('c_chi_tiet_van_don/keyAutoComplete/ms_hanghoa')?>", {
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