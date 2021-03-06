<?php
namespace app\modules\auto;
use app\modules\auto\A2d;
/**
 * Класс с API и внутренними функциями для АвтоКаталога
 * В каталог входят такие марки как: ВАЗ, ГАЗ, КаМАЗ и многие другие
 * Посмотреть полный список можно на странице с марками
*/
class ADCAPI extends A2D {

    /// Тип каталога, для АвтоДилер пока не указывается
    protected static $_type = "ADC";

    public function __construct(){

        parent::__construct();
        static::setMark($this->rcv('mark'));
        /// Для "хлебных крошек", на какой каталог ссылаться при построении крошек
        static::$catalogRoot = "";
        /// Данным значениям (static::$arrActions) в helpers/breads.php сопоставляются последовательно параметрам из A2D::$aBreads
        static::$arrActions = ['typeID','markID','modelID','treeID'];
        /// Корневой каталог, откуда стартовать скрипты поиска для текущего каталога (используется в конструкторе формы поиска)
        static::$searchIFace = "adc";
        /// Массив для построение формы с поиском (опиание в главном README.MD)
        static::$searchTabs = [[
            'id'    => 1,
            'alias' => 'detail',
            'name'  => 'номер детали', /// В контексте "Укажите ..."
            'tName' => 'Поиск по номеру детали'
        ],[
            'id'    => 2,
            'alias' => 'model',
            'name'  => 'Модель', /// В контексте "Укажите ..."
            'tName' => 'Поиск модели'
        ]];
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///   СТАНДАРТНЫЕ ФУНКЦИИ ДЛЯ ПОЛУЧЕНИЯ ДАННЫХ   ///////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Пулочение списка групп/типов автомобилей
    public function getTypeList(){
        $body = "f=".__FUNCTION__.$this->_auth;
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Получаем марки по типу или все
    public function getMarkList($type=FALSE){
        $body = "f=".__FUNCTION__.$this->_auth."&typeID=$type";
//        var_dump($body);die;
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Получение списка моделей по типу и марке или только марке
    public function getModelList($mark,$type=FALSE){
        $body = "f=".__FUNCTION__.$this->_auth."&typeID=$type&markID=$mark";
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Получение всех деталей и их узлов для текущей модели
    public function getTreeList($model,$bMultiArray){
        $body = "f=".__FUNCTION__.$this->_auth."&modelID=$model&multiArray=$bMultiArray";
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Получение иллюстрации со списком номенклатуры
    public function getDetails($model,$detail,$jump){
        $body = "f=".__FUNCTION__.$this->_auth."&modelID=$model&treeID=$detail&jumpPic=$jump";
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Получении информации о детали
    public function getDetailInfo($model,$detail){
        $body = "f=".__FUNCTION__.$this->_auth."&modelID=$model&treeID=$detail";
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Поиск модели
    public function searchModels($model){
        $body = "f=".__FUNCTION__.$this->_auth."&model=$model";
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    /// Поиск детали
    public function searchNumber($sSearch=FALSE,$sModel=FALSE){
        $body = "f=".__FUNCTION__.$this->_auth."&search=$sSearch&modelID=$sModel";
        $answer = $this->getAnswer($body);
        $r = json_decode($answer);
        return $r;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}
