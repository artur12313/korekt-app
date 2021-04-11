import React, { Component } from 'react';
import Select from '../zamowienia/Select';
import PickProducts from '../zamowienia/PickProducts';
import PropTypes from 'prop-types';
import list from '../../../icons/list.svg';
import grip from '../../../icons/grip.svg';
import Icon from './Icon';

class DodajZamowienie extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            labor: 0,
            vat: 23,
            clients: [],
            client_id: null,
            products: [], //name, id
            categories: [], //name
            selectedProducts: {},
            searchQuery: '',
            isLoading: true,
            message: "Wczytywanie danych...",
            view: 'grid'
        }
        this.handleChange = this.handleChange.bind(this)
        this.clearBasket = this.clearBasket.bind(this)
        this.addToBasket = this.addToBasket.bind(this)
        this.removeFromBasket = this.removeFromBasket.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this)
        this.changeView = this.changeView.bind(this)
    }

    componentDidMount() {
        $(async function () {
            await $('[data-toggle="tooltip"]').tooltip()
        })
        if(this.props.clients.length) {
            this.setState({...this.props, client_id: this.props.clients[0].id})
        } else {
            this.setState({message: "Musisz najpierw dodać klientów!"});
        }

        if(localStorage.getItem('view')) {
            this.setState({view: localStorage.getItem('view')})
        }
    }

    handleChange(e) {
        e.preventDefault()
        this.setState({[e.target.name]: e.target.value})
    }

    changeView(view) {
        localStorage.setItem('view', view);
        this.setState({view})
    }

    clearBasket() {
        this.setState({selectedProducts: {}})
    }

    addToBasket(product) {
        if (product.quantity > 0) {
            this.setState({selectedProducts: {...this.state.selectedProducts, [product.id]: product}})
        }
    }
    
    removeFromBasket(product) {
        const newSelectedProducts = this.state.selectedProducts
        delete newSelectedProducts[product.id]
        this.setState({selectedProducts: newSelectedProducts})
    }

    handleSubmit() {
        const selectedProducts = Object.values(this.state.selectedProducts)
        if(selectedProducts.length) {
            axios.post('/api/zamowienie/new',
            {
                'data': selectedProducts,
                'client_id': this.state.client_id,
                'author_id': window.author_id,
                'name': this.state.name,
                'labor': this.state.labor,
                'vat': this.state.vat
            })
            .then(res => {
                if(res.data) {
                    window.location.href = `/zamowienia/${res.data.id}`;
                }
            })
            .catch(err => console.log(err.response))
        }
    }

    render() {
        const { selectedProducts, products, categories, searchQuery, isLoading, message, view, name, vat, labor } = this.state
        
        return (
            <div className="pb-5">
                <h1>Dodaj nowe zamówienie</h1>
                <div className="row mt-5">
                    <div className="form-group col col-md-4">
                        <label htmlFor="name">Nazwa zamówienia</label>
                        <input 
                        type="text" 
                        name="name"
                        value={name}
                        className="form-control" 
                        id="name" 
                        onChange={this.handleChange}/>
                    </div>
                    <div className="form-group col col-md-4">
                        <label htmlFor="labor">Robocizna (netto)</label>
                        <input 
                        type="text" 
                        name="labor"
                        value={labor}
                        className="form-control" 
                        id="labor"
                        onChange={this.handleChange}/>
                    </div>
                    <div className="form-group col">
                        <label htmlFor="vat">Stawka VAT</label>
                        <select className="form-control" name="vat" id="vat" value={vat} onChange={this.handleChange}>
                            <option value={23}>23%</option>
                            <option value={8}>8%</option>
                            <option value={0}>0%</option>
                        </select>
                    </div>
                </div>
                <hr className="my-3"/>
                <h3>Dodaj produkty do zamówienia</h3>
                <div className="card my-3">
                    <div className="card-body d-flex justify-content-between align-items-center">
                        <div className="d-flex justify-content-start">
                            <span className="mr-3">Zamówienie dla klienta:</span> 
                            <Select handleChange={this.handleChange} clients={this.state.clients}/>
                        </div>
                        <div className="d-flex">
                            <Icon 
                            icon={list} 
                            alt="Lista"
                            action={() => this.changeView('list')}
                            title="Włącz widok listy"
                            />
                            <Icon 
                            icon={grip} 
                            alt="Siatka"
                            action={() => this.changeView('grid')}
                            title="Włącz widok siatki"
                            /> 
                            <div className="form-group m-0">
                                <input 
                                type="text"
                                className="form-control"
                                onChange={this.handleChange} 
                                name="searchQuery"
                                placeholder="Wyszukaj po nazwie..." 
                                value={searchQuery}/>
                            </div>
                        </div>
                    </div>
                </div>
                { isLoading 
                    ? <div className="text-center">
                        <div className="spinner"></div>
                        <div className="loading-text">{message}</div>
                    </div>
                    : (
                        <PickProducts
                            view={view}
                            products={products} 
                            categories={categories} 
                            selectedProducts={selectedProducts}
                            searchQuery={searchQuery}
                            addToBasket={this.addToBasket}
                            removeFromBasket={this.removeFromBasket}
                        />
                    )
                }
            <div style={{position: "fixed", bottom: 0, left:0, right:0, height: "80px", backgroundColor: "rgb(50,50,50)"}}>
                <div className="container">
                    <div style={{width: "100%", height: "80px"}} className="d-flex px-5 align-items-center justify-content-between">
                        <div>
                            <button className="btn btn-danger" onClick={this.clearBasket}>Wyczyść zamówienie</button>
                        </div>
                        <div style={{color: "white", fontSize: "14pt"}}>
                            Wybrane produkty:&nbsp;
                            <span
                            style={{fontSize: "12pt"}}
                            className="badge badge-pill badge-light">
                                {Object.keys(selectedProducts).length}
                            </span>
                        </div>
                        <div>
                            <button className="btn btn-success" onClick={this.handleSubmit}>Dodaj zamówienie</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        );
    }
}

DodajZamowienie.propTypes = {
    clients: PropTypes.array,
    products: PropTypes.array,
    categories: PropTypes.array,
    isLoading: PropTypes.bool,
}

export default DodajZamowienie;
