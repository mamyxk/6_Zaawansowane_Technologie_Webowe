<template>
    <div class="borrow-book-form">
      <h2>Borrow Book</h2>
      <form @submit.prevent="handleSubmit">
        <div class="form-group">
          <label for="borrow">Borrowings:</label>
          <select id="borrow" v-model.number="bookId" required>
            <option v-for="borrow in customersBooks" :key="borrow.id" :value="borrow.id">
              {{customersBooks.customer.firstName}} {{customersBooks.customer.lastName}}
               - {{customersBooks.book.author.firstName}} : "{{ customersBooks.book.name }}"
            </option>
          </select>
        </div>
        <div class="form-group">
            <label for="ed" class="form-label">Date of Return</label>
            <input type="date" class="form-control" id="ed" placeholder="Enter date of borrow" v-model="dor">
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        customerBookId: null,
        dor: null,
        customersBooks: []
      };
    },
    async created() {
      const response = await fetch('http://localhost:8080/api/borrowings/book-customers');
      this.customersBooks = await response.json();
    },
    methods: {
      async handleSubmit() {
        const response = await fetch('http://localhost:8080/api/borrowings/hand-back-book', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            endDate: this.dor
          })
        });
        const data = await response.json();
        console.log(data);
      }
    }
  };
  </script>