<?php
/**
 * Created by PhpStorm.
 * User: aweigor
 * Date: 8/9/20
 * Time: 9:45 AM
 */

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;

/*
 * @var $filesProvider
 * @var $folder
 * @var $identity
 * @var $uploadModel
 * @var $searchModel
 *
 *
 * todo: загрузка файлов возможна всем юзерам, если нет - добавить условия.
 * */

$this->title = "Мой каталог";

$this->registerCssFile("@web/css/storage/files.css",
    [
        'rel' => 'stylesheet',
        'depends'=> ['app\assets\AppAsset']
    ]
);

$actionButtons =

$gridColumns = [
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '5%',
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
        'attribute' => 'file_ext',
        'vAlign' => 'middle',
        'width' => '5%',
        'contentOptions' => ['class' => 'extension_column'],
        'value' => function ($model) {
            $formatIcon = isset(Yii::$app->params["format_icons"][$model->file_ext])
                ? Yii::$app->params["format_icons"][$model->file_ext]
                : '<i class="fas fa-file"></i>';
            $html = $formatIcon . '<span>'.$model->file_ext.'</span>';
            return $html;
        },
        'format' => 'html'
    ],
    [
        'attribute' => 'file_name',
        'vAlign' => 'middle',
        'width' => '50%',
        'format' => 'raw'
    ],
    [
        'attribute' => 'file_dateloaded',
        'width' => '20%',
        'vAlign' => 'middle',
        'format' => ['date', 'dd-MM-yy H:i:s']
    ],
#    [
#        'class' => 'kartik\grid\BooleanColumn',
#        'attribute' => 'file_isPersonal',
#        'vAlign' => 'middle'
#    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'width' => '20%',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
        'header' => "",
        'template' => '{bt_download_file}{bt_edit_file}{bt_delete_file}',
        'contentOptions' => ['class' => 'action_button_group'],
        'buttons' => [
            'bt_edit_file' => function ($url, $model, $key) use($folder) {
                if($model->file_user_id !== Yii::$app->user->id && $folder->fold_user_id !== Yii::$app->user->id) return '<a href="#" class="restricted_link"></a>';
                return '<div 
                        type="button"
                        id="file_'.$model->file_id.'" 
                        owner="'.$model->file_user_id.'" 
                        data-toggle="modal" 
                        data-target="#editModal" 
                        class="btn bt-edit-file files_bu-edit"
                        ><i class="fas fa-pencil-alt"></i></div>';
            },
            'bt_delete_file' => function ($url, $model, $key) use($folder) {
                if($model->file_user_id !== Yii::$app->user->id && $folder->fold_user_id !== Yii::$app->user->id) return '<a href="#" class="restricted_link"></a>';
                return '<div type="button " class="btn"><a href="'.Url::to(['folder/remove-file', 'file_id' => $model->file_id]).'">
                            <i style="color:red" class="fas fa-minus-square"></i>
                        </a></div>';
            },
            'bt_download_file' => function ($url, $model, $key) {
                return '<div type="button " class="btn"><a href="'.Url::to(['folder/download-file', 'file_id' => $model->file_id]).'">
                            <i class="fas fa-angle-double-down"></i>
                        </a></div>';
            },
        ]
    ],
];
?>

<?php if($folder->fold_user_id == $identity->user_id): ?>
<?php endif; ?>

<div class="grid-table files">
    <?php echo GridView::widget([
        'dataProvider'=> $filesProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'toolbar' =>  [
            [
                'content' =>
                    Html::button('<i class="fas fa-download"></i>&nbsp&nbsp<span>Загрузить файл</span>', [
                        'class' => 'btn btn-success',
                        'title' => "Загрузить файл",
                        'id' => "bt-upload-file",
                        'folder' => $folder->fold_id,
                        'data-toggle' => 'modal',
                        'data-target' => '#uploadFileModal'
                    ]),
                'options' => ['class' => 'btn-group mr-2']
            ]
        ],
        'panel' => [
            'heading' => $folder->fold_name,
            'before' => '', //IMPORTANT
        ],
        'resizableColumns' => false,
        'persistResize' => false
    ]) ?>
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

