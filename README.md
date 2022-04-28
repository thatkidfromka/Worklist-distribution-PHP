# Worklist-distribution-PHP
This is a Worklist distribution installed on a server. The Worklist assigns tasks to workers, who are responsible for a certain job. 
In the user interface, the employee enters his name and then the availible tasks for him show up. Here is a picture of the User interface: 

<img width="298" alt="Bildschirmfoto 2022-04-28 um 19 22 06" src="https://user-images.githubusercontent.com/93349629/165811340-4bc240fe-f951-4725-927a-36194fa12996.png">
In this case, the worker carlos entered his name and his task is to repair the car. he can now refuse or accept the task. By the way, the process engine(in this case CPEE) sends the tasks to the worklist server. If the worker accepts the service, the process engine receives a message, that the service is done. 
The communication between the process engine and the worklist distribution is done with HTTP-POST. 
The tasks are saved in JSON files on the server. These files are created when the process engine calls addtask.php. The UI reads out the content of the JSON's. 
