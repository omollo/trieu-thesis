<?php if($for_mobile) { ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="content-language" content="en" />      
        <title>Quản lý thông điệp</title>
    </head>
    <body>
        <div>
            Số đăng ký xe: <?php echo $requesterID; ?>
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
                                    echo '<span style="color:red" >Đang chờ xe nhận lệnh (Pending)</span>';
                                }
                                else if($message->status == 2){
                                    echo '<span style="color:blue" >Xe đã nhận lệnh (Received) và đang làm việc</span>';
                                }
                                else if($message->status == 3){
                                    echo '<span style="color:black" >Đã hoàn thàng công việc (Finished)</span>';
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
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>