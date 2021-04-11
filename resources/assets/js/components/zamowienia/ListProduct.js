import React, { Component } from 'react'
import chevronDown from '../../../icons/chevron-down.svg'
import chevronRight from '../../../icons/chevron-right.svg'

export default class ListProduct extends Component {
  constructor(props) {
    super(props)
    this.state = {
      quantity: 0,
      margin: 0,
      clicked: false
    }
    this.handleChange = this.handleChange.bind(this)
    this.toggleProduct = this.toggleProduct.bind(this)
  }

  handleChange(e) {
    this.setState({[e.target.name]: e.target.value})
  }

  toggleProduct() {
    this.setState({clicked: !this.state.clicked})
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
    const {
      product, selectedProducts, addToBasket, removeFromBasket, clickedProducts, 
    } = this.props
    const { quantity, margin, clicked } = this.state
    return (
      <div className="col-12 mb-1">
        <div className="accordion w-100" id="accordionExample">
          <a className="w-100 bg-transparent link-reset">
          <div className="card">
            <div className="card-header bg-white shadow-sm">
              <div className="d-flex justify-content-between align-items-center">
                <div className="font-weight-bold cursor-pointer" onClick={() => this.toggleProduct()}>
                  { 
                    clicked
                    ? <img src={chevronDown} alt="▼" className="icon-16 mr-2"/>
                    : <img src={chevronRight} alt="►" className="icon-16 mr-2"/>
                  }
                  {product.name}
                </div>
                  <div className="d-flex flex-row align-items-center">
                    <div className="d-flex justify-content-end align-items-center ml-4">
                      <label htmlFor="quantity">Ilość:</label>
                      <input 
                      type="number" 
                      className="form-control ml-2 px-2"
                      style={{width: '64px'}}
                      name="quantity"
                      placeholder={product.jednostka} 
                      value={quantity}
                      onChange={this.handleChange}
                      disabled={selectedProducts[product.id] ? 'disabled' : ''}/>
                    </div>
                    <div className="d-flex justify-content-end align-items-center ml-4">
                      <label htmlFor="margin">Marża:</label>
                      <input 
                      type="number"
                      name="margin"
                      className="form-control ml-2 px-2"
                      style={{width: '64px'}}
                      placeholder="%" 
                      value={margin} 
                      onChange={this.handleChange}
                      disabled={selectedProducts[product.id] ? 'disabled' : ''}/>
                    </div>
                    {
                      selectedProducts[product.id]
                      ? (
                        <button 
                        role="button"
                        style={{width: '64px'}}
                        className="card-link btn btn-danger btn-block ml-4" 
                        onClick={() => removeFromBasket(product)}>
                          Usuń
                        </button>
                      )
                      : (
                        <button 
                        role="button"
                        style={{width: '64px'}}
                        className="card-link btn btn-primary btn-block ml-4" 
                        onClick={() => addToBasket({...product, quantity, margin})}>
                          Dodaj
                        </button>
                      )
                    }
                  </div>
                </div>
              </div>
              <div 
              className={`collapse ${clicked ? 'show' : null}`} >
                <div className="card-body">
                  <h6 className="card-subtitle mb-2 text-muted">Kat. {product.category}</h6>
                  <p className="card-text">
                    Dostawca: {product.dostawca} <br />
                    Jednostka: {product.jednostka} <br />
                    Cena zakupu netto: {product.cena_zakupu_netto} zł<br />
                    Ostatnia aktualizacja produktu: {product.updated_at} <br />
                  </p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    )
  }
}
