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
                    echo "Toạ độ bắt đầu: ".$toks[0]."<br/>";
                    echo "Toạ độ kết thúc: ".$toks[1]."<br/>";
                    echo "Nội dung công việc: ".$toks[2]."<br/>";
                ?>
            </td>
            <td>
                <div style="font-weight: bold; font-size: 11px;">
                <?php 
                    if($message->status == 1){
                        echo '<span style="color:red" >Đang chờ xe nhận lệnh (Pending)</span>';
                    }
                    else if($message->status == 2){
                        echo '<span style="color:blue" >Xe nhận lệnh (Received)</span>';
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