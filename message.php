<?php include_once 'common/header.php'?>

<div class = "container">

    <div class="row justify-content-center">
        <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);
                    foreach ($data['groups'] as $group) {
                        if($group == 'Проверенные пользователи' || $group == 'Администратор'){ 
                            $message = getMessage($_GET['id']); ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Заголовок</th>
                                        <th scope="col"><?php echo $message['title'];?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Отправитель</th>
                                        <td><?php echo $message['name'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail</th>
                                        <td colspan="2"><?php echo $message['email'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Дата отправки</th>
                                        <td colspan="2"><?php echo $message['date_added'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Текст сообщения</th>
                                        <td colspan="2"><?php echo $message['text'];?></td>
                                    </tr>
                                </tbody>
                            </table>
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

