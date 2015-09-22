<?php
/**
 * @author: Eugene Brx
 * @email: compuniti@mail.ru
 * @date: 13.08.15
 * @time: 11:59
 */

namespace app\modules\autoparts\controllers;

use Codeception\Module\SOAP;
use yii\base\Exception;
use app\helpers\BrxArrayHelper;
use yii\base\Request;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\UrlManager;
use yii\widgets\ActiveForm;

class DefaultController extends ProviderController
{


    public function actionIndex(){

        $config_1 = ['paramsTemplate' => [
            0 => 'code',
            1 => 'name',
//            2 => 'manufacture',
            3 => 'price',
//            4 => 'quantity',
//            5 => 'srokmin',
//            6 => 'srokmax',
//            7 => 'provider',
//            8 => 'reference',
//            9 => 'srok',
//            10 => 'estimation',
//            11 => 'lotquantity',
//            12 => 'pricedate',
//            13 => 'pricedestination',
//            14 => 'skladid',
//            15 => 'sklad',
//            16 => 'groupid',
//            17 => 'flagpostav',
//            18 => 'storeid',
//            19 => 'pid',
//            20 => 'srokdays',
//            21 => 'weight',
//            22 => 'cross',
//            23 => 'ball',
        ]
            ];



        $arr = [
            'resources' => [
                0 => [
                    'id' => 40386,
                    'name' => 'Колодки тормозные дисковые GDB1044',
                    'article' => 'GDB1044',
                    'brand' => [
                        'id' => 3,
                        'name' => 'TRW',
                    ],
                    'offers' => [
                        0 => [
                            'price' => 1573.82,
                            'quantity' => 0,
                            'reliability' => 100,
                            'multiplication_factor' => 1,
                            'average_period' => 0,
                            'assured_period' => 0,
                            'warehouse' => [
                                'id' => 46,
                                'name' => 'BERG',
                                'type' => 1
                            ]
                        ],
                        1 => [
                            'price' => 1572.82,
                            'quantity' => 6,
                            'reliability' => 100,
                            'multiplication_factor' => 1,
                            'average_period' => 1,
                            'assured_period' => 1,
                            'warehouse' => [
                                'id' => 27820,
                                'name' => 'BERG MSK',
                                'type' => 2
                              ]
                        ]
                    ],
                    'source_idx' => '0',
                ],
                1 => [
                    'id' => 40558,
                    'name' => 'Колодки тормозные дисковые GDB1266',
                    'article' => 'GDB1266',
                    'brand' => [
                        'id' => 3,
                        'name' => 'TRW'
                    ],
                    'offers' =>[
                        0 => [
                            'price' => 2407.03,
                            'quantity' => 0,
                            'reliability' => 100,
                            'multiplication_factor' => 1,
                            'average_period' => 0,
                            'assured_period' => 0,
                            'warehouse' => [
                                'id' => 46,
                                'name' => 'BERG',
                                'type' => 1
                            ]
                        ],
                        1 => [
                            'price' => 2406.03,
                            'quantity' => 1,
                            'reliability' => 100,
                            'multiplication_factor' => 1,
                            'average_period' => 1,
                            'assured_period' => 1,
                            'warehouse' => [
                                'id' => 27820,
                                'name' => 'BERG MSK',
                                'type' => 2
                            ]
                        ]
                    ],
                    'source_idx' => '0'
                ]
            ]
        ];
        function find_parent($array, $needle, $parent = null) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $pass = $parent;
                    if (is_string($key)) {
                        $pass = $key;
                    }
                    $found = find_parent($value, $needle, $pass);
                    if ($found !== false) {
                        return $found;
                    }
                } else if ($value === $needle) {
                    return $parent;
                }
            }

            return false;
        }
//        var_dump(find_parent($arr, 40386));die;

        function array_search_values_recursive($key, &$haystack, $removeItem = false) {
            $haystack = is_object($haystack) ? (array)$haystack : $haystack;
            static $result = [];
//            $result = [];
            foreach ($haystack as &$v) {
                $v = is_object($v) ? (array)$v : $v;
                if (is_array($v)) {
                    if (array_key_exists($key, $v)) {
                        $result[$key][] = $v[$key];
                        if($removeItem)
                            unset($v[$key]);
                    } else
                        array_search_values_recursive($key, $v, $removeItem);
                }
            }
            return $result;
        }



