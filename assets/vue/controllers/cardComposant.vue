<template>
  <div class="card m-2" style="width: 18rem">
    <img :src="getImgUrl(composant.categorie.name + composant.id )" class="card-img-top" alt="image du composant" />
    <div class="card-body">
      <h5 class="card-title">{{ composant.marque }}</h5>
      <h6 class="card-text">{{ composant.modele }}</h6>
      <h5 class="card-title">{{ (composant.price / 100).toFixed(2) }} €</h5>
      <p class="card-text">
      </p>
      <a :href="'/cart/' + composant.id" class="btn btn-primary">Ajouter à votre configuration</a>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    composant: {}
  },
  methods: {
    getImgUrl(pic) {
    return require('../../../public/images/'+pic +'.jpg');
}
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
