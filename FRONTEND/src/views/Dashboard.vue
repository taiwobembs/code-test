<template>
  <section style="width: 100%">
    <NavMain />
    <v-content style="clear: both;padding: 2%;margin:0;width: 100%">
      <h1 class="subHeading middle">All Products</h1>
      <sweetalert-icon icon="loading" v-show="showLoadingIcon" />

      <section class="SearchResults" v-show="showSearchResults">

        <section class="searchListings">
          <article v-for="searchResult in searchResults" :key="searchResult.id">
            <v-img
              v-bind:alt="searchResult.name"
              :v-bind:title="searchResult.name"
              class="mt-1"
              :src="searchResult.image"
              width="100"
            />
            <h2 :title="searchResult.name">{{searchResult.name}}</h2>
            <span>{{searchResult.description}} </span><span style="font-weight: bolder;color: #ff0000"> |  ${{searchResult.price}}</span>
          </article>
          <section class="clearfix"></section>  
        </section>

      </section>
    </v-content>
    <Footer />
  </section>
</template>

<script>
import store from "../store";
import NavMain from "../components/Navs/NavMain.vue";
import Footer from "../components/Footers/Footer.vue";
import { appMixin } from "../mixins/appMixin.js";
import axios from "axios";

export default {
  name: "Dashboard",
  mixins: [appMixin],
  components: {
    NavMain,
    Footer
  },
  created: function() {
    let vmObjectInstance = this;

    axios
      .get(this.getProductsEndpoint)
      .then(function(response) {
        if (JSON.stringify(response.data) !='{}') {
          vmObjectInstance.searchResults = response.data.data;
          vmObjectInstance.showLoadingIcon = false;
          vmObjectInstance.showSearchResults = true;
        }
      })
      .catch(function(error) {
        console.error(error);
      });
  },
  data: () => ({
    getProductsEndpoint: store.state.urlStore.baseUrl + store.state.urlStore.productsUrl,
    searchResults: [],
    showLoadingIcon: true,
    showSearchResults: false
  }),
  computed: {
    getAppName() {
      return store.state.commonStore.appName;
    }
  },
  methods: {
  }
};
</script>

<style scoped>

.subHeading{
  color: #000000;
  font-size: 1.2em;
  text-align: left;
  margin: 20px 0;
  font-weight: 300;
}

.clearfix{
  clear: both;
}

.middle{
  text-align: center
}


.searchListings > article{
  width: 22.9%;
  height: 230px;
  box-shadow: 0px 2px 6px rgb(33 33 38 / 12%);
  float: left;
  padding: 1%;
  margin: 10px 20px 20px 10px;
}


.searchListings > article:hover{
  box-shadow: 0px 2px 6px rgb(33 33 38 / 62%);
}

.searchListings > article > h2{
  text-align: left;
  font-size: 1em;
  margin-top: 20px;
}

.searchListings > article > span{
  color: #c0c0c0;
  font-size: 0.7em;
  margin-top: -10px;
  float: left;
}

</style>