<template>
  <h1>Votre configuration en détails</h1>
  <h6 v-if="panier.boitier.marque == undefined">
    Commencez par ajouter un boitier à votre configuration
  </h6>
  <h6 v-if="panier.alimentation.marque == undefined">
    Ajoutez une alimentation à votre configuration
  </h6>
  <h6 v-if="panier.processeur.marque == undefined">
    Ajoutez un processeur à votre configuration
  </h6>
  <!-- si on a un boitier -->
  <div v-if="panier.boitier.marque != undefined">
    {{ panier.boitier.marque }}
    <img
      :src="getImgUrl(panier.boitier.categorie.name, panier.boitier.id)"
      class="card-img-top"
      alt="image du composant"
    />
  </div>
  <!-- si on a une alimentation -->
  <div v-if="panier.alimentation.marque != undefined">
    {{ panier.alimentation.marque }}
    <img
      :src="getImgUrl(panier.alimentation.categorie.name + panier.alimentation.id)"
      class="card-img-top"
      alt="image du composant"
    />
  </div>
</template>

<script>
export default {
  props: ["panier"],
  methods: {
    getImgUrl(cat, id) {
      // eslint-disable-next-line no-undef
      return require("../../../public/images/" + cat + "/" + id + ".jpg");
    },
  },
};
</script>

<style scoped>
img {
  margin: auto;
  height: 140px;
  width: auto;
}
</style>
