const userRepository = require('./repositories/userRepository');

class Admin {
    static listUsers() {
        return userRepository.getAllUsers();
    }

    static findUserById(id) {
        return userRepository.getUserById(id);
    }
}

module.exports = Admin;