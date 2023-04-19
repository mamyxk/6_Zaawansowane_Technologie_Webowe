<template>
  <div>
    <h1 class="text-center mb-4">Author List</h1>
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" id="show-active" v-model="showActive">
      <label class="form-check-label" for="show-active">Show active</label>
    </div>
    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>Customer</th>
          <th>Book</th>
          <th>Date of Borrow</th>
          <th>Date of Return</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="borrow in filteredBorrowings" :key="borrow.id">
          <td>{{ borrow.customer.firstName }} {{borrow.customer.lastName}}</td>
          <td>{{ borrow.book.author.firstName }} {{borrow.book.author.lastName}} - {{borrow.book.name}}</td>
          <td>{{ borrow.startDate }}</td>
          <td>{{ borrow.endDate }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "BorrowListPage",
  data() {
    return {
      borrowings: [],
      showActive: false,
      originalBorrowings: []
    };
  },
  mounted() {
    fetch("http://localhost:8080/api/borrowings/book-customers")
      .then((response) => response.json())
      .then((data) => {
        this.borrowings = data;
        this.originalBorrowings = [...data];
      })
      .catch((error) => {
        console.error("Error fetching borrowings data:", error);
      });
  },
  computed: {
    filteredBorrowings() {
      if (this.showActive) {
        return this.borrowings.filter((borrow) => !borrow.endDate);
      } else {
        return this.borrowings;
      }
    }
  }
};
</script>
