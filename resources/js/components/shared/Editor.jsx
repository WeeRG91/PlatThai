import React, {useState} from "react";
import {CKEditor} from "@ckeditor/ckeditor5-react";
import   '../../ckeditor/build/ckeditor'

/**
 * Upload d'image en base64 avec un build custom
 * https://ckeditor.com/ckeditor-5/online-builder/
 * il faut faire un npm install dans le dossier resources/js/ckeditor
 * ensuite un npm run build dans le même dossier
 * @param props
 * @returns {JSX.Element}
 * @constructor
 */
function CustomEditor(props) {
    const [name, setName] = useState(props.name)
    const [value, setValue] = useState(props.value)
    const onUpdate = (event, editor) => {
        setValue(editor.getData())
    }

    return (
        <div>
            <CKEditor
                editor={ ClassicEditor }
                data={value}
                onReady={ editor => {
                    // You can store the "editor" and use when it is needed.
                } }
                onChange={ (event, editor) => {
                    console.log(event)
                    onUpdate(event, editor)
                } }
                onBlur={ ( event, editor ) => {
                } }
                onFocus={ ( event, editor ) => {
                } }
            />
            <input type="hidden" name={name} value={value}/>
        </div>
    )
}
export default CustomEditor
