<?php include_once "common/header.php";?>

<div class = "container">

    <div class="row justify-content-center">
        <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);
                    foreach ($data['groups'] as $group) {
                        if($group == 'Проверенные пользователи' || $group == 'Администратор'){?> 

                        <form action="controller/controller.php" method="POST" name="sendMessage">
                            <div class="mb-3">
                                <label for="title_message" class="form-label">Заголовок</label>
                                <input type="text" class="form-control" id="title_message" name="title_message" placeholder="Заголовок" required>
                            </div>
                            <div class="mb-3">
                                <label for="text_message" class="form-label">Текст сообщения</label>
                                <textarea class="form-control" id="text_message" name="text_message" rows="3" required></textarea>
                            </div>

                            <label for="group_message" class="form-label">Пользователь</label>
                            <select class="form-select" aria-label="Default select example" id="user_message" name="user_message" required>
                                <option value="">Выберете пользователя</option>
                                <?php $allUsers = getVerifiedUsers();
                                foreach($allUsers as $user){
                                    echo "<option value=".$user['id'].">".$user['email']."</option>";
                                }?>
                            </select>

                            <label for="group_message" class="form-label">Раздел</label>
                            <select class="form-select" aria-label="Default select example" id="group_message" name="group_message" required>
                                <option value="">Выберете раздел сообщения</option>
                                <?php $allGroups = getAllGroups();
                                foreach($allGroups as $group){
                                    echo "<option value=".$group['id']." style = color:" . $group['color']. ">".$group['group_title']."</option>";
                                }?>
                            </select>                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

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