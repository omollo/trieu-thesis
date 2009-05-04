<html>
    <head>
        <base href="<?php echo base_url()?>">
        <title>Chi_nhanh</title>
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
            var Chi_nhanh = {};

Chi_nhanh.data = {};
Chi_nhanh.setDataField = function(fieldName,fieldValue)
    {
Chi_nhanh.data[fieldName] = fieldValue;
    }

Chi_nhanh.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Chi_nhanh.data[name] = value;
            $("#form_Chi_nhanh input[name="+ name +"]").setValue(value);
        });
    }


Chi_nhanh.getData = function()
    {
        var obj = {};
        $.each( $("#form_Chi_nhanh").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Chi_nhanh.data = obj;
        return Chi_nhanh.data;
    }

    //create
Chi_nhanh.Create = function()
    {
        if(!$("#form_Chi_nhanh").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chi_nhanh/create')?>", $("#form_Chi_nhanh").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Chi_nhanh " + message);
            }
        });
    }

    //refresh grid
Chi_nhanh.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo base_url()?>index.php/c_chi_nhanh/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Chi_nhanh.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Chi_nhanh.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Chi_nhanh.Update = function()
    {
        if(!$("#form_Chi_nhanh").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chi_nhanh/update')?>", $("#form_Chi_nhanh").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Chi_nhanh " + message);
        });
    }


    //delete
Chi_nhanh.Delete = function()
    {
        if(!$("#form_Chi_nhanh").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chi_nhanh/delete')?>",$("#form_Chi_nhanh").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Chi_nhanh " + message);
        });
    }

Chi_nhanh.currentRowID = null;

Chi_nhanh.setSelectedRow = function(id)
    {
Chi_nhanh.currentRowID = id;
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
                    <h1> Chi Nhánh </h1>
                    <hr>

                    <form method="POST" id="form_Chi_nhanh" action="">
                                                                        <label>
                            <span>ms_chi_nhanh</span>
                            <input type="text" name="ms_chi_nhanh" value="" id="chi_nhanh_ms_chi_nhanh" class="input-text " onchange="Chi_nhanh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>stt_diem</span>
                            <input type="text" name="stt_diem" value="" id="chi_nhanh_stt_diem" class="input-text keyAutoComplete" onchange="Chi_nhanh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten_chi_nhanh</span>
                            <input type="text" name="ten_chi_nhanh" value="" id="chi_nhanh_ten_chi_nhanh" class="input-text keyAutoComplete" onchange="Chi_nhanh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>diachi</span>
                            <input type="text" name="diachi" value="" id="chi_nhanh_diachi" class="input-text keyAutoComplete" onchange="Chi_nhanh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>dienthoai</span>
                            <input type="text" name="dienthoai" value="" id="chi_nhanh_dienthoai" class="input-text keyAutoComplete" onchange="Chi_nhanh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>loai_chi_nhanh</span>
                            <input type="text" name="loai_chi_nhanh" value="" id="chi_nhanh_loai_chi_nhanh" class="input-text keyAutoComplete" onchange="Chi_nhanh.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Chi_nhanh.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Chi_nhanh.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Chi_nhanh.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Chi_nhanh.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('ms_chi_nhanh');
    colModelT.push({name:'ms_chi_nhanh',index:'ms_chi_nhanh', editable: false});

  
    colNamesT.push('stt_diem');
    colModelT.push({name:'stt_diem',index:'stt_diem', editable: false});

    colNamesT.push('ten_chi_nhanh');
    colModelT.push({name:'ten_chi_nhanh',index:'ten_chi_nhanh', editable: false});

    colNamesT.push('diachi');
    colModelT.push({name:'diachi',index:'diachi', editable: false});

    colNamesT.push('dienthoai');
    colModelT.push({name:'dienthoai',index:'dienthoai', editable: false});

    colNamesT.push('loai_chi_nhanh');
    colModelT.push({name:'loai_chi_nhanh',index:'loai_chi_nhanh', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_chi_nhanh/read_json_format')?>',
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
            caption:"Chi nhánh",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Chi_nhanh.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Chi_nhanh").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Chi_nhanh").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_chi_nhanh/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_chi_nhanh/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#chi_nhanh_ms_chi_nhanh").autocomplete("<?php echo site_url('c_chi_nhanh/keyAutoComplete/ms_chi_nhanh')?>", {
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