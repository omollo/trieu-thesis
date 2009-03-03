<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Model_xe</title>
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
            var Model_xe = {};

            Model_xe.data = {};
            Model_xe.setDataField = function(fieldName,fieldValue)
            {
                Model_xe.data[fieldName] = fieldValue;
            }

            Model_xe.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Model_xe.data[name] = value;
                    $("#form_Model_xe input[name="+ name +"]").setValue(value);
                });
            }


            Model_xe.getData = function()
            {
                var obj = {};
                $.each( $("#form_Model_xe").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Model_xe.data = obj;
                return Model_xe.data;
            }

            //create
            Model_xe.Create = function()
            {
                if(!$("#form_Model_xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_model_xe/create')?>", $("#form_Model_xe").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Model_xe " + message);
                    }
                });
            }

            //refresh grid
            Model_xe.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("http://localhost/vehicle1/index.php/c_model_xe/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Model_xe.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Model_xe.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Model_xe.Update = function()
            {
                if(!$("#form_Model_xe").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_model_xe/update')?>", $("#form_Model_xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Model_xe " + message);
                });
            }


            //delete
            Model_xe.Delete = function()
            {
                if(!$("#form_Model_xe").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_model_xe/delete')?>",$("#form_Model_xe").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Model_xe " + message);
                });
            }

            Model_xe.currentRowID = null;

            Model_xe.setSelectedRow = function(id)
            {
                Model_xe.currentRowID = id;
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
                    <h1> Model Xe </h1>
                    <hr>

                    <form method="POST" id="form_Model_xe" action="">
                        <label>
                            <span>ms_model_xe</span>
                            <input type="text" name="ms_model_xe" value="" id="model_xe_ms_model_xe" class="input-text " onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>loai_model</span>
                            <input type="text" name="loai_model" value="" id="model_xe_loai_model" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>nhan_hieu</span>
                            <input type="text" name="nhan_hieu" value="" id="model_xe_nhan_hieu" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>ms_thue</span>
                            <input type="text" name="ms_thue" value="" id="model_xe_ms_thue" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>nhienlieu</span>
                            <input type="text" name="nhienlieu" value="" id="model_xe_nhienlieu" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>trongtai</span>
                            <input type="text" name="trongtai" value="" id="model_xe_trongtai" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>dientich_san</span>
                            <input type="text" name="dientich_san" value="" id="model_xe_dientich_san" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>loaixe</span>
                            <input type="text" name="loaixe" value="" id="model_xe_loaixe" class="input-text keyAutoComplete" onchange="Model_xe.setDataField(this.name,this.value);"  />
                        </label>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Model_xe.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Model_xe.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Model_xe.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Model_xe.Delete()" class="green"> Xoá </a>
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

        colNamesT.push('ms_model_xe');
        colModelT.push({name:'ms_model_xe',index:'ms_model_xe', editable: false});


        colNamesT.push('loai_model');
        colModelT.push({name:'loai_model',index:'loai_model', editable: false});

        colNamesT.push('nhan_hieu');
        colModelT.push({name:'nhan_hieu',index:'nhan_hieu', editable: false});

        colNamesT.push('ms_thue');
        colModelT.push({name:'ms_thue',index:'ms_thue', editable: false});

        colNamesT.push('nhienlieu');
        colModelT.push({name:'nhienlieu',index:'nhienlieu', editable: false});

        colNamesT.push('trongtai');
        colModelT.push({name:'trongtai',index:'trongtai', editable: false});

        colNamesT.push('dientich_san');
        colModelT.push({name:'dientich_san',index:'dientich_san', editable: false});

        colNamesT.push('loaixe');
        colModelT.push({name:'loaixe',index:'loaixe', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_model_xe/read_json_format')?>',
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
                caption:"Model Xe",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Model_xe.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Model_xe").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Model_xe").ready(initForm);




        var inputDate = {};
        $( function() {
        });


    </script>


    <script type="text/javascript">
        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_model_xe/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_model_xe/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });

        $("#model_xe_ms_model_xe").autocomplete("<?php echo site_url('c_model_xe/keyAutoComplete/ms_model_xe')?>", {
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