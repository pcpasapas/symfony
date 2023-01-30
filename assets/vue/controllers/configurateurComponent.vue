<template>
  <div v-if="!loadingCat">
    <p class="mb-0">Sélectionnez votre catégorie :</p>
    <div class="mx-5 my-2">
      <select
        class="form-select form-select-lg shadow-lg"
        @change="onChange"
        v-model="categorieSelect"
        name="catégories"
        id="categoriesSelect"
      >
        <option
          name="categories"
          id="categories"
          v-for="categorie in categoriesFilterFn"
          :value="categorie.id"
          :key="categorie.id"
        >
          {{ categorie.name }}
        </option>
      </select>
    </div>
    <div class="d-flex flex-wrap mx-auto" v-if="!loadingComp">
      <div v-for="composant in composantsLoad" :key="composant.id" class="mx-auto">
        <cardComposant :composant="composant" :key="composant.id"></cardComposant>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import cardComposant from "./cardComposant.vue";

export default {
  props: ["categories", "panier"],
  data() {
    return {
      loadingCat: true,
      loadingComp: true,
      categorie: 1,
      composantsLoad: [],
      categoriesFilter: this.categories,
      categorieSelect: "",
    };
  },

  mounted() {
    this.categorieSelect = this.categoriesFilterFn[0].id;
    this.onChange();
  },

  computed: {
    categoriesFilterFn() {
      for (let composant in this.panier) {
        for (let categorie in this.categoriesFilter)
          if (this.panier[composant].categorie !== undefined) {
            if (
              this.categories[categorie].name === this.panier[composant].categorie.name
            ) {
              this.categoriesFilter.splice(categorie, 1);
            }
          }
      }
      return this.categoriesFilter;
    },
  },

  methods: {
    onChange() {
      axios
        .get("/composants/" + this.categorieSelect)
        .then((response) => {
          this.composantsLoad = response.data;
        })
        .then(() => {
          this.loadingComp = false;
          this.loadingCat = false;
        });
    },
  },
  components: { cardComposant },
};
</script>