//        $value = array_search_values_recursive('article', $arr);
//        $value = array_search_values_recursive('name', $arr);
//        var_dump($value);die;


        function array_get_path_to_key_recursive($key, &$haystack, $keyToPath = false){
            $haystack = is_object($haystack) ? (array)$haystack : $haystack;
            static $result = [];
//            $result = [];
            foreach ($haystack as $k => &$v) {
                $v = is_object($v) ? (array)$v : $v;
                if (is_array($v)) {
                    if (array_key_exists($key, $v)) {
                        $result[] = $k;
                    }
                    else {
                        $result[] = $k;
                        array_get_path_to_key_recursive($key, $v, $keyToPath);
                    }
                }

            }
            return $result;
//            return $keyToPath ? array_merge($result, [$key]) : $result;
        }

//        var_dump($arr['resources'][0]['offers'][0]);
//        $a = BrxArrayHelper::array_search_recursive(0, $arr);
//        $b = BrxArrayHelper::array_search_recursive_value($a, $arr);
//        $c = array_search_values_recursive('price', $arr);
//        $d = array_get_path_to_key_recursive('price', $arr, true);
//        var_dump($a);
//        var_dump($b);
//        var_dump($c);
//        var_dump($d);
//        die;
        $config = \Yii::$app->getModule('autoparts')->params;
        $fromTemplate = $config['providersFieldsParams']['Berg']['method']['findDetails']['params']['out'];
        $data = is_object($arr) ? (array)$arr : $arr;
        $items = [];
        foreach($config_1['paramsTemplate'] as $key => $value){
            if(isset($fromTemplate[$key])){
//                if(isset($data[0]) && $data[0] instanceof ActiveRecord){
//                    foreach($data as $k => $model){
//                        $values[$k] = $model->$fromTemplate[$key];
//                    }
//                } else
                    $values = array_search_values_recursive($fromTemplate[$key], $data);
                var_dump($values);
                for($i = 0; $i <= count($values[$fromTemplate[$key]])-1; $i++){
                    $items[$i][$value] = $values[$fromTemplate[$key]][$i];
                }
            }
        }
        var_dump($items);die;
        foreach($items as $item){
            foreach($config['paramsTemplate'] as $key => $value){
                if(!array_key_exists($value, $item))
                    $item[$value] = '';
            }
        }

        for($i = 0; $i <= count($items)-1; $i++){
            foreach($config['paramsTemplate'] as $key => $value){
                if(!array_key_exists($value, $items[$i]))
                    $items[$i][$value] = '';
            }
        }
        die;

















    /*EMEX*/
//       var_dump($this->provider('Emex')->findDetails(['code' => '32-D88-F']));

//        Ответ
        //public 'GroupId' => int -370
        //public 'PriceGroup' => string 'Original' (length=8)
        //public 'MakeLogo' => string 'HK' (length=2)
        //public 'MakeName' => string 'HDK' (length=3)
        //public 'DetailNum' => string 'HY012' (length=5)
        //public 'DetailNameRus' => string 'ШРУС ВНЕШНИЙ' (length=23)
        //public 'PriceLogo' => string 'MSAS' (length=4)
        //public 'DestinationLogo' => string 'AFL' (length=3)
        //public 'PriceCountry' => string 'Москва' (length=12)
        //public 'LotQuantity' => int 1
        //public 'Quantity' => int 30
        //public 'DDPercent' => string '100.0' (length=5)
        //public 'ADDays' => int 1
        //public 'DeliverTimeGuaranteed' => int 5
        //public 'ResultPrice' => string '1965.6100' (length=9)*/

