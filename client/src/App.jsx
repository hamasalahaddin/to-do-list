import {useState, useEffect} from "react";
import ToDoList from "./ToDoList";
import Register from "./Register";
import Login from "./Login";

function App() {
    const [isLoggedIn, setIsLoggedIn] = useState(false);
    const [loading, setLoading] = useState(true);
    const [showRegister, setShowRegister] = useState(false);

    useEffect(() => {
        checkSession();
    }, []);
    async function checkSession(){
        const response = await fetch("http://localhost/to-do-list/server/checkSession.php",
            {
                credentials: "include"
            }
        );

        const data = await response.json();
        console.log(data);

        if(data.success){
            setIsLoggedIn(true);
        }

        setLoading(false);
    }    

    if(loading){
        return <h2>Loading...</h2>;
    }
    
    return (
        isLoggedIn ? (
            <ToDoList onLogout={() => setIsLoggedIn(false)} />
        ) : (
            showRegister ? (
                <Register onShowLogin={() => setShowRegister(false)} />
            ) : (
                <Login onLogin={setIsLoggedIn} onShowRegister={() => setShowRegister(true)} />
            )
        )
    );
}

export default App;