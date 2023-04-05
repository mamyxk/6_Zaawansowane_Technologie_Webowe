<template>
    <div class="borrow-book-form">
      <h2>Borrow Book</h2>
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
            <label for="customer">Customer:</label>
            <select id="customer" v-model.number="customerId" required>
                <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                {{ customer.firstName }} {{ customer.lastName }}
                </option>
            </select>
        </div>
        <div class="form-group">
          <label for="book">Books:</label>
          <select id="book" v-model.number="bookId" required>
            <option v-for="book in books" :key="book.id" :value="book.id">
              {{book.author.lastName}} - "{{ book.name }}"
            </option>
          </select>
        </div>
        <div class="form-group">
            <label for="sd" class="form-label">Date of Borrow</label>
            <input type="date" class="form-control" id="sd" placeholder="Enter date of borrow" v-model="dob">
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        customerId: null,
        bookId: null,
        dob: null,
        customers: [],
        books: []
      };
    },
    async created() {
      const responseC = await fetch('http://localhost:8080/api/customers/get-all');
      this.customers = await responseC.json();
      
      const responseB = await fetch('http://localhost:8080/api/books/get-all')
      this.books = await responseB.json();
    },
    methods: {
      async handleSubmit() {
        const response = await fetch('http://localhost:8080/api/borrowings/borrow-book', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            customer: this.customerId,
            book: this.bookId,
            startDate: this.dob
          })
        });
        const data = await response.json();
        console.log(data);
      }
    }
  };
  </script>