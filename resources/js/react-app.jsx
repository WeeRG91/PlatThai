import ReactDOM from "react-dom/client";
import React, {StrictMode} from "react";
import Select from 'react-select'

/**
 * React Select
 */

let reactSelects = document.querySelectorAll('.react-select')
if(reactSelects.length > 0) {
    reactSelects.forEach(rs=> {
        let rootSelect = ReactDOM.createRoot(rs)
        let options = rs.getAttribute('data-options')
            ? JSON.parse(rs.getAttribute('data-options'))
            : null
        let name = rs.getAttribute('data-name') || null
        let defaultValue = rs.getAttribute('data-default-value')
            ? JSON.parse(rs.getAttribute('data-default-value'))
            : null
        let isMulti = rs.getAttribute('data-is-multi') || false
        if(!options) {
            console.log('Pas d\'options trouvées pour un react-select')
            return
        }
        rootSelect.render(
            <StrictMode>
            <Select
                isMulti={isMulti}
                options={options}
                name={name}
                defaultValue={defaultValue}
                formatOptionLabel={function(data) {
                    return (
                        <span dangerouslySetInnerHTML={{ __html: data.label }} />
                    );
                }}
            />
            </StrictMode>
        )
    })
}
