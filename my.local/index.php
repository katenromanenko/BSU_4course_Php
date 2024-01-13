<?php
//Организацию соединения с базой данных вынести в отдельный класс,
// метод которого возвращает соединение.


//Создайте класс для выполнения запросов на
// извлечение информации из БД.
class DBQuery
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getTeachersByDayAndClassroom($day, $classroom)
    {
        $sql = "SELECT * FROM teachers
                INNER JOIN subjects ON teachers.subject_id = subjects.subject_id
                WHERE subjects.schedule_day = '{$day}' AND subjects.classroom = '{$classroom}'";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeachersNotTeachingOnDay($day)
    {
        $sql = "SELECT teachers.full_name
                FROM teachers
                LEFT JOIN subjects ON teachers.subject_id = subjects.subject_id
                WHERE subjects.schedule_day <> '{$day}' OR subjects.subject_id IS NULL";

        $result = $this->connection->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Добавьте остальные методы для выполнения остальных запросов
}

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

// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=university';
$username = 'root';
$password = '';
$pdo = new PDO($dsn, $username, $password);



//***************************************************************************************************
//1.Выведите информацию о преподавателях,
// работающих в заданный день недели в заданной аудитории.

// Создание экземпляра класса для выполнения запросов
$dbQuery = new DBQuery($pdo);

// Заданный день недели и аудитория
$dayOfWeek = 'понедельник';
$classroom = '809';

// Получение информации о преподавателях
$teachersInClassroom = $dbQuery->getTeachersByDayAndClassroom($dayOfWeek, $classroom);

// Вывод результатов
echo "<h2>Преподаватели, работающие в {$classroom} в {$dayOfWeek}:</h2>";
echo "<table border='1'>";
echo "<tr><th>Преподаватель</th><th>Предмет</th><th>День недели</th><th>Аудитория</th></tr>";

foreach ($teachersInClassroom as $teacher) {
    echo "<tr>";
    echo "<td>{$teacher['full_name']}</td>";
    echo "<td>{$teacher['subject_name']}</td>";
    echo "<td>{$teacher['schedule_day']}</td>";
    echo "<td>{$teacher['classroom']}</td>";
    echo "</tr>";
}

echo "</table>";
//********************************************************************************************



//2.Выведите информацию о преподавателях,
// которые не ведут заня­тия в заданный день недели.

// Создание экземпляра класса для выполнения запросов
$dbQuery = new DBQuery($pdo);

// Заданный день недели и аудитория
$dayOfWeek = 'вторник';

// Получение информации о преподавателях, не ведущих занятия в заданный день
$teachersNotTeachingOnDay = $dbQuery->getTeachersNotTeachingOnDay($dayOfWeek);

// Вывод результатов
echo "<h2>Преподаватели, не ведущие занятия в {$dayOfWeek}:</h2>";
echo "<ul>";

foreach ($teachersNotTeachingOnDay as $teacher) {
    echo "<li>{$teacher['full_name']}</li>";
}

echo "</ul>";
//********************************************************************************************



//3.Выведите дни недели, в которых проводится
// наименьшее количество занятий.
//********************************************************************************************



//4.Вывести дни недели,
// в которых занято наименьшее количество аудито­рий.
//********************************************************************************************


//5.Перенесите первые занятия заданных
// дней недели на последнее ме­сто.
//********************************************************************************************
?>