//        var_dump($this->provider('Emex')->toBasket(['ePrices' => ['EPrice' => [
//                'Num' => '2',                     // номер по порядку (произвольный номер)
//                'MLogo' => 'HK',                   // лого изготовителя (MakeLogo)
//                'DNum' => 'HY012',                    // уникальный номер детали (DetailNum)
//                'Name' => 'ШРУС ВНЕШНИЙ',                    // наименование детали русское (DetailNameRus все большие)
//                'Quan' => '2',                    // количество деталей (max Quantity)
//                'Price' => '1965.6100',                   // цена рублевая (пример: 0000.0000)
//                'PLogo' => 'MSAS',                   // лого прайса детали (PriceLogo)
//                'DLogo' => 'AFL',                   // лого доставки (DestinationLogo)
//                'DeliveryRegionType' => 'PRI',      // тип доставки по региону. Если этот элемент не задан, то сохраняется значение PRI
//                'Ref' => 'API тест',                     // поле reference (это и есть комментарий)
//                'Com' => 'API тест',                     // поле комментария. Также в этом поле можно задавать разрешенные признаки детали. Вводить их в любом порядке, через пробел. Например BRAND ONLY
//                'Notc' => '',                    // признак безналичной оплаты
//                'Error' => ''                    // поле ошибки, с описанием причины ошибки.
//        ]]]));
        //Ответ
        //public 'Num' => string '2' (length=1)
        //public 'GlobalId' => string '81072955' (length=8)
        //public 'Comment' => string '' (length=0)

        /*Iksora*/
//        var_dump($this->provider('Iksora')->findDetails(['code' => '32-D88-F']));
//        Ответ
//        public 'FindResult' =>
//            object(stdClass)[174]
//              public 'DetailInfo' =>
//                array (size=39)
//                  0 =>
//                    object(stdClass)[175]
//                      public 'number' => string 'HY012' (length=5)
//                      public 'maker' => string 'HDK' (length=3)
//                      public 'name' => string 'ШРУС ВНЕШНИЙ' (length=23)
//                      public 'quantity' => string '>4' (length=2)
//                      public 'lotquantity' => int 2
//                      public 'price' => float 1827.42
//                      public 'pricedestination' => float 0
//                      public 'days' => int 0
//                      public 'dayswarranty' => int 0
//                      public 'region' => string 'АВТО-ИКСОРА СКЛАД' (length=32)
//                      public 'estimation' => string '5 5 5' (length=5)
//                      public 'orderreference' => string '0-91001-1-64-3-43385284-2-0' (length=27)
//                      public 'group' => string 'Original' (length=8)
//                      public 'date' => string '2015-08-20T00:00:00' (length=19)
//
        /*Partkom*/
//        var_dump($this->provider('Partkom')->findDetails(['code'=> '32-D88-F'])); // основная проблема поиска в трех последних параметрах
//        Ответ
//        0 =>
//          array (size=22)
//              'number' => string 'HY012' (length=5)
//              'maker' => string 'HDK' (length=3)
//              'makerId' => string '223' (length=3)
//              'description' => string 'ШРУС внешний HY-12' (length=29)
//              'providerId' => int 205
//              'providerDescription' => string 'МСК склад' (length=17)
//              'minQuantity' => int 10
//              'storehouse' => boolean false
//              'minDeliveryDays' => int 1
//              'averageDeliveryDays' => int 1
//              'maxDeliveryDays' => int 1
//              'warrantedDeliveryDays' => int 1
//              'lastUpdateDate' => string '2015-08-20 18:58:50' (length=19)
//              'statProvider' => int 86
//              'price' => float 2093
//              'quantity' => string '1' (length=1)
//              'detailGroup' => string 'Original' (length=8)
//              'group' => string '223' (length=3)
//              'lastOrderDate' => string '' (length=0)
//              'statSuccessCount' => int 0
//              'statRefusalCount' => int 0
//              'statTotalOrderCount' => int 0

//        var_dump($this->provider('Partkom')->toBasket(['OrderItem' => [
//                (object)[
//                      'detailNum' => '90915YZZE1',
//                      'makerId' => 920,
//                      'description' => 'ШРУС внешний HY-12',
//                      'price' => 247,
//                      'providerId' => 5,
//                      'quantity' => 1,
//                      'comment' => 'API тест',
//                      'errorMessage' => ''
//                ]
//          ]
//        ]
//        ));
//        Ответ пустой масив

//        MOSKVORECHIE
//        var_dump($this->provider('Moskvorechie')->findDetails(['code' => '32-D88-F'])); //32-D88-F

