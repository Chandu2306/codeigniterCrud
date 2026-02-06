<?php
defined('BASEPATH') or exit('no direct script access allowed');

class StudentController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('StudentModel', 'stud');
        $this->load->library('session');
    }

        public function index()
    {
        $data['students'] = $this->stud->show();
        $this->load->view('dashboard', $data);
    }


    public function add()
    {
        $this->load->view('addForm');
    }

    public function save()
    {
        $rollNo = $this->input->post('roll_no');
        $checkStudent = $this->stud->getStudentByRollNo($rollNo);
        $contactNo  = $this->input->post('contact');
        $checkContact = $this->stud->getStudentByContact($contactNo);
        if($checkStudent){
            $this->session->set_flashdata('checkRollNo','roll_no not available,try different');
            redirect('StudentController');
        }elseif ($checkContact) {
            $this->session->set_flashdata('checkContact', 'contact already in use, try different');
            redirect('StudentController');
        } else{

        $resumeData = null;
        $resumeName = null;
        $resumeType = null;

        if (!empty($_FILES['resume']['name'])) {
            $resumeName = $_FILES['resume']['name'];
            $resumeType = $_FILES['resume']['type'];
            $resumeData = file_get_contents($_FILES['resume']['tmp_name']);  // BLOB
        }

        $data = array(
            'roll_no'      => $this->input->post('roll_no'),
            'name'         => $this->input->post('name'),
            'contact'      => $this->input->post('contact'),
            'resume'       => $resumeData,
            'resume_name'  => $resumeName,
            'resume_type'  => $resumeType,
        );

        $this->stud->add($data);

        //Set flash message
        $this->session->set_flashdata('success', 'Student added!');
        redirect('StudentController');
        }
        
    }

    public function delete($id)
    {
        $this->stud->delete($id);
        $this->session->set_flashdata('delete', 'student deleted!');
        redirect('StudentController');
    }


    public function updateForm($id)
    {
        $data['student'] = $this->stud->showStudent($id);
        $this->load->view('updateForm', $data);
    }

    public function update()
    {

        $contactNo  = $this->input->post('contact');
        $checkContact = $this->stud->getStudentByContact($contactNo);
        $count = 0;

        if($checkContact){
        $id = $this->input->post('id'); // get id from hidden input

    $data = array(
        'roll_no' => $this->input->post('roll_no'),
        'name'    => $this->input->post('name'),
    );

    $this->stud->update($id, $data);
    $this->session->set_flashdata('updated', 'student updated!contact not changed');

    redirect('StudentController/');
            
        }else{

    $id = $this->input->post('id'); // get id from hidden input

    $data = array(
        'roll_no' => $this->input->post('roll_no'),
        'name'    => $this->input->post('name'),
        'contact' => $this->input->post('contact'),
    );

    $this->stud->update($id, $data);
    $this->session->set_flashdata('update', 'student updated!');

    redirect('StudentController/');
        }
    }

    public function addResume()
    {
        $resumeData = null;
        $resumeName = null;
        $resumeType = null;
        $id =  $this->input->post('id');

        if (!empty($_FILES['resume']['name'])) {
            $resumeName = $_FILES['resume']['name'];
            $resumeType = $_FILES['resume']['type'];
            $resumeData = file_get_contents($_FILES['resume']['tmp_name']);  // BLOB
        }
        $data = array(
            'resume'       => $resumeData,
            'resume_name'  => $resumeName,
            'resume_type'  => $resumeType,
        );

        $this->stud->update($id,$data);
        redirect('StudentController');
    }




    public function aboutUs()
    {
        $this->load->view('aboutUs');
    }

    public function contactUs()
    {
        $this->load->view('contactUs');
    }

    public function saveQuery()
    {
        $data = array(
            'name'    => $this->input->post('name'),
            'email'   => $this->input->post('email'),
            'contact' => $this->input->post('contact'),
            'query'   => $this->input->post('query'),
        );

        $this->stud->contactUs($data);
        $this->session->set_flashdata("query","query submitted");
        redirect('StudentController');
    }


    // EXCEL DOWNLOAD WITH RESUME (HTML TABLE)
    public function downloadExcel()
    {
        ob_clean(); // Remove previous accidental output
        ob_start();

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=students.xls");

        $students = $this->db->get('students')->result();

        echo "<table border='1'>";
        echo "
            <tr>
                <th>Roll No</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Resume</th>
            </tr>
        ";

        foreach ($students as $s) {

            // Force Excel to keep contact number as text
            $contact = "=\"$s->contact\"";

            //  FIXED — create hyperlink, DO NOT load file contents
            $resumeLink = $s->resume
                ? '<a href="' . site_url('StudentController/viewResume/' . $s->id) . '" target="_blank">View Resume</a>'
                : 'No Resume';

            echo "
                <tr>
                    <td>{$s->roll_no}</td>
                    <td>{$s->name}</td>
                    <td>{$contact}</td>
                    <td>{$resumeLink}</td>
                </tr>
            ";
        }

        echo "</table>";

        ob_end_flush(); // send clean output to browser
    }

    // ACTIVE VIEW RESUME METHOD
    public function viewResume($id)
    {
        $this->load->model('StudentModel', 'stud');
        $student = $this->stud->showStudent($id);

        if ($student && $student->resume != null) {
            header("Content-Type: " . $student->resume_type);
            header("Content-Disposition: inline; filename=\"" . $student->resume_name . "\"");
            echo $student->resume; // send file binary
        } else {
            echo "Resume not found.";
        }
    }
    
    public function importCSV()
    {
    if (isset($_FILES['csvfile']['name']))
    {
        $file = fopen($_FILES['csvfile']['tmp_name'], "r");

        // Skip header row
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {
            $roll_no = $row[0];
            $checkStudent = $this->stud->getStudentByRollNo($roll_no);
            if($checkStudent){
                continue;
            }else{

            $data = [
                'roll_no' => $row[0],
                'name'    => $row[1],
                'contact' => $row[2]
            ];
            $this->stud->add($data); // reuse your add() method in StudentModel
            }
        }

        fclose($file);

        $this->session->set_flashdata('success', 'CSV imported successfully!');
        redirect('StudentController');
        }
    }
   // bulk delete
    public function bulkDelete()
{
    $ids = $this->input->post('ids');

    if (!empty($ids)) {
        $this->db->where_in('id', $ids);
        $this->db->delete('students');

        echo "success";
    }
    $this->session->set_flashdata('bulkDelete','selected students deleted');
}

}
?>


