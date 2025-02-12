const fs = require('fs');
const path = require('path');
const User = require('../models/userModel');

const usersFilePath = path.join(__dirname, '../../data/users.json');

class userRepository {
    static getAllUsers() {
        const data = fs.readFileSync(usersFilePath);
        const users = JSON.parse(data);
        return users.map(user => new User(user.id, user.name, user.email));
    }

    static getUserById(id) {
        const data = fs.readFileSync(usersFilePath);
        const users = JSON.parse(data);
        const user = users.find(u => u.id === id);
        return user ? new User(user.id, user.name, user.email) : null;
    }

    static saveUser(user) {
        const data = fs.readFileSync(usersFilePath);
        const users = JSON.parse(data);
        users.push(user);
        fs.writeFileSync(usersFilePath, JSON.stringify(users, null, 2));
    }
}

module.exports = userRepository;