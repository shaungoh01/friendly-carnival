<template>
    <autocomplete v-bind:items="items" v-on:input="titleSearch" :isAsync="isAsync" name="title"></autocomplete>
</template>

<script>
    export default {
        name:"article-searchbar",
        data(){
            return {
                items: [],
                isAsync :true
            }
        },
        methods:{
            titleSearch: function(search){
                axios.get('/articles?title='+search+'&format=array')
                    .then(response => {
                        console.log(response.data);
                        this.items = response.data
                        });
            }
        },
        mounted() {
            console.log('SearchBar mounted.')
        }
    }
</script>
