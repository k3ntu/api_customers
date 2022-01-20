<template>
    <div class="container">
        <div class="row justify-content-center mb-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Find Customer
                    </div>

                    <div class="card-body">
                        <div class="w-full flex">
                            <input type="number" v-model="state.customerId" @keydown.enter="findCustomerById">
                            <button class="btn btn-primary mx-2" @click="findCustomerById">
                                Search
                            </button>
                        </div>
                        <table id="dtBasicExample1" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%" v-show="customer.id > 0">
                            <thead>
                            <tr>
                                <th class="th-sm">
                                    Name
                                </th>
                                <th class="th-sm">
                                    First Name
                                </th>
                                <th class="th-sm">
                                    Last Name
                                </th>
                                <th class="th-sm">
                                    Email
                                </th>
                                <th class="th-sm">
                                    Gender
                                </th>
                                <th class="th-sm">
                                    City
                                </th>
                                <th>
                                    Latitude
                                </th>
                                <th>
                                    Longitude
                                </th>
                                <th class="th-sm">
                                    Title
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{ customer.id }}
                                </td>
                                <td>
                                    {{ customer.first_name }}
                                </td>
                                <td>
                                    {{ customer.last_name }}
                                </td>
                                <td>
                                    {{ customer.email }}
                                </td>
                                <td>
                                    {{ customer.gender }}
                                </td>
                                <td>
                                    {{ customer.city }}
                                </td>
                                <td>
                                    {{ customer.latitude }}
                                </td>
                                <td>
                                    {{ customer.longitude }}
                                </td>
                                <td>
                                    {{ customer.title }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Customers | <span class="italic">{{ customers.length }} entries</span>
                    </div>

                    <div class="card-body">
                        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="th-sm">
                                    Name
                                </th>
                                <th class="th-sm">
                                    First Name
                                </th>
                                <th class="th-sm">
                                    Last Name
                                </th>
                                <th class="th-sm">
                                    Email
                                </th>
                                <th class="th-sm">
                                    Gender
                                </th>
                                <th class="th-sm">
                                    City
                                </th>
                                <th class="th-sm">
                                    Title
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="c in customers" :key="c.id">
                                    <td>
                                        {{ c.id }}
                                    </td>
                                    <td>
                                        {{ c.first_name }}
                                    </td>
                                    <td>
                                        {{ c.last_name }}
                                    </td>
                                    <td>
                                        {{ c.email }}
                                    </td>
                                    <td>
                                        {{ c.gender }}
                                    </td>
                                    <td>
                                        {{ c.city }}
                                    </td>
                                    <td>
                                        {{ customer.latitude }}
                                    </td>
                                    <td>
                                        {{ customer.longitude }}
                                    </td>
                                    <td>
                                        {{ c.title }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useCustomers from '../composables/customers'
import { reactive, onMounted, computed, watch } from 'vue'

export default {
    setup() {
        const { customers, customer, getCustomers, getCustomer, } = useCustomers()

        const state = reactive({
            loading: false,
            counts: 0,
            customerId: '',
            errorMessage: ''
        })

        onMounted(() => {
            getCustomers()
        })

        const findCustomerById = () => {
            getCustomer(state.customerId);
            getCustomers()
        }

        return {
            customers,
            customer,
            findCustomerById,
            state,
        }
    }
}
</script>
