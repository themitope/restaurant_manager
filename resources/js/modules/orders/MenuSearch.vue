<template>
    <div class="wrapper">
        <input type="text" class="form-control" placeholder="Type to search" v-model="searchString"/>
    </div>
</template>
<script>
export default {
    props: ['items'],
    data(){
        return{
           searchString: '',
        }
    },

    computed:{
        filteredList(){
            return this.items.filter(item =>{
                return item.name.toLowerCase().includes(this.searchString.toLowerCase());
            })
        }
    },

    watch:{
        searchString(value){
            //console.log("value changed", value);
            if(value != ''){
                window.eventBus.$emit('filteredList', this.filteredList);
            }else{
                window.eventBus.$emit('clearFilteredList');
            }

        }
    }
}
</script>