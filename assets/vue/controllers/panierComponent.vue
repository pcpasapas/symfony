<template>
    <div>
    <table class="table table-hover table-sm caption-top table-responsive">
        <caption>Votre configuration</caption>
        <thead>
            <tr class="table-primary">
                <th scope="col">Marque</th>
                <th>Modèle</th>
                <th>Prix</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
                <tr class="" v-for="composant, index in panier"  :key="index">
                    <div v-if="composant !== null">
                    <td>{{ composant.marque }}</td>
                    <td>{{ composant.modele }}</td>
                    <td>{{ (composant.price / 100).toFixed(2) }} €</td>
                    <td><a :href="'/cart/remove/' + composant.categorie['panier_bdd_name']" class="btn btn-danger p-1">Supprimer</a></td>
                </div>
                </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
export default {
    props : ['panier'],
    data() {
        return {
            panierLoad : {},
            loadingpanier : true,
        }
    },
    mounted() {
    this.panierLoad = this.panier
    this.loadingpanier = false
  },

}
</script>
