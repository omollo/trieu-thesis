<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Nhat_ki_hanh_trinh</title>
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
            var Nhat_ki_hanh_trinh = {};

Nhat_ki_hanh_trinh.data = {};
Nhat_ki_hanh_trinh.setDataField = function(fieldName,fieldValue)
    {
Nhat_ki_hanh_trinh.data[fieldName] = fieldValue;
    }

Nhat_ki_hanh_trinh.setData = function(data)
    {
        jQuery.each(data, function(name, value) {
Nhat_ki_hanh_trinh.data[name] = value;
            $("#form_Nhat_ki_hanh_trinh input[name="+ name +"]").setValue(value);
        });
    }


Nhat_ki_hanh_trinh.getData = function()
    {
        var obj = {};
        $.each( $("#form_Nhat_ki_hanh_trinh").formSerialize().split("&"), function(i,n)
        {
            var toks = n.split("=");
            obj[toks[0]] = toks[1];
        }
    );
Nhat_ki_hanh_trinh.data = obj;
        return Nhat_ki_hanh_trinh.data;
    }

    //create
Nhat_ki_hanh_trinh.Create = function()
    {
        if(!$("#form_Nhat_ki_hanh_trinh").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_nhat_ki_hanh_trinh/create')?>", $("#form_Nhat_ki_hanh_trinh").formToArray() ,
        function(message){
            if(message != null){
                InlineBox.hideAjaxLoader();
                $("#list2").trigger("reloadGrid");
                InlineBox.showModalBox("Tạo Nhat_ki_hanh_trinh " + message);
            }
        });
    }

    //refresh grid
Nhat_ki_hanh_trinh.Read = function()
    {
        InlineBox.showAjaxLoader();
        jQuery.post("http://localhost/vehicle1/index.php/c_nhat_ki_hanh_trinh/read_json_format", {},
        function(data){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
        });
    }

    // Filter the Grid and refresh
Nhat_ki_hanh_trinh.Filter = function()
    {
        //var name_field = $("#"+id).attr("name");
        //var value_field =  $("#"+id).val();
        //jQuery("#list2").setPostData({name_field:value_field});
        var post_data = Nhat_ki_hanh_trinh.getData();

        for(var e in post_data){
            if($.trim(post_data[e]) == "")
                delete post_data[e];
        }
        jQuery("#list2").setPostData(post_data);
        $("#list2").trigger("reloadGrid");
    }

    //update
Nhat_ki_hanh_trinh.Update = function()
    {
        if(!$("#form_Nhat_ki_hanh_trinh").valid())
        return;

        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_nhat_ki_hanh_trinh/update')?>", $("#form_Nhat_ki_hanh_trinh").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Cập nhật Nhat_ki_hanh_trinh " + message);
        });
    }


    //delete
Nhat_ki_hanh_trinh.Delete = function()
    {
        if(!$("#form_Nhat_ki_hanh_trinh").valid())
        return;
        InlineBox.showAjaxLoader();
        jQuery.post("<?php echo site_url('c_nhat_ki_hanh_trinh/delete')?>",$("#form_Nhat_ki_hanh_trinh").formToArray() ,
        function(message){
            InlineBox.hideAjaxLoader();
            $("#list2").trigger("reloadGrid");
            InlineBox.showModalBox("Xoá Nhat_ki_hanh_trinh " + message);
        });
    }

Nhat_ki_hanh_trinh.currentRowID = null;

