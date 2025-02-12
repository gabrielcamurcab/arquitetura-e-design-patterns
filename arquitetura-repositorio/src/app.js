const express = require('express');
const bodyParser = require('body-parser');
const Admin = require('./admin');
const Report = require('./report');
const User = require('./models/userModel');
const userRepository = require('./repositories/userRepository');

const app = express();
app.use(bodyParser.json());

app.get('/admin/users', (req, res) => {
    const users = Admin.listUsers();
    res.json(users);
});

app.get('/report', (req, res) => {
    const report = Report.generateReport();
    res.json(report);
});

app.post('/admin/users', (req, res) => {
    const { id, name, email } = req.body;
    const user = new User(id, name, email);
    userRepository.saveUser(user);
    res.status(201).send({ message: 'User created' });
});

const PORT = 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});