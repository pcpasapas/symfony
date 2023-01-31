<!-- eslint-disable vue/no-side-effects-in-computed-properties -->
<template>
  <div v-if="prixTotalPanier !== 0">
    <table class="table table-hover table-sm caption-top table-responsive">
      <caption>
        Votre configuration
      </caption>
      <thead>
        <tr class="table-primary">
          <th scope="col">Composant</th>
          <th scope="col">Marque</th>
          <th>Modèle</th>
          <th>Prix</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(composant, index) in panierLoad" :key="index">
          <tr class="" v-if="composant.length !== 0">
            <th>{{ composant.categorie.name }}</th>
            <td>{{ composant.marque }}</td>
            <td>{{ composant.modele }}</td>
            <td>{{ (composant.price / 100).toFixed(2) }} €</td>
            <td>
              <a
                :href="'/cart/remove/' + composant.categorie['panier_bdd_name']"
                class="btn btn-danger p-1"
                >Supprimer</a
              >
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <p class="text-end fs-5">
      Prix total de votre configuration :
      {{ (prixTotalPanier / 100).toFixed(2) }}
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
