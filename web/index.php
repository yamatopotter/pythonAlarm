<?php include('head.php'); ?>
    <main>
        <section class="login-form">
            <img src="./assets/img/logo.svg" alt="Alarm System Logo" class="logo">
            <div class="card">
                <form action="login.php" method="post">
                    <label for='user'>
                        Usuário
                    </label>
                    <input type="text" name="user" class="input-text">
                    <label for='password'>
                        Senha
                    </label>
                    <input type="password" name="password" class="input-text">
                    <input type="submit" value="Login" class="btn">
                </form>
            </div>        
        </section>
    </main>
    
    </body>
</html>