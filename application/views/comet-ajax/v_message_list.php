<?php if($for_mobile) { ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="content-language" content="en" />      
        <title>Quản lý thông điệp</title>
        <style type="text/css" >
            img[src="http://get-banner.lookup.co.cc/banner_img/cocc90_40b.gif"]  { display:none; }
            .pending_msg { color:red   }
            .received_msg { color:blue   }
            .finished_msg { color:black   }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript" ></script>       
        <script type="text/javascript" >           
            jQuery(document).ready(function(){                
                //var n = jQuery("#message_box_list").find(".pending_msg").length;
                //alert("Pending Messages is " + n);
            });
        </script>
    </head>
    <body>
        <div id="message_box_list" >
            <b>Số đăng ký xe: <?php echo $requesterID; ?></b>
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID đối tượng gửi</th>
                        <th>Nội dung</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($messages as $message){ ?>
                    <tr>
                        <td><?php echo($message->id); ?></td>
                        <td><?php echo($message->senderId); ?></td>
                        <td>
                            <?php
                                $toks = explode(";" ,$message->content );
                               // echo "Toạ độ bắt đầu: ".$toks[0]."<br/>";
                               // echo "Toạ độ kết thúc: ".$toks[1]."<br/>";
                               // echo "Nội dung công việc: ".$toks[2]."<br/>";
                                echo $toks[2];
                            ?>
                        </td>
                        <td>
                            <div style="font-weight: bold; font-size: 11px;">
                            <?php
                                if($message->status == 1){
                                    echo '<span class="pending_msg" >Đang chờ xe nhận lệnh (Pending)</span>';
                                }
                                else if($message->status == 2){
                                    echo '<span class="received_msg" >Xe đã nhận lệnh (Received) và đang làm việc</span>';
                                }
                                else if($message->status == 3){
                                    echo '<span class="finished_msg" >Đã hoàn thàng công việc (Finished)</span>';
                                }
                            ?>
                            </div>
                        </td>
                        <td>
                            <div>
                                <?php  if($message->status != 3) { ?>
                                <form action="<?php echo site_url('c_message_handler/updateMessageStatus')?>" method="post" >
                                        <input type="hidden" name="id" value="<?php echo($message->id); ?>" />
                                        
                                        <?php
                                            if($message->status == 1) {
                                                echo '<input type="hidden" name="status" value="2" />';
                                                echo '<input type="submit" value="Nhận lệnh" />';
                                            }
                                            else if($message->status == 2) {
                                                echo '<input type="hidden" name="status" value="3" />';
                                                echo '<input type="submit" value="Đã hoàn thành" />';
                                            }
                                        ?> 
                                    </form>
                                <?php } else { ?>
                                    Đã hoàn thành
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>        
    </body>
</html>

<?php } else { ?>

    <script type="text/javascript" >
            function updateMessagePriorityForReceiver(msg_id, receiverId){
                var url = "<?php echo site_url('c_message_handler/updateMessagePriorityForReceiver')?>";
                var priority = 1;
                jQuery.post(url, {'id':msg_id , 'isCurrent': priority, 'receiverId':receiverId}, function(){
                    jQuery("#priority_this_" + msg_id).after("<span>Hành trình ưu tiên</span>");
                    jQuery("#priority_this_" + msg_id).remove();
                });
            }
    </script>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID đối tượng gửi</th>
                <th>ID đối tượng nhận</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($messages as $message){ ?>
            <tr>
                <td><?php echo($message->id); ?></td>
                <td><?php echo($message->senderId); ?></td>
                <td><?php echo($message->receiverId); ?></td>
                <td>
                    <?php
                        $toks = explode(";" ,$message->content );
                       // echo "Toạ độ bắt đầu: ".$toks[0]."<br/>";
                       // echo "Toạ độ kết thúc: ".$toks[1]."<br/>";
                       // echo "Nội dung công việc: ".$toks[2]."<br/>";
                        echo $toks[2];
                    ?>
                </td>
                <td>
                    <div style="font-weight: bold; font-size: 11px;">
                    <?php
                        if($message->status == 1){
                            echo '<span style="color:red" >Đang chờ xe nhận lệnh (Pending)</span>';
                        }
                        else if($message->status == 2){
                            echo '<span style="color:blue" >Xe đã nhận lệnh (Received) và đang làm việc</span>';
                        }
                        else if($message->status == 3){
                            echo '<span style="color:black" >Đã hoàn thàng công việc (Finished)</span>';
                        }
                    ?>
                     <?php if($message->status == 1 || $message->status == 2) {                         
                         if( $message->isCurrent == 0){    ?>
                            <br/><a href="javascript: updateMessagePriorityForReceiver('<?php echo($message->id); ?>','<?php echo($message->receiverId); ?>')" id="priority_this_<?php echo($message->id); ?>" >Ưu tiên</a>
                        <?php }
                           else if( $message->isCurrent == 1) {
                                echo '<br/><span>Hành trình ưu tiên</span>';
                           }
                     }?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>