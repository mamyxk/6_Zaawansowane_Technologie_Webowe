<template>
  <div>
    <h1 class="text-center mb-4">Book List</h1>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Author</th>
                <th>Inaccessible?</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.name }}</td>
                <td>{{ book.year }}</td>
                <td>{{ book.author.firstName }} {{ book.author.lastName }}</td>
                <td>{{ book.deleted }}</td>
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
        fetch("http://localhost:8080/api/books/get-all-full")
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
  