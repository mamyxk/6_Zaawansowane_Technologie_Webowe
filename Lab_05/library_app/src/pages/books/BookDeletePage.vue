<template>
  <div>
    <h1 class="text-center mb-4">Book List</h1>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Author</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.name }}</td>
                <td>{{ book.year }}</td>
                <td>{{ book.authorName.firstName }} {{ book.authorName.lastName }}</td>
                <td>
                    <button class="btn btn-danger" @click="deleteBook(book.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
  </div>
</template>
  
<script>
export default {
    name: 'BookDeletePage',
    data() {
        return {
            books: []
        }
    },
    mounted() {
        fetch('http://localhost:8080/api/books/get-all-avail')
            .then(response => response.json())
            .then(data => {
                this.books = data
            })
            .catch(error => {
                console.log(error)
            })
    },
    methods: {
        deleteBook(bookId) {
            fetch('http://localhost:8080/api/books/delete', {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: bookId })
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    this.books = this.books.filter(book => book.id !== bookId)
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}

</script>
  