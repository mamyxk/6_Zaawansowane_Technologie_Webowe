const axios = require('axios');

async function getRestTodosList(){
    try {
        const todos = await axios.get("https://jsonplaceholder.typicode.com/todos")
        console.log('todos connected!');
        return todos.data.map(({id, title, completed, userId}) => ({
            id: id,
            title: title,
            completed: completed,
            user: userId,
        }))
    } catch (error){
        throw error
    }
}

async function getRestUsersList(){
    try {
        const users = await axios.get("https://jsonplaceholder.typicode.com/users")
        console.log('users connected!');
        return users.data.map(({id, name, email, username}) => ({
            id: id,
            name: name,
            email: email,
            login: username,
        }))
    } catch (error){
        throw error
    }
}

async function getRestTodoById(parent, args, context, info){
    try {
        const todo = await axios.get(`https://jsonplaceholder.typicode.com/todos?id=${args.id}`);
        console.log(`todos ${args.id} connected!`);
        const todoData = todo.data[0];
        return {
            id: todoData.id,
            title: todoData.title,
            completed: todoData.completed,
            user: todoData.userId,
        };
    } catch (error){
        throw error;
    }
}

async function getRestUserById(parent, args, context, info){
    try {
        const user = await axios.get(`https://jsonplaceholder.typicode.com/users?id=${args.id}`)
        console.log(`user ${args.id} connected!`);
        const userData = user.data[0];
        return {
            id: userData.id,
            name: userData.name,
            email: userData.email,
            login: userData.username,
        };
    } catch (error){
        throw error
    }
}

async function getRestTodoByUserId(parent, args, context, info){
    try {
        const todos = await axios.get(`https://jsonplaceholder.typicode.com/todos?userId=${parent.id}`);
        console.log(`todos with userId: ${parent.id} connected!`);
        return todos.data.map(({id, title, completed, userId}) => ({
            id: id,
            title: title,
            completed: completed,
            user: userId,
        }));
    } catch (error){
        throw error;
    }
}

async function getRestUserByTodoId(parent, args, context, info){
    try {
        const user = await axios.get(`https://jsonplaceholder.typicode.com/users?id=${parent.user}`)
        console.log(`user with todo ${parent.user} connected!`);
        const userData = user.data[0];
        return {
            id: userData.id,
            name: userData.name,
            email: userData.email,
            login: userData.username,
        };
    } catch (error){
        throw error
    }
}

module.exports = {
    getRestTodosList,
    getRestUsersList,
    getRestTodoById,
    getRestUserById,
    getRestTodoByUserId,
    getRestUserByTodoId,
};