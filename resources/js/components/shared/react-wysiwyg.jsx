import React, {Component, StrictMode} from 'react';
import ReactDOM from "react-dom/client";
import CustomEditor from "./Editor";

let reactWysiwyg = document.querySelectorAll('.react-wysiwyg')
if(reactWysiwyg.length > 0) {
    reactWysiwyg.forEach(wysiwyg=> {
        let rootSelect = ReactDOM.createRoot(wysiwyg)

        const config = wysiwyg.getAttribute('data-config')
            ? JSON.parse(wysiwyg.getAttribute('data-config'))
            : null
        let placeHolder = wysiwyg.getAttribute('data-place-holder')
            ? JSON.parse(wysiwyg.getAttribute('data-place-holder'))
            : '<p>Insérer le contenu ici</p>'
        let name = wysiwyg.getAttribute('data-name')
            ? JSON.parse(wysiwyg.getAttribute('data-name'))
            : null
        let value = wysiwyg.getAttribute('data-value')
            ? JSON.parse(wysiwyg.getAttribute('data-value'))
            : placeHolder

        rootSelect.render(
            <StrictMode>
                <CustomEditor config={config} placeHolder={placeHolder} name={name} value={value} />
            </StrictMode>
        )
    })
}
