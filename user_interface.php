<html>
<body>

<?php

$task = file_get_contents('https://cpee.org//flow//engine//3015//callbacks//34b4fa314871c7d40245b6003fc5bc05//');
$arr = explode(",",$task);

$task_appclerk;
$task_mechanic;
$task_car_owner;
$ur_task;
$this_task;

$task_now = explode(":",$arr[3]);
$net_task_now = str_replace('"','',$task_now[1]);
if($net_task_now =="check car registration}"){
    $task_appclerk = array($net_task_now);
    $this_task = "check car registration}";
}
if($net_task_now =="bring car to service}"){
    $task_car_owner = array($net_task_now);
    $this_task = "bring car to service}";
}
if($net_task_now =="repair car}"){
    $task_mechanic = array($net_task_now);
    $this_task = "repair car}";
}



$xml =simplexml_load_file("https://lehre.bpm.in.tum.de/~ge32ped/exercise04/UI/worklist.xml") or die("Error: Cannot create object");
foreach($xml->subjects->children() as $subject){
    if($_POST["name"]==$subject['id']){
        #we identified the person
        #let's give them their role corresponding tasks
        if($subject->relation['role']=="app clerk"){
            $ur_task = $task_appclerk;
            echo "task for app clerks";
            echo "</br>";  
        }
        if($subject->relation['role']=="mechanic"){
            $ur_task = $task_mechanic;
            echo "task for mechanics"; 
            echo "</br>"; 
        }
        if($subject->relation['role']=="car owner"){
            $ur_task = $task_mechanic;
            echo "task for car owners"; 
            echo "</br>"; 
        }

    }
}

?>

Welcome <?php echo $_POST["name"]; ?><br>
Your tasks are: <?php print_r($ur_task); ?>
<?php $asjson = json_encode($ur_task);?>




<form action="result.php" method="post">
TASK RESULT: <input type="text" name="result"><br>
<input type="submit">
</form>

<?php
        if(array_key_exists('button1', $_POST)) {
            button1();
        }

        function button1() {
            echo "This is Button1 that is selected";
            #here is the round robin...
            foreach($xml->subjects->children() as $subject){
                if($_POST["name"]==$subject['id']){
                    #we identified the person
                    #let's give them their role corresponding tasks
                    if($subject->relation['role']=="app clerk"){
                        $task_mechanic = array($this_task);
                        $key = array_search($task_now,$task_app_clerk);
                        unset($task_app_clerk[$key]); 
                    }
                    if($subject->relation['role']=="mechanic"){
                        $task_car_owner = array($this_task);
                        $key = array_search($task_now,$task_mechanic);
                        unset($task_mechanic[$key]); 
                    }
                    if($subject->relation['role']=="car owner"){
                        $task_app_clerk = array($this_task);
                        $key = array_search($task_now,$task_car_owner);
                        unset($task_car_owner[$key]); 
                    }
            
                }
            }
        }
?>
 <form method="post">
        <input type="submit" name="button1"
                class="button" value="Refuse task" />
          
        
</form>
</body>
</html> 