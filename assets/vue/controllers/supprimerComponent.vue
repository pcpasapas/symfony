<template>
    <div>
        <button type="button" class="btn btn-danger p-1" @click="supprimer(composant.cat)">Supprimer</button>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    props: ['composant'],
    methods: {
        supprimer(composant) {
            axios.get('/cart/remove/' + composant)
        }
    }

}
</script>
<style>

</style>
