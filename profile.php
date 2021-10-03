<?php include_once 'common/header.php'?>
<div class = "container">

        <div class="row justify-content-center">
            <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);?>
                <span>Вы авторизованы</span>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Пользователь</th>
                            <th scope="col"><?php echo $data['name']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">ID</th>
                            <td><?php echo $data['id']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Статус</th>
                            <td><?php echo $data['status']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">E-mail</th>
                            <td colspan="2"><?php echo $data['email']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td colspan="2"><?php echo $data['phone']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Newsletter</th>
                            <td colspan="2"><?php echo $data['newsletter']; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">User group</th>
                            <td colspan="2">
                                <?php foreach ($data['groups'] as $group) {
                                    echo $group . '</br>';
                                }?>
                             </td>
                        </tr>
                    </tbody>
                    </table>
            <?php } ?>
            </div>
        </div>                            
    </div> 