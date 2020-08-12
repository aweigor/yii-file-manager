<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 7/15/20
 * Time: 8:14 AM
 */
use app\models\User;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

$this->registerCssFile("@web/css/storage/layout.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);


// Пользователи, которые дали доступ к папке
$userId = Yii::$app->user->identity->id;
$userModel = User::findOne($userId);
$friends = $userModel->getFriends();


$navItems = [
    [
        'label' => $userModel->user_name,
        'url' => ['/catchbin/folder', ['uid' => $userModel->user_id]]
    ]
];

foreach($friends as $friend) {
    if ($friend->user_id === $userModel->user_id) continue;

    $navItems[] = [
            'label' => $friend->user_name,
            'url' => ['/catchbin/folder', ['uid' => $friend->user_id]]
    ];
}

/* @var $friends - Array - shared folders from Users
 * @var $navItems - Array - navigation items
 */

?>
<?php $this->beginContent('@views/layouts/storageModal.php'); ?>
<?php $this->endContent(); ?>

<?php $this->beginContent('@views/layouts/main.php'); ?>
    <div class="storage_container container">

        <!--div class="storage_header row">
            Поиск
        </div-->

        <div class="storage_body row">

            <div class="storage_sided_bar col-3">
                <?php
                ?>
                <?php
                NavBar::begin([
                    'options' => [
                        'class' => 'navbar navbar-expand-lg navbar-light bg-light',
                    ]
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'nav flex-column'],
                    'items' => $navItems,
                ]);
                NavBar::end();
                ?>
            </div>

            <div class="storage_content_view col-9">
                <?= $content ?>
            </div>

        </div>

    </div>
<?php $this->endContent(); ?>