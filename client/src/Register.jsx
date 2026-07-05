import {useState} from "react";

function Register(){
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
    const [message, setMessage] = useState("");

    async function registerUser(){
        if(username.trim() === "" || password.trim() === ""){
            setMessage("Username and password required");
            return;
        }

        const formData = new FormData();
        formData.append("username", username);
        formData.append("password", password);

        const response = await fetch("http://localhost/to-do-list/server/register.php",
            {
                method: "POST",
                body: formData
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
            <h1>Register</h1>
            <input className="register-input" type="text" placeholder="Username" value={username}
                   onChange={(e) => setUsername(e.target.value)}
            />
            <br />
            <input className="register-input" type="password" placeholder="Password" value={password}
                   onChange={(e) => setPassword(e.target.value)}
            />
            <br />
            <p>{message}</p>
            <button className="register-button" onClick={registerUser}>Register</button>
        </>
    );
}
export default Register;