<form action="/?login" method="POST" class="loginForm">
    <div class="formCaption">АВТОРИЗАЦИЯ</div>
    <div>
        <div><label for="login" class="inputHeader">Логин</label></div>
        <input type="text" name="login" id="login"
               class="dronInput inputField dronInputWide"
               placeholder="Введите логин" required
               <?php echo isset($params['userName']) ? ('value="' . $params['userName'] . '"') : ''; ?>>
    </div>
    <div>
        <div><label for="pass" class="inputHeader">Пароль</label></div>
        <input type="password" name="pass" id="pass" class="dronInput inputField dronInputWide" placeholder="Введите пароль" required>
    </div>
    <div style="display: flex; justify-content: space-between; margin-bottom:16px;">
        <input type="checkbox" name="isSave" id="isSave" class="dronChkBox">
        <label for="isSave" class="inputHeader">Запомнить</label>
        <input type="submit" value="Войти" class="dronInput dronBtn dronBtnMiddle">
    </div>
    <a href="?registration" class="dronInput dronBtnOk dronInputWide aBtn">Регистрация</a>
</form>