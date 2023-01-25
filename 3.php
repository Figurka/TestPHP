<?php

/**
 * @charset UTF-8
 *
 * Задание 3
 * В данный момент компания X работает с двумя перевозчиками
 * 1. Почта России
 * 2. DHL
 * У каждого перевозчика своя формула расчета стоимости доставки посылки
 * Почта России до 10 кг берет 100 руб, все что cвыше 10 кг берет 1000 руб
 * DHL за каждый 1 кг берет 100 руб
 * Задача:
 * Необходимо описать архитектуру на php из методов или классов для работы с
 * перевозчиками на предмет получения стоимости доставки по каждому из указанных
 * перевозчиков, согласно данным формулам.
 * При разработке нужно учесть, что количество перевозчиков со временем может
 * возрасти. И делать расчет для новых перевозчиков будут уже другие программисты.
 * Поэтому необходимо построить архитектуру так, чтобы максимально минимизировать
 * ошибки программиста, который будет в дальнейшем делать расчет для нового
 * перевозчика, а также того, кто будет пользоваться данным архитектурным решением.
 *
 */

# Использовать данные:
# любые

// Первый вариант(не закончен) Причина: Наверное стоит идти от посылки, но такой варинт тоже возмможен.
// abstract class Transporter{
//     public $brand; // Наименование перевозчика
//     protected float $cost = 0; // Цена перевозки по умолчанию/минимальная цена перевозки

//     function __construct($brand,)
//     {
       

//     }
//     // Метод расчета стоимости доставки.
//     abstract public function transitCost();
// };

// class DHL{
//     public $brand = 'DHL';
//     public function transitCost($weight){
//         $this->cost=$weight*100;
//         return $this->cost;
//     }
// };
// class RussianPost{
//     public $brand = 'Russian Post';
//     public function transitCost($weight){
//         $this->cost=($weight<=10) ? 100: 1000;
//     }
// };


// Вариант второй

class Package{
    public $adress;
    public $client;
    public $weight = 0;
    public $cost = 0;

    public function __construct($a,$b,$c)//Не стал сильно продумывать возможные атрибуты, так как пока важен только вес.
    {
        $this->adress =$a;
        $this->client =$b;
        $this->weight =$c;
    }
    public function __call($name, $arguments)
    {
      return $name.count($arguments);
    }
    public function transitCost($transporter){
        if (is_callable($transporter)){
        $this->cost=$transporter($this->weight);
        return $this->cost;
    }else{
        return 'Wrong Transporter';
        }
    }
};


function DHL($weight){
            $cost=$weight*100;
            return $cost;
};
function russianPost($weight){
        $cost=($weight<=10) ? 100: 1000;
        return $cost;
};



$a = new Package('x','z',11);
echo $a->transitCost('DHL');
echo $a->transitCost('russianPost');
echo $a->transitCost('ssianPost');

?>