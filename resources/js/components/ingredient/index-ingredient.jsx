import ReactDOM from "react-dom/client";
import React, {StrictMode} from "react";
import IngredientTable from "./IngredientTable";


let indexIngredient = document.getElementById('index-ingredient')
if(indexIngredient) {
    let rootIndex = ReactDOM.createRoot(indexIngredient)

    rootIndex.render(
        <StrictMode>
            <IngredientTable />
        </StrictMode>
    )
}

