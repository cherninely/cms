<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="<?=base_url()?>projects/prints/js/jquery-1.6.2.min.js" ></script>
<script type="text/javascript" src="<?=base_url()?>projects/prints/js/admin_login.js" ></script>
<title>Админка</title>
<style>
    #log_in ul{list-style: none;}
    #log_in ul li{height: 30px;}
</style>
</head>
<body>
    <div style="font-size: 72px; color: blue; text-align: center; margin: 0 auto; margin-top: 90px;"><b>Админка</b></div>
    <div style="margin: 0 auto;width: 250px;">
    <form id="log_in" method="POST">
        <ul>
            <li>
                <div style="width:50px;float: left;">Логин</div>
                <div style="float: right;"><input name="login" type="text" maxlength="20" /></div>
            </li>
            <li>
                <div style="width:50px;float: left;">Пароль</div>
                <div style="float: right;"><input name="password" type="password" maxlength="20" /></div>
            </li>
        </ul> 
        <div style="margin:0 auto; width: 50px;"><a onclick="document.forms['log_in'].submit();" href="javascript:void(0)">Войти</a></div>
        <input style="visibility: hidden" type="submit" value="Submit" />
    </form>
    <p id="err_log" style="color: red; font-size: 17px;display:none;">Ошибка</p>
    </div>
</body>

</html>