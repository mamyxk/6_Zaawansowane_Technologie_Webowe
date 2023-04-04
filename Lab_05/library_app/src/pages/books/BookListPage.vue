<template>
    <div>
        <h1>Book List</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books" :key="book.id">
                    <td>{{ book.name }}</td>
                    <td>{{ book.year }}</td>
                    <td>{{ book.author.firstName }} {{ book.author.lastName }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
  
<script>
export default {
    name: "BookListPage",
    data() {
        return {
            books: [],
        };
    },
    mounted() {
        fetch("http://localhost:8080/api/books/get-all")
            .then((response) => response.json())
            .then((data) => {
                this.books = data;
            })
            .catch((error) => {
                console.error("Error fetching book data:", error);
            });
    },
};
</script>
  