<?php 
namespace App\model;

require __DIR__ . '../../../vendor/autoload.php';

use App\Entity\People;

use App\core\Connection;
use PDOException;

class PeopleModel
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new Connection();
    }

    public function create(People $people)
    {
        try {
            $sql = "INSERT INTO people (nome,email,age,salary,convenio,loan) VALUE (:nome, :email, :age, :salary, :convenio, :loan)";
            $params = [
                ":nome" => $people->getName(),
                ":email" => $people->getEmail(),
                ":age" => $people->getAge(),
                ":salary" => $people->getSalary(),
                ":convenio" => $people->getConvenio(),
                ":loan" => $people->getLoan(),
            ];

             $this->pdo->ExecuteNonQuery($sql, $params);
        } catch (\Throwable $th) {
            echo "Erro" . $th->getMessage();
        }
    }
    public function update(People $people)
    {
        try {
            $sql = "UPDATE people SET nome = :nome, email = :email, age = :age, salary = :salary, convenio = :convenio, loan = :loan WHERE id = :id";
            $params = [
                ":id"     => $people->getId(),
                ":nome"   => $people->getName(),
                ":email"  => $people->getEmail(),
                ":age"   => $people->getAge(),
                ":salary" => $people->getSalary(),
                ":convenio" => $people->getConvenio(),
                ":loan" => $people->getLoan(),
            ];

            return $this->pdo->ExecuteNonQuery($sql, $params);
        } catch (PDOException $ex) {
            echo "ERRO: {$ex->getMessage()}";
            return false;
        }
    }

    public function getAll()
    {
        try {
            $sql = "SELECT id, nome, email, age, salary, convenio, loan FROM user ORDER BY nome ASC";
            $results = $this->pdo->ExecuteQuery($sql);

            $list= [];

            foreach($results as $result){
                $list[] = new People(
                    $result["id"],
                    $result["nome"],
                    $result["email"],
                    $result["age"],
                    $result["salary"],
                    $result["convenio"],
                    $result["loan"],
                );
            }
            return $list;
        } catch (\Throwable $ex) {
            echo "ERRO: {$ex->getMessage()}";
            return false;
        }
    }

    public function getById(int $peopleId)
    {
        try {

            $sql = "SELECT nome, email, age, salary, convenio, loan FROM user WHERE id = :id ORDER BY nome ASC";
            $param = ["id" => $peopleId];
            $result = $this->pdo->ExecuteQueryOneRow($sql, $param);
                return new People(
                    $peopleId,
                    $result["nome"],
                    $result["email"],
                    $result["age"],
                    $result["salary"],
                    $result["convenio"],
                    $result["loan"]
             );

        } catch (\Throwable $ex) {
            echo "ERRO: {$ex->getMessage()}";
            return false;
        }
    }
    
      public function delete(int $peopleId){
        try{
          $sql = "DELETE FROM user WHERE id = :id";
          $param = [":id" => $peopleId];
    
          return $this->pdo->ExecuteNonQuery($sql, $param);
        }catch(PDOException $ex){
          echo "ERRO: {$ex->getMessage()}";
          return false;
        }
      }
}
?>