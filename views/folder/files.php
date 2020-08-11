<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/9/20
 * Time: 9:45 AM
 */

use yii\grid\ActionColumn;
use yii\helpers\html;
use yii\helpers\Url;
use kartik\grid\GridView;

/*
 * @var $filesProvider
 * @var $folder
 * @var $identity
 * @var $uploadModel
 * @var $searchModel
 *
 * */

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
        'template' => '{bt_edit_file}{bt_delete_file}{bt_download_file}',
        'buttons' => [
            'bt_edit_file' => function ($url, $model, $key) {
                return '<div 
                        type="button " 
                        id="file_'.$model->file_id.'" 
                        owner="'.$model->file_user_id.'" 
                        data-toggle="modal" 
                        data-target="#editModal" 
                        class="btn bt-edit-file files_bu-edit"
                        ><i class="fas fa-pencil-alt"></i></div>';
            },
            'bt_delete_file' => function ($url, $model, $key) {
                return '<div type="button " class="btn"><a href="'.Url::to(['folder/remove-file', 'file_id' => $model->file_id]).'">
                            <i style="color:red" class="fas fa-minus-square"></i>
                        </a></div>';
            },
            'bt_download_file' => function ($url, $model, $key) {
                return '<div type="button " class="btn"><a href="'.Url::to(['folder/download-file', 'file_id' => $model->file_id]).'">
                            <i style="color:red" class="fas fa-minus-square"></i>
                        </a></div>';
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
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style']
    ]) ?>
</div>

