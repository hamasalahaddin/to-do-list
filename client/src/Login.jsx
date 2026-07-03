import {useState} from "react";
function Login(){
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [message, setMessage] = useState("");

    async function loginUser(){
        if(username.trim() === "" || password.trim() === ""){
            setMessage("Username and password are required");
            return;
        }

        const formData = new FormData();
        formData.append("username", username);
        formData.append("password", password);

        const response = await fetch("http://localhost/to-do-list/server/login.php",
            {
                method: "POST",
                body: formData,
                credentials: "include"
            }
        );

        const data = await response.json();

        setMessage(data.message);

        if(data.success){
            setUsername("");
            setPassword("");
        }
    }

    return(
        <>
            <h2>Login</h2>
            <input type="text" placeholder="Username" value={username}
                onChange={(e) => setUsername(e.target.value)}
            />
            <br />
            <input type="password" placeholder="Password" value={password}
                onChange={(e) => setPassword(e.target.value)}
            />
            <br />
            <p>{message}</p>
            <button onClick={loginUser}>Login</button>
        </>
    );
}
export default Login;