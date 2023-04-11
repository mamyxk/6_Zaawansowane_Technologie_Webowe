const express = require('express');
const { createSchema, createYoga } = require('graphql-yoga');
const fs = require('fs');
const {getRestTodosList, getRestUsersList, getRestTodoById, getRestUserById, getRestTodoByUserId, getRestUserByTodoId } = require('./rest-api');
const port = 4000;

const resolvers = {
    Query: {
        users: () => getRestUsersList(),
        todos: () => getRestTodosList(),
        todo: (parent, args, context, info) => getRestTodoById(parent, args, context, info),
        user: (parent, args, context, info) => getRestUserById(parent, args, context, info),
    },
    User:{
        todos: (parent, args, context, info) => getRestTodoByUserId(parent, args, context, info),
    },
    ToDoItem:{
        user: (parent, args, context, info) => getRestUserByTodoId(parent, args, context, info),
    }
}

const schema = createSchema({
    typeDefs: fs.readFileSync('./src/schema.graphql', 'utf-8'),
    resolvers,
});

const app = express();

const yoga = createYoga({
    schema,
});

app.use('/graphql', yoga);

async function startServer(){
    try{
        await app.listen(port);
        console.log(`Server is running on http://localhost:4000/graphql`);
    }catch(error){
        console.log('Something went wrong!');
        console.log(error);
    }
}

startServer();