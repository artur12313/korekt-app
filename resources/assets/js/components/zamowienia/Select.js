import React from 'react'

const Select = ({ clients, handleChange, selectedClient = false }) => {
  const OPTIONS = clients.map(client => (
    <option 
      key={client.id} 
      value={client.id}
      selected={selectedClient.id ? "selected" : ""}>
      {client.nazwa}
    </option>
  ))
  return (
    <select 
    className="form-control mt-2" 
    name="client_id" 
    onChange={handleChange}
    disabled={selectedClient.id ? "disabled" : ""}>
        { OPTIONS }
    </select>
  )
}

export default Select
