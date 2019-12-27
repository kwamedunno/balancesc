<template>

    <div>
        <button type="submit" class="create-button" v-text = "text"></button>
    </div>
    
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style >
    .create-button {
        background-color:blue;
        height:500px; 
        width:200px;
        color:#ffffff;
    }
</style>
