<template>
  <h1 class="text-center text-success">Votre configuration en détails</h1>
  <h6 v-if="panier.boitier.marque == undefined">
    Commencez par ajouter un boitier à votre configuration
  </h6>
  <h6 v-if="panier.alimentation.marque == undefined">
    Ajoutez une alimentation à votre configuration
  </h6>
  <h6 v-if="panier.processeur.marque == undefined">
    Ajoutez un processeur à votre configuration
  </h6>
  <h6 v-if="panier.carte_mere.marque == undefined">
    Ajoutez une carte mère à votre configuration
  </h6>
  <h6 v-if="panier.ram.marque == undefined">
    Ajoutez de la mémoire Ram à votre configuration
  </h6>
  <h6 v-if="panier.carte_graphique.marque == undefined">
    Ajoutez une carte graphique à votre configuration<span
      v-if="
        panier.processeur.cg_processeur !== null &&
        panier.processeur.cg_processeur !== undefined
      "
    >
      (Optionnel car votre processeur contient une partie graphique de base)</span
    >
  </h6>
  <h6 v-if="panier.hdd.marque == undefined && panier.ssd.marque == undefined">
    Ajoutez un disque dur à votre configuration
  </h6>
  <div class="container-fluid">
    <!-- si on a un boitier -->
    <div v-if="panier.boitier.marque != undefined">
      <img
        :src="getImgUrl(panier.boitier.categorie.name, panier.boitier.id)"
        class="boitierImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a une alimentation -->
    <div v-if="panier.alimentation.marque != undefined">
      <img
        :src="getImgUrl(panier.alimentation.categorie.name, panier.alimentation.id)"
        class="alimImg"
        alt="image du composant"
      />
    </div>
    <!-- si on a un processeur -->
    <div v-if="panier.processeur.marque != undefined">
      <img
        :src="getImgUrl(panier.processeur.categorie.name, panier.processeur.id)"
        class="processeurImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a une carte mère -->
    <div v-if="panier.carte_mere.marque != undefined">
      <img
        :src="getImgUrl(panier.carte_mere.categorie.name, panier.carte_mere.id)"
        class="carte_mereImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a de la ram -->
    <div v-if="panier.ram.marque != undefined">
      <img
        :src="getImgUrl(panier.ram.categorie.name, panier.ram.id)"
        class="ramImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a une carte graphique -->
    <div v-if="panier.carte_graphique.marque != undefined">
      <img
        :src="getImgUrl(panier.carte_graphique.categorie.name, panier.carte_graphique.id)"
        class="carte_graphiqueImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a un hdd -->
    <div v-if="panier.hdd.marque != undefined">
      <img
        :src="getImgUrl(panier.hdd.categorie.name, panier.hdd.id)"
        class="hddImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a un ssd -->
    <div v-if="panier.ssd.marque != undefined">
      <img
        :src="getImgUrl(panier.ssd.categorie.name, panier.ssd.id)"
        class="ssdImg img-fluid"
        alt="image du composant"
      />
    </div>
  </div>
  <p></p>
  <hr class="mt-4" />
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
  width: 50%;
}
.container-fluid {
  min-width: 90%;
  position: relative;
}
.boitierImg {
  position: relative;
  width: 35%;
  top: 50%;
  left: 50%;
  transform: translate(-50%);
}
.alimImg {
  width: 10%;
  position: absolute;
  top: 0%;
  left: 5%;
}
.processeurImg {
  width: 10%;
  position: absolute;
  top: 40%;
  right: 5%;
}
.carte_mereImg {
  width: 10%;
  position: absolute;
  top: 5%;
  right: 5%;
}
.ramImg {
  width: 10%;
  position: absolute;
  top: 70%;
  right: 5%;
}
.carte_graphiqueImg {
  width: 10%;
  position: absolute;
  top: 30%;
  left: 5%;
}
.hddImg {
  width: 10%;
  position: absolute;
  top: 90%;
  left: 5%;
}
.ssdImg {
  width: 10%;
  position: absolute;
  top: 60%;
  left: 5%;
}
</style>
