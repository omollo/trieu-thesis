<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Hang_hoa</title>
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
            var Hang_hoa = {};

Hang_hoa.data = {};
Hang_hoa.setDataField = function(fieldName,fieldValue)
    {
Hang_hoa.data[fieldName] = fieldValue;
    }

Hang_hoa.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Hang_hoa.data[name] = value;
            $("#form_Hang_hoa input[name="+ name +"]").setValue(value);
        });
    }


Hang_hoa.getData = function()
    {
        var obj = {};
        $.each( $("#form_Hang_hoa").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Hang_hoa.data = obj;
        return Hang_hoa.data;
    }

    //create
Hang_hoa.Create = function()
    {
        if(!$("#form_Hang_hoa").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_hang_hoa/create')?>", $("#form_Hang_hoa").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Hang_hoa " + message);
            }
        });
    }

    //refresh grid
Hang_hoa.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_hang_hoa/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Hang_hoa.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Hang_hoa.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Hang_hoa.Update = function()
    {
        if(!$("#form_Hang_hoa").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_hang_hoa/update')?>", $("#form_Hang_hoa").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Hang_hoa " + message);
        });
    }


    //delete
Hang_hoa.Delete = function()
    {
        if(!$("#form_Hang_hoa").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_hang_hoa/delete')?>",$("#form_Hang_hoa").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Hang_hoa " + message);
        });
    }

Hang_hoa.currentRowID = null;

Hang_hoa.setSelectedRow = function(id)
    {
Hang_hoa.currentRowID = id;
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
                    <h1> Hang_hoa </h1>
                    <hr>

                    <form method="POST" id="form_Hang_hoa" action="">
                                                                        <label>
                            <span>ms_hanghoa</span>
                            <input type="text" name="ms_hanghoa" value="" id="hang_hoa_ms_hanghoa" class="input-text " onchange="Hang_hoa.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>stt_khachhang</span>
                            <input type="text" name="stt_khachhang" value="" id="hang_hoa_stt_khachhang" class="input-text keyAutoComplete" onchange="Hang_hoa.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten_hanghoa</span>
                            <input type="text" name="ten_hanghoa" value="" id="hang_hoa_ten_hanghoa" class="input-text keyAutoComplete" onchange="Hang_hoa.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>soluong</span>
                            <input type="text" name="soluong" value="" id="hang_hoa_soluong" class="input-text keyAutoComplete" onchange="Hang_hoa.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>donvitinh</span>
                            <input type="text" name="donvitinh" value="" id="hang_hoa_donvitinh" class="input-text keyAutoComplete" onchange="Hang_hoa.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>loaihang</span>
                            <input type="text" name="loaihang" value="" id="hang_hoa_loaihang" class="input-text keyAutoComplete" onchange="Hang_hoa.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Hang_hoa.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Hang_hoa.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Hang_hoa.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Hang_hoa.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('ms_hanghoa');
    colModelT.push({name:'ms_hanghoa',index:'ms_hanghoa', editable: false});

  
    colNamesT.push('stt_khachhang');
    colModelT.push({name:'stt_khachhang',index:'stt_khachhang', editable: false});

    colNamesT.push('ten_hanghoa');
    colModelT.push({name:'ten_hanghoa',index:'ten_hanghoa', editable: false});

    colNamesT.push('soluong');
    colModelT.push({name:'soluong',index:'soluong', editable: false});

    colNamesT.push('donvitinh');
    colModelT.push({name:'donvitinh',index:'donvitinh', editable: false});

    colNamesT.push('loaihang');
    colModelT.push({name:'loaihang',index:'loaihang', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_hang_hoa/read_json_format')?>',
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
            caption:"hang_hoa",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Hang_hoa.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Hang_hoa").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Hang_hoa").ready(initForm);




    var inputDate = {};
    $( function() {
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_hang_hoa/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_hang_hoa/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#hang_hoa_ms_hanghoa").autocomplete("<?php echo site_url('c_hang_hoa/keyAutoComplete/ms_hanghoa')?>", {
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