<?php

class Person
{
    const CEO ='ceo';
    const WORKER ="worker";
    const MANAGER ='manager';
    const PROGRAMER ='programer';
    const ANALITIK ='analitik';
    const DRIVER ='driver';
    protected $Bmoney =190;

    private $idPerson;
    private $firstName;
    private $lastName;
    private $telNumber;
    private $privateEmail;
    private $position;
    private $cardNumber;
    private $date; // entery date to job
    private $workEmail;
    private $workTime;
    private $children;

//treating form registration person
    public static function fromPost(array $post): self
    {
       $firstName = isset($post["firstName"]) ? $post['firstName'] : null;
       $lastName = isset($post["lastName"]) ? $post['lastName'] : null;
       $telNumber = isset($post["telNumber"]) ? $post['telNumber'] : null;
       $privateEmail = isset($post["privateEmail"]) ? $post['privateEmail'] : null;
       $position = isset($post["position"]) ? $post['position'] : null;
       $cardNumber = isset($post["cardNumber"]) ? $post['cardNumber'] : null;
       $date = isset($post["date"]) ? $post['date'] : null;
       $workEmail = $firstName . $lastName . "@company.com";
       $children = isset($post['children']) ? $post['children']:null;
       $workTime = isset($post['workTime']) ? $post['workTime']:null;
       $person = new self(null,$firstName,$lastName,$telNumber,$privateEmail,$position,$cardNumber,$date,$workEmail,$workTime,$children);

       return $person;
    }


//get first name
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getFullName(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

//get last name
    public function getLastName()
    {
        return $this->lastName;
    }

//get telephone number
    public function getTelNumber()
    {
        return $this->telNumber;
    }

//get private email
    public function getPrivateEmail()
    {
        return $this->privateEmail;
    }

// get position
    public function getPosition()
    {
        return $this->position;
    }

//get card number
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

// get date a entry to job
    public function getDate()
    {
        return $this->date;
    }

// get work email
    public function getWorkEmail()
    {
        return $this->workEmail;
    }
// get work time for month
    public function getWorkTime(){
        return $this->workTime;
    }
    // get children on taxis
    public function getChildren(){
        return $this->children;
    }

    public function __construct($idPerson,$firstName,$lastName,$telNumber,$privateEmail,$position,$cardNumber,$date,$workEmail,$workTime,$childs){
        $this->idPerson = $idPerson;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->telNumber = $telNumber;
        $this->privateEmail = $privateEmail;
        $this->position = $position;
        $this->cardNumber = $cardNumber;
        $this->date = $date;
        $this->workEmail= $workEmail;
        $this->workTime =$workTime;
        $this->children    =$childs;

    }

    public function setIdPerson(int $id){
        $this->idPerson= $id;
    }
// delete SQL -> lookPerson button
    public function delete(){
        Db::query('DELETE from person where idPerson=?',$this->idPerson);
    }
//insert SQL to Database
    public function insert(){
        Db::query('INSERT INTO person (firstName,lastName,telNumber,privateEmail,position,cardNumber,date,workEmail,workTime,childs)
            values (?,?,?,?,?,?,?,?,?,?)'
            ,$this->firstName,$this->lastName,$this->telNumber,$this->privateEmail,$this->position,$this->cardNumber,$this->date,$this->workEmail,$this->workTime,$this->children);
    }


// update SQL Person -> lookPerson in Database
    public function update(){
        Db::query('update  person set  firstName = ?,lastName = ?,telNumber = ?,privateEmail = ?,position = ?,cardNumber =? ,date =? ,workEmail =? ,workTime = ? ,childs = ? 
           where idPerson =?'
            ,$this->firstName,$this->lastName,$this->telNumber,$this->privateEmail,$this->position,$this->cardNumber,$this->date,$this->workEmail,$this->workTime,$this->children,$this->idPerson);
    }
// select person as per idPerson
    public static function find(int  $id): self
    {
       $data = Db::queryOne('SELECT * FROM person WHERE idPerson =?', $id);

       return new self($data['idPerson'],$data["firstName"],$data['lastName'],$data['telNumber'],$data['privateEmail'],$data['position'],$data['cardNumber'],$data['date'],$data['workEmail'],$data['workTime'],$data['childs']);
    }

    // position wage
    public function positionRating(){
        switch ($this->position){
            case self::CEO:
                return $this->workTime*$this->Bmoney*1.7;
            case self::WORKER:
                return $this->workTime*$this->Bmoney*1.2;
            case self::MANAGER:
                return $this->workTime*$this->Bmoney*1.6;
            case self::ANALITIK:
                return $this->workTime*$this->Bmoney*1.9;
            case self::PROGRAMER:
                return $this->workTime*$this->Bmoney*2;
            case self::DRIVER:
                return $this->workTime*$this->Bmoney*1.3;

        }
    }
}
