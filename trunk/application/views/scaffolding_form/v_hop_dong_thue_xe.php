<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Hop_dong_thue_xe</title>
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
            var Hop_dong_thue_xe = {};

            Hop_dong_thue_xe.data = {};
            Hop_dong_thue_xe.setDataField = function(fieldName,fieldValue)
            {
                Hop_dong_thue_xe.data[fieldName] = fieldValue;
            }

            Hop_dong_thue_xe.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Hop_dong_thue_xe.data[name] = value;
                    $("#form_Hop_dong_thue_xe input[name="+ name +"]").setValue(value);
                    if(name == "loai_hop_dong"){
                        $("#form_Hop_dong_thue_xe select[name="+ name +"]").setValue(value);
                    }

                    if(name == "vi_tri"){
                        $("#hop_dong_thue_xe_vi_tri").text(value);
                    }
                });
            }


            Hop_dong_thue_xe.getData = function()
            {
                var obj = {};
                $.each( $("#form_Hop_dong_thue_xe").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Hop_dong_thue_xe.data = obj;
                return Hop_dong_thue_xe.data;
            }

            //create
            Hop_dong_thue_xe.Create = function()
            {
                if(!$("#form_Hop_dong_thue_xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_hop_dong_thue_xe/create')?>", $("#form_Hop_dong_thue_xe").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Hop_dong_thue_xe " + message);
                    }
                });
            }

            //refresh grid
            Hop_dong_thue_xe.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("http://localhost/vehicle1/index.php/c_hop_dong_thue_xe/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Hop_dong_thue_xe.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Hop_dong_thue_xe.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Hop_dong_thue_xe.Update = function()
            {
                if(!$("#form_Hop_dong_thue_xe").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_hop_dong_thue_xe/update')?>", $("#form_Hop_dong_thue_xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Hop_dong_thue_xe " + message);
                });
            }


            //delete
            Hop_dong_thue_xe.Delete = function()
            {
                if(!$("#form_Hop_dong_thue_xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_hop_dong_thue_xe/delete')?>",$("#form_Hop_dong_thue_xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Hop_dong_thue_xe " + message);
                });
            }

            Hop_dong_thue_xe.currentRowID = null;

            Hop_dong_thue_xe.setSelectedRow = function(id)
            {
                Hop_dong_thue_xe.currentRowID = id;
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
                    <h1> Hợp đồng Thuê Xe </h1>
                    <hr>
                    
                    <form method="POST" id="form_Hop_dong_thue_xe" action="">
                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="hop_dong_thue_xe_so_dang_ky_xe" class="input-text " onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ms_hop_dong</span>
                            <input type="text" name="ms_hop_dong" value="" id="hop_dong_thue_xe_ms_hop_dong" class="input-text " onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>stt_nhanvien</span>
                            <input type="text" name="stt_nhanvien" value="" id="hop_dong_thue_xe_stt_nhanvien" class="input-text " onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ms_chi_nhanh</span>
                            <input type="text" name="ms_chi_nhanh" value="" id="hop_dong_thue_xe_ms_chi_nhanh" class="input-text " onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>loai_hop_dong</span>
                            
                            <select name="loai_hop_dong" id="hop_dong_thue_xe_loai_hop_dong" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);">
                                <option>loại 1</option>
                                <option>loại 2</option>
                                <option>loại 3</option>
                                <option>loại 4</option>
                                <option>loại 5</option>
                                <option>loại 6</option>                                
                            </select>
                        </label>
                        <label>
                            <span>nguoi_tiep_nhan</span>
                            <input type="text" name="nguoi_tiep_nhan" value="" id="hop_dong_thue_xe_nguoi_tiep_nhan" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>km_tran</span>
                            <input type="text" name="km_tran" value="" id="hop_dong_thue_xe_km_tran" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>so_tien</span>
                            <input type="text" name="so_tien" value="" id="hop_dong_thue_xe_so_tien" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>sothuc_te</span>
                            <input type="text" name="sothuc_te" value="" id="hop_dong_thue_xe_sothuc_te" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ngay_bat_dau</span>
                            <input type="text" name="ngay_bat_dau" value="" id="hop_dong_thue_xe_ngay_bat_dau" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ngay_ket_thuc</span>
                            <input type="text" name="ngay_ket_thuc" value="" id="hop_dong_thue_xe_ngay_ket_thuc" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>vi_tri</span>                           
                            <textarea name="" name="vi_tri" value="" id="hop_dong_thue_xe_vi_tri" rows="4" cols="20">
                            </textarea>
                        </label>
                        <label>
                            <span>dich_vu</span>
                            <input type="text" name="dich_vu" value="" id="hop_dong_thue_xe_dich_vu" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>bao_hiem</span>
                            <input type="text" name="bao_hiem" value="" id="hop_dong_thue_xe_bao_hiem" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>chi_phi_cho_km_them</span>
                            <input type="text" name="chi_phi_cho_km_them" value="" id="hop_dong_thue_xe_chi_phi_cho_km_them" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>nhuong_quyen_thuong_mai</span>
                            <input type="text" name="nhuong_quyen_thuong_mai" value="" id="hop_dong_thue_xe_nhuong_quyen_thuong_mai" class="input-text keyAutoComplete" onchange="Hop_dong_thue_xe.setDataField(this.name,this.value);"  />
                        </label>
                    </form>
                    
                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Hop_dong_thue_xe.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Hop_dong_thue_xe.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Hop_dong_thue_xe.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Hop_dong_thue_xe.Delete()" class="green"> Xoá </a>
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

        colNamesT.push('ms_hop_dong');
        colModelT.push({name:'ms_hop_dong',index:'ms_hop_dong', editable: false, key: true});

        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false, key: true});





        colNamesT.push('stt_nhanvien');
        colModelT.push({name:'stt_nhanvien',index:'stt_nhanvien', editable: false});

        colNamesT.push('ms_chi_nhanh');
        colModelT.push({name:'ms_chi_nhanh',index:'ms_chi_nhanh', editable: false});

        colNamesT.push('loai_hop_dong');
        colModelT.push({name:'loai_hop_dong',index:'loai_hop_dong', editable: false});

        colNamesT.push('nguoi_tiep_nhan');
        colModelT.push({name:'nguoi_tiep_nhan',index:'nguoi_tiep_nhan', editable: false});

        colNamesT.push('km_tran');
        colModelT.push({name:'km_tran',index:'km_tran', editable: false});

        colNamesT.push('so_tien');
        colModelT.push({name:'so_tien',index:'so_tien', editable: false});

        colNamesT.push('sothuc_te');
        colModelT.push({name:'sothuc_te',index:'sothuc_te', editable: false});

        colNamesT.push('ngay_bat_dau');
        colModelT.push({name:'ngay_bat_dau',index:'ngay_bat_dau', editable: false});

        colNamesT.push('ngay_ket_thuc');
        colModelT.push({name:'ngay_ket_thuc',index:'ngay_ket_thuc', editable: false});

        colNamesT.push('vi_tri');
        colModelT.push({name:'vi_tri',index:'vi_tri', editable: false});

        colNamesT.push('dich_vu');
        colModelT.push({name:'dich_vu',index:'dich_vu', editable: false});

        colNamesT.push('bao_hiem');
        colModelT.push({name:'bao_hiem',index:'bao_hiem', editable: false});

        colNamesT.push('chi_phi_cho_km_them');
        colModelT.push({name:'chi_phi_cho_km_them',index:'chi_phi_cho_km_them', editable: false});

        colNamesT.push('nhuong_quyen_thuong_mai');
        colModelT.push({name:'nhuong_quyen_thuong_mai',index:'nhuong_quyen_thuong_mai', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_hop_dong_thue_xe/read_json_format')?>',
                mtype : "POST",
                datatype: "json",
                colNames: colNamesT ,
                colModel: colModelT ,
                rowNum:10,
                height: 270,
                rowList:[10,20,30],
                imgpath: gridimgpath,
                pager: jQuery('#pager2'),
                sortname: colNamesT[0] ,
                viewrecords: true,
                caption:"Hợp đồng thuê Xe",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Hop_dong_thue_xe.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Hop_dong_thue_xe").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Hop_dong_thue_xe").ready(initForm);




        var inputDate = {};
        $( function() {
            inputDate['hop_dong_thue_xe_ngay_bat_dau'] = $("#hop_dong_thue_xe_ngay_bat_dau").datepicker({dateFormat:"yy/mm/dd"});
            $('#hop_dong_thue_xe_ngay_bat_dau').mask('9999/99/99');
            $('#hop_dong_thue_xe_ngay_bat_dau').validate({rules:{ require: true, date: true}});
            inputDate['hop_dong_thue_xe_ngay_ket_thuc'] = $("#hop_dong_thue_xe_ngay_ket_thuc").datepicker({dateFormat:"yy/mm/dd"});
            $('#hop_dong_thue_xe_ngay_ket_thuc').mask('9999/99/99');
            $('#hop_dong_thue_xe_ngay_ket_thuc').validate({rules:{ require: true, date: true}});
        });


    </script>
    
    
    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_hop_dong_thue_xe/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_hop_dong_thue_xe/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

        $("#hop_dong_thue_xe_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
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
        $("#hop_dong_thue_xe_stt_nhanvien").autocomplete("<?php echo site_url('c_nhan_vien/keyAutoComplete/stt_nhanvien')?>", {
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
        $("#hop_dong_thue_xe_ms_chi_nhanh").autocomplete("<?php echo site_url('c_chi_nhanh/keyAutoComplete/ms_chi_nhanh')?>", {
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
        $("#hop_dong_thue_xe_ms_hop_dong").autocomplete("<?php echo site_url('c_hop_dong_thue_xe/keyAutoComplete/ms_hop_dong')?>", {
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