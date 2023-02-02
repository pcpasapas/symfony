<!-- eslint-disable vue/no-side-effects-in-computed-properties -->
<template>
  <hr />
  <div v-if="prixTotalPanier !== 0">
    <h1 class="text-center text-success">Votre configuration</h1>
    <table class="table table-hover table-sm caption-top table">
      <thead>
        <tr class="table-success">
          <th class="col-1">Composant</th>
          <th class="col-2">Marque</th>
          <th class="col-2">Modèle</th>
          <th class="col-2">Prix</th>
          <th class="col-2"></th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(composant, index) in panierLoad" :key="index">
          <tr v-if="composant.length !== 0">
            <th class="col">{{ composant.categorie.name }}</th>
            <td class="col">{{ composant.marque }}</td>
            <td class="col">{{ composant.modele }}</td>
            <td class="col">
              {{ (composant.price / 100).toFixed(2).replace(".", ",") }} €
            </td>
            <td class="col">
              <a
                :href="'/cart/remove/' + composant.categorie['panier_bdd_name']"
                class="btn btn-danger p-1 mx-auto"
                >Supprimer</a
              >
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <p class="text-end fs-5">
      Prix total de votre configuration :
      {{ (prixTotalPanier / 100).toFixed(2).replace(".", ",") }}
      €
    </p>
  </div>
</template>

<!-- eslint-disable vue/no-side-effects-in-computed-properties -->
<script>
export default {
  props: ["panier"],
  data() {
    return {
      panierLoad: [],
      loadingpanier: true,
      prixTotal: 0,
    };
  },
  mounted() {
    this.panierLoad = this.panier;
    this.loadingpanier = false;
  },
  computed: {
    prixTotalPanier() {
      this.prixTotal = 0;
      for (let composant in this.panierLoad) {
        if (this.panierLoad[composant].price !== undefined) {
          this.prixTotal = this.prixTotal + this.panierLoad[composant].price;
        }
      }
      return this.prixTotal;
    },
  },
};
</script>
