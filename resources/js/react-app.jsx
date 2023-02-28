import ReactDOM from "react-dom/client";
import React from "react";
import Select from 'react-select'

/**
 * React Select
 */

let reactSelects = document.querySelectorAll('.react-select')
if(reactSelects.length > 0) {
    reactSelects.forEach(rs=> {
        let rootSelect = ReactDOM.createRoot(rs)
        let options = rs.getAttribute('options')
        let name = rs.getAttribute('name')
        let value = rs.getAttribute('value')
        if(!options) {
            console.log('Pas d\'options trouvées pour un react-select')
            return
        }
        rootSelect.render(
            <Select
                options={options ? JSON.parse(options) : null}
                name={name || null}
                defaultValue={value ? JSON.parse(value) : null}
                formatOptionLabel={function(data) {
                    return (
                        <span dangerouslySetInnerHTML={{ __html: data.label }} />
                    );
                }}
            />
        )
    })
}
