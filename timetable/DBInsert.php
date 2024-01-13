<?php
//Создайте класс на добавление информации.
class DBInsert
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function insertSubject($subjectName, $day, $classroom)
    {
        $sql = "INSERT INTO subjects (subject_name, schedule_day, classroom)
                VALUES ('{$subjectName}', '{$day}', '{$classroom}')";

        $this->connection->exec($sql);
    }

    public function insertTeacher($fullName, $subjectId, $weeklyHours, $studentsCount)
    {
        $sql = "INSERT INTO teachers (full_name, subject_id, weekly_hours, students_count)
                VALUES ('{$fullName}', {$subjectId}, {$weeklyHours}, {$studentsCount})";

        $this->connection->exec($sql);
    }
    // Добавьте остальные методы для вставки данных
}

