<template>
    <ul class="list-group">
        <li class="list-group-item" v-for="orderDetail in orderDetails" :key="orderDetail.id">
            {{orderDetail.name}}
            <span class="float-right">
                {{orderDetail.price}}
                <span class="ml-3" @click="handleRemoveItem(orderDetail)"><button class="btn btn-danger btn-sm">x</button></span>
            </span>
        </li>
    </ul>
</template>

<script>
export default {
    props:['orderDetails'],
    methods:{
        handleRemoveItem(orderDetail){
            window.eventBus.$emit('removeOrderedItem', orderDetail);
        }
    }
}
</script>