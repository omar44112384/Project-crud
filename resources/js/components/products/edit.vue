<script >
import axios from 'axios';
import { toStatement } from "@babel/types";
import { useRouter } from 'vue-router';
import { onMounted ,ref} from 'vue';

 
export default {
 name: 'edit',
 
 data() {
 return {
 article:{}

 }
 },
 methods: {
 modifierproduit(){
 axios.post(`http://localhost:8000/api/update_product/${this.$route.params.id}`,this.article)
 .then(() => {
 this.$router.push('/')})
 .catch(error => {
 this.errorMessage = error.message;
 console.error("There was an error!", error);})
 },
 


 getOneArticle(){
 axios.get(`http://localhost:8000/api/get_ediy_product/${this.$route.params.id}`).then((res) => {
 this.article = res.data.product;
 });
 }
 },
 created() {
 this.getOneArticle() ;
 },
}
</script>
<template>
<div class="container">
           <form @submit.prevent="modifierproduit">

    <div class="products_edit ">
                <div class="products__create__titlebar dflex justify-content-between align-items-center">
                    <div class="products__create__titlebar--item">
                        
                        <h1 class="my-1">Edit Product</h1>
                    </div>
                    <div class="products__create__titlebar--item">
                        
                    </div>
                </div>

                <div class="products__create__cardWrapper mt-2">
                    <div class="products__create__main">
                        <div class="products__create__main--addInfo card py-2 px-2 bg-white">
                            <p class="mb-1">Name</p>
                            <input type="text" class="input" v-model="article.name">

                            <p class="my-1">Description (optional)</p>
                            <textarea cols="10" rows="5" class="textarea" v-model="article.description" ></textarea>
                            
                            <div class="products__create__main--media--images mt-2">
                                <ul class="products__create__main--media--images--list list-unstyled">
                                    
                                    <li class="products__create__main--media--images--item">
                                        <div class="products__create__main--media--images--item--imgWrapper">
                                            <img class="products__create__main--media--images--item--img" >
                                        </div>
                                    </li>

                                    <!-- upload image small -->
                                    <li class="products__create__main--media--images--item">
                                            <label class="products__create__main--media--images--item--form--label" for="myfile">Add Image</label>
                                            <input class="products__create__main--media--images--item--form--input" type="file" id="myfile"  >
                                    </li>
                                </ul>
                            </div>
                            
                        </div>

                    </div>
                    <div class="products__create__sidebar">
                        <!-- Product Organization -->
                        <div class="card py-2 px-2 bg-white">
                            
                            <!-- Product unit -->
                            <div class="my-3">
                                <p>Product type</p>
                                <input type="text" class="input" v-model="article.type" >
                            </div>
                            <hr>

                            <!-- Product invrntory -->
                            <div class="my-3">
                                <p>Inventory</p>
                                <input type="text" class="input" v-model="article.quantity">
                            </div>
                            <hr>

                            <!-- Product Price -->
                            <div class="my-3">
                                <p>Price</p>
                                <input type="text" class="input" v-model="article.price">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Footer Bar -->
                <div class="dflex justify-content-between align-items-center my-3">
                    <p ></p>
                </div>
              <button class="btn btn-secondary" type="submit">Save</button>
 </div>
</form>
       </div>
                          




</template>