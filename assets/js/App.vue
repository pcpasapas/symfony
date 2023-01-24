div<template>
  <div v-if="!loadingcat">
        <p class="mb-0">Sélectionnez votre catégorie pour voir les composants :</p>
        <select @change="onChange" name="catégories" id="categories-select">
            <option v-for="categorie in categories">{{ categorie.name }}</option>
        </select>
        <div class="d-flex" v-if="!loadingcomp">
            <div  v-for="composant in composants">
                <cardComposant :composant="composant"></cardComposant>
            </div>
        </div>


</div>
</template>
<script>

import cardComposant from './components/cardComposant.vue';
export default {
    props:['cats'],
    data() {
        return {
            categories: [],
            loadingcat: true,
            loadingcomp: true,
            categorie: "Boitiers",
            username: "",
            composants: []
        }
    },
    async mounted() {
    this.loadingcat = true;
    const response = await fetch('api/categories')
    const data = await response.json()
    this.categories = await data['hydra:member']
    const response2 = await fetch('/composants/' + this.categorie)
    this.composants = await response2.json()
    this.loadingcomp = false;
    this.loadingcat = false;
    },
    methods: {
        async onChange(e) {
            this.loadingcomp = true;
            this.categorie = e.target.value
            const response = await fetch('/composants/' + this.categorie)
            this.composants = await response.json()
            this.loadingcomp = false;
        }
    },
    components: {cardComposant}
}
</script>
