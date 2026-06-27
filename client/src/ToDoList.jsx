import React, {useState, useEffect} from "react";

function ToDoList(){

    const [tasks, setTasks] = useState([]);
    const [newTask, setNewTask] = useState("");

    async function loadTasks(){
        const response = await fetch("http://localhost/to-do-list/server/getTasks.php");

        const data = await response.json();
        console.log(data);

        setTasks(data);
    }
    useEffect(() => {
        loadTasks();
    }, []);
    function handleInputChange(event){
        setNewTask(event.target.value);
    }
    async function addTask(){
        if(newTask.trim() === ""){
            return;
        }

        const formData = new FormData();
        formData.append("task", newTask);

        const response = await fetch("http://localhost/to-do-list/server/addTask.php",
            {
                method: "POST",
                body: formData
            }
        );

        const message = await response.text();
        console.log(message);

        setNewTask("");

        await loadTasks();
    }
    function deleteTask(index){
        const updatedTasks = tasks.filter((_, i) => i !== index);
        setTasks(updatedTasks);
    }
    function toggleComplete(index){
        const updatedTasks = [...tasks];
        updatedTasks[index].completed = !updatedTasks[index].completed;
        setTasks(updatedTasks);
    }
    function moveTaskUp(index){
        if(index > 0){
            const updatedTasks = [...tasks];
            [updatedTasks[index], updatedTasks[index - 1]] = 
            [updatedTasks[index - 1], updatedTasks[index]];
            setTasks(updatedTasks);
        }
    }
    function moveTaskDown(index){
        if(index < tasks.length - 1){
            const updatedTasks = [...tasks];
            [updatedTasks[index], updatedTasks[index + 1]] = 
            [updatedTasks[index + 1], updatedTasks[index]];
            setTasks(updatedTasks);
        }
    }

    return(
        <div className="to-do-list">
            <h1>To-Do List</h1>
            <div>
                <input type="text" 
                        placeholder="Enter a task..."
                        value={newTask}
                        onChange={handleInputChange}/>
                <button className="add-button" onClick={addTask}>
                Add Task
                </button>
            </div>
            <ol>
                {tasks.map((task, index) => 
                <li key={index}>
                    <span 
                        className={`text ${task.completed ? "completed" : ""}`}
                        onClick={() => toggleComplete(index)}>
                        {task.task}
                    </span>
                    <button className="delete-button" onClick={() => deleteTask(index)}>❌</button>
                    <button className="move-button" onClick={() => moveTaskUp(index)}>🔼</button>
                    <button className="move-button" onClick={() =>   moveTaskDown(index)}>🔽</button>
                </li>)}
            </ol>
        </div>
    );
}
export default ToDoList