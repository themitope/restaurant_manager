<template>
    <div class="resto_add_form_wrapper">
        <h3>Add a new Restaurant</h3>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" 
            class="form-control" 
            name="name" v-model="resto.name" 
            placeholder="Enter restaurant name">
        </div>
        <div class="form-group">
            <label for="name">Location</label>
            <input type="text" 
            class="form-control" 
            name="location"  
            v-model="resto.location" 
            placeholder="Enter restaurant location">
        </div>
        <div class="form-group">
            <label for="name">Number of table</label>
            <input type="number" 
            class="form-control" 
            name="tables" 
            v-model="resto.tables" 
            placeholder="Enter restaurant tables">
        </div>

        <button class="btn btn-primary" @click="handleAddButton">Add</button>
        <button class="btn btn-warning" @click="handleCancelButton">Cancel</button>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    // created(){
    //     axios.get('/api/user')
    //     .then(response => {
    //         console.log(response.data);
    //     });
    // },
    data(){
        return {
            resto: this.basicResto()
        }
    },
    methods:{
        basicResto(){
           return {
                name: "",
                location:"",
                tables: 0
           } 
        },
        handleAddButton(){
            this.$emit('addRestoEvent', this.resto);
        },
        handleCancelButton(){
            this.resto = this.basicResto();
            this.$emit('modalCancel');
        }
    }
}
</script>