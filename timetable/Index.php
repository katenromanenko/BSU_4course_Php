<?php
// Подключение к базе данных
$dsn = 'mysql:host=localhost;dbname=university';
$username = 'root';
$password = '';

// Создание экземпляра класса для подключения
require_once 'DBConnection.php';
$dbConnection = new DBConnection($dsn, $username, $password);
$pdo = $dbConnection->getConnection();

// Пример использования DBQuery
require_once 'DBQuery.php';
$dbQuery = new DBQuery($pdo);

//***********************************************************************
//Выведите информацию о преподавателях,
// работающих в заданный день недели в заданной аудитории.
//***********************************************************************

// Заданный день недели и аудитория
$dayOfWeek = 'понедельник';
$classroom = 'ауд. 606';

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

//***********************************************************************
//Выведите информацию о преподавателях,
// которые не ведут заня­тия в заданный день недели.
//***********************************************************************

// Заданный день недели
$dayOfWeek = 'понедельник';

// Получение информации о преподавателях, не ведущих занятия в заданный день
$teachersNotTeachingOnDay = $dbQuery->getTeachersNotTeachingOnDay($dayOfWeek);

// Вывод результатов
echo "<h2>Преподаватели, не ведущие занятия в {$dayOfWeek}:</h2>";
echo "<ul>";

foreach ($teachersNotTeachingOnDay as $teacher) {
    echo "<li>{$teacher['full_name']}</li>";
}

echo "</ul>";

//***********************************************************************
//Выведите дни недели, в которых проводится наименьшее количество занятий.
//***********************************************************************

// Получение информации о днях недели с наименьшим количеством занятий
$daysWithMinLessons = $dbQuery->getDaysWithMinLessons();
// Вывод результатов
echo "<h2>Дни недели с наименьшим количеством занятий:</h2>";
echo "<ul>";

foreach ($daysWithMinLessons as $day) {
    echo "<li>{$day['schedule_day']} ({$day['lesson_count']} занятие)</li>";
}

echo "</ul>";

//***********************************************************************
//Выведите дни недели, в которых проводится наименьшее количество занятий.
//***********************************************************************
// Получение информации о днях недели с наименьшим количеством аудиторий
$daysWithMinClassrooms = $dbQuery->getDaysWithMinClassrooms();

// Вывод результатов
echo "<h2>Дни недели с наименьшим количеством аудиторий:</h2>";
echo "<ul>";

foreach ($daysWithMinClassrooms as $day) {
    echo "<li>{$day['schedule_day']} ({$day['classroom_count']} аудитория)</li>";
}

echo "</ul>";
//***********************************************************************
//Выведите дни недели, в которых проводится наименьшее количество занятий.
//***********************************************************************
// Заданные дни недели, для которых нужно перенести первые занятия
$daysToMove = ['понедельник', 'среда'];

// Перенос первых занятий на последнее место
$dbQuery->moveFirstLessonsToLast($daysToMove);

// Вывод сообщения об успешном выполнении
echo "Первые занятия для дней недели " . implode(", ", $daysToMove) . " успешно перенесены на последнее место.";

//***********************************************************************
//Создайте распределенную информационную систему.
// Из пользователей системы обязательно наличие Администратора и Зарегистрированного Пользователя.
//***********************************************************************
// Создание экземпляра класса для работы с пользователями
require_once 'User.php';
$userHandler = new User($pdo);

// Пример регистрации пользователя
$username = 'user1';
$password = 'password123';
$userHandler->registerUser($username, $password);

// Пример входа пользователя
$loginUsername = 'user1';
$loginPassword = 'password123';

$loggedInUser = $userHandler->loginUser($loginUsername, $loginPassword);

if ($loggedInUser) {
    echo "Пользователь успешно вошел в систему. Роль: {$loggedInUser['role']}";
} else {
    echo "Ошибка входа. Проверьте имя пользователя и пароль.";
}
?>


