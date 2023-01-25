<template>
  <div>
    <p class="mb-0">Sélectionnez votre catégorie pour voir les composants :</p>
    <select @change="onChange" name="catégories" id="categories">
      <option
        name="categories"
        id="categories"
        v-for="categorie in categories"
        :value="categorie.id"
      >
        {{ categorie.name }}
      </option>
    </select>
    <div class="d-flex" v-if="!loadingcomp">
      <div v-for="composant in composantsLoad">
        <cardComposant
          :composant="composant"
          :key="composant.id"
        ></cardComposant>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import cardComposant from "./cardComposant.vue";
import supprimerComponent from "./supprimerComponent.vue";

export default {
  props: ["categories", "composants"],
  data() {
    return {
      loadingcat: true,
      loadingcomp: true,
      categorie: 1,
      username: "",
      composantsLoad: [],
    };
  },

  mounted() {
    this.composantsLoad = this.composants
    this.loadingcomp = false
  },

  methods: {
    onChange(e) {
      this.loadingcomp = true;
      this.categorie = e.target.value;
      axios
        .get("/composants/" + this.categorie)
        .then((response) => {
          this.composantsLoad = response.data;
        })
        .then(() => {
          this.loadingcomp = false;
        });
    },
  },
  components: { cardComposant, supprimerComponent },
};
</script>
