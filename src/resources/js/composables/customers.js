import { ref } from 'vue'
import axios from 'axios'
import store from './../store'
import { useToast } from 'vue-toastification'

export default function useCustomers() {
    const customers = ref([])
    const customer = ref({})
    const toast = useToast();

    const getCustomers = async () => {
        const config = {
            headers: {
                'Authorization': store.getters.bearerToken
            }
        }

        let response = await axios.get('/api/customer', config)
        customers.value = response.data.data
        toast.success(response.data.message)
    }

    const getCustomer = async (customerId) => {
        const config = {
            headers: {
                'Authorization': store.getters.bearerToken
            }
        }

        let response = await axios.get('/api/customer/' + customerId, config)
        customer.value = response.data.data
        toast.success(response.data.message)
    }

    return {
        customers,
        customer,
        getCustomers,
        getCustomer,
    }
}
