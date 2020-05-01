<?php

namespace App\Twig;

use DateInterval;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Détails d'implémentation pour le rendu des tableaux bootstrap
 */
class BootstrapExtensionTableRenderer
{
    /**
     * Classes CSS par défaut pour le tableau
     */
    protected $tableClasses = 'table-hover';

    /**
     * Constructeur
     *
     * @param string $tableClasses Les classes par défaut
     */
    public function __construct(string $tableClasses = 'table-hover')
    {
        $this->tableClasses = $tableClasses;
    }

    /**
     * Permet de rendre une balise <table>
     *
     * @param array $options
     * @return string
     */
    public function renderTableStart(array $options = []): string
    {
        return '<table class="table ' . ($options['classes'] ?? $this->tableClasses) . '">';
    }

    /**
     * Permet de rendre une balise </table>
     *
     * @return string
     */
    public function renderTableEnd(): string
    {
        return '</table>';
    }

    /**
     * Permet de rendre un tableau complet !
     *
     * @param array $data
     * @param array $options
     * @return string
     */
    public function renderTable(array $data, array $options = []): string
    {
        $exampleRow = $data[0];
        $headers = array_keys($exampleRow);

        $tableTemplate = '
            <table class="table ' . ($options['classes'] ?? $this->tableClasses) . '">
                <thead>%s</thead>
                <tbody>%s</tbody>
            </table>
        ';

        return sprintf(
            $tableTemplate,
            $this->renderTableHeader($headers),
            $this->renderTableBody($data)
        );
    }

    /**
     * Permet de rendre le corps du tableau (<tbody>)
     *
     * @param array $data
     * @return string
     */
    public function renderTableBody(array $data): string
    {
        $html = '<tbody>';
        foreach ($data as $dataRow) {
            $row = '<tr>';
            foreach ($dataRow as $text) {
                $row .= "<td>$text</td>";
            }
            $row .= '</tr>';
            $html .= $row;
        }

        $html .= '</tbody>';

        return $html;
    }

    /**
     * Permet de rendre une en-tête de table (<thead>)
     *
     * @param array $headers
     * @return string
     */
    public function renderTableHeader(array $headers): string
    {
        $html = '
            <thead>
                <tr>';

        foreach ($headers as $title) {
            $html .= '<th>' . ucfirst($title) . '</th>';
        }

        $html .= '
                </tr>
            </head>
        ';

        return $html;
    }


function renderTimeslots($duration =10, $cleanup = 0, $start = "09:00", $end = "15:00"){
    $start = new \DateTime($start);
    $end = new \DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M"); 
    $slots = array();

    for($intStart = $start; $intStart < $end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
        break;
        }

        $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
    }
    return $slots;
}
    

    public function renderBuildcalendar($month, $year)
     {
        
        
        
         // Create array containing abbreviations of days of week.
         $daysOfWeek = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
    
         // What is the first day of the month in question?
         $firstDayOfMonth = mktime(0,0,0,$month,1,$year);
    
         // How many days does this month contain?
         $numberDays = date('t',$firstDayOfMonth);
    
         // Retrieve some information about the first day of the
         // month in question.
         $dateComponents = getdate($firstDayOfMonth);
    
         // What is the name of the month in question?
         $monthName = $dateComponents['month'];
    
         // What is the index value (0-6) of the first day of the
         // month in question.
         $dayOfWeek = $dateComponents['wday'];
         if($dayOfWeek==0){
             $dayOfWeek = 6;
         }else{
             $dayOfWeek = $dayOfWeek-1;
         }
         // Create the table tag opener and day headers
         
        $datetoday = date('Y-m-d');
        
        
        
        $calendar = "<table class='table table-bordered'>";
        $calendar .= "<center><h2>$monthName $year</h2>";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
        
        $calendar.= " <a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
        
        $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
        
        
            
          $calendar .= "<tr>";
    
         // Create the calendar headers
    
         foreach($daysOfWeek as $day) {
              $calendar .= "<th  class='header'>$day</th>";
         } 
    
         // Create the rest of the calendar
    
         // Initiate the day counter, starting with the 1st.
    
         $currentDay = 1;
    
         $calendar .= "</tr><tr>";
    
         // The variable $dayOfWeek is used to
         // ensure that the calendar
         // display consists of exactly 7 columns.
    
         if ($dayOfWeek > 0) { 
             for($k=0;$k<$dayOfWeek;$k++){
                    $calendar .= "<td  class='empty'></td>"; 
    
             }
         }
        
         
         $month = str_pad($month, 2, "0", STR_PAD_LEFT);
      
         while ($currentDay <= $numberDays) {
    
              // Seventh column (Saturday) reached. Start a new row.
    
              if ($dayOfWeek == 7) {
    
                   $dayOfWeek = 0;
                   $calendar .= "</tr><tr>";
    
              }
              
              $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
              $date = "$year-$month-$currentDayRel";
              
                $dayname = strtolower(date('l', strtotime($date)));
                $eventNum = 0;
                $today = $date==date('Y-m-d')? "today" : "";
                if($dayname == 'saturday' || $dayname == 'sunday'){
                    $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Already Booked</button>";
               }
             elseif($date<date('Y-m-d')){
                 $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
             }/* elseif(in_array($date, $bookings)){
                 $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Already Booked</button>";
             } */else{
                 $path = 
                $calendar.="<td class='$today'><h4>$currentDay</h4>
                 <a href='/bookings?date=".$date."' class='btn btn-success btn-xs'>Book</a>";

             }
                
                
             
                
              $calendar .="</td>";
              // Increment counters
     
              $currentDay++;
              $dayOfWeek++;
    
         }
         
         
    
         // Complete the row of the last week in month, if necessary
    
         if ($dayOfWeek != 7) { 
         
              $remainingDays = 7 - $dayOfWeek;
                for($l=0;$l<$remainingDays;$l++){
                    $calendar .= "<td class='empty'></td>"; 
    
             }
    
         }
         
         $calendar .= "</tr>";
    
         $calendar .= "</table>";
    
         echo $calendar;
    
    }

    


}
