<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Комплит Файлы. Справка';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать в "Комплит Файлы"!</h1>

        <p class="lead">Этот раздел посвящен основным функциям программы.</p>

        <div class="instructions container" align="left">
            <p>
                <span>1. Для начала работы, перейдите на страницу авторизации, и совершите вход в систему. Посде входа вам станет доступан раздел "Файлы"</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/auth.png" alt="Форма авторизации" >
            </div>
            <p>
                <span>2. В разделе "Файлы" слева отображается список пользователей, которые дали доступ на просмотр своих папок. Для создания собственной папки необходимо перейти в раздел с имененм своего аккаунта.</span>
            </p>
            <div class="rightimg">
                <img src="/images/help/usersform.png" alt="Список пользователей" class="rightimg">
            </div>

            <p>
                <span>3. Чтобы создать папку, щелкните по большой кнопке "+". Справа откроется меню. Заполните поля и нажмите "Создать папку". Папка появится в правом окне.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/addbutton.png" alt="Кнопка добавления папки" class="rightimg">
            </div>

            <p>
                <span>4. Для редактирования или удаления папки, наведите курсор на папку, и выберите карандаш для редактирования, или корзину для удаления.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/folderbuttons.png" alt="Кнопки редактирования" class="rightimg">
            </div>

            <p>
                <span>5. Если вы хотите, чтобы папка была доступна другим пользователям, войдите в меню редактирования, и выберите их в графе "Могут просматривать". Для выбора нескольких пользователей, используйте клавиши  Shift и Ctrl.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/sharepanel.png" alt="Добавление пользователей" class="rightimg">
            </div>

            <p>
                <span>6. Чтобы перейти в панель управления файлами, нажмите на папку, которую вы хотите просмотреть. Перед вами откроется таблица файлов.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/folderbutton.png" alt="Папка" class="rightimg">
            </div>

            <p>
                <span>7. Для загрузки файла, нажмите "Загрузить файл", и следуйте указателям на правой панели экрана. После добавления, файл появится в таблице файлов.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/uploadbutton.png" alt="Кнопка загрузки" class="rightimg">
            </div>

            <p>
                <span>8. Для просмотра галереи, выберите кнопку "Галерея" слева от "Загрузить файл", или выберите файл и списка, и нажмите на него.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/gallerybutton.png" alt="Кнопка галереи" class="rightimg">
            </div>

            <p>
                <span>9. Для удаления, скачивания, и редактирования файлов, используйте кнопки в правом углу списка.</span>

            </p>
            <div class="rightimg">
                <img src="/images/help/filebuttons.png" alt="Кнопки управления" class="rightimg">
            </div>

        </div>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(["folder/catalog"])?>">Приступить к работе</a></p>
    </div>
</div>
