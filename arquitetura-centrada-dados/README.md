# Arquitetura centrada em dados

Neste arquitetura **Padrão de Arquitetura** todo o sistema depende dos dados. Ele é o centro, e os componentes o consultam com bastante frequência.

Um exemplo prático disso são os SGBDs (Sistemas Gerenciadores de Bancos de Dados), pois o centro da aplicação são os dados armazenados e gerenciados pelo SGBD.

![Arquitetura Centrada em Dados](https://www.tutorialspoint.com/software_architecture_design/images/data_centered_architecture.jpg)

## Sobre o projeto

Este projeto é uma API REST simples feita utilizando *NodeJS*, e conectada a um banco de dados *sqlite*, no qual é automaticamante criado um banco de dados simplificado chamado *users*.

Para rodar a aplicação siga os seguintes passos:
```bash
cd arquitetura-centrada-dados
npm install
node server.js
```

E para acessar os endpoints, use uma ferramenta como Postman ou Insomnia.

Os endpoints são:

- ``POST /users``
- ``GET /users``
- ``DELETE /users/{id}``