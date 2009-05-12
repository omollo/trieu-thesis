<html>
    <head>
        <base href="<?php echo base_url()?>">
        <title>Van_don</title>
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
            var Van_don = {};

            Van_don.data = {};
            Van_don.setDataField = function(fieldName,fieldValue)
            {
                Van_don.data[fieldName] = fieldValue;
            }

            Van_don.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Van_don.data[name] = value;
                    $("#form_Van_don input[name="+ name +"]").setValue(value);

                    if(name == "so_van_don"){
                        $.post("<?php echo base_url()?>/index.php/c_Chi_tiet_van_don/readChi_tiet_van_don/", { so_van_don: value },
                        function(data){
                            $("#chi_tiet_van_don").html(data);
                        });
                    }
                });
            }


            Van_don.getData = function()
            {
                var obj = {};
                $.each( $("#form_Van_don").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Van_don.data = obj;
                return Van_don.data;
            }

            //create
            Van_don.Create = function()
            {
                if($("#form_Van_don_input:hidden").length >0){
                    $("#form_Van_don_input:hidden").show();
                    Van_don.Clear();
                    return;
                }

                if(!$("#form_Van_don").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_don/create')?>", $("#form_Van_don").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Van_don " + message);
                    }
                });
            }

            //refresh grid
            Van_don.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo base_url()?>/index.php/c_van_don/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Van_don.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Van_don.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Van_don.Update = function()
            {
                if($("#form_Van_don_input:hidden").length >0){
                    $("#form_Van_don_input:hidden").show();
                    return;
                }

                if(!$("#form_Van_don").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_don/update')?>", $("#form_Van_don").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Van_don " + message);
                });
            }


            //delete
            Van_don.Delete = function()
            {
                if(!$("#form_Van_don").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_don/delete')?>",$("#form_Van_don").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Van_don " + message);
                });
            }

            Van_don.Clear = function(){
                $("#form_Van_don :input").each(function(i,e){$(e).val("");});
            }

            Van_don.currentRowID = null;

            Van_don.setSelectedRow = function(id)
            {
                Van_don.currentRowID = id;
            }



        </script>
    </head>

    <body>
        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>Vận đơn</span></a></li>
                <li><a href="#fragment-2"><span>Danh sách các vận đơn</span></a></li>
                <li><a href="#fragment-3"><span>Biên bản giao nhận</span></a></li>
            </ul>
            <div id="fragment-1" style="width: 100%;">
                <div class="box">
                    <h1> Van_don </h1>
                    <hr>

                    <form method="POST" id="form_Van_don" action="">
                        <label>
                            <span>Số vận đơn</span>
                            <input type="text" name="so_van_don" value="" id="van_don_so_van_don" class="input-text " onchange="Van_don.setDataField(this.name,this.value);"  />
                        </label>

                        <div id="form_Van_don_input" style="display:none">
                            <label>
                                <span>STT Khách hàng</span>
                                <input type="text" name="stt_khachhang" value="" id="van_don_stt_khachhang" class="input-text keyAutoComplete" onchange="Van_don.setDataField(this.name,this.value);"  />
                            </label>
                            <label>
                                <span>Ngày vận đơn</span>
                                <input type="text" name="ngay_van_don" value="" id="van_don_ngay_van_don" class="input-text keyAutoComplete" onchange="Van_don.setDataField(this.name,this.value);"  />
                            </label>
                            <label>
                                <span>Tổng khối lượng</span>
                                <input type="text" name="tong_khoi_luong" value="" id="van_don_tong_khoi_luong" class="input-text keyAutoComplete" onchange="Van_don.setDataField(this.name,this.value);"  />
                            </label>
                            <label>
                                <span>Tổng cước</span>
                                <input type="text" name="tong_cuoc" value="" id="van_don_tong_cuoc" class="input-text keyAutoComplete" onchange="Van_don.setDataField(this.name,this.value);"  />
                            </label>
                            <label>
                                <span>Chú thích</span>
                                <input type="text" name="chuthich" value="" id="van_don_chuthich" class="input-text keyAutoComplete" onchange="Van_don.setDataField(this.name,this.value);"  />
                            </label>
                        </div>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Van_don.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Van_don.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Van_don.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Van_don.Delete()" class="green"> Xoá </a>
                        <a href="javascript:void(0)" onclick="Van_don.Clear()" class="green"> Refresh form </a>
                    </div>
                    <div id="ajaxloader" style="display:none" >
                        <img  src="<?php echo base_url()?>/resources/css/img/ajax-loader.gif" />
                    </div>

                    <div>
                        <table id="list2" class="scroll" style="margin-top:8px;" cellpadding="0" cellspacing="0"></table>
                        <div id="pager2" class="scroll" style="text-align:center;"></div>
                    </div>

                    <br>
                    <hr>
                    <div>
                        <table id="list3" class="scroll" style="margin-top:8px;" cellpadding="0" cellspacing="0"></table>
                        <div id="pager3" class="scroll" style="text-align:center;"></div>
                    </div>
                    
                    <br>

                    <div id="chi_tiet_van_don">
                    </div>
                </div>

            </div>
            <div id="fragment-2" style="width: 100%;">
                <iframe scrolling="auto" name="c_Chi_tiet_van_don" id="c_Chi_tiet_van_don" style="border: 0px none; width: 100%; height: 950px;" src="<?php echo site_url('c_Chi_tiet_van_don')?>"></iframe>
            </div>
            <div id="fragment-3" style="width: 100%;">
                <iframe scrolling="auto" name="c_bienban_giaonhan" id="c_bienban_giaonhan" style="border: 0px none; width: 100%; height: 950px;" src="<?php echo site_url('c_bienban_giaonhan')?>"></iframe>
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


        colNamesT.push('stt_khachhang');
        colModelT.push({name:'stt_khachhang',index:'stt_khachhang', editable: false});

        colNamesT.push('ngay_van_don');
        colModelT.push({name:'ngay_van_don',index:'ngay_van_don', editable: false});

        colNamesT.push('tong_khoi_luong');
        colModelT.push({name:'tong_khoi_luong',index:'tong_khoi_luong', editable: false});

        colNamesT.push('tong_cuoc');
        colModelT.push({name:'tong_cuoc',index:'tong_cuoc', editable: false});

        colNamesT.push('chuthich');
        colModelT.push({name:'chuthich',index:'chuthich', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_van_don/read_json_format')?>',
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
                caption:"van_don",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Van_don.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Van_don").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Van_don").ready(initForm);

        var colNamesT2 = new Array();
        var colModelT2 = new Array();
        colNamesT2.push('so_van_don');
        colModelT2.push({name:'so_van_don',index:'so_van_don', editable: false});
        colNamesT2.push('ms_hanghoa');
        colModelT2.push({name:'ms_hanghoa',index:'ms_hanghoa', editable: false});
        colNamesT2.push('ma_chuyen');
        colModelT2.push({name:'ma_chuyen',index:'ma_chuyen', editable: false});
        colNamesT2.push('ms_loaihang');
        colModelT2.push({name:'ms_loaihang',index:'ms_loaihang', editable: false});
        colNamesT2.push('ten_hang');
        colModelT2.push({name:'ten_hang',index:'ten_hang', editable: false});
        colNamesT2.push('so_luong');
        colModelT2.push({name:'so_luong',index:'so_luong', editable: false});
        colNamesT2.push('khoi_luong');
        colModelT2.push({name:'khoi_luong',index:'khoi_luong', editable: false});
        colNamesT2.push('quy_cach_dong_goi');
        colModelT2.push({name:'quy_cach_dong_goi',index:'quy_cach_dong_goi', editable: false});
        colNamesT2.push('trangthai_hanghoa');
        colModelT2.push({name:'trangthai_hanghoa',index:'trangthai_hanghoa', editable: false});
        colNamesT2.push('nguoinhan');
        colModelT2.push({name:'nguoinhan',index:'nguoinhan', editable: false});
        colNamesT2.push('diachi_nhan');
        colModelT2.push({name:'diachi_nhan',index:'diachi_nhan', editable: false});
        colNamesT2.push('cuoc');
        colModelT2.push({name:'cuoc',index:'cuoc', editable: false});


        var loadCTVD_Grid = function()
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
            jGrid.navGrid('#pager3',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }    




        var inputDate = {};
        $( function() {
            inputDate['van_don_ngay_van_don'] = $("#van_don_ngay_van_don").datepicker({dateFormat:"yy/mm/dd"});
            $('#van_don_ngay_van_don').mask('9999/99/99');
            $('#van_don_ngay_van_don').validate({rules:{ require: true, date: true}});
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_van_don/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_van_don/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

        $("#van_don_so_van_don").autocomplete("<?php echo site_url('c_van_don/keyAutoComplete/so_van_don')?>", {
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