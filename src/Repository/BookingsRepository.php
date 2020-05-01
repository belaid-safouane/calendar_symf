<?php

namespace App\Repository;

use PDO;
use App\Entity\Bookings;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Bookings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookings[]    findAll()
 * @method Bookings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookings::class);
    }


    
public function findDatebooking()
{
    
    if(isset($_GET['date'])){

    $conn = $this->getEntityManager()->getConnection();
    
    $sql = 'select * from bookings where date = ?';
   
    $stmt = $conn->prepare($sql);

    $bookings = array();

    if($stmt->execute([$_GET['date']]))
    {
        if($stmt->fetchColumn() > 0){
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC))
            { 
                $bookings[] = $row['timeslot'];
            }
            
           // $stmt->close();
        }//echo $bookings;die;
    }
    // returns an array of arrays (i.e. a raw data set)
     //return $stmt->fetchAll();
     return $bookings;
    }
  }


}


/*
public function findTimebook()
    {
        if(isset($_POST['submit'])){
        $conn = $this->getEntityManager()->getConnection();
        $date = $_GET['date'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $timeslot = trim($_POST['timeslot']);
        $sql = 'select * from bookings where date = ? AND timeslot = ?';
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue('ss', $date, $timeslot);
        
        if($stmt->execute()){
            $result = $sql->get_result();
            if($result->num_rows>0){
                $msg = "<div class='alert alert-danger'>Already Booked</div>";
    
            }else{
                $sql = 'INSERT INTO bookings (name, timeslot, email, date) VALUES (?,?,?,?)';
                $stmt = $conn->prepare($sql);
                $stmt->bindValue('ssss', $name, $timeslot, $email, $date);
                $stmt->execute();
                $msg = "<div class='alert alert-success'>Booking Successfull</div>";
                $bookings[] = $timeslot;
                return $stmt->fetchAll();
                
        }
       }
    }
    }


    // /**
    //  * @return Bookings[] Returns an array of Bookings objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bookings
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

