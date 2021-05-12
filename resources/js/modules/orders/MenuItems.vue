<template>
     <ul class="list-group mt-3">
        <li class="list-group-item" v-for="item in items" :key=item.id>
            <div class="row">
                <div class="col-md-10">
                    {{item.name}} <span class="float-right  ">{{item.price}}</span>
                    <br>
                    <small>{{item.category.name}}</small>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-sm" @click="handleAddButton(item)">Add</button>
                </div>
            </div>
        </li>
    </ul>
</template>
<script>
export default {
    props:['items'],
    methods:{
        handleAddButton(item){
            window.eventBus.$emit('menu-item-added', item);
        }
    }
}
</script>