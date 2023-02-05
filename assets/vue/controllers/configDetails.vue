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
      <div class="alimText">
        <span>{{ panier.alimentation.marque }}</span>
        <p>{{ panier.alimentation.puissance }} W</p>
      </div>
      <img
        :src="getImgUrl(panier.alimentation.categorie.name, panier.alimentation.id)"
        class="alimImg"
        alt="image du composant"
      />
    </div>
    <!-- si on a un processeur -->
    <div v-if="panier.processeur.marque != undefined">
      <div class="processeurText">
        <span>{{ panier.processeur.modele_min }}</span>
        <p class="mb-0">{{ panier.processeur.puissance / 10 }} Mhz</p>
        <p>{{ panier.processeur.couleur }} coeurs</p>
      </div>
      <img
        :src="getImgUrl(panier.processeur.categorie.name, panier.processeur.id)"
        class="processeurImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a une carte mère -->
    <div v-if="panier.carte_mere.marque != undefined">
      <div class="carte_mereText">
        <span>{{ panier.carte_mere.socket }}</span>
      </div>
      <img
        :src="getImgUrl(panier.carte_mere.categorie.name, panier.carte_mere.id)"
        class="carte_mereImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a de la ram -->
    <div v-if="panier.ram.marque != undefined">
      <div class="ramText">
        <p class="mt-0">RAM : {{ panier.ram.puissance }} Go</p>
      </div>
      <img
        :src="getImgUrl(panier.ram.categorie.name, panier.ram.id)"
        class="ramImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a une carte graphique -->
    <div v-if="panier.carte_graphique.marque != undefined">
      <div class="carte_graphiqueText">
        <p class="mb-0">{{ panier.carte_graphique.modele_min }}</p>
        <p class="mt-0">{{ panier.carte_graphique.puissance }} Go</p>
      </div>
      <img
        :src="getImgUrl(panier.carte_graphique.categorie.name, panier.carte_graphique.id)"
        class="carte_graphiqueImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a un hdd -->
    <div v-if="panier.hdd.marque != undefined">
      <div class="hddText">
        <span>HDD : {{ panier.hdd.puissance }} Go</span>
      </div>
      <img
        :src="getImgUrl(panier.hdd.categorie.name, panier.hdd.id)"
        class="hddImg img-fluid"
        alt="image du composant"
      />
    </div>
    <!-- si on a un ssd -->
    <div v-if="panier.ssd.marque != undefined">
      <div class="ssdText">
        <span>SSD : {{ panier.ssd.puissance }} Go</span>
      </div>
      <img
        :src="getImgUrl(panier.ssd.categorie.name, panier.ssd.id)"
        class="ssdImg img-fluid"
        alt="image du composant"
      />
    </div>
  </div>
  <hr />
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
.container-fluid {
  min-width: 95%;
  position: relative;
  min-height: 220px;
}
</style>
<style>
img {
  margin: auto;
  width: 50%;
}
.boitierImg {
  position: relative;
  width: 35%;
  top: 50%;
  left: 50%;
  transform: translate(-50%);
}
.alimText {
  position: absolute;
  top: 0%;
  left: 15%;
}
.alimImg {
  width: 10%;
  position: absolute;
  top: 0%;
  left: 1%;
}
.processeurImg {
  width: 10%;
  position: absolute;
  top: 40%;
  right: 1%;
}
.carte_mereText {
  position: absolute;
  top: 5%;
  right: 13%;
}
.carte_mereImg {
  width: 10%;
  position: absolute;
  top: 5%;
  right: 1%;
}
.ramImg {
  width: 10%;
  position: absolute;
  top: 70%;
  right: 1%;
}
.carte_graphiqueText {
  position: absolute;
  top: 30%;
  left: 15%;
}
.carte_graphiqueImg {
  width: 10%;
  position: absolute;
  top: 30%;
  left: 1%;
}
.hddText {
  position: absolute;
  top: 90%;
  left: 15%;
}
.hddImg {
  width: 10%;
  position: absolute;
  top: 90%;
  left: 1%;
}
.ssdText {
  position: absolute;
  top: 60%;
  left: 15%;
}
.ssdImg {
  width: 10%;
  position: absolute;
  top: 60%;
  left: 1%;
}
</style>
