<?php include_once 'common/header.php'?>

<div class = "container">

    <div class="row justify-content-center">
        <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);
                    foreach ($data['groups'] as $group) {
                        if($group == 'Проверенные пользователи' || $group == 'Администратор'){ 
                            $messages = getMessage($_GET['id']); ?>
                            
                    <?php break; }else{ ?>
                            Вы не можете просматривать сообщение.
                        <?php break; } ?>
                    <?php } ?>
            <?php } ?>
            </div>
        </div>                      
    </div>
</body>
</html>