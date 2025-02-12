const express = require('express');
const db = require('./database');

const app = express();
app.use(express.json());

app.get("/users", (req, res) => {
    db.all("SELECT * FROM users", [], (err, rows) => {
        if (err) {
            return res.status(500).json({ error: err.message });
        }
        res.json({ users: rows });
    });
});

app.post("/users", (req, res) => {
    const { name, email } = req.body;
    db.run("INSERT INTO users (name, email) VALUES (?,?)", [name, email], function (err) {
        if (err) {
            return res.status(500).json({ error: err.message });
        }
        res.json({ message: "Usuário criado com sucesso!", id: this.lastID });
    });
});

app.delete("/users/:id", (req, res) => {
   const  { id } = req.params;
   db.run("DELETE FROM users WHERE id = ?", [id], function (err) {
        if (err) {
            return res.status(500).json({ error: err.message });
        }
        res.json({ message: `Usuário de ID ${id} excluído com sucesso!` });
   });
})

app.listen(3000, () => {
    console.log("Servidor escutando em http://localhost:3000");
})