<?php include_once 'common/header.php'?>

    <div class = "container">
        <div class="row justify-content-center">
            <div class="col-4">
            <?php (isset($_SESSION)) ? '' : session_start(); if(isset($_SESSION['id'])){ $data = getUserInfo($_SESSION['id']);?>
            <span>Вы авторизованы</span>
            <?php }else{ ?>
                <form action="controller/controller.php" method="POST" name="auth">
                    <div class="mb-3">
                        <label for="InputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="InputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } ?>
            </div>
        </div>                            
    </div> 
</body>
</html>