<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-12">
                <button class="btn btn-success float-right" @click="handleOrderSave">Save</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="mb-5">
                    <h3>Customer Details</h3>
                    <order-form @customerDetailsChanged="customerDetailsHandle"></order-form>
                </div>

                <div class="mt-5">
                    <h3>Order Details <span v-if="(finalAmount > 0)" class="float-right">{{finalAmount}}</span></h3>
                    <order-details :order-details="orderDetails"></order-details>
                </div>
            </div>
            <div class="col-md-5">
                <h3>Menu</h3>
                <order-menu-items :items="menuItems" v-on:menu-item-added="handleNewMenuItem"></order-menu-items>
            </div>
        </div>
    </div>
</template>

<script>
import OrderForm from './OrderForm';
import OrderMenuItems from './OrderMenuItems';
import OrderDetails from './OrderDetails';
import axios from 'axios';
export default {
    props:['restoId'],
    components:{
        OrderForm,
        OrderMenuItems,
        OrderDetails
    },
    created(){
        this.loadRestoMenuItems();
        window.eventBus.$on('menu-item-added', this.handleNewMenuItem);
        window.eventBus.$on('filteredList', this.handleFilteredList);
        window.eventBus.$on('clearFilteredList', this.handleClearFilteredList);
        // window.eventBus.$on('customerDetailsChanged', this.handleClearFilteredList);
        window.eventBus.$on('removeOrderedItem', this.handleRemoveOrderedItem);
    },
    computed:{
        finalAmount(){
            let price = 0;
            this.orderDetails.forEach(order => {
                price = price + order.price;
            });
            return price;
        }
    },
    data(){
        return {
            menuItems:[],
            orderDetails:[],
            originalMenuItems:[],
            customerDetails: null
        }
    },
    methods: {
        loadRestoMenuItems(){
            let postData = {restoId: this.restoId};
            axios.post('/api/resto/menu', postData)
            .then(response=>{
             this.menuItems = response.data
             this.originalMenuItems = response.data
            })
            .catch(error => console.error(error.response));
        },
        
        handleClearFilteredList(){
            this.menuItems = this.originalMenuItems;
        },

        handleNewMenuItem(item){
            this.orderDetails.unshift(item);
        },
        handleFilteredList(filteredList){
            this.menuItems = filteredList;
        },

        customerDetailsHandle(customer){
            //console.log(customer);
            this.customerDetails = customer;
        },

        handleRemoveOrderedItem(item){
            this.orderDetails = this.orderDetails.filter(orderDetails => orderDetails.id != item.id);
        },

        handleOrderSave(){
            let orderedItemsIds = [];
            this.orderDetails.forEach(item => {
                orderedItemsIds.push(item.id);
                //console.log(item.id);
            });
            let orderData = {
                resto_id : this.restoId,
                order_data:{
                    customerDetails: this.customerDetails,
                    totalPrice: this.finalAmount,
                    orderDetails: orderedItemsIds
                }
            }
            console.log(orderData);
            axios.post('/api/order/save', orderData).then(response=>console.log(response))
            .catch(error=>console.log(error))
        },
        
    }
}
</script>