<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 10.01.15
 * Time: 15:55
 */
//var_dump($model);die;
echo '<table>';
foreach ($model as $key=>$m)
{
    echo '<tr><td>'.$key.'</td><td>'.$m.'</td></tr>';
}
echo '</table>';