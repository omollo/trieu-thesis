<html>
    <head>
        <base href="<?php echo base_url()?>">
        <title>Van_chuyen</title>
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
            var Van_chuyen = {};

            Van_chuyen.data = {};
            Van_chuyen.setDataField = function(fieldName,fieldValue)
            {
                Van_chuyen.data[fieldName] = fieldValue;
            }

            Van_chuyen.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Van_chuyen.data[name] = value;
                    $("#form_Van_chuyen input[name="+ name +"]").setValue(value);
                });
            }


            Van_chuyen.getData = function()
            {
                var obj = {};
                $.each( $("#form_Van_chuyen").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Van_chuyen.data = obj;
                return Van_chuyen.data;
            }

            //create
            Van_chuyen.Create = function()
            {
                if(!$("#form_Van_chuyen").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_chuyen/create')?>", $("#form_Van_chuyen").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Van_chuyen " + message);
                    }
                });
            }

            //refresh grid
            Van_chuyen.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_chuyen/read_json_format')?>", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Van_chuyen.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Van_chuyen.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Van_chuyen.Update = function()
            {
                if(!$("#form_Van_chuyen").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_chuyen/update')?>", $("#form_Van_chuyen").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Van_chuyen " + message);
                });
            }


            //delete
            Van_chuyen.Delete = function()
            {
                if(!$("#form_Van_chuyen").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_van_chuyen/delete')?>",$("#form_Van_chuyen").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Van_chuyen " + message);
                });
            }

            Van_chuyen.currentRowID = null;

            Van_chuyen.setSelectedRow = function(id)
            {
                Van_chuyen.currentRowID = id;
            }



        </script>
    </head>

    <body>
        <div id="container-1">
            <ul>
                <li><a href="#fragment-1"><span>Danh sách chuyến hàng</span></a></li>
                <li><a href="#fragment-2"><span>Danh mục hành trình</span></a></li>
            </ul>
            <div id="fragment-1" style="width: 930px;">
                <div>
                    <table id="list2" class="scroll" style="margin-top:8px;" cellpadding="0" cellspacing="0"></table>
                    <div id="pager2" class="scroll" style="text-align:center;"></div>
                </div>

                <hr>

                <div class="box">
                    <h1> Van_chuyen </h1>
                    <hr>

                    <form method="POST" id="form_Van_chuyen" action="">
                        <label>
                            <span>ma_chuyen</span>
                            <input type="text" name="ma_chuyen" value="" id="van_chuyen_ma_chuyen" class="input-text " onchange="Van_chuyen.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>so_dang_ky_xe</span>
                            <input type="text" name="so_dang_ky_xe" value="" id="van_chuyen_so_dang_ky_xe" class="input-text keyAutoComplete" onchange="Van_chuyen.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ms_hanhtrinh</span>
                            <input type="text" name="ms_hanhtrinh" value="" id="van_chuyen_ms_hanhtrinh" class="input-text keyAutoComplete" onchange="Van_chuyen.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ngay_khoi_hanh</span>
                            <input type="text" name="ngay_khoi_hanh" value="" id="van_chuyen_ngay_khoi_hanh" class="input-text keyAutoComplete" onchange="Van_chuyen.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ngay_ket_thuc_dukien</span>
                            <input type="text" name="ngay_ket_thuc_dukien" value="" id="van_chuyen_ngay_ket_thuc_dukien" class="input-text keyAutoComplete" onchange="Van_chuyen.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ngay_ket_thuc_thucte</span>
                            <input type="text" name="ngay_ket_thuc_thucte" value="" id="van_chuyen_ngay_ket_thuc_thucte" class="input-text keyAutoComplete" onchange="Van_chuyen.setDataField(this.name,this.value);"  />
                        </label>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Van_chuyen.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Van_chuyen.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Van_chuyen.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Van_chuyen.Delete()" class="green"> Xoá </a>
                    </div>
                    <div id="ajaxloader" style="display:none" >
                        <img  src="<?php echo base_url()?>resources/css/img/ajax-loader.gif" />
                    </div>
                </div>

            </div>
            <div id="fragment-2">
                <iframe scrolling="auto" name="c_chuyenhang" id="c_chuyenhang" style="border: 0px none; width: 1222px; height: 950px;" src="<?php echo site_url('c_dm_hanhtrinh')?>"></iframe>
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

        colNamesT.push('ma_chuyen');
        colModelT.push({name:'ma_chuyen',index:'ma_chuyen', editable: false});


        colNamesT.push('so_dang_ky_xe');
        colModelT.push({name:'so_dang_ky_xe',index:'so_dang_ky_xe', editable: false});

        colNamesT.push('ms_hanhtrinh');
        colModelT.push({name:'ms_hanhtrinh',index:'ms_hanhtrinh', editable: false});

        colNamesT.push('ngay_khoi_hanh');
        colModelT.push({name:'ngay_khoi_hanh',index:'ngay_khoi_hanh', editable: false});

        colNamesT.push('ngay_ket_thuc_dukien');
        colModelT.push({name:'ngay_ket_thuc_dukien',index:'ngay_ket_thuc_dukien', editable: false});

        colNamesT.push('ngay_ket_thuc_thucte');
        colModelT.push({name:'ngay_ket_thuc_thucte',index:'ngay_ket_thuc_thucte', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_van_chuyen/read_json_format')?>',
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
                caption:"van_chuyen",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Van_chuyen.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Van_chuyen").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Van_chuyen").ready(initForm);




        var inputDate = {};
        $( function() {
            inputDate['van_chuyen_ngay_khoi_hanh'] = $("#van_chuyen_ngay_khoi_hanh").datepicker({dateFormat:"yy/mm/dd"});
            $('#van_chuyen_ngay_khoi_hanh').mask('9999/99/99');
            $('#van_chuyen_ngay_khoi_hanh').validate({rules:{ require: true, date: true}});
            inputDate['van_chuyen_ngay_ket_thuc_dukien'] = $("#van_chuyen_ngay_ket_thuc_dukien").datepicker({dateFormat:"yy/mm/dd"});
            $('#van_chuyen_ngay_ket_thuc_dukien').mask('9999/99/99');
            $('#van_chuyen_ngay_ket_thuc_dukien').validate({rules:{ require: true, date: true}});
            inputDate['van_chuyen_ngay_ket_thuc_thucte'] = $("#van_chuyen_ngay_ket_thuc_thucte").datepicker({dateFormat:"yy/mm/dd"});
            $('#van_chuyen_ngay_ket_thuc_thucte').mask('9999/99/99');
            $('#van_chuyen_ngay_ket_thuc_thucte').validate({rules:{ require: true, date: true}});
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};

        $("#van_chuyen_ma_chuyen").autocomplete("<?php echo site_url('c_van_chuyen/keyAutoComplete/ma_chuyen')?>", {
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

        $("#van_chuyen_so_dang_ky_xe").autocomplete("<?php echo site_url('c_xe/keyAutoComplete/so_dang_ky_xe')?>", {
            width: 200,
            max: 10,
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

        $("#van_chuyen_ms_hanhtrinh").autocomplete("<?php echo site_url('c_dm_hanhtrinh/keyAutoComplete/ms_hanhtrinh')?>", {
            width: 250,
            max: 5,
            highlight: false,
            scroll: true,
            scrollHeight: 300,
            formatItem: function(data, i, n, value) {
                 return "<strong>" + value.split("$$")[1] + "</strong> (MS: " +  value.split("$$")[0] + ")";
            },
            formatResult: function(data, value) {
                return  value.split("$$")[0];
            }
        });

    </script>

</html>