//        Ответ
//        string '{"result":
//                      [
//                          {
//                              "nr":"334614",
//                              "brand":"Kayaba",
//                              "name":"Амортизатор BMW 3 E46 -05 пер.прав.газ.SPORT",
//                              "stock":"1",
//                              "delivery":"2 дня",
//                              "minq":"1",
//                              "upd":"25.08.15 08:02",
//                              "price":"4674.30",
//                              "currency":"руб.",
//                              "gid":"1001232170"
//                          }
//                      ]
//                  }'
//
//        var_dump($this->provider('Moskvorechie')->toBasket(['gid' => '1001232170']));
//        Ответ
//        {"result":
//                  {
//                      "status":"0",
//                      "msg":""
//                  }
//        }'
//
//        BERG
//        $items = [
//                    'items' => [
//                        [
//                            'resource_article' => 'HY012',
//                            'brand_id' => 672,
//                            'brand_name' => 'HDK'
//                        ]
//                    ]
//                 ];
//        var_dump($this->provider('Berg')->findDetails(['code' => '32-D88-F']));//32-D88-F
//        Ответ
//        {"resources":
//              [
//                  {
//                      "id":40386,
//                      "name":"\u041a\u043e\u043b\u043e\u0434\u043a\u0438 \u0442\u043e\u0440\u043c\u043e\u0437\u043d\u044b\u0435 \u0434\u0438\u0441\u043a\u043e\u0432\u044b\u0435 GDB1044",
//                      "article":"GDB1044",
//                      "brand":{
//                                  "id":3,
//                                  "name":"TRW"
//                              },
//                      "offers":
//                              [
//                                  {
//                                      "price":1799.53,
//                                      "quantity":0,
//                                      "reliability":100,
//                                      "multiplication_factor":1,
//                                      "average_period":0,
//                                      "assured_period":0,
//                                      "warehouse":
//                                                  {
//                                                      "id":46,
//                                                      "name":"BERG",
//                                                      "type":1
//                                                  }
//                                  }
//                              ],
//                      "source_idx":"0"
//                  }
//              ]
//          }'

//        $order = [
//            'order'	=> [
//                'items' => [
//                    1 => [
//                        'resource_id' => '40386',
//                        'warehouse_id' => '46',
//                        'quantity' => 1,
//                        'comment' => 'API Test'
//                    ]
//                ]
//            ],
//        ];
//        var_dump($this->provider('Berg')->toBasket($order));

//object(linslin\yii2\curl\Curl)[172]
//        public 'response' =>
//           array (size=2)
//               'warnings' =>
//                 array (size=2)
//                   0 =>
//                     array (size=3)
//                       'code' => string 'ERR_ORDER_ITEMS_MULTIPLICATION_FACTOR' (length=37)
//                       'text' => string 'Quantity must be a multiple of the minimum normal shipping' (length=58)
//                       'data' =>
//                         array (size=4)
//                           'resource_id' => int 703
//                           'warehouse_id' => int 46
//                           'quantity' => int 1
//                           'comment' => string 'произвольный комментарий 1' (length=49)
//                   1 =>
//                     array (size=3)
//                       'code' => string 'ERR_ORDER_ITEMS_QUANTITY_EXCEED_AVAILABLE' (length=41)
//                       'text' => string 'Requested item quantity exceed available on warehouse' (length=53)
//                       'data' =>
//                         array (size=4)
//                           'resource_id' => int 50716
//                           'warehouse_id' => int 46
//                           'quantity' => int 1
//                           'comment' => string 'произвольный комментарий 2' (length=49)
//               'order' =>
//                 array (size=9)
//                   'id' => int 7252443
//                   'dispatch_type' => int 3
//                   'dispatch_at' => string '2015-09-11T23:00:00+0300' (length=24)
//                   'dispatch_time' => int 1
//                   'person' => string 'Женя Лукашин' (length=23)
//                   'shipment_address' => string 'Москва, 3-я улица Строителей, дом 25, квартира 12' (length=82)
//                   'comment' => string 'запчасти для Ипполита' (length=40)
//                   'is_test' => boolean true
//                   'items' =>
//                     array (size=1)
//                       0 =>
//                         array (size=9)
//                           'sequence' => int 1
//                           'resource_id' => int 50716
//                           'warehouse_id' => int 6
//                           'quantity' => int 1
//                           'price' => float 1596.39
//                           'average_time' => string '2015-08-28T10:33:51+0300' (length=24)
//                           'assured_time' => string '2015-08-31T10:33:51+0300' (length=24)
//                           'state_id' => int 296
//                           'comment' => string 'произвольный комментарий 3' (length=49)
    }
}