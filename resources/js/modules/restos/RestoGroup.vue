<template>
    <div class="resto-group__wrapper mb-5">
        <div class="row">
            <div class="col-md-4 mb-4" v-for="resto in localResto" :key="resto.id">
                <card-component>
                    <template slot="title">{{resto.name}}</template>
                    <template slot="main">
                        {{resto.location}}<br>
                        <a v-bind:href="resto.slug" class="card-link">Menu</a>
                        <a v-bind:href="resto.ordersSlug" class="card-link">Orders</a>
                    </template>
                </card-component>
            </div>

            <div class="col-md-4" v-if="showAddForm">
                <card-component>
                    <template slot="title">Add new Restaurant</template>
                    <template slot="main">
                        <span @click="handleNewResto">+</span>
                    </template>
                </card-component>
                <modal name="add-new-resto" height="60%">
                    <div class="container-padding">
                        <resto-add-form 
                        @modalCancel="handleCancelResto"
                        @addRestoEvent="handleSaveResto"
                        ></resto-add-form>
                    </div>
                </modal>
            </div>
        </div>
    </div>
</template>

<script>
import RestoAddForm from './RestoAddForm.vue';
import axios from 'axios';
    export default{
        components:{
            RestoAddForm
        },
        props: ['restos'],
        created(){
            console.log('this.restos.length', this.restos.length);
            this.localResto = this.restos;
        },
        computed:{
            showAddForm(){
                return (this.localResto.length < 5) ? true : false;
            }
        },
        data(){
            return{
                localResto:[]
            }
        },
        methods:{
            handleNewResto(){
               this.$modal.show('add-new-resto');
            },
            handleCancelResto(){
                this.$modal.hide('add-new-resto');
            },

            handleSaveResto(restoData){
                console.log(restoData);
                axios.post('/api/resto', restoData).
                then(response=>{
                    console.log(response.data);
                    this.localResto.unshift(response.data);
                })
                .catch(err=>{
                    console.log(err);
                });
                this.$modal.hide('add-new-resto');
            }
        }
    }
</script>