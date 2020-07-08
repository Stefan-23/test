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
                    'id' => $id,
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
                        flash('post_message' , 'Schedule booked');
                        redirect('schedules');
                    }
                }else{
                    $this->view('schedules/add', $data);
                }
            }
            $url = urldecode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
            $urlarray=explode("/",$url);
            $end=$urlarray[count($urlarray)-1];
            $end=urldecode($end);

            $data=[
                'url' => $end,
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
        public function calendar(){
            // Set your timezone
            date_default_timezone_set('Europe/Belgrade');
            //date_default_timezone_set();

            // Get prev & next month
            if (isset($_GET['ym'])) {
                $ym = $_GET['ym'];
            } else {
            // This month
            $ym = date('Y-m');
        }

            // Check format
        $timestamp = strtotime($ym . '-01');
            if ($timestamp === false) {
                $ym = date('Y-m');
                $timestamp = strtotime($ym . '-01');
            }

            // Today
        $today = date('Y-m-j', time());

            // For H3 title
        $html_title = date('m / Y', $timestamp);

        // Create prev & next month link     mktime(hour,minute,second,month,day,year)
        $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
        $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
        // You can also use strtotime!
        // $prev = date('Y-m', strtotime('-1 month', $timestamp));
        // $next = date('Y-m', strtotime('+1 month', $timestamp));

        // Number of days in the month
        $day_count = date('t', $timestamp);
 
        // 0:Sun 1:Mon 2:Tue ...
        $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
        //$str = date('w', $timestamp);


        // Create Calendar!!
        $weeks = array();
        $week = '';

        // Add empty cell
        $week .= str_repeat('<td></td>', $str);

        for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
            $date = $ym . '-' . $day;
            
        if ($today == $date) {
            $week .=  '<td class="today"><a class="btn" href="add/' . $ym . '-'.$day .'"</a>' . $day;
        } else {
            $week .= '<td><a class="btn" href="add/' . $ym . '-'.$day .'"</a>' . $day;
           
        }
        $week .= '</a></td>';
     
        // End of the week OR End of the month
        if ($str % 7 == 6 || $day == $day_count) {

            if ($day == $day_count) {
                // Add empty cell
                $week .= str_repeat('<td></td>', 6 - ($str % 7));
            }

        $weeks[] = '<tr>' . $week . '</tr>';
       

        // Prepare for new week
        $week = '';
            }

        }

        $data = [
            'day' => $day,
            'ym' => $ym,
            'prev' => $prev,
            'next' => $next,
            'weeks' => $weeks,
            'html_title' => $html_title
        ];

        $this->view('schedules/calendar',$data);
    }
      

      

}