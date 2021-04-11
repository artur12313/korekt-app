import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import DodajZamowienie from './dodawanieZamowienia/DodajZamowienie';
import EdytujZamowienie from './dodawanieZamowienia/EdytujZamowienie';

export default class App extends Component {
    constructor(props){
        super(props);
        this.state = {
            clients: null,
            order: null,
            isLoading: true
        }
    }

    componentDidMount() {
        if(window.order) {
            this.setState({order: window.order})
        }
        if(window.clients) {
            this.setState({clients: window.clients})
        }

        const products = axios.get('/api/products')
        const categories = axios.get('/api/categories')
        
        Promise.all([products, categories])
            .then(values => this.setState({products: values[0].data.data, categories: values[1].data.data, isLoading: false}))
            .catch(err => console.log(err.response))
    }

    render() {
        const { order, products, categories, isLoading, clients } = this.state
        return isLoading
        ? <div>Wczytywanie...</div>
        : (
            order
            ? <EdytujZamowienie order={order} clients={clients} products={products} categories={categories} isLoading={isLoading} />
            : <DodajZamowienie clients={clients} products={products} categories={categories} isLoading={isLoading} />
        );
    }
}

if (document.getElementById('zamowienie')) {
    ReactDOM.render(<App />, document.getElementById('zamowienie'));
}
