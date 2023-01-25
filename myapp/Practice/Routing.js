const express = require('express')
const app = express()
const port = 3000

app.get('/', (req, res) => res.send('Routing Example ( 경로에 /Path1,2 추가)'))

// Routing
app.get('/Path1', (req, res) => res.send("GET Path1"))
app.get('/Path2', (req, res) => res.send("GET Path2 : " + Date()))
app.put('/Path1', (req, res) => res.send("Put Path1"))

app.listen(port, () => console.log(`Example app listening at http://localhost:${port}`))