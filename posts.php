<?php include_once "common/header.php";?>

<div class = "container">

    <div class="row justify-content-center">
        <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);
                getMessages($_SESSION['id']);
                    foreach ($data['groups'] as $group) {
                        if($group == 'Проверенные пользователи' || $group == 'Администратор'){ ?>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Непрочитанные сообщения</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Прочитанные сообщения</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
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