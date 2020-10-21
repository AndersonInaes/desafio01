<?php
namespace App\conrtoller;

use App\Entity\People;
use App\Model\PeopleModel;

class PeopleController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new PeopleModel();
    }

    public function create(People $people)
    {
         if (strlen($people->getName()) < 3 && strlen($people->getName() > 100))
             return false;

         if (empty($people->getEmail()))
             return false;
        
        
        if(empty($people->getAge()))
        return false;

        if(empty($people->getSalary()))
        return false;

        if(empty($people->getConvenio()))
        return false;

        if(empty($people->getLoan()))
        return false;

        $this->userModel->create($people);
        return true;
      }
    
      public function getAll(){
        return $this->userModel->getAll();
      }
    
      public function getById(int $peopleId){
        if($peopleId < 1)
          return null;
    
        return $this->userModel->getbyId($peopleId);
      }
}
?>