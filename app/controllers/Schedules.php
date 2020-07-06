<?php

    class Schedules extends Controller{
        public function __construct(){
            //Checks if user is logged in
            if(!isLoggedIn()){
                redirect('users/login');
              }
            //calling models 
            $this->scheduleModel = $this->model('Schedule');
            $this->userModel = $this->model('User');
        }

        //index function
        public function index(){

            $schedules = $this->scheduleModel->getSchedules();

            $data=[
                'title' => 'Calendar',
                'schedules' => $schedules,
            ];

            $this->view('schedules/index', $data);
        }
        //add function
        public function add(){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $schedule = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data=[

                    'title'=> trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'err_title' => '',
                    'err_body' => '',
                ];

                //Validate data
                if(empty($data['title'])){
                    $data['err_title'] = 'Please enter title';
                }
                if(empty($data['body'])){
                    $data['err_body'] = 'Please enter body text';
                }
                //No errors
                if(empty($data['err_title']) && empty($data['err_body'])){
                    if($this->scheduleModel->addSchedule($data)){
                        flash('post_message' , 'Schedule is Pending');
                        redirect('schedules');
                    }
                }else{
                    $this->view('schedules/add', $data);
                }
            }

            $data=[

                'schedules' => '',
                'title'=> '',
                'body' => '',
            ];

            $this->view('schedules/add', $data);
        }

        //Takes id param to know which schedule
        public function edit($id){
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $schedule = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                $data=[
                    'id' => $id,
                    'title'=> trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'approved'=> trim($_POST['approved']),
                    'err_title' => '',
                    'err_body' => '',
                    'err_approved' => ''
                ];
                //Validate data
                if(empty($data['title'])){
                    $data['err_title'] = 'Please enter title';
                }
                if(empty($data['body'])){
                    $data['err_body'] = 'Please enter body text';
                }
                //No errors
                if(empty($data['err_title']) && empty($data['err_body'])){
                    if($this->scheduleModel->editSchedule($data)){
                        flash('post_message' , 'Schedule Edited');
                        redirect('schedules');
                    }
                }else{
                    $this->view('schedules/edit', $data);
                }
            }else{
            //Get model methtod
            $schedule = $this->scheduleModel->getScheduleById($id);
        
            $data = [
                'id' => $id,
                'title' => $schedule->title,
                'body' => $schedule->body,
                'approved' => $schedule->approved
            ];
            $this->view('schedule/edit', $data);
        }
    }

        
        //show fucntion
        public function show($id){
            $schedule = $this->scheduleModel->getScheduleById($id);
            $user = $this->userModel->getUserById($schedule->user_id);
            $data = [
                'schedule' => $schedule,
                'user' => $user,
            ];
            $this->view('schedule/show', $data);
        }

        //delete function
        public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get existing schedule from model
          $schedule = $this->scheduleModel->getScheduleById($id);
          if($this->scheduleModel->deleteSchedule($id)){
            flash('post_message', 'Schedule Removed');
            redirect('schedules');
          } else {
            die('Something went wrong');
          }
        } else {
          redirect('schedules');
        }
      }

      

      

    }