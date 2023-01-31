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
    <h6 v-if="message != ''">{{ message }}</h6>
    <h6 v-if="message2 != ''">{{ message2 }}</h6>
    <Transition appear name="slide-fade">
      <div class="d-flex flex-wrap mx-auto" v-if="!loadingComp">
        <div v-for="composant in composantsLoad" :key="composant.id" class="mx-auto">
          <cardComposant :composant="composant" :key="composant.id"></cardComposant>
        </div>
      </div>
    </Transition>
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
      message: "",
      message2: "",
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
              // eslint-disable-next-line vue/no-side-effects-in-computed-properties
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
        .catch((err) => console.log(err, this.composantsLoad))
        .then((response) => {
          console.log(response.data);
          this.composantsLoad = response.data[0];
          this.message = response.data[1];
          this.message2 = response.data[2];
        })
        .catch((err) => console.log(err, this.composantsLoad))
        .then(() => {
          this.loadingComp = false;
          this.loadingCat = false;
        });
    },
  },
  components: { cardComposant },
};
</script>

<style>
.slide-fade-enter-active {
  transition: all 1s ease-out;
}
.slide-fade-leave-active {
  transition: all 1s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateY(-20px);
  opacity: 0;
}
</style>
