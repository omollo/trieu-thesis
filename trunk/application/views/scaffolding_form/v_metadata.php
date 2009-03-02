<html>
    <head>
        <base href="http://localhost/vehicle1/">
        <title>Metadata</title>
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
            var Metadata = {};

            Metadata.data = {};
            Metadata.setDataField = function(fieldName,fieldValue)
            {
                Metadata.data[fieldName] = fieldValue;
            }

            Metadata.setData = function(data)
            {
                jQuery.each(data, function(name, value) {
                    Metadata.data[name] = value;
                    $("#form_Metadata input[name="+ name +"]").setValue(value);
                });
            }


            Metadata.getData = function()
            {
                var obj = {};
                $.each( $("#form_Metadata").formSerialize().split("&"), function(i,n)
                {
                    var toks = n.split("=");
                    obj[toks[0]] = toks[1];
                }
            );
                Metadata.data = obj;
                return Metadata.data;
            }

            //create
            Metadata.Create = function()
            {
                if(!$("#form_Metadata").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_metadata/create')?>", $("#form_Metadata").formToArray() ,
                function(message){
                    if(message != null){
                        InlineBox.hideAjaxLoader();
                        $("#list2").trigger("reloadGrid");
                        InlineBox.showModalBox("Tạo Metadata " + message);
                    }
                });
            }

            //refresh grid
            Metadata.Read = function()
            {
                InlineBox.showAjaxLoader();
                jQuery.post("http://localhost/vehicle1/index.php/c_metadata/read_json_format", {},
                function(data){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                });
            }

            // Filter the Grid and refresh
            Metadata.Filter = function()
            {
                //var name_field = $("#"+id).attr("name");
                //var value_field =  $("#"+id).val();
                //jQuery("#list2").setPostData({name_field:value_field});
                var post_data = Metadata.getData();

                for(var e in post_data){
                    if($.trim(post_data[e]) == "")
                        delete post_data[e];
                }
                jQuery("#list2").setPostData(post_data);
                $("#list2").trigger("reloadGrid");
            }

            //update
            Metadata.Update = function()
            {
                if(!$("#form_Metadata").valid())
                    return;

                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_metadata/update')?>", $("#form_Metadata").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Cập nhật Metadata " + message);
                });
            }


            //delete
            Metadata.Delete = function()
            {
                if(!$("#form_Metadata").valid())
                    return;
                InlineBox.showAjaxLoader();
                jQuery.post("<?php echo site_url('c_metadata/delete')?>",$("#form_Metadata").formToArray() ,
                function(message){
                    InlineBox.hideAjaxLoader();
                    $("#list2").trigger("reloadGrid");
                    InlineBox.showModalBox("Xoá Metadata " + message);
                });
            }

            Metadata.currentRowID = null;

            Metadata.setSelectedRow = function(id)
            {
                Metadata.currentRowID = id;
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
                    <h1> Metadata </h1>
                    <hr>

                    <form method="POST" id="form_Metadata" action="">
                        <label>
                            <span>id</span>
                            <input type="text" name="id" value="" id="metadata_id" class="input-text keyAutoComplete" onchange="Metadata.setDataField(this.name,this.value);"  />
                        </label>
                        <label>
                            <span>tablename</span>
                            <input type="text" name="tablename" value="" id="metadata_tablename" class="input-text keyAutoComplete" onchange="Metadata.setDataField(this.name,this.value);"  />
                        </label>
                        <div>
                            <label>
                                <span style="color:red">use_scaffolding:</span>
                                <input type="radio" name="use_scaffolding" value="1" />
                            </label>
                            <label>
                                <span style="color:red">NOT use_scaffolding: </span>
                                <input type="radio" name="use_scaffolding" value="0" />
                            </label>
                        </div>
                    </form>

                    <div class="spacer" id="form_control" >
                        <a href="javascript:void(0)" onclick="Metadata.Create()" class="green"> Thêm </a>
                        <a href="javascript:void(0)" onclick="Metadata.Update()" class="green">Cập nhập</a>
                        <a href="javascript:void(0)" onclick="Metadata.Filter()" class="green"> Tìm </a>
                        <a href="javascript:void(0)" onclick="Metadata.Delete()" class="green"> Xoá </a>
                    </div>
                    <div id="ajaxloader" style="display:none" >
                        <img  src="http://localhost/vehicle1/resources/css/img/ajax-loader.gif" />
                    </div>
                </div>

            </div>
        </div>
    </body>

    <script type="text/javascript">
        var jGrid = null;
        var colNamesT = new Array();
        var colModelT = new Array();
        var gridimgpath = '<?php echo base_url()?>resources/jqGrid/themes/basic/images';

        colNamesT.push('id');
        colModelT.push({name:'id',index:'id', editable: false});


        colNamesT.push('tablename');
        colModelT.push({name:'tablename',index:'tablename', editable: false});

        colNamesT.push('use_scaffolding');
        colModelT.push({name:'use_scaffolding',index:'use_scaffolding', editable: false});


        var loadView = function()
        {
            jGrid = jQuery("#list2").jqGrid(
            {
                url:'<?php echo site_url('c_metadata/read_json_format')?>',
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
                caption:"metadata",
                onSelectRow: function(){
                    var id = jQuery("#list2").getGridParam('selrow');
                    Metadata.setData(jQuery("#list2").getRowData(id));
                }
            });
            jGrid.navGrid('#pager2',{edit:false,add:false,del:false, search: false, refresh: true});
            $("#alertmod").remove();//FIXME
        }
        jQuery("#list2").ready(loadView);


        var initForm = function(){
            //init validation form
            $("#form_Metadata").validate();
            $('#container-1 > ul').tabs();

        }
        jQuery("#form_Metadata").ready(initForm);

        var keyAutoComplete_fields = {};
        $(".keyAutoComplete").each(function(i,e)
        {
            keyAutoComplete_fields[$(e).attr('id')] = $(e).autocomplete("<?php echo site_url('c_metadata/keyAutoComplete')?>", {
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
                keyAutoComplete_fields[id].setOptions({url : "<?php echo site_url('c_metadata/keyAutoComplete')?>/"+$('#'+id).attr("name")});
            });
        });


        var inputDate = {};
        $( function() {
        });


    </script>

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
</html>