import React, {useEffect, useState} from "react";
import axios from "axios";
import StockSwitch from "@/components/ingredient/StockSwitch";
import AllergenSwitch from "@/components/ingredient/AllergenSwitch";


export default function IngredientTable() {
    const [ingredients, setIngredients] = useState([])
    const [searchTerm, setSearchTerm] = useState('')
    const [descriptionTerm, setDescriptionTerm] = useState('')
    const [direction, setDirection] = useState('asc')
    const [orderBy, setOrderBy] = useState('id')
    useEffect(() => {
        async function search() {
            let res = await axios.post('/admin/ingredient/search', {
                searchTerm: searchTerm,
                descriptionTerm: descriptionTerm,
                orderBy: orderBy,
                direction: direction,
            })
            setIngredients(res.data.ingredients)
        }
        search()

    }, [searchTerm, descriptionTerm, orderBy, direction])

    const onChange = async (e)=> {
        setSearchTerm(e.target.value)
    }
    const onDescriptionChange = async (e)=> {
        setDescriptionTerm(e.target.value)
    }

    const Rows = ingredients.map((row)=> {
        return (
            <tr key={'ingredient-row-'+row.id}>
                <td>{row.id}</td>
                <td>{row.remplacement ? row.remplacement.name : null}</td>
                <td><StockSwitch checked={row.stock} ingredientId={row.id}></StockSwitch></td>
                <td>{row.image ? <img className="img-fluid" src={'/storage/'+row.image.path} alt={row.image.name}/> : null }</td>
                <td>{row.name}</td>
                <td>{row.description}</td>
                <td className="text-center">
                    <AllergenSwitch allergen={row.is_allergen} ingredientId={row.id}></AllergenSwitch>
                </td>
                <td>
                    <a href={'/admin/ingredient/'+row.id+'/edit'} className="btn btn-sm btn-success">Editer</a>
                    <a href={'/admin/ingredient/'+row.id+'/supprimer'} className="btn btn-sm btn-danger btn-delete">Supprimer</a>
                </td>
            </tr>
        )
    })


    return (
        <div>
            <div className="card-body">
                <div className="row mt-3">
                    <div className="col-md-12">
                        <div className="table-responsive">
                            <table className="listing table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th className="text-center" style={{width: '30px'}}></th>
                                    <th className="text-center" style={{width: '30px'}}></th>
                                    <th className="text-center" style={{width: '30px'}}></th>
                                    <th className="text-center" style={{width: '200px'}}></th>
                                    <th><input type="text" className="form-control" onInput={onChange}/></th>
                                    <th><input type="text" className="form-control" onInput={onDescriptionChange}/></th>
                                    <th className="text-center" style={{width: '75px'}}></th>
                                    <th style={{width: '150px'}}></th>
                                </tr>
                                <tr className="text-center">
                                    <th className="text-center" style={{width: '30px'}}>
                                        <div className="text-primary" onClick={()=> {
                                            setOrderBy('id')
                                            setDirection((direction) => direction === 'asc' ? 'desc' : 'asc')
                                        }}>ID</div>
                                    </th>
                                    <th className="text-center" style={{width: '30px'}}>
                                        <div className="text-primary" onClick={()=> {
                                            setOrderBy('replace')
                                            setDirection((direction) => direction === 'asc' ? 'desc' : 'asc')
                                        }}>Remplacement</div>
                                        </th>
                                    <th className="text-center" style={{width: '30px'}}>
                                        Stock
                                    </th>
                                    <th className="text-center" style={{width: '200px'}}>Image</th>
                                    <th>
                                        <div className="text-primary" onClick={()=> {
                                            setOrderBy('name')
                                            setDirection((direction) => direction === 'asc' ? 'desc' : 'asc')
                                        }}>Nom</div>
                                    </th>
                                    <th>Description</th>
                                    <th className="text-center" style={{width: '75px'}}>Allergène</th>
                                    <th style={{width: '150px'}}>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                {Rows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
