<template>
  <div class="card m-2 py-2" style="width: 18rem">
    <img
      :src="getImgUrl(composant.categorie.name, composant.id)"
      class="card-img-top"
      alt="image du composant"
    />
    <div class="card-body">
      <h5 class="card-title">{{ composant.marque }}</h5>
      <h6 class="card-text">{{ composant.modele }}</h6>
      <h5 class="card-title">{{ (composant.price / 100).toFixed(2) }} €</h5>
      <p class="card-text"></p>
      <p class="card-text" v-if="composant.format !== null">
        Format : {{ formatMaxFn(composant.format) }}
      </p>
      <p class="card-text m-0" v-if="composant.socket !== null">
        Socket : {{ composant.socket }}
      </p>
      <p class="card-text" v-if="composant.cgProcesseur !== null">
        Graphiques intégrés : {{ composant.cgProcesseur }}
      </p>
      <a :href="'/cart/' + composant.id" class="btn btn-primary shadow-lg"
        >Ajouter à votre configuration</a
      >
    </div>
  </div>
</template>

<script>
export default {
  props: {
    composant: {},
  },
  methods: {
    getImgUrl(cat, id) {
      // eslint-disable-next-line no-undef
      return require("../../../public/images/" + cat + "/" + id + ".jpg");
    },
    formatMaxFn(format) {
      format = format.split(" ");
      return format[format.length - 1];
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
