<?php


namespace App\Entity;

class People
{
    private $id;
    private $name;
    private $email;
    private $age;
    private $convenio;
    private $salary;
    private $loan;

    public function __construct($id = 0, $name = '', $email = '', $age = '', $convenio = '', $salary = '', $loan = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->convenio = $convenio;
        $this->salary = $salary;
        $this->loan = $loan;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setEmail(string $email)
    {
        $this->email = strtolower($email);
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    public function setConvenio($convenio)
    {
        $this->convenio = $convenio;
    }
    public function setSalary(string $salary)
    {
        $this->salary = $salary;
    }
    public function setLoan($loan)
    {
        $this->loan = $loan;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function getConvenio()
    {
        return $this->convenio;
    }
    public function getSalary()
    {
       return $this->salary;
    }
    public function getLoan()
    {
        return $this->loan;
    }
}
?>