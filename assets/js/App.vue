div<template>
  <div v-if="!loadingcat">
        <p class="mb-0">Sélectionnez votre catégorie pour voir les composants :</p>
        <select @change="onChange" name="catégories" id="categories">
            <option name="categories" id="categories" v-for="categorie in categories" :value='categorie.id'>{{ categorie.name }}</option>
        </select>
        <div class="d-flex" v-if="!loadingcomp">
            <div v-for="composant in composants">
                <cardComposant :composant="composant" :key="composant.id"></cardComposant>
            </div>
        </div>


</div>
</template>
<script>
import axios from 'axios'
import cardComposant from './components/cardComposant.vue';
export default {
    props:['cats'],
    data() {
        return {
            categories: [],
            loadingcat: true,
            loadingcomp: true,
            categorie: 1,
            username: "",
            composants: []
        }
    },

    beforeMount() {
    this.loadingcat = true;
    this.loadingcomp = true;
    axios.get('api/categorie').then((response) => {
        this.categories = response.data}).then(() => {this.loadingcat = false})
    axios.get('/composants/' + this.categorie).then((response) => {
        this.composants = response.data}).then(() => {this.loadingcomp = false})
    },
    methods: {
        onChange(e) {
            this.loadingcomp = true;
            this.categorie = e.target.value
            axios.get('/composants/' + (this.categorie))
                .then((response) => {this.composants = response.data})
                .then(() => {this.loadingcomp = false})

        }
    },
    components: {cardComposant}
}
</script>
