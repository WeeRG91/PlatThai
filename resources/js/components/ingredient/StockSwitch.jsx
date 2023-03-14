import React, {useState} from "react";
import axios from "axios";

export default function StockSwitch({checked, ingredientId}){
    const [isChecked, setIsChecked] = useState(checked)
    const onChange = async (e) => {
        setIsChecked(!isChecked)
        await toggleStock()
    }

    const toggleStock = async ()=> {
        let res = await axios.post('/admin/ingredient/toggle-stock/'+ingredientId)
    }

    return (
        <>
            <label key={'ingredient-'+ingredientId} htmlFor={'stock-'+ingredientId} className="switch stock">
                <input type="checkbox" name={'stock-'+ingredientId} checked={isChecked} onChange={onChange} id={'stock-'+ingredientId}
                       value="1"/>
                <span className="slider round">
                    <i className="fa-solid fa-store"></i>
                </span>
            </label>
        </>
    )
}
