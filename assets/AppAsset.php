<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@app/assets/files';
    public $css = [
        'css/site.css','css/style.css','css/offcanvas.css','css/animate.css',
    ];
    public $js = [
        'js/site.js','js/offcanvas.js','js/bootstrap-notify.js'
    ];
//    public $jsOptions=['position' => '\yii\web\index::POS_HEAD'];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
