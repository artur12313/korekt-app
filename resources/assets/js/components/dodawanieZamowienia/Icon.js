import React from 'react'

export default ({icon, alt, action, title}) => {
  return (
    <button 
    onClick={action} 
    className="btn btn-sm btn-light shadow-sm mr-2" 
    style={{border: '1px solid #ced4da'}}
    data-toggle="tooltip"
    data-placement="bottom"
    title={title}>
     <img src={icon} alt={alt} style={{width: "24px"}}/> 
    </button>
  )
}
