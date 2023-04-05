<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
          <div class="card-header">
            <h3 class="text-center font-weight-light my-4">Borrow Book</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <div class="form-floating mb-3">
                <label for="customer">Customer:</label>
                <br>
                <select id="customer" v-model.number="customerId" required class="form-control">
                  <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                    {{ customer.firstName }} {{ customer.lastName }}
                  </option>
                </select>
              </div>
              <div class="form-floating mb-3">
                <label for="book">Books:</label>
                <br>
                <select id="book" v-model.number="bookId" required class="form-control">
                  <option v-for="book in books" :key="book.id" :value="book.id">
                    {{ book.author.lastName }} - "{{ book.name }}"
                  </option>
                </select>
              </div>
              <div class="form-floating mb-3">
                <label for="sd">Date of Borrow:</label>
                <input type="date" class="form-control" id="sd" placeholder="Enter date of borrow" v-model="dob">
              </div>
              <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
      
      const responseB = await fetch('http://localhost:8080/api/books/get-all-full')
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