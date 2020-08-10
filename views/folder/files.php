<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/9/20
 * Time: 9:45 AM
 */

use yii\grid\ActionColumn;
use yii\helpers\html;
use kartik\grid\GridView;


$this->title = "Мой каталог";

$this->registerCssFile("@web/css/storage/files.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);

$gridColumns = [
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        // uncomment below and comment detail if you need to render via ajax
        // 'detailUrl' => Url::to(['/site/book-details']),
        'detail' => function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_fileDetails', ['model' => $model]);
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'expandOneOnly' => true
    ],
    [
        'attribute' => 'file_name',
        'vAlign' => 'middle',
        'filterWidgetOptions' => [
            'pluginOptions' => ['allowClear' => true],
        ],
        'filterInputOptions' => ['placeholder' => 'Any author', 'multiple' => true],
        'format' => 'raw'
    ],
    [
        'class' => 'kartik\grid\BooleanColumn',
        'attribute' => 'file_isPersonal',
        'vAlign' => 'middle'
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
        'template' => '{bt_activate}',
        'buttons' => [
            'bt_edit_file' => function ($url, $model, $key) {
                $text = "Edit";
                return Html::a($text , ['index']);
            },
        ]
    ],
];
?>

<?php if($folder->fold_user_id == $identity->user_id): ?>
    <div class="file_input container">
        <div
                type="button"
                class="file_input dd_button btn"
                id="bt-upload-file"
                folder="<?= $folder->fold_id?>"
                data-toggle="modal"
                data-target="#uploadFileModal"
        >
            <i class="fas fa-plus"></i>
        </div>
        <div class="file_input form">

        </div>
    </div>

    <!-- Modal -->
    <div
            class="modal right fade"
            id="uploadFileModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myModalLabel1"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Загрузка файлов</h6>
                    <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 0">
                    <?= $this->render("_formFileUpload", [
                        "folder" => $folder,
                        "uploadModel" => $uploadModel
                    ]);?>
                </div>

                <div class="modal-footer">
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div><!-- modal -->
<?php endif; ?>

<div class="grid-table files">
    <?php echo GridView::widget([
        'dataProvider'=> $filesProvider,
        'columns' => $gridColumns
    ]) ?>
</div>

