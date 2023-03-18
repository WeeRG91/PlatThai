import React, {useState} from "react";
import axios from "axios";

function AllergenSwitch({allergen, ingredientId}){
    const [isAllergen, setIsAllergen] = useState(allergen)
    const onAllergenChange = async () =>{
        setIsAllergen(!isAllergen)
        await axios.post('/admin/ingredient/allergen/'+ingredientId)

    }
    return (
        <div>
            <label key={'allergen-'+ingredientId} htmlFor={'allergen-'+ingredientId} className="switch allergen">
                <input type="checkbox" name={'allergen-'+ingredientId} checked={isAllergen} onChange={onAllergenChange}
                       id={'allergen-'+ingredientId} value="0"/>
                <span className="slider round">
                    <i className="fa-solid fa-triangle-exclamation"></i>
                </span>
            </label>
        </div>
    )
}
export default AllergenSwitch
