<template>
    <div>
        <h1>Customer List</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Second</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers" :key="customer.id">
                    <td>{{ customer.firstName }}</td>
                    <td>{{ customer.lastName }}</td>
                    <td>{{ customer.email }}</td>
                    <td>{{ customer.dateOfBirth }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
  
<script>
export default {
    name: "CustomerListPage",
    data() {
        return {
            customers: [],
        };
    },
    mounted() {
        fetch("http://localhost:8080/api/customers/get-all")
            .then((response) => response.json())
            .then((data) => {
                this.customers = data;
            })
            .catch((error) => {
                console.error("Error fetching customer data:", error);
            });
    },
};
</script>