<?php
    
    class Schedule{
        private $database;

        public function __construct(){
            $this->database = new Database;
        }

        public function getSchedules(){
            $this->database->query("SELECT *,
                                    schedules.id as scheduleId,
                                    users.id as userId,
                                    schedules.created as scheduleCreated,
                                    users.created as userCreated
                                    FROM schedules
                                    INNER JOIN users
                                    ON schedules.user_id = users.id
                                    ORDER BY schedules.created DESC
                                    ");

            return $this->database->resultSet();
        }


        public function addSchedule($data){
            $this->database->query("INSERT INTO schedules (title, user_id, body) VALUE(:title,:user_id, :body) ");
            $this->database->bind(':title', $data['title']);
            $this->database->bind(':user_id', $data['user_id']);
            $this->database->bind(':body', $data['body']);
            //Execute
            if($this->database->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getScheduleById($id){
            $this->database->query('SELECT*FROM schedules WHERE id = :id');
            $this->database->bind(':id', $id);

            $row = $this->database->single();

            return $row;
        }

        public function editSchedule($data){
            $this->database->query('UPDATE schedules SET title = :title, body = :body WHERE id = :id');
            // Bind values
            $this->database->bind(':id', $data['id']);
            $this->database->bind(':title', $data['title']);
            $this->database->bind(':body', $data['body']);
            $this->database->bind(':approved', $data['approved']);
            //Execute
            if($this->database->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function deleteSchedule($id){
            $this->database->query('DELETE FROM schedules WHERE id = :id');
            // Bind values
            $this->database->bind(':id', $id);
      
            // Execute
            if($this->database->execute()){
              return true;
            } else {
              return false;
            }
          }

    }