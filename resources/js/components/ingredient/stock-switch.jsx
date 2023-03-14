import ReactDOM from "react-dom/client";
import React, {StrictMode} from "react";
import StockSwitch from "./stockSwitch";

let stockSwitch = document.querySelectorAll('.stock-switch')
if(stockSwitch.length > 0) {
    stockSwitch.forEach(sw=> {
        let rootSwitch = ReactDOM.createRoot(sw)
        let checked = sw.dataset.checked
            ? JSON.parse(sw.dataset.checked)
            : false
        let ingredientId = sw.dataset.id
            ? JSON.parse(sw.dataset.id)
            : false

        /*
        let options = sw.getAttribute('data-options')
            ? JSON.parse(sw.getAttribute('data-options'))
            : null

        }

         */
        rootSwitch.render(
            <StrictMode>
              <StockSwitch checked={checked} ingredientId={ingredientId}></StockSwitch>
            </StrictMode>
        )
    })
}
