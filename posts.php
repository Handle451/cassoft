<?php include_once "common/header.php";?>

<div class = "container">

    <div class="row justify-content-center">
        <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);
                    foreach ($data['groups'] as $group) {
                        if($group == 'Проверенные пользователи' || $group == 'Администратор'){ 
                            $messages = getMessageGroups($_SESSION['id']);?>
                            <ol class="list-group list-group-numbered">
                            <?php foreach($messages as $group => $mess){?>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"><?php echo $group?></div>
                                            <?php foreach($mess as $message){?>
                                                <div><a href="message.php?id=<?php echo $message['id'];?>"><?php echo $message['title'];?></a><?php ($message['readed'] == '0' && $message['sendler_id'] != $_SESSION['id']) ? print('&emsp;&emsp;(новое)'):'';?></div>
                                            <?php }?>
                                    </div>
                                    <span class="badge bg-primary rounded-pill"><?php echo count($mess);?></span>
                                    <?php }?>
                                </li>
                                </ol>
                    <?php break; }else{ ?>
                            Вы не можете писать сообщения
                        <?php break; } ?>
                    <?php } ?>
            <?php } ?>
            </div>
        </div>                      
    </div>
</body>
</html>