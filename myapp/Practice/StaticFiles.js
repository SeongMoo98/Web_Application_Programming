const express = require('express')
const app = express()
const port = 3000

app.use(express.static("Static Files"))

app.get('/', (req, res) => res.send('Static FIles Example' ))

app.get('/Path1', (req, res) => res.send("GET Path1"))
app.get('/Path2', (req, res) => res.send("GET Path2 : " + Date()))
app.put('/Path1', (req, res) => res.send("Put Path1"))

app.listen(port, () => console.log(`Example app listening at http://localhost:${port}`))