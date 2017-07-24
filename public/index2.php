<?php
require '../vendor/autoload.php';

class B
{
    public $name = 'akram';
}

class A
{
    private $b;

    public function getB()
    {
        return $this->b;
    }

    function __construct(B $b)
    {
        $this->b = $b;
    }
}

class Container
{
    public static function make($className)
    {
        $class = new ReflectionClass($className);
        $constructor = $class->getConstructor();
        if (!$constructor || ($constructor && count($constructor->getParameters()) == 0)) {
            $obj = new $className;
        } else {
            $_params = collect($constructor->getParameters())
                ->reduce(function ($acc, $item) {
                    $acc[] = Container::make($item->getClass()->name);//->newInstance();
                    return $acc;
                }, []);

            $obj = $class->newInstanceArgs($_params);
        }
        return $obj;
    }
}

$a = Container::make(A::class); // Too few arguments exception
//$b = Container::make(B::class); // no problem
//$a = Container::make(A::class); // Too few arguments exception
var_dump($a->getB());

