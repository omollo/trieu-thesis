<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Chuyenhang</title>
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
            var Chuyenhang = {};

Chuyenhang.data = {};
Chuyenhang.setDataField = function(fieldName,fieldValue)
    {
Chuyenhang.data[fieldName] = fieldValue;
    }

Chuyenhang.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Chuyenhang.data[name] = value;
            $("#form_Chuyenhang input[name="+ name +"]").setValue(value);
        });
    }


Chuyenhang.getData = function()
    {
        var obj = {};
        $.each( $("#form_Chuyenhang").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Chuyenhang.data = obj;
        return Chuyenhang.data;
    }

    //create
Chuyenhang.Create = function()
    {
        if(!$("#form_Chuyenhang").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chuyenhang/create')?>", $("#form_Chuyenhang").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Chuyenhang " + message);
            }
        });
    }

    //refresh grid
Chuyenhang.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_chuyenhang/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Chuyenhang.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Chuyenhang.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Chuyenhang.Update = function()
    {
        if(!$("#form_Chuyenhang").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chuyenhang/update')?>", $("#form_Chuyenhang").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Chuyenhang " + message);
        });
    }


    //delete
Chuyenhang.Delete = function()
    {
        if(!$("#form_Chuyenhang").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_chuyenhang/delete')?>",$("#form_Chuyenhang").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Chuyenhang " + message);
        });
    }

Chuyenhang.currentRowID = null;

Chuyenhang.setSelectedRow = function(id)
    {
Chuyenhang.currentRowID = id;
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
                    <h1> Chuyenhang </h1>
                    <hr>

                    <form method="POST" id="form_Chuyenhang" action="">
                                                                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="chuyenhang_so_dang_ky_xe" class="input-text " onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ms_hanghoa</span>
                            <input type="text" name="ms_hanghoa" value="" id="chuyenhang_ms_hanghoa" class="input-text " onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ngay_nhanhang</span>
                            <input type="text" name="ngay_nhanhang" value="" id="chuyenhang_ngay_nhanhang" class="input-text " onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>diachi_nhanhang</span>
                            <input type="text" name="diachi_nhanhang" value="" id="chuyenhang_diachi_nhanhang" class="input-text keyAutoComplete" onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>diachi_trahang</span>
                            <input type="text" name="diachi_trahang" value="" id="chuyenhang_diachi_trahang" class="input-text keyAutoComplete" onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>soluong</span>
                            <input type="text" name="soluong" value="" id="chuyenhang_soluong" class="input-text keyAutoComplete" onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>trang_thai</span>
                            <input type="text" name="trang_thai" value="" id="chuyenhang_trang_thai" class="input-text keyAutoComplete" onchange="Chuyenhang.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Chuyenhang.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Chuyenhang.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Chuyenhang.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Chuyenhang.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('so_dang_ky_xe');
    colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

  
    colNamesT.push('ms_hanghoa');
    colModelT.push({name:'ms_hanghoa',index:'ms_hanghoa', editable: false});

  
    colNamesT.push('ngay_nhanhang');
    colModelT.push({name:'ngay_nhanhang',index:'ngay_nhanhang', editable: false});

  
    colNamesT.push('diachi_nhanhang');
    colModelT.push({name:'diachi_nhanhang',index:'diachi_nhanhang', editable: false});

    colNamesT.push('diachi_trahang');
    colModelT.push({name:'diachi_trahang',index:'diachi_trahang', editable: false});

    colNamesT.push('soluong');
    colModelT.push({name:'soluong',index:'soluong', editable: false});

    colNamesT.push('trang_thai');
    colModelT.push({name:'trang_thai',index:'trang_thai', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_chuyenhang/read_json_format')?>',
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
            caption:"chuyenhang",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Chuyenhang.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Chuyenhang").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Chuyenhang").ready(initForm);




    var inputDate = {};
    $( function() {
        inputDate['chuyenhang_ngay_nhanhang'] = $("#chuyenhang_ngay_nhanhang").datepicker({dateFormat:"yy/mm/dd"});
        $('#chuyenhang_ngay_nhanhang').mask('9999/99/99');
        $('#chuyenhang_ngay_nhanhang').validate({rules:{ require: true, date: true}});
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_chuyenhang/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_chuyenhang/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#chuyenhang_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
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
    $("#chuyenhang_ms_hanghoa").autocomplete("<?php echo site_url('c_chuyenhang/keyAutoComplete/ms_hanghoa')?>", {
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
    $("#chuyenhang_ngay_nhanhang").autocomplete("<?php echo site_url('c_chuyenhang/keyAutoComplete/ngay_nhanhang')?>", {
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