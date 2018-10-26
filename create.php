<?php  include_once 'config/init.php'; ?>


<?php 
$job = new Job;

if(isset($_POST['submit'])){
    $data = array();
    $data['company'] = $_POST['company'];
    $data['job_title'] = $_POST['job_title'];
    $data['category_id'] = $_POST['category'];
    $data['description'] = $_POST['description'];
    $data['salary'] = $_POST['salary'];
    $data['contact_email'] = $_POST['contact_email'];
    $data['contact_user'] = $_POST['contact_user'];
    $data['location'] = $_POST['location'];

    if($job->create($data)){
        redirect('index.php','Your Job has been listed','success');
    } else {
        redirect('index.php','Something Went Wrong','error');

    }
}

$template = new Template('templates/job-create.php');

$template->categories = $job->getCategories();

echo $template;

?>