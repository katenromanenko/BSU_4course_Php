<?php
//Создайте класс для выполнения запросов на извлечение информации из БД.
class DBQuery
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
    //***********************************************************************
    //метод, который будет извлекать информацию
    //о преподавателях, работающих в заданный день недели в заданной аудитории
    //***********************************************************************
    public function getTeachersByDayAndClassroom($day, $classroom)
    {
        $sql = "SELECT * FROM teachers
                INNER JOIN subjects ON teachers.subject_id = subjects.subject_id
                WHERE subjects.schedule_day = '{$day}' AND subjects.classroom = '{$classroom}'";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    //***********************************************************************
    //метод, который будет извлекать информацию
    //о преподавателях, которые не ведут заня­тия в заданный день недели
    //***********************************************************************

    public function getTeachersNotTeachingOnDay($day)
    {
        $sql = "SELECT * FROM teachers
                LEFT JOIN subjects ON teachers.subject_id = subjects.subject_id
                WHERE subjects.schedule_day <> '{$day}' OR subjects.subject_id IS NULL";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    //***********************************************************************
    //метод, который будет извлекать информацию
    // о днях недели с наименьшим количеством занятий
    //***********************************************************************
    public function getDaysWithMinLessons()
    {
        $sql = "SELECT schedule_day, COUNT(*) as lesson_count
                FROM subjects
                GROUP BY schedule_day
                ORDER BY lesson_count ASC
                LIMIT 1";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    //***********************************************************************
    //метод, который будет извлекать информацию
    //о днях недели, в которых занято наименьшее количество аудито­рий
    //***********************************************************************
    public function getDaysWithMinClassrooms()
    {
        $sql = "SELECT schedule_day, COUNT(DISTINCT classroom) as classroom_count
                FROM subjects
                GROUP BY schedule_day
                ORDER BY classroom_count ASC
                LIMIT 1";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    //***********************************************************************
    //метод, который будет извлекать информацию
    //о днях недели, в которых занято наименьшее количество аудито­рий
    //***********************************************************************
    public function moveFirstLessonsToLast($daysOfWeek)
    {
        $daysString = implode("','", $daysOfWeek);

        $sql = "UPDATE subjects
                SET lesson_order = lesson_order + (SELECT MAX(lesson_order) FROM subjects) + 1
                WHERE schedule_day IN ('$daysString')
                AND lesson_order = 1";

        $this->connection->exec($sql);
    }

}
