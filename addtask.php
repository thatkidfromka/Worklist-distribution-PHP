<?php
header('CPEE-CALLBACK: true');
header('content-type: application/json');

$result = json_encode(getallheaders(),JSON_PRETTY_PRINT);
echo $result;
fopen("tasklist.json","w+");
file_put_contents("tasklist.json",json_encode(getallheaders()));
fclose("tasklist.json");

$task = file_get_contents('https://cpee.org//flow//engine//3015//callbacks//34b4fa314871c7d40245b6003fc5bc05//');
$arr = explode(",",$task);

#used some brutal coding to get the label of the task. The gentle way with $arr['label'] was not possible.

$this_task;

$task_now = explode(":",$arr[3]);
$net_task_now = str_replace('"','',$task_now[1]);


# assign tasks to different roles and save them as seperate tasklists
if($net_task_now =="check car registration}"){
    $this_task = json_encode("check car registration}");
    fopen("tasklist_app.json","w+");
    file_put_contents("tasklist_app.json",$this_task);
    fclose("tasklist_app.json");
}
if($net_task_now =="bring car to service}"){
    $this_task = json_encode("bring car to service}");
    fopen("tasklist_car.json","w+");
    file_put_contents("tasklist_car.json",$this_task);
    fclose("tasklist_car.json");
}
if($net_task_now =="repair car}"){
    $this_task = json_encode("repair car}");
    fopen("tasklist_mechanic.json","w+");
    file_put_contents("tasklist_mechanic.json",$this_task);
    fclose("tasklist_mechanic.json");
}

$va = $_POST["result"];
$json = json_encode($va);
echo $json;
?>

