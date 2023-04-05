<template>
    <div class="add-customer-form">
        <h2>Add Customer</h2>
        <form @submit.prevent="handleSubmit">
            <div class="mb-3">
                <label for="first-name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first-name" placeholder="Enter first name" v-model="customer.firstName">
            </div>
            <div class="mb-3">
                <label for="last-name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last-name" placeholder="Enter last name" v-model="customer.lastName">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="customer.email">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" placeholder="Enter date of birth" v-model="customer.dob">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
  name: 'CustomerAddPage',
  data() {
    return {
      customer: {
        firstName: '',
        lastName: '',
        email: '',
        dob: null
      },
    };
  },
  methods: {
    async handleSubmit() {
      try {
        const response = await fetch('http://localhost:8080/api/customers/add-customer', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.customer),
        });
        if (!response.ok) {
          throw new Error('Failed to add customer');
        }
        // Handle successful response here
      } catch (error) {
        console.error(error);
        // Handle error here
      }
    },
  },
};
</script>