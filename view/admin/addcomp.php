<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Добавить </title>
    <link rel="stylesheet" href="/view/css/main.css">
</head>

<body>
    <?php require_once "../blocks/header2.php"; ?>
    <div class="wrapper">
        <div class="feedback">
            <div class="container">
                <form method="post" action="/controls/Addcomp.php">
                    <label>Название</label>
                    <input type="text" class="one-line" name="Name" required>
                    <label>Путь к иконке</label>
                    <input type="text" class="one-line" name="Img_path" required >
                    <label>Информация</label>
                        <textarea class="one-line" name="Info" style="height: 200px;" required></textarea>
                    <div class="inline">
                        <input type="checkbox" name="trust" value="1" style="margin-right: 10px;"/> 
                        Подтверждение
                        <button style="margin-left: 300px;" type="submit">Сохранить</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once "../blocks/footer.php"; ?>

</body>

</html>