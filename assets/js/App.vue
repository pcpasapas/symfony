div<template>
  <div v-if="!loadingcat">
        <p class="mb-0">Sélectionnez votre catégorie pour voir les composants :</p>
        <select @change="onChange" name="catégories" id="categories-select">
            <option v-for="categorie in categories">{{ categorie.name }}</option>
        </select>
        <div v-if="!loadingcomp">
            <div v-for="composant in composants">
                <h1>{{  composant.marque }}</h1>
            </div>
        </div>


</div>
</template>
<script>
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
}
</script>