Nhat_ki_hanh_trinh.setSelectedRow = function(id)
    {
Nhat_ki_hanh_trinh.currentRowID = id;
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
                    <h1> Nhật Ký HàNh Trình </h1>
                    <hr>

                    <form method="POST" id="form_Nhat_ki_hanh_trinh" action="">
                                                                        <label>
                            <span>stt_nkht</span>
                            <input type="text" name="stt_nkht" value="" id="nhat_ki_hanh_trinh_stt_nkht" class="input-text " onchange="Nhat_ki_hanh_trinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="nhat_ki_hanh_trinh_so_dang_ky_xe" class="input-text " onchange="Nhat_ki_hanh_trinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ngay_khoi_hanh</span>
                            <input type="text" name="ngay_khoi_hanh" value="" id="nhat_ki_hanh_trinh_ngay_khoi_hanh" class="input-text " onchange="Nhat_ki_hanh_trinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ten</span>
                            <input type="text" name="ten" value="" id="nhat_ki_hanh_trinh_ten" class="input-text keyAutoComplete" onchange="Nhat_ki_hanh_trinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ngay_ket_thuc_dukien</span>
                            <input type="text" name="ngay_ket_thuc_dukien" value="" id="nhat_ki_hanh_trinh_ngay_ket_thuc_dukien" class="input-text keyAutoComplete" onchange="Nhat_ki_hanh_trinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                                                <label>
                            <span>ngay_ket_thuc_thucte</span>
                            <input type="text" name="ngay_ket_thuc_thucte" value="" id="nhat_ki_hanh_trinh_ngay_ket_thuc_thucte" class="input-text keyAutoComplete" onchange="Nhat_ki_hanh_trinh.setDataField(this.name,this.value);"  />
                        </label>
                                                                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Nhat_ki_hanh_trinh.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Nhat_ki_hanh_trinh.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Nhat_ki_hanh_trinh.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Nhat_ki_hanh_trinh.Delete()" class="green"> Xoá </a>
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

    colNamesT.push('stt_nkht');
    colModelT.push({name:'stt_nkht',index:'stt_nkht', editable: false});

  
    colNamesT.push('so_dang_ky_xe');
    colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

  
    colNamesT.push('ngay_khoi_hanh');
    colModelT.push({name:'ngay_khoi_hanh',index:'ngay_khoi_hanh', editable: false});

  
    colNamesT.push('ten');
    colModelT.push({name:'ten',index:'ten', editable: false});

    colNamesT.push('ngay_ket_thuc_dukien');
    colModelT.push({name:'ngay_ket_thuc_dukien',index:'ngay_ket_thuc_dukien', editable: false});

    colNamesT.push('ngay_ket_thuc_thucte');
    colModelT.push({name:'ngay_ket_thuc_thucte',index:'ngay_ket_thuc_thucte', editable: false});


    var loadView = function()
    {
        jGrid = jQuery("#list2").jqGrid(
        {
            url:'<?php echo site_url('c_nhat_ki_hanh_trinh/read_json_format')?>',
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
            caption:"Nhật ký hành trình",
            onSelectRow: function(){
                var id = jQuery("#list2").getGridParam('selrow');
Nhat_ki_hanh_trinh.setData(jQuery("#list2").getRowData(id));
            }
        });
        jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
        $("#alertmod").remove();//FIXME
    }
    jQuery("#list2").ready(loadView);


    var initForm = function(){
        //init validation form
        $("#form_Nhat_ki_hanh_trinh").validate();
        $('#container-1 > ul').tabs();

    }
    jQuery("#form_Nhat_ki_hanh_trinh").ready(initForm);




    var inputDate = {};
    $( function() {
        inputDate['nhat_ki_hanh_trinh_ngay_khoi_hanh'] = $("#nhat_ki_hanh_trinh_ngay_khoi_hanh").datepicker({dateFormat:"yy/mm/dd"});
        $('#nhat_ki_hanh_trinh_ngay_khoi_hanh').mask('9999/99/99');
        $('#nhat_ki_hanh_trinh_ngay_khoi_hanh').validate({rules:{ require: true, date: true}});
        inputDate['nhat_ki_hanh_trinh_ngay_ket_thuc_dukien'] = $("#nhat_ki_hanh_trinh_ngay_ket_thuc_dukien").datepicker({dateFormat:"yy/mm/dd"});
        $('#nhat_ki_hanh_trinh_ngay_ket_thuc_dukien').mask('9999/99/99');
        $('#nhat_ki_hanh_trinh_ngay_ket_thuc_dukien').validate({rules:{ require: true, date: true}});
        inputDate['nhat_ki_hanh_trinh_ngay_ket_thuc_thucte'] = $("#nhat_ki_hanh_trinh_ngay_ket_thuc_thucte").datepicker({dateFormat:"yy/mm/dd"});
        $('#nhat_ki_hanh_trinh_ngay_ket_thuc_thucte').mask('9999/99/99');
        $('#nhat_ki_hanh_trinh_ngay_ket_thuc_thucte').validate({rules:{ require: true, date: true}});
    });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_nhat_ki_hanh_trinh/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_nhat_ki_hanh_trinh/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

    $("#nhat_ki_hanh_trinh_stt_nkht").autocomplete("<?php echo site_url('c_nhat_ki_hanh_trinh/keyAutoComplete/stt_nkht')?>", {
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
    $("#nhat_ki_hanh_trinh_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
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
    $("#nhat_ki_hanh_trinh_ngay_khoi_hanh").autocomplete("<?php echo site_url('c_nhat_ki_hanh_trinh/keyAutoComplete/ngay_khoi_hanh')?>", {
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