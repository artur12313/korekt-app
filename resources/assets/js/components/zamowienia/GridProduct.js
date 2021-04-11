import React, { Component } from 'react'

export default class GridProduct extends Component {
  constructor(props) {
    super(props)
    this.state = {
      quantity: 0,
      margin: 0
    }
    this.handleChange = this.handleChange.bind(this)
  }

  handleChange(e) {
    this.setState({[e.target.name]: e.target.value})
  }

  componentDidMount() {
    if(this.props.selectedProducts[this.props.product.id]) {
      const { quantity, margin } = this.props.selectedProducts[this.props.product.id]
      if(quantity) {
        this.setState({quantity})
      }
      if(margin) {
        this.setState({margin})
      }
    }
  }
  render() {
    const { product, selectedProducts, addToBasket, removeFromBasket } = this.props
    const { quantity, margin } = this.state
    return (
      <div className="col-6 col-lg-4 mb-4">
        <div className="card" style={{width: "100%"}}>
          <div className={`card-header ${selectedProducts[product.id] ? 'bg-danger' : 'bg-primary'}`}></div>
          <div className="card-body">
            <h5 className="card-title">{product.name}</h5>
            <h6 className="card-subtitle mb-2 text-muted">Kat. {product.category}</h6>
            <p className="card-text">
              Dostawca: {product.dostawca} <br />
              Jednostka: {product.jednostka} <br />
              Cena zakupu netto: {product.cena_zakupu_netto} zł<br />
              Ostatnia aktualizacja produktu: {product.updated_at} <br />
            </p>
          </div>
          <div className="card-footer">
            <div className="row mb-2 no-gutters">
              <div className="col-6 pr-1">
                <label htmlFor="ilosc">Ilość:</label>
              </div>
              <div className="col-6 pl-1">
                <input 
                type="number" 
                className="form-control"
                name="quantity"
                placeholder={product.jednostka} 
                value={quantity}
                onChange={this.handleChange}
                disabled={selectedProducts[product.id] ? 'disabled' : ''}/>
              </div>
            </div>
            <div className="row mb-2 no-gutters">
              <div className="col-6 pr-1">
                <label htmlFor="ilosc">Marża:</label>
              </div>
              <div className="col-6 pl-1">
                <input 
                type="number"
                name="margin"
                className="form-control"
                placeholder="%" 
                value={margin} 
                onChange={this.handleChange}
                disabled={selectedProducts[product.id] ? 'disabled' : ''}/>
              </div>
            </div>
            {
              selectedProducts[product.id]
              ? (
                <button 
                role="button" 
                className="card-link btn btn-danger btn-block" 
                onClick={() => removeFromBasket(product)}>
                  Usuń
                </button>
              )
              : (
                <button 
                role="button" 
                className="card-link btn btn-primary btn-block" 
                onClick={() => addToBasket({...product, quantity, margin})}>
                  Dodaj
                </button>
              )
            }
          </div>
        </div>
      </div>
    )
  }
}
