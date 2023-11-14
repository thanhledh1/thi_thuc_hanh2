<?php 
class Person {
    public $name;
    public $age;


    // public function __construct($personname,$personage)
    // {
    //     $this->name = $personname;
    //     $this->age = $personage;

    // }

  function setage($newage){
        $this->age = $newage;
    }


     function getage(){
        return $this->age;
    }


    function setname($newname){
        $this->name = $newname;
    }


     function getname(){
        return $this->name;
    }

    function __destruct()
    {
        echo "ket thuc!";
    }
    public static function a(){
        echo "static";
    }
   
}
$thanh = new Person();
$thanh -> setname('levvanthanh');
echo $thanh->getname()


// echo $thanh->getname() . "<br/>";
// echo $thanh->getage() . "<br/>";
// echo Person::a(). '<br/>';




?>


