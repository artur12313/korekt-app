import React, { Component } from 'react'
import GridProduct from './GridProduct'
import ListProduct from './ListProduct'

export default class PickProducts extends Component {
  constructor(props) {
    super(props)

    this.state = {
      selectedCategory: {},
    }
    this.handleClick = this.handleClick.bind(this)
  }

  handleClick(selectedCategory) {
    if(selectedCategory === this.state.selectedCategory) {
      return this.setState({selectedCategory: {}})
    }
    this.setState({selectedCategory})
  }

  render() {
    const { 
      products, categories, addToBasket, selectedProducts, removeFromBasket, searchQuery, view
    } = this.props

    const CATEGORIES = categories.map(category => (
        <li
        key={category.id}
        onClick={() => this.handleClick(category)}
        style={{cursor: "pointer"}}
        className={`list-group-item 
        ${category.name === this.state.selectedCategory.name 
        ? 'active' 
        : ''}
        `}>
          {category.name}
        </li>
    ))

    const sortedProducts = products.reduce((acc, element) => {
      if(selectedProducts[element.id] != undefined) {
        return [element, ...acc];
      }
      return [...acc, element];
    }, []);

    const filteredProducts = this.state.selectedCategory.name ? sortedProducts.filter(product => product.category === this.state.selectedCategory.name) : sortedProducts

    const searchedProducts = filteredProducts.filter(product => searchQuery.length > 1 ? product.name.toLowerCase().includes(searchQuery.toLowerCase()) : product)
    
    const PRODUCTS = searchedProducts.map(product => {
        switch(view) {
          case 'grid': return (
            <GridProduct
            key={product.id} 
            product={product} 
            selectedProducts={selectedProducts}
            addToBasket={addToBasket}
            removeFromBasket={removeFromBasket}
            />
          )
          case 'list': return (
            <ListProduct
            key={product.id} 
            product={product} 
            selectedProducts={selectedProducts}
            addToBasket={addToBasket}
            removeFromBasket={removeFromBasket}
            />
          )
          default: return (
            <GridProduct
            key={product.id} 
            product={product} 
            selectedProducts={selectedProducts}
            addToBasket={addToBasket}
            removeFromBasket={removeFromBasket}
            />
          )
        }
      }
    )

    return (
      <div className="container-fluid p-0">
        <div className="row no-gutters">
          <div className="col-3">
            <ul className="list-group">
              { CATEGORIES }
            </ul>
          </div>
          <div className="col-9">
            <div className="container-fluid">
              <div className="row">
                { PRODUCTS }
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}