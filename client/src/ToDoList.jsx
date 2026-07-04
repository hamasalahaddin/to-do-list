import React, {useState, useEffect} from "react";

function ToDoList(){

    const [tasks, setTasks] = useState([]);
    const [newTask, setNewTask] = useState("");
    const [editingId, setEditingId] = useState(null);
    const [editedTask, setEditedTask] = useState("");

    async function loadTasks(){
        const response = await fetch("http://localhost/to-do-list/server/getTasks.php",
            {
                credentials: "include"    
            }
        );

        const data = await response.json();
        console.log(data);

        setTasks(data.data);
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
                body: formData,
                credentials: "include"
            }
        );

        const data = await response.json();
        console.log(data);

        setNewTask("");

        await loadTasks();
    }
    async function deleteTask(id){
        const formData = new FormData();
        formData.append("id", id);

        const response = await fetch("http://localhost/to-do-list/server/deleteTask.php",
            {
                method: "POST",
                body: formData,
                credentials: "include"
            }
        );

        const data = await response.json();
        console.log(data);

        await loadTasks();
    }
    async function toggleComplete(id, completed){
        const formData = new FormData();
        formData.append("id", id);
        formData.append("completed", Number(completed) ? 0 : 1);

        const response = await fetch("http://localhost/to-do-list/server/toggleComplete.php",
            {
                method: "POST",
                body: formData,
                credentials: "include"
            }
        );

        const data = await response.json();
        console.log(data);

        await loadTasks();
    }
    function startEditing(task){
        setEditingId(task.id);
        setEditedTask(task.task);
    }
    function cancelEditing(){
        setEditingId(null);
        setEditedTask("");
    }
    async function saveTask(id){
        if(editedTask.trim() === ""){
            return;
        }

        const formData = new FormData();
        formData.append("id", id);
        formData.append("task", editedTask);

        const response = await fetch("http://localhost/to-do-list/server/updateTask.php",
            {
                method: "POST",
                body: formData,
                credentials: "include"
            }
        );

        const data = await response.json();
        console.log(data);

        await loadTasks();

        setEditingId(null);
        setEditedTask("");
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
                <input type="text" className="todo-input" 
                        placeholder="Enter a task..." value={newTask}
                        onChange={handleInputChange}/>
                <button className="add-button" onClick={addTask}>
                Add Task
                </button>
            </div>
            <ol>
                {tasks.map((task, index) => 
                <li key={task.id}>
                    {editingId === task.id ? (
                        <input
                            type="text" className="edit-input" value={editedTask}
                            onChange={(e) => setEditedTask(e.target.value)}
                        />
                    ) : (
                        <span
                            className={`text ${Number(task.completed) ? "completed" : ""}`}
                            onClick={() => toggleComplete(task.id, task.completed)}
                        >
                            {task.task}
                        </span>
                    )}
                    {editingId === task.id ? (
                        <>
                            <button className="save-button" onClick={() => saveTask(task.id)}>💾</button>
                            <button className="cancel-button" onClick={cancelEditing}>↩️</button>
                        </>
                    ) : (
                        <>
                            <button className="edit-button" onClick={() => startEditing(task)}>✏️</button>
                            <button className="delete-button" onClick={() => deleteTask(task.id)}>❌</button>
                            <button className="move-button" onClick={() => moveTaskUp(index)}>🔼</button>
                            <button className="move-button" onClick={() => moveTaskDown(index)}>🔽</button>
                        </>
                    )}
                </li>)}
            </ol>
        </div>
    );
}
export default ToDoList