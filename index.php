<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Julius Caesar</title>
    <style type="text/css">
      @import "media/css/demo_page.css";
      @import "media/css/demo_table.css";
    </style>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script class="jsbin" src="http://datatables.net/download/build/jquery.dataTables.nightly.js"></script>
	<script>
	$(document).ready(function() {
    $('#example').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );
} );
	</script>	
</head>
<body id="dt_example">
<?php
include 'test1.php';

$data = new SimpleXMLElement($xmlstr);
foreach ($data->ACT as $act) {
    foreach ($act->SCENE as $scene) {
        foreach ($scene->SPEECH as $speech) {
            $rolearr[]=$speech->SPEAKER;
            $rolearr1[]=$speech->SPEAKER->asXML();
        }
    }
}
$rolearr2 = array_keys(array_flip($rolearr1));
$totalscenes = 0;
foreach ($rolearr2 as $rolearrelem) {
     $rolenumlines[$rolearrelem] = 0;
     $rolenumlines1[$rolearrelem] = 0;
     $longestspeech[$rolearrelem] = "";
     $longestspeechlen[$rolearrelem] = 0;
     $numberofscenes[$rolearrelem] = 0;
}

foreach ($data->ACT as $act) {
    foreach ($act->SCENE as $scene) {
        foreach ($scene->SPEECH as $speech) {
	    $speaker = $speech->SPEAKER->asXML();
            $k=0;
            $line1="";
            $numberofscenes[$speaker]++;
            $totalscenes++;
            foreach ($speech->LINE as $line) {
                $k++;
                $rolenumlines1[$speaker]++;
                $line1 = $line1 . " " . $line->asXML();
            }
            $string_length  = strlen($line1);
            if ($string_length > $longestspeechlen[$speaker] ) {
                $longestspeechlen[$speaker] = $string_length;
                $longestspeech[$speaker] = $line1;
                $rolenumlines[$speaker] = $rolenumlines[$speaker] + $k;
            }           
        }
    }
} 
sort($rolearr2);
?>

<div id="container">
      <h1>Julius Caesar</h1>

      <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
        <thead>
          <tr>
            <th>Role</th>
            <th>Number of Lines</th>
            <th>Number of Scenes</th>
            <th>Percent of Scenes</th>
            <th>Longest Speech</th>
          </tr>
        </thead>
        <tbody>

<?php 
    foreach ($rolearr2 as $speaker)  
    { 
        $percentscenes = ($numberofscenes[$speaker] / $totalscenes ) * 100.0;
        echo '<tr class="'.$speaker.'">';
        echo '<td>' . $speaker . '</td>';
        echo '<td>' . $rolenumlines1[$speaker] . '</td>';
        echo '<td>' . $numberofscenes[$speaker] . '</td>';
        echo '<td>' . number_format($percentscenes, 2, '.', '') . '</td>';
        echo '<td>' . $longestspeech[$speaker] . '</td>';
        echo '</tr>';
    }
?>
</tbody>
</table>
</div>

</body>
</html>