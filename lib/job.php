<?php 

class Job {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // Get All Jobs
    public function getAllJobs(){
        $this->db->query("SELECT jobs.*, categories.name AS cname 
        FROM jobs 
        INNER JOIN categories 
        ON jobs.category_id = categories.id
        ORDER BY post_date DESC
        ");

        // Assign Result Set
        $results = $this->db->resultSet();
        return $results;
    }

    // Get Categories

    public function getCategories(){
        $this->db->query("SELECT * FROM categories");
      // Assign Result set
        $results = $this->db->resultSet();
        return $results;
    }

    // Get Jobs By Category
    public function getByCategory($category){
        $this->db->query("SELECT jobs.*, categories.name AS cname 
        FROM jobs 
        INNER JOIN categories 
        ON jobs.category_id = categories.id
        WHERE jobs.category_id = $category
        ORDER BY post_date DESC
        ");

        // Assign Result Set
        $results = $this->db->resultSet();
        return $results;

    }


    // Get Category Name
    public function getCategory($category_id){
       $this->db->query("SELECT * FROM categories WHERE id = :category_id");

       $this->db->bind(':category_id',$category_id, PDO::PARAM_STR);

       // Assign row
       $row = $this->db->single();
       return $row;
    }

    // Get Single Job Detail

    public function getJob($id){
        $this->db->query("SELECT * FROM jobs WHERE id = :id");

        $this->db->bind(':id',$id, PDO::PARAM_STR);
 
        // Assign row
        $row = $this->db->single();
        return $row;
    }



    public function create($data){
        // insert Query

        $this->db->query("INSERT INTO jobs (category_id,
           job_title,company,description,location,
           salary,contact_user,contact_email)
           VALUES (:category_id,
           :job_title,:company,:description,:location,
           :salary,:contact_user,:contact_email)");

           // Bind Data

           $this->db->bind(':category_id',$data['category_id'], PDO::PARAM_STR);
           $this->db->bind(':job_title',$data['job_title'], PDO::PARAM_STR);
           $this->db->bind(':company',$data['company'], PDO::PARAM_STR);
           $this->db->bind(':description',$data['description'], PDO::PARAM_STR);
           $this->db->bind(':location',$data['location'], PDO::PARAM_STR);
           $this->db->bind(':salary',$data['salary'], PDO::PARAM_STR);
           $this->db->bind(':contact_user',$data['contact_user'], PDO::PARAM_STR);
           $this->db->bind(':contact_email',$data['contact_email'], PDO::PARAM_STR);

           // Execute

           if($this->db->execute()){
               return true;
           } else {
               return false;
           }
    }

    public function delete($id){
        $this->db->query("DELETE FROM jobs WHERE id = $id");

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    //Update
    public function update($id,$data){
        // update Query

        $this->db->query("UPDATE jobs
        SET 
        category_id = :category_id,
        job_title = :job_title,
        company = :company,
        description = :description,
        location = :location,
        salary = :salary,
        contact_user = :contact_user,
        contact_email = :contact_email 
        WHERE id = $id");

           // Bind Data

           $this->db->bind(':category_id',$data['category_id'], PDO::PARAM_STR);
           $this->db->bind(':job_title',$data['job_title'], PDO::PARAM_STR);
           $this->db->bind(':company',$data['company'], PDO::PARAM_STR);
           $this->db->bind(':description',$data['description'], PDO::PARAM_STR);
           $this->db->bind(':location',$data['location'], PDO::PARAM_STR);
           $this->db->bind(':salary',$data['salary'], PDO::PARAM_STR);
           $this->db->bind(':contact_user',$data['contact_user'], PDO::PARAM_STR);
           $this->db->bind(':contact_email',$data['contact_email'], PDO::PARAM_STR);

           // Execute

           if($this->db->execute()){
               return true;
           } else {
               return false;
           }
    }

}




?>