<form name="regForm" action="/?registration" method="POST" class="regForm windowMain" style="padding: 25px;"
 onsubmit="checkMail(); return false;">
    <div class="formCaption">Регистрация</div>
    <div class="inputGroup">
        <div><label for="surName" class="inputHeader">Фамилия *</label></div>
        <input type="text" name="surName" id="surName" class="dronInput inputField dronInputWide" placeholder="Сахаров" required>
    </div>

    <div class="inputGroup">
        <div><label for="fName" class="inputHeader">Имя *</label></div>
        <input type="text" name="fName" id="fName" class="dronInput inputField dronInputWide" placeholder="Андрей" required>
    </div>

    <div class="inputGroup">
        <div><label for="pName" class="inputHeader">Отчество</label></div>
        <input type="text" name="pName" id="pName" class="dronInput inputField dronInputWide" placeholder="Геннадьевич">
    </div>

    <div class="inputGroup">
        <div><label for="eMail" class="inputHeader">Email *</label></div>
        <input type="email" name="eMail" id="eMail" class="dronInput inputField dronInputWide" placeholder="andrey-saxarov@mail.ru" required
        onchange="isEmailExists(document.getElementById('eMail').value);"
        onblur="isEmailExists(document.getElementById('eMail').value);">
    </div>

    <div class="inputGroup">
        <div><label for="pass1" class="inputHeader">Пароль *</label></div>
        <img src="./icon-svg/closed-eye.svg" class="inputIcon" data-input="pass1"
             onclick="let el = document.getElementById(this.dataset.input);
                      el.setAttribute('type', el.getAttribute('type') == 'password' ? 'text' : 'password');
                      this.src = el.getAttribute('type') == 'password' ? './icon-svg/closed-eye.svg' : './icon-svg/open-eye.svg';">
        <input type="password" name="pass1" id="pass1" class="dronInput inputField dronInputWide" placeholder="Введите пароль" required
         onchange="if (this.checkValidity()) { form.pass2.pattern = this.value; form.pass2.title = 'Пароли не совпадают!'; }"
         pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])[\w\W]{6,}" title="Минимум 6 символов, минимум 1 символ в верхнем регистре, минимум 1 цифра">
    </div>

    <div class="inputGroup">
        <div><label for="pass2" class="inputHeader">Подтвердите пароль *</label></div>
        <img src="./icon-svg/closed-eye.svg" class="inputIcon" data-input="pass2"
             onclick="let el = document.getElementById(this.dataset.input);
                      el.setAttribute('type', el.getAttribute('type') == 'password' ? 'text' : 'password');
                      this.src = el.getAttribute('type') == 'password' ? './icon-svg/closed-eye.svg' : './icon-svg/open-eye.svg';">
        <input type="password" name="pass2" id="pass2" class="dronInput inputField dronInputWide" placeholder="Подтвердите пароль" required
        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])[\w\W]{6,}" title="Минимум 6 символов, минимум 1 символ в верхнем регистре, минимум 1 цифра">
    </div>
    <input type="submit" value="Регистрация" class="dronInput dronBtnOk dronInputWide" style="margin-top: 20px;">
</form>
<script>
    async function isEmailExists(email) {
        let result = await fetch('/atom-api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    'body': JSON.stringify({"requestType":"emailExists", "email":email})
                })
        .then((resp) => {
            if (resp.ok) {
                return resp.json();
            } else {
                return JSON.parse(`{"result": "error"}`);
            };
        })
        .catch(err => {
            return JSON.parse(`{"result": "error", "message": "${err.message}"}`);
        });
        document.getElementById('eMail').setCustomValidity(result.result ? 'Указанный email уже зарегистрирован' : '');
        return result.result;
    }; // isEmailExists()

    async function checkMail() {
        let result = await isEmailExists(document.getElementById('eMail').value);
        if (!result) {
            console.log('submitted');
            document.forms.regForm.submit();
        };
    }; // checkMail()
</script>