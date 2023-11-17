import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'

 //Components
import TheProductList from './components/Products/TheProductList.vue'
import TheCategoryList from './components/Categories/TheCategoryList.vue'
import BackendError from './components/Components/BackendError.vue'


const app = createApp({
    components: {
        TheProductList,
        TheCategoryList

    }
})

app.component('v-select', vSelect)
app.component('backend-error', BackendError)
app.mount('#app')
