<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario";

// Conecta ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para gerar o calendário
function build_calendar($month, $year, $conn) {
    $daysOfWeek = array('Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth); 
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    
    $calendar = "<table class='calendar'>";
    $calendar .= "<tr>";
    foreach($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }
    $calendar .= "</tr><tr>";
    
    if ($dayOfWeek > 0) { 
        for ($k=0; $k<$dayOfWeek; $k++) {
            $calendar .= "<td></td>"; 
        }
    }
    
    $currentDay = 1;
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        
        $sql = "SELECT * FROM eventos WHERE data='$date'";
        $result = $conn->query($sql);
        
        $calendar .= "<td class='day' rel='$date'>$currentDay";
        while ($event = $result->fetch_assoc()) {
            $calendar .= "<br><span class='event'>" . $event['titulo'] . "</span>";
        }
        $calendar .= "</td>";
        $currentDay++;
        $dayOfWeek++;
    }
    
    if ($dayOfWeek != 7) { 
        $remainingDays = 7 - $dayOfWeek;
        for ($i=0; $i<$remainingDays; $i++) {
            $calendar .= "<td></td>"; 
        }
    }
    
    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}

$month = date('m');
$year = date('Y');
echo build_calendar($month, $year, $conn);

$conn->close();
?>
