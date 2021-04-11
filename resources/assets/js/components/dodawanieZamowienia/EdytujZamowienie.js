import React, { Component, Fragment } from 'react';
import Select from '../zamowienia/Select';
import PickProducts from '../zamowienia/PickProducts';
import PropTypes from 'prop-types';
import list from '../../../icons/list.svg';
import grip from '../../../icons/grip.svg';
import Icon from './Icon';

class EdytujZamowienie extends Component {
    constructor(props){
        super(props);
        this.state = {
            name: '',
            labor: 0,
            vat: '',
            clients: [],
            client_id: null,
            products: [], //name, id
            categories: [], //name
            selectedProducts: {},
            searchQuery: '',
            isLoading: true,
            order: {},
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
        const selectedProducts = {};
        this.props.order.products.forEach(product => 
            selectedProducts[product.id] = {
                ...product, 
                quantity: product.pivot.ilosc,
                margin: product.pivot.marza
            }
        )
        this.setState({
            ...this.props,
            name: this.props.order.nazwa,
            labor: this.props.order.labor,
            vat: this.props.order.vat,
            selectedProducts
        })
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
        axios.put(`/api/zamowienie/${this.state.order.id}`, 
            {
                'data': selectedProducts,
                'name': this.state.name,
                'labor': this.state.labor,
                'vat': this.state.vat
            }
        )
        .then(res => {
            if(res.data) {
                window.location.href = `/zamowienia/${res.data.id}`;
            }
        })
        .catch(err => console.log(err.response))
    }

    render() {
        const { view, products, selectedProducts, categories, searchQuery, isLoading, name, vat, labor } = this.state
            
        return (
            <div className="pb-5">
            <h1>Edytuj zamówienie</h1>
                <div className="row mt-5">
                    <div className="form-group col col-md-4">
                        <label htmlFor="name">Nazwa zamówienia</label>
                        <input 
                        type="text" 
                        name="name" 
                        className="form-control" 
                        id="name"
                        value={name}
                        onChange={this.handleChange}/>
                    </div>
                    <div className="form-group col col-md-4">
                        <label htmlFor="labor">Robocizna (netto)</label>
                        <input 
                        type="text" 
                        name="labor" 
                        className="form-control" 
                        id="labor"
                        value={labor}
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
                <h3>Edytuj produkty w zamówieniu</h3>
                <div className="card my-3">
                    <div className="card-body d-flex justify-content-between align-items-center">
                        <h4 className="m-0 p-0">
                            <span className="mr-3">Zamówienie dla klienta:</span>
                            <Select 
                            handleChange={this.handleChange} 
                            clients={this.state.clients} 
                            selectedClient={this.props.order.client}/>
                        </h4>
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
                    <div className="loading-text">Wczytuję dane...</div>
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
                            <button className="btn btn-success" onClick={this.handleSubmit}>Edytuj zamówienie</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        );
    }
}

EdytujZamowienie.propTypes = {
    order: PropTypes.object,
    clients: PropTypes.array,
    products: PropTypes.array,
    categories: PropTypes.array,
    isLoading: PropTypes.bool,
}

export default EdytujZamowienie
