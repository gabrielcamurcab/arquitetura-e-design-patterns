const userRepository = require('./repositories/userRepository');

class Report {
    static generateReport() {
        const users = userRepository.getAllUsers();
        return users.map(user => `User: ${user.name} | E-mail: ${user.email}`).join('\n');
    }
}

module.exports = Report;