import React from 'react'
import ReactDOM from 'react-dom/client'
import { BrowserRouter } from 'react-router-dom'

import * as Components from './components'
import { ListInputProvider } from './contexts/inputs'

ReactDOM.createRoot(document.getElementById('root') as HTMLElement).render(
  <React.StrictMode>
    <BrowserRouter>
      <ListInputProvider>
        <Components.App/>
      </ListInputProvider>
    </BrowserRouter>
  </React.StrictMode>,
)
