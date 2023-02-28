import ReactDOM from "react-dom/client";
import React from "react";
import GridPlats from "./plat/GridPlats";

let grillePlats = document.getElementById('react-grille-plats')
if (grillePlats) {
    const App = ReactDOM.createRoot(grillePlats);
    let plats = JSON.parse(grillePlats.getAttribute('plats'))
    App.render(
        <React.StrictMode>
            <GridPlats plats={plats}/>
        </React.StrictMode>
    )
